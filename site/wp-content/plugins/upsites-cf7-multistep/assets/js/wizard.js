/**
 * UpSites — motor do formulário multi-step para Contact Form 7.
 *
 * O fatiamento das etapas acontece no SERVIDOR (class-renderer.php). Este
 * arquivo cuida só de comportamento: navegação, validação por etapa, máscara de
 * telefone, captura parcial, envio ao middleware e tela de sucesso.
 *
 * Referência de comportamento: lp_google_ads/index.html, linhas 1922-2380.
 *
 * @package UpSites_CF7MS
 */
(function (window, document) {
  'use strict';

  var CFG = window.UPSITES_CF7MS || {};
  var T = CFG.i18n || {};
  var PREFIXO_RASCUNHO = 'upsites_cf7ms_draft_v1:';

  /* PII em localStorage não deve viver indefinidamente. */
  var VALIDADE_RASCUNHO_MS = 24 * 60 * 60 * 1000;

  /* Sigla do país por DDI. É lista de código telefônico, não copy de marketing:
     mora aqui e não no editor do CF7. Um DDI sem entrada mostra só o código.

     Sigla, e não nome por extenso: num <select> nativo o texto do estado
     fechado é o da opção selecionada, e "Estados Unidos +1" não cabe na
     largura do campo em tela de celular — trunca para "Estados Unido". */
  var PAISES = {
    '+55': 'BR',
    '+351': 'PT',
    '+1': 'US',
    '+54': 'AR',
    '+44': 'GB',
    '+34': 'ES'
  };

  var REGEX_EMAIL = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // -------------------------------------------------------------- utilidades

  function digitos(v) {
    return String(v == null ? '' : v).replace(/\D/g, '');
  }

  function mascaraBR(bruto) {
    var d = digitos(bruto).slice(0, 11);
    if (!d.length) return '';
    if (d.length <= 2) return '(' + d;
    if (d.length <= 6) return '(' + d.slice(0, 2) + ') ' + d.slice(2);
    if (d.length <= 10) return '(' + d.slice(0, 2) + ') ' + d.slice(2, 6) + '-' + d.slice(6);
    return '(' + d.slice(0, 2) + ') ' + d.slice(2, 7) + '-' + d.slice(7);
  }

  /** E.164 sem o "+": só dígitos, com o código do país. Espelha class-telefone.php. */
  function e164(ddi, telefone) {
    var pais = digitos(ddi);
    var nacional = digitos(telefone);
    if (!nacional) return '';
    if (pais && nacional.indexOf(pais) === 0 && nacional.length > pais.length + 7) {
      return nacional;
    }
    return pais + nacional;
  }

  function primeiroNome(nome) {
    return String(nome || '').trim().split(/\s+/)[0] || '';
  }

  // ------------------------------------------------------------------ wizard

  function Wizard(form) {
    this.form = form;
    this.raiz = form.querySelector('[data-upms]');
    this.wizardEl = form.querySelector('[data-upms-wizard]');
    this.sucessoEl = form.querySelector('[data-upms-sucesso]');
    this.etapas = Array.prototype.slice.call(form.querySelectorAll('[data-upms-etapa]'));
    this.indicadores = Array.prototype.slice.call(form.querySelectorAll('[data-upms-indicador] li'));
    this.btnVoltar = form.querySelector('[data-upms-voltar]');
    this.btnAvancar = form.querySelector('[data-upms-avancar]');
    this.btnEnviar = form.querySelector('[data-upms-enviar]');

    this.indice = 0;
    this.tentou = false;
    this.concluido = false;
    this.enviando = false;
    this.leadUid = '';

    this.chave = PREFIXO_RASCUNHO + (form.getAttribute('data-upms-form-id') || this.idDoForm());
  }

  Wizard.prototype.idDoForm = function () {
    var campo = this.form.querySelector('input[name="_wpcf7"]');
    return campo ? campo.value : 'default';
  };

  Wizard.prototype.iniciar = function () {
    if (!this.etapas.length || !this.wizardEl) return;

    this.garantirUid();
    this.decorarDDI();
    this.restaurarRascunho();
    this.ligarEventos();
    this.render();
  };

  // ----------------------------------------------------------- lead_uid

  /**
   * O lead_uid nasce aqui e é o mesmo do rascunho e do envio final — é ele que
   * costura os dois no middleware. Nunca é gerado em PHP: a página é cacheável,
   * e um uid renderizado no servidor seria idêntico para todos os visitantes.
   */
  Wizard.prototype.garantirUid = function () {
    if (this.leadUid) return this.leadUid;

    var salvo = this.lerRascunho();
    this.leadUid = (salvo && salvo.lead_uid) || window.upsitesGenUid();
    this.escreverOculto('lead_uid', this.leadUid);
    this.escreverOculto('origem', CFG.origem || '');

    return this.leadUid;
  };

  Wizard.prototype.escreverOculto = function (nome, valor) {
    var campo = this.form.querySelector('[data-upms-hidden="' + nome + '"]');
    if (campo) campo.value = valor == null ? '' : String(valor);
  };

  // -------------------------------------------------------------- campos

  Wizard.prototype.campo = function (nome) {
    return this.form.querySelector('[name="' + nome + '"]');
  };

  Wizard.prototype.valor = function (nome) {
    var el = this.form.querySelector('[name="' + nome + '"]');
    if (!el) return '';

    if (el.type === 'radio') {
      var marcado = this.form.querySelector('[name="' + nome + '"]:checked');
      return marcado ? marcado.value : '';
    }

    if (el.type === 'checkbox') {
      return el.checked ? el.value || '1' : '';
    }

    return el.value || '';
  };

  Wizard.prototype.dados = function () {
    return {
      nome: this.valor('nome').trim(),
      email: this.valor('email').trim(),
      ddi: this.valor('ddi') || '+55',
      telefone: this.valor('telefone').trim(),
      empresa: this.valor('empresa').trim(),
      site_url: this.valor('site_url').trim(),
      tipo_projeto: this.valor('tipo_projeto'),
      prazo: this.valor('prazo')
    };
  };

  /**
   * Mostra o nome do país junto do código, mantendo o value do <option> como o
   * DDI puro — que é o que o middleware espera receber.
   */
  Wizard.prototype.decorarDDI = function () {
    var select = this.campo('ddi');
    if (!select || select.tagName !== 'SELECT') return;

    Array.prototype.forEach.call(select.options, function (opcao) {
      var pais = PAISES[opcao.value];
      if (pais && opcao.textContent.indexOf(pais) !== 0) {
        opcao.textContent = pais + ' ' + opcao.value;
      }
    });
  };

  // ---------------------------------------------------------- validação

  /**
   * Valida uma etapa reaproveitando o que o CF7 já declara no HTML:
   * aria-required nos campos obrigatórios e as classes wpcf7-validates-as-*.
   * Assim a regra continua vindo do form-tag no wp-admin, não daqui.
   */
  Wizard.prototype.validarEtapa = function (indice) {
    var etapa = this.etapas[indice];
    var erros = [];
    var self = this;

    if (!etapa) return erros;

    Array.prototype.forEach.call(
      etapa.querySelectorAll('input, select, textarea'),
      function (el) {
        if (el.type === 'hidden' || el.type === 'radio' || el.disabled) return;

        var obrigatorio = el.getAttribute('aria-required') === 'true' ||
          el.classList.contains('wpcf7-validates-as-required');
        var v = String(el.value || '').trim();

        if (obrigatorio && !v) {
          erros.push({ el: el, msg: T.campoObrig || 'Preencha este campo.' });
          return;
        }

        if (!v) return;

        if (el.name === 'nome' && v.length < 2) {
          erros.push({ el: el, msg: T.nomeInvalido });
          return;
        }

        if (el.classList.contains('wpcf7-validates-as-email') && !REGEX_EMAIL.test(v)) {
          erros.push({ el: el, msg: T.emailInvalido });
          return;
        }

        if (el.name === 'telefone') {
          var minimo = self.valor('ddi') === '+55' ? 10 : 8;
          if (digitos(v).length < minimo) {
            erros.push({ el: el, msg: T.foneInvalido });
          }
        }
      }
    );

    // Grupos de opção obrigatórios. O CF7 não tem [radio*]; a marcação vem de
    // class:up-obrigatorio na form-tag e é validada também no servidor.
    Array.prototype.forEach.call(
      etapa.querySelectorAll('.wpcf7-radio.up-obrigatorio'),
      function (grupo) {
        if (!grupo.querySelector('input[type="radio"]:checked')) {
          erros.push({ el: grupo, msg: T.escolhaOpcao });
        }
      }
    );

    return erros;
  };

  Wizard.prototype.limparErros = function (escopo) {
    Array.prototype.forEach.call(
      (escopo || this.form).querySelectorAll('.wpcf7-not-valid-tip[data-upms-erro]'),
      function (el) {
        el.parentNode.removeChild(el);
      }
    );

    Array.prototype.forEach.call(
      (escopo || this.form).querySelectorAll('[data-upms-marcado]'),
      function (el) {
        el.classList.remove('wpcf7-not-valid');
        el.removeAttribute('aria-invalid');
        el.removeAttribute('data-upms-marcado');
      }
    );
  };

  /** Usa as MESMAS classes do CF7: uma folha de estilo cobre os dois caminhos. */
  Wizard.prototype.mostrarErro = function (el, msg) {
    el.classList.add('wpcf7-not-valid');
    el.setAttribute('data-upms-marcado', '1');

    if (el.tagName !== 'SPAN') {
      el.setAttribute('aria-invalid', 'true');
    }

    var dica = document.createElement('span');
    dica.className = 'wpcf7-not-valid-tip';
    dica.setAttribute('role', 'alert');
    dica.setAttribute('aria-live', 'polite');
    dica.setAttribute('data-upms-erro', '1');
    dica.textContent = msg;

    var alvo = el.closest('.wpcf7-form-control-wrap') || el.parentNode;
    alvo.parentNode.insertBefore(dica, alvo.nextSibling);
  };

  // ---------------------------------------------------------- navegação

  Wizard.prototype.avancar = function () {
    var erros = this.validarEtapa(this.indice);

    this.tentou = true;
    this.limparErros(this.etapas[this.indice]);

    if (erros.length) {
      var self = this;
      erros.forEach(function (e) {
        self.mostrarErro(e.el, e.msg);
      });

      var primeiro = erros[0].el;
      try {
        primeiro.focus({ preventScroll: true });
      } catch (e) { /* SPAN não é focável */ }
      try {
        primeiro.scrollIntoView({ block: 'center', behavior: 'smooth' });
      } catch (e) { /* ignora */ }

      return;
    }

    // A etapa validou: persiste o rascunho antes de seguir.
    this.enviarRascunho();
    this.renovarRecaptcha();

    if (this.indice >= this.etapas.length - 1) {
      this.submeter();
      return;
    }

    this.indice += 1;
    this.tentou = false;
    this.render();
  };

  Wizard.prototype.voltar = function () {
    if (this.indice === 0) return;
    this.indice -= 1;
    this.tentou = false;
    this.render();
  };

  Wizard.prototype.irPara = function (indice) {
    if (indice < 0 || indice >= this.etapas.length) return;
    this.indice = indice;
    this.render();
  };

  Wizard.prototype.render = function () {
    var self = this;
    var ultima = this.indice >= this.etapas.length - 1;

    this.etapas.forEach(function (etapa, i) {
      if (i === self.indice) {
        etapa.removeAttribute('hidden');
      } else {
        etapa.setAttribute('hidden', 'hidden');
      }
    });

    this.indicadores.forEach(function (li, i) {
      li.classList.toggle('is-atual', i === self.indice);
      li.classList.toggle('is-concluida', i < self.indice);
      if (i === self.indice) {
        li.setAttribute('aria-current', 'step');
      } else {
        li.removeAttribute('aria-current');
      }
    });

    if (this.btnVoltar) {
      if (this.indice === 0) {
        this.btnVoltar.setAttribute('hidden', 'hidden');
      } else {
        this.btnVoltar.removeAttribute('hidden');
      }
    }

    // Na última etapa o botão nativo do CF7 assume: o submit continua sendo do
    // CF7, sem evento sintético.
    if (this.btnAvancar) {
      this.btnAvancar.toggleAttribute('hidden', ultima);
    }
    if (this.btnEnviar) {
      this.btnEnviar.toggleAttribute('hidden', !ultima);
    }

    this.focarEtapa();
  };

  Wizard.prototype.focarEtapa = function () {
    var etapa = this.etapas[this.indice];
    if (!etapa) return;

    var titulo = etapa.querySelector('.upms__titulo');
    if (titulo && this.jaRenderizouUmaVez) {
      try {
        titulo.focus({ preventScroll: true });
      } catch (e) { /* ignora */ }
    }

    this.jaRenderizouUmaVez = true;
  };

  // ------------------------------------------------------------ rascunho

  Wizard.prototype.lerRascunho = function () {
    try {
      var bruto = window.localStorage.getItem(this.chave);
      if (!bruto) return null;

      var d = JSON.parse(bruto);
      if (!d || typeof d !== 'object') return null;

      if (d.saved_at && Date.now() - d.saved_at > VALIDADE_RASCUNHO_MS) {
        window.localStorage.removeItem(this.chave);
        return null;
      }

      return d;
    } catch (e) {
      return null;
    }
  };

  Wizard.prototype.gravarRascunho = function () {
    try {
      var d = this.dados();
      d.lead_uid = this.leadUid;
      d.saved_at = Date.now();
      window.localStorage.setItem(this.chave, JSON.stringify(d));
    } catch (e) { /* modo privado, cota estourada */ }
  };

  Wizard.prototype.limparRascunho = function () {
    try {
      window.localStorage.removeItem(this.chave);
    } catch (e) { /* ignora */ }
  };

  Wizard.prototype.restaurarRascunho = function () {
    var d = this.lerRascunho();
    if (!d) return;

    var self = this;

    ['nome', 'email', 'ddi', 'telefone', 'empresa', 'site_url'].forEach(function (nome) {
      var el = self.campo(nome);
      if (el && d[nome]) el.value = d[nome];
    });

    ['tipo_projeto', 'prazo'].forEach(function (nome) {
      if (!d[nome]) return;
      var opcao = self.form.querySelector('[name="' + nome + '"][value="' + window.CSS.escape(d[nome]) + '"]');
      if (opcao) {
        opcao.checked = true;
        self.marcarEscolha(opcao);
      }
    });

    this.atualizarDicaCelular();
  };

  /**
   * Envia o estado atual ao middleware.
   *
   * Piso: só dispara quando nome, e-mail e telefone já são válidos — é o mínimo
   * que o middleware exige para promover um rascunho a lead. Quem desiste antes
   * disso não gera registro, e sempre foi assim.
   *
   * NÃO existe timer aqui. O gatilho de tempo é do middleware: um sweep a cada
   * 60s promove rascunhos parados há mais de 180s. Adicionar um setTimeout no
   * cliente duplicaria o comportamento e criaria leads fantasma.
   */
  Wizard.prototype.enviarRascunho = function (usarBeacon) {
    if (!CFG.rascunhoAtivo || this.concluido) return;

    var d = this.dados();

    if (d.nome.length < 2 || !REGEX_EMAIL.test(d.email)) return;
    if (digitos(d.telefone).length < (d.ddi === '+55' ? 10 : 8)) return;

    this.gravarRascunho();

    var payload = this.montarPayload(d, this.indice + 1);
    var url = CFG.endpoint + '/rascunho';

    try {
      if (usarBeacon && navigator.sendBeacon) {
        // text/plain torna a requisição "simples": sem preflight, que o browser
        // não completaria durante o unload. O middleware faz get_json(force=True)
        // justamente por causa disso.
        navigator.sendBeacon(url, new Blob([JSON.stringify(payload)], { type: 'text/plain' }));
      } else {
        window.fetch(url, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload),
          keepalive: true
        })['catch'](function () { /* rascunho é best-effort */ });
      }
    } catch (e) { /* ignora */ }
  };

  Wizard.prototype.montarPayload = function (d, etapa) {
    var consentiu = true;
    var check = this.form.querySelector('[name="consentimento"]');
    if (check) consentiu = !!check.checked;

    var tracking = window.upsitesTracking ? window.upsitesTracking() : {};

    var payload = {
      lead_uid: this.leadUid,
      origem: CFG.origem || '',
      etapa: etapa,
      nome: d.nome,
      email: d.email,
      ddi: d.ddi,
      telefone: e164(d.ddi, d.telefone),
      empresa: d.empresa || '',
      site_url: d.site_url || '',
      tipo_projeto: d.tipo_projeto || '',
      prazo: d.prazo || '',
      consentimento: consentiu,
      consentimento_texto: (CFG.consentimento || {}).texto || '',
      consentimento_versao: (CFG.consentimento || {}).versao || ''
    };

    Object.keys(tracking).forEach(function (k) {
      payload[k] = tracking[k];
    });

    return payload;
  };

  // -------------------------------------------------------------- envio

  Wizard.prototype.submeter = function () {
    if (this.enviando) return;

    this.enviando = true;

    if (this.btnEnviar) {
      this.btnEnviar.setAttribute('aria-disabled', 'true');
      this.btnEnviar.disabled = true;
      this.rotuloEnviar = this.btnEnviar.value || this.btnEnviar.textContent;
      if ('value' in this.btnEnviar) {
        this.btnEnviar.value = T.enviando || 'Enviando…';
      }
    }

    // Espelha o E.164 num campo oculto para o e-mail do CF7 e o Flamingo terem
    // o telefone canônico, e não só o mascarado.
    var d = this.dados();
    this.escreverOculto('telefone_e164', e164(d.ddi, d.telefone));
    this.espelharTracking();

    // Submit NATIVO do CF7: ele valida, roda honeypot e reCAPTCHA, e dispara os
    // eventos wpcf7*. Nada de XHR próprio.
    if (this.btnEnviar) {
      this.btnEnviar.disabled = false;
      this.btnEnviar.click();
      this.btnEnviar.disabled = true;
    } else if (typeof this.form.requestSubmit === 'function') {
      this.form.requestSubmit();
    } else {
      this.form.submit();
    }
  };

  Wizard.prototype.espelharTracking = function () {
    var t = window.upsitesTracking ? window.upsitesTracking() : {};
    var self = this;

    Object.keys(t).forEach(function (k) {
      self.escreverOculto(k, t[k]);
    });
  };

  Wizard.prototype.reabilitarEnvio = function () {
    this.enviando = false;

    if (!this.btnEnviar) return;

    this.btnEnviar.disabled = false;
    this.btnEnviar.removeAttribute('aria-disabled');

    if ('value' in this.btnEnviar && this.rotuloEnviar) {
      this.btnEnviar.value = this.rotuloEnviar;
    }
  };

  /**
   * POST final ao middleware.
   *
   * 207 (partial_success) É sucesso, e `fetch` o trata como ok === false — daí a
   * checagem explícita. Errar isso descarta lead bom como se tivesse falhado.
   */
  Wizard.prototype.enviarAoMiddleware = function (d) {
    var payload = this.montarPayload(d, this.etapas.length);

    return window
      .fetch(CFG.endpoint, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
        keepalive: true
      })
      .then(function (r) {
        return r.ok || r.status === 207;
      })['catch'](function () {
        return false;
      });
  };

  /**
   * @param {Object} instantaneo Valores lidos de event.detail.inputs.
   */
  Wizard.prototype.aoEnviar = function (instantaneo) {
    var self = this;
    var d = instantaneo;
    var api = window.UpSitesTracking || {};

    this.concluido = true;
    this.reabilitarEnvio();

    // A tela de sucesso aparece já: o middleware corre em segundo plano. A LP
    // esperava o fetch antes de mostrar, e podia deixar o visitante olhando um
    // spinner enquanto o CRM era chamado.
    this.mostrarSucesso(d);
    this.limparRascunho();

    var dispararNoCF7 = (CFG.conversao || {}).quando === 'cf7';

    if (dispararNoCF7) {
      this.dispararConversoes(d);
    }

    this.enviarAoMiddleware(d).then(function (ok) {
      if (ok) {
        if (!dispararNoCF7) self.dispararConversoes(d);
      } else if (api.falhaDeEnvio) {
        api.falhaDeEnvio(CFG.origem || 'site');
      }
    });
  };

  Wizard.prototype.dispararConversoes = function (d) {
    var api = window.UpSitesTracking || {};
    var partes = String(d.nome || '').trim().split(/\s+/);

    if (api.conversaoLead) {
      api.conversaoLead({
        email: d.email,
        phone: '+' + e164(d.ddi, d.telefone),
        firstName: partes[0] || '',
        lastName: partes.slice(1).join(' ') || '',
        source: CFG.origem || 'site',
        value: (CFG.conversao || {}).valor
      });
    }

    if (api.conversaoOpenAI) {
      api.conversaoOpenAI(CFG.origem || 'site', this.leadUid);
    }
  };

  // ------------------------------------------------------------ sucesso

  Wizard.prototype.mostrarSucesso = function (d) {
    if (!this.sucessoEl) return;

    this.wizardEl.setAttribute('hidden', 'hidden');
    this.sucessoEl.removeAttribute('hidden');

    var nome = primeiroNome(d.nome);

    var msg = this.sucessoEl.querySelector('[data-upms-sucesso-msg]');
    if (msg) {
      msg.textContent = String(CFG.sucessoMensagem || '').replace(/\{primeiro_nome\}/g, nome);
    }

    this.montarRecap(d);
    this.montarWhatsApp(d, nome);

    var titulo = this.sucessoEl.querySelector('.upms__sucesso-titulo');
    if (titulo) {
      try {
        titulo.focus({ preventScroll: true });
      } catch (e) { /* ignora */ }
      try {
        titulo.scrollIntoView({ block: 'center' });
      } catch (e) { /* ignora */ }
    }
  };

  Wizard.prototype.montarRecap = function (d) {
    var recap = this.sucessoEl.querySelector('[data-upms-recap]');
    if (!recap) return;

    var contato = ((d.ddi ? d.ddi + ' ' : '') + (d.telefone || '')).trim();
    if (d.email) contato += (contato ? '  ·  ' : '') + d.email;

    // tipo_projeto e prazo já são o label legível — o [radio] vai sem pipes de
    // propósito. Nada de tabela de tradução aqui.
    var mapa = {
      nome: [T.labelNome, d.nome],
      telefone: [T.labelContato, contato],
      email: null,
      empresa: [T.labelEmpresa, d.empresa || T.pessoaFisica],
      site_url: [T.labelSite, d.site_url || T.semSite],
      tipo_projeto: [T.labelProjeto, d.tipo_projeto],
      prazo: [T.labelPrazo, d.prazo]
    };

    var linhas = [];

    (CFG.recapCampos || []).forEach(function (campo) {
      var par = mapa[campo];
      if (!par || !par[1]) return;
      linhas.push(par);
    });

    recap.innerHTML = '';

    linhas.forEach(function (par) {
      var linha = document.createElement('div');
      linha.className = 'upms__recap-linha';

      var dt = document.createElement('dt');
      dt.textContent = par[0];

      var dd = document.createElement('dd');
      dd.textContent = par[1];

      linha.appendChild(dt);
      linha.appendChild(dd);
      recap.appendChild(linha);
    });
  };

  Wizard.prototype.montarWhatsApp = function (d, nome) {
    var cta = this.sucessoEl.querySelector('[data-upms-whatsapp]');
    if (!cta) return;

    if (!CFG.whatsappNumero) {
      cta.setAttribute('hidden', 'hidden');
      return;
    }

    var texto = String(CFG.whatsappMensagem || '')
      .replace(/\{primeiro_nome\}/g, nome)
      .replace(/\{tipo_projeto\}/g, d.tipo_projeto || '');

    cta.href = 'https://api.whatsapp.com/send/?phone=' + CFG.whatsappNumero +
      '&text=' + encodeURIComponent(texto);
  };

  Wizard.prototype.reiniciar = function () {
    this.form.reset();
    this.limparRascunho();
    this.limparErros();

    this.leadUid = '';
    this.concluido = false;
    this.indice = 0;
    this.tentou = false;

    Array.prototype.forEach.call(
      this.form.querySelectorAll('.wpcf7-list-item.is-selecionado'),
      function (el) {
        el.classList.remove('is-selecionado');
      }
    );

    this.garantirUid();

    if (this.sucessoEl) this.sucessoEl.setAttribute('hidden', 'hidden');
    this.wizardEl.removeAttribute('hidden');
    this.form.classList.remove('sent');

    this.render();
  };

  // ------------------------------------------------------------- eventos

  Wizard.prototype.marcarEscolha = function (input) {
    var grupo = input.closest('.wpcf7-radio');
    if (!grupo) return;

    Array.prototype.forEach.call(grupo.querySelectorAll('.wpcf7-list-item'), function (item) {
      item.classList.remove('is-selecionado');
    });

    var item = input.closest('.wpcf7-list-item');
    if (item) item.classList.add('is-selecionado');
  };

  Wizard.prototype.atualizarDicaCelular = function () {
    var dica = this.form.querySelector('[data-upms-dica="celular"]');
    if (!dica) return;

    var d = digitos(this.valor('telefone'));
    var ehCelular = this.valor('ddi') === '+55' && d.length === 11 && d[2] === '9';

    if (ehCelular) {
      dica.removeAttribute('hidden');
    } else {
      dica.setAttribute('hidden', 'hidden');
    }
  };

  Wizard.prototype.ligarEventos = function () {
    var self = this;

    if (this.btnAvancar) {
      this.btnAvancar.addEventListener('click', function () {
        self.avancar();
      });
    }

    if (this.btnVoltar) {
      this.btnVoltar.addEventListener('click', function () {
        self.voltar();
      });
    }

    // O botão de envio é o do CF7. Interceptamos para validar a última etapa
    // antes de deixar o submit acontecer.
    if (this.btnEnviar) {
      this.btnEnviar.addEventListener('click', function (ev) {
        if (self.enviando) return;

        var erros = self.validarEtapa(self.indice);
        if (erros.length) {
          ev.preventDefault();
          self.avancar();
          return;
        }

        self.enviarRascunho();
        var d = self.dados();
        self.escreverOculto('telefone_e164', e164(d.ddi, d.telefone));
        self.espelharTracking();
        self.enviando = true;
      });
    }

    var reiniciar = this.form.querySelector('[data-upms-reiniciar]');
    if (reiniciar) {
      reiniciar.addEventListener('click', function () {
        self.reiniciar();
      });
    }

    // Máscara, dica de celular e persistência.
    var tel = this.campo('telefone');
    if (tel) {
      tel.addEventListener('input', function () {
        if (self.valor('ddi') === '+55') {
          var pos = tel.selectionStart === tel.value.length;
          tel.value = mascaraBR(tel.value);
          if (pos) {
            try {
              tel.setSelectionRange(tel.value.length, tel.value.length);
            } catch (e) { /* ignora */ }
          }
        }
        self.atualizarDicaCelular();
        self.gravarRascunho();
      });
    }

    var ddi = this.campo('ddi');
    if (ddi) {
      ddi.addEventListener('change', function () {
        if (tel && self.valor('ddi') === '+55') {
          tel.value = mascaraBR(tel.value);
        }
        self.atualizarDicaCelular();
        self.gravarRascunho();
      });
    }

    this.form.addEventListener('input', function (ev) {
      if (ev.target && ev.target.name && ev.target.name !== 'telefone') {
        self.gravarRascunho();
      }
    });

    this.form.addEventListener('change', function (ev) {
      if (ev.target && ev.target.type === 'radio') {
        self.marcarEscolha(ev.target);
        self.limparErros(self.etapas[self.indice]);
        self.gravarRascunho();
      }
    });

    // Enter avança a etapa em vez de submeter no meio do wizard.
    this.form.addEventListener('keydown', function (ev) {
      if (ev.key !== 'Enter') return;
      if (ev.target && ev.target.tagName === 'TEXTAREA') return;

      var ultima = self.indice >= self.etapas.length - 1;
      if (!ultima) {
        ev.preventDefault();
        self.avancar();
      }
    });

    // Mobile: o campo focado não pode ficar atrás do teclado virtual. O atraso
    // dá tempo do teclado assentar; 'nearest' evita salto brusco no modal.
    Array.prototype.forEach.call(
      this.form.querySelectorAll('input, select, textarea'),
      function (el) {
        el.addEventListener('focus', function () {
          window.setTimeout(function () {
            try {
              el.scrollIntoView({ block: 'nearest' });
            } catch (e) { /* ignora */ }
          }, 300);
        });
      }
    );
  };

  /**
   * Regera o token do reCAPTCHA v3.
   *
   * O token vale cerca de dois minutos. Num wizard de quatro etapas o visitante
   * passa disso com facilidade e o CF7 rejeitaria o envio como spam. Regerar a
   * cada avanço mantém o token com poucos segundos de idade no submit.
   */
  Wizard.prototype.renovarRecaptcha = function () {
    if (!CFG.recaptchaSitekey || !window.grecaptcha || !window.grecaptcha.execute) return;

    var self = this;

    try {
      window.grecaptcha.execute(CFG.recaptchaSitekey, { action: 'wpcf7' }).then(function (token) {
        var campo = self.form.querySelector('input[name="_wpcf7_recaptcha_response"]');
        if (campo) campo.value = token;
      });
    } catch (e) { /* reCAPTCHA indisponível não pode travar o wizard */ }
  };

  // ---------------------------------------------------------------- modal

  function ligarModal(wizards) {
    var modal = document.querySelector('[data-upms-modal]');
    if (!modal) return;

    var seletor = CFG.gatilhoSeletor || '';

    function abrir(ev) {
      if (ev) ev.preventDefault();

      if (typeof modal.showModal === 'function') {
        if (!modal.open) modal.showModal();
      } else {
        modal.setAttribute('open', 'open');
      }

      document.body.style.overflow = 'hidden';
    }

    function fechar() {
      wizards.forEach(function (w) {
        if (!w.concluido) w.enviarRascunho();
      });

      if (typeof modal.close === 'function' && modal.open) {
        modal.close();
      } else {
        modal.removeAttribute('open');
      }

      document.body.style.overflow = '';
    }

    // Delegação: pega CTAs que o tema injeta depois do carregamento.
    document.addEventListener('click', function (ev) {
      var alvo = ev.target.closest('[data-upms-abrir]');

      if (!alvo && seletor) {
        try {
          alvo = ev.target.closest(seletor);
        } catch (e) {
          alvo = null; // seletor inválido configurado no painel
        }
      }

      if (alvo) abrir(ev);
    });

    Array.prototype.forEach.call(modal.querySelectorAll('[data-upms-fechar]'), function (b) {
      b.addEventListener('click', fechar);
    });

    // Clique no backdrop: no <dialog>, o alvo é o próprio dialog.
    modal.addEventListener('click', function (ev) {
      if (ev.target === modal) fechar();
    });

    // Esc é tratado pelo <dialog>; o 'close' cobre os dois caminhos.
    modal.addEventListener('close', function () {
      wizards.forEach(function (w) {
        if (!w.concluido) w.enviarRascunho();
      });
      document.body.style.overflow = '';
    });

    window.UpSitesFormulario = { abrir: abrir, fechar: fechar };
  }

  // ----------------------------------------------------------------- boot

  function iniciar() {
    var forms = Array.prototype.slice.call(document.querySelectorAll('form.upms-form'));
    if (!forms.length) return;

    var wizards = forms.map(function (form) {
      var w = new Wizard(form);
      w.iniciar();
      form.upsitesWizard = w;
      return w;
    });

    function doWizard(ev) {
      var form = ev.target.querySelector ? ev.target.querySelector('form.upms-form') : null;
      if (!form && ev.target.classList && ev.target.classList.contains('upms-form')) {
        form = ev.target;
      }
      return form ? form.upsitesWizard : null;
    }

    document.addEventListener('wpcf7mailsent', function (ev) {
      var w = doWizard(ev);
      if (!w) return;

      var snap = {};
      (ev.detail.inputs || []).forEach(function (i) {
        snap[i.name] = i.value;
      });

      // O snapshot vem do evento porque o CF7 dá form.reset() logo depois: ler
      // o DOM aqui devolveria campos vazios.
      w.aoEnviar({
        nome: snap.nome || '',
        email: snap.email || '',
        ddi: snap.ddi || '+55',
        telefone: snap.telefone || '',
        empresa: snap.empresa || '',
        site_url: snap.site_url || '',
        tipo_projeto: snap.tipo_projeto || '',
        prazo: snap.prazo || ''
      });
    });

    // O envio foi válido; só o SMTP falhou. O lead é real — segue para o
    // middleware e mostra a tela de sucesso.
    document.addEventListener('wpcf7mailfailed', function (ev) {
      var w = doWizard(ev);
      if (!w) return;

      var snap = {};
      (ev.detail.inputs || []).forEach(function (i) {
        snap[i.name] = i.value;
      });

      w.aoEnviar({
        nome: snap.nome || '',
        email: snap.email || '',
        ddi: snap.ddi || '+55',
        telefone: snap.telefone || '',
        empresa: snap.empresa || '',
        site_url: snap.site_url || '',
        tipo_projeto: snap.tipo_projeto || '',
        prazo: snap.prazo || ''
      });
    });

    document.addEventListener('wpcf7invalid', function (ev) {
      var w = doWizard(ev);
      if (!w) return;

      w.reabilitarEnvio();

      // Leva o visitante à etapa do primeiro campo que o servidor recusou.
      var invalido = w.form.querySelector('.wpcf7-not-valid');
      if (!invalido) return;

      var etapa = invalido.closest('[data-upms-etapa]');
      if (etapa) {
        w.irPara(parseInt(etapa.getAttribute('data-upms-etapa'), 10) || 0);
      }
    });

    document.addEventListener('wpcf7spam', function (ev) {
      var w = doWizard(ev);
      if (!w) return;

      w.reabilitarEnvio();
      w.renovarRecaptcha();
    });

    // Abandono. sendBeacon porque o fetch não sobrevive ao unload.
    window.addEventListener('pagehide', function () {
      wizards.forEach(function (w) {
        if (!w.concluido) w.enviarRascunho(true);
      });
    });

    document.addEventListener('visibilitychange', function () {
      if (document.visibilityState !== 'hidden') return;
      wizards.forEach(function (w) {
        if (!w.concluido) w.enviarRascunho(true);
      });
    });

    ligarModal(wizards);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', iniciar);
  } else {
    iniciar();
  }
})(window, document);
