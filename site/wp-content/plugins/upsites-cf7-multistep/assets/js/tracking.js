/**
 * Captura e persistência de origem do lead + conversões de anúncio.
 *
 * Porte fiel do bloco inline da landing page de Google Ads
 * (lp_google_ads/index.html, linhas 16-105). As chaves de localStorage usam o
 * mesmo prefixo `_upsites_`, mas NÃO são compartilhadas com a LP: localStorage
 * é isolado por origem, e lp.upsites.digital é outra origem.
 *
 * Este arquivo é enfileirado em TODAS as páginas, de propósito. Ele grava o
 * first-touch (referrer externo e landing page da primeira visita). Carregá-lo
 * só onde o formulário aparece perderia a atribuição de quem chega por anúncio,
 * navega pelo site e só depois pede orçamento.
 *
 * @package UpSites_CF7MS
 */
(function (window, document) {
  'use strict';

  var PREFIXO = '_upsites_';

  /* Click IDs e UTMs em last-touch: sobrescrevem quando presentes na URL. */
  var PARAMETROS = [
    'gclid', 'gad_source', 'gad_campaignid', 'gbraid', 'wbraid',
    'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'
  ];

  function ler(chave) {
    try {
      return window.localStorage.getItem(PREFIXO + chave) || '';
    } catch (e) {
      return '';
    }
  }

  function gravar(chave, valor) {
    try {
      window.localStorage.setItem(PREFIXO + chave, valor);
    } catch (e) {
      /* modo privado, cota estourada: seguir sem tracking persistido */
    }
  }

  function capturar() {
    var url = new URLSearchParams(window.location.search);

    PARAMETROS.forEach(function (p) {
      var v = url.get(p);
      if (v) {
        gravar(p, v);
        gravar(p + '_time', String(Date.now()));
      }
    });

    /* First-touch: só grava se ainda não existir. */
    try {
      if (!ler('referrer')) {
        var ref = document.referrer || '';
        if (ref && ref.indexOf(window.location.hostname) === -1) {
          gravar('referrer', ref);
        }
      }
      if (!ler('landing_url')) {
        gravar('landing_url', window.location.href);
      }
    } catch (e) {
      /* ignora */
    }
  }

  /**
   * Origem REAL do lead.
   *
   * Lê o parâmetro da URL e, na falta, o persistido. NUNCA inventa google/cpc:
   * devolve vazio quando não há sinal, para o middleware derivar o canal de fato
   * (pago, social, referral, direto/orgânico).
   */
  function tracking() {
    var url = new URLSearchParams(window.location.search);
    var atual = function (k) {
      return url.get(k) || ler(k) || '';
    };

    return {
      gclid: atual('gclid'),
      gbraid: atual('gbraid'),
      wbraid: atual('wbraid'),
      utm_source: atual('utm_source'),
      utm_medium: atual('utm_medium'),
      utm_campaign: atual('utm_campaign'),
      utm_term: atual('utm_term'),
      utm_content: atual('utm_content'),
      referrer: ler('referrer'),
      landing_url: ler('landing_url') || window.location.href
    };
  }

  /** UID de tentativa: liga o rascunho parcial ao envio final. */
  function gerarUid() {
    try {
      if (window.crypto && window.crypto.randomUUID) {
        return window.crypto.randomUUID();
      }
    } catch (e) {
      /* ignora */
    }
    return 'uid-' + Date.now().toString(36) + '-' + Math.random().toString(36).slice(2, 10);
  }

  /**
   * Enhanced Conversion do Google Ads, via dataLayer.
   *
   * Chamar SÓ no sucesso real do envio. Disparar em toda tentativa envenenaria
   * o Smart Bidding com conversões que nunca viraram lead.
   */
  function conversaoLead(dados) {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
      event: 'generate_lead',
      enhanced_conversion_data: {
        email: dados.email || '',
        phone_number: dados.phone || '',
        first_name: dados.firstName || '',
        last_name: dados.lastName || ''
      },
      lead_source: dados.source || 'unknown',
      conversion_value: typeof dados.value === 'number' ? dados.value : 200
    });
  }

  /**
   * Conversão do OpenAI Ads.
   *
   * event_id = lead_uid (o mesmo id do middleware) para deduplicar caso um dia
   * a mesma conversão seja enviada server-side pela Conversions API.
   *
   * O pixel `oaiq` ainda NÃO existe no site principal — o guard abaixo faz esta
   * chamada virar no-op silencioso até ele ser adicionado via GTM.
   */
  function conversaoOpenAI(origem, leadUid) {
    try {
      if (typeof window.oaiq !== 'function') {
        return;
      }
      window.oaiq(
        'measure',
        'lead_created',
        { type: 'customer_action' },
        leadUid ? { event_id: leadUid } : undefined
      );
    } catch (e) {
      /* pixel indisponível não pode quebrar o envio */
    }
  }

  /** Sinaliza falha de envio, para não confundir com ausência de tentativa. */
  function falhaDeEnvio(origem) {
    try {
      window.dataLayer = window.dataLayer || [];
      window.dataLayer.push({ event: 'lead_submit_failed', source: origem });
    } catch (e) {
      /* ignora */
    }
  }

  capturar();

  window.upsitesTracking = tracking;
  window.upsitesGenUid = gerarUid;
  window.UpSitesTracking = {
    tracking: tracking,
    gerarUid: gerarUid,
    conversaoLead: conversaoLead,
    conversaoOpenAI: conversaoOpenAI,
    falhaDeEnvio: falhaDeEnvio
  };
})(window, document);
