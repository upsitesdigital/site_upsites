---
name: performance
description: Áreas de risco de performance conhecidas no tema upsites (site institucional da UpSites Digital) — pastas de imagens grandes, sem dicas manuais de lazy-loading/fetchpriority, build tooling legado (gulp/webpack), filtros de plugin de SEO mortos, webp tratado por plugins e não pelo código do tema. Use ao investigar notas do PageSpeed/Lighthouse, carregamento lento de páginas, ou antes de adicionar novas imagens/assets.
---

# Notas de performance para o tema upsites

## Produção (novo.siteup.dev) tem plugins que o ambiente local não tem

Relatório real do Lighthouse mobile contra produção (2026-07-11, Moto G Power emulado, 4G lento):
Desempenho 85, LCP 3.3s, FCP 3.0s, TBT 30ms, CLS 0.036, SI 4.3s. Revelou plugins ativos em
produção que **não existem no ambiente local** — mais um caso como o Yoast×Rank Math (ver seção
de SEO abaixo): **CleanTalk (Anti-Spam by CleanTalk, prefixo interno "apbct")**, carregando
`apbct-public-bundle.min.js` (~20KB) de forma bloqueante bem no meio do caminho crítico de LCP,
mais CSS (`cleantalk-public.min.css`, `cleantalk-email-decoder.min.css`) e uma chamada
cross-origin pro `cleantalk.org` (bot-detector-wrapper.js). Não dá pra testar mudanças nesse
plugin localmente porque ele simplesmente não está instalado aqui — qualquer fix precisa ser
validado em produção após deploy. Corrigido (não testado localmente, só por análise de código):
filtro `script_loader_tag` em `upsites/functions.php` (perto de `US_remove_type_attr`) que
adiciona `defer` em qualquer script cujo handle/src contenha `apbct`/`cleantalk`.

Sempre que for investigar performance a partir de um relatório do Lighthouse/PSI rodado contra
produção, **não assuma que a lista de plugins do ambiente local é a mesma** — confira o relatório
por nomes de arquivo/handle que não reconhece antes de concluir que algo "não existe" no site.

## LCP: TTFB domina tudo — não otimize o resto sem checar isso primeiro

Medido ao vivo (2026-07): TTFB da home ~2.5-2.6s via `curl` puro (sem overhead de browser).
Instrumentando os hooks do WP com um mu-plugin temporário, **81% desse tempo é bootstrap do
WordPress/plugins antes do tema sequer começar a renderizar** — ~700ms só carregando os
arquivos dos 18 plugins ativos, ~336ms no hook `plugins_loaded`, ~854ms no hook `init` (CPTs,
taxonomias, ACF — provavelmente pesado por causa de `customizer-register.php`, 12k+ linhas). O
render do template em si (`home-old.php`) é só ~233ms (10% do total). As queries de banco somam
só ~133ms de 2417ms medidos via CLI — não é gargalo de banco.

Causa mais provável: **OPcache do PHP está desligado** (`php -m` não lista `Zend OPcache`,
`php.ini` não tem `zend_extension=opcache`) — todo request recompila WordPress core + ACF Pro +
Yoast + 2 plugins de tradução do zero. Decisão consciente (2026-07): não mexer nisso agora,
porque é config de `php.ini` compartilhada com outros projetos nesse XAMPP — se for reabrir esse
assunto, é a intervenção de maior impacto disponível, mas fica fora do escopo de mudanças só no
tema. Um teste via CLI (`php -d opcache.enable_cli=1 ...`) não é representativo do ganho real
(CLI não compartilha o cache entre processos como o mod_php do Apache faz) — não tirar conclusão
de testes assim.

**Dado isso, qualquer otimização de LCP feita só no nível do tema (preload, fontes, imagem) tem
teto baixo** — o TTFB de ~2.5s acontece antes de qualquer coisa do HTML ser processada. Ainda
assim, valem a pena por reduzirem o trabalho do browser depois que o HTML chega.

## Google Fonts — 3 famílias pedidas, só 1 e meia realmente usadas (corrigido)

`header.php` e `header-land.php` pediam `Inter:wght@100..900` + `Montserrat` (100-900 + itálico,
~18 variantes) + `Ubuntu` (100-900 + itálico, ~8 variantes) via um único `<link rel="stylesheet"
href="fonts.googleapis.com/css2?...">` bloqueante. Conferido via grep em `src/sass/**/*.scss`:
- **Ubuntu: zero uso em qualquer lugar** (nem como `$font-*`, nem como string literal em SCSS
  ativo — só sobrava numa linha comentada em `_fonts.scss` e nos headers `-bkp`).
- **Montserrat (`$font-alt`)**: usado em 4 lugares específicos (`_page.scss`, `_post-internal.scss`)
  e — **correção, achado depois de já ter feito o fix abaixo**: também sitewide, para **todos os
  headings `h1`-`h6`**, via `core/_fonts.scss` (`font-family: $font-alt; font-weight: normal;`),
  que é importado só por `structure.scss`, não por `home.scss`/`_landing.scss` diretamente — mas
  `structure.min.css` é enfileirado em **toda página** (é a folha de estilo base/global), então
  isso inclui a home. Confirmado no CSS compilado:
  `h1,h2,h3,h4,h5,h6{font-family:Montserrat,sans-serif;font-weight:400;margin:0}`. Ou seja,
  Montserrat **é** usado na home (e em toda página) — só nunca em peso/itálico diferente de 400
  normal, em nenhum dos usos conhecidos (nem nos 4 específicos, nem no sitewide de heading).
  **Sorte, não acerto**: o fix abaixo (`Montserrat:wght@400`) continua correto porque 400 normal
  é exatamente o único peso/estilo usado em qualquer lugar — mas o raciocínio original de "não é
  usado na home" estava errado. Ao investigar uso de fonte, sempre cheque também os arquivos
  `core/*.scss` incluídos só pela folha de estilo global (`structure.scss`), não só os imports
  diretos do bundle da página que você está olhando.

Corrigido em duas etapas. Primeiro (2026-07): URL do Google Fonts trocada para
`Inter:wght@100..900&family=Montserrat:wght@400&display=swap` em `header.php` e
`header-land.php` — caiu de 7808 para 2289 bytes (-71%). Depois (mesmo dia, a pedido do Bruno):
**self-hosted de vez**, eliminando o Google Fonts inteiramente. `header-signature.php` tem o
mesmo problema mas está **órfão** (`grep -rn "get_header('signature'"` não acha nenhuma chamada)
— não foi tocado.

## Google Fonts self-hosted (Inter + Montserrat, subset latin)

Baixados de `fonts.gstatic.com` (via `curl` com User-Agent de Chrome, pra receber woff2 em vez de
woff/ttf) e salvos em `assets/fonts/inter-latin-variable.woff2` (48KB, variable font, cobre pesos
100-900 num arquivo só) e `assets/fonts/montserrat-latin-400.woff2` (18.8KB, peso 400 estático —
único peso usado em qualquer lugar do tema, ver acima). **Só o subset "latin"** foi baixado (não
latin-ext/cyrillic/greek/vietnamese) — o site é 100% pt-BR (`<html lang="pt-BR">`), e os acentos
do português (ã, õ, ç, etc.) já estão cobertos pelo range `U+0000-00FF` do subset latin.

`@font-face` (com `font-display: swap`) adicionado em `src/sass/core/_fonts.scss`, que só é
importado por `structure.scss` — mas `structure.min.css` é enfileirado **incondicionalmente**
(`upsites/functions.php:90-95`, antes de qualquer `is_page_template()`) em toda página do site,
então a fonte fica disponível globalmente mesmo sem `home.scss`/`landings.scss`/etc. importarem
`core/fonts` diretamente. Removido de `header.php` e `header-land.php`: os 2 `<link
rel="preconnect">` (pra fonts.googleapis.com/fonts.gstatic.com) e o `<link rel="stylesheet"
href="fonts.googleapis.com/css2?...">` — não são mais necessários, zero origens externas de
fonte no carregamento da página principal.

**Não mexido, escopo diferente**: (1) `upsites/functions.php` (~linha 197-214) tem um loader de
fonte **dinâmico por ACF** (`fontslist_casesletter`, usado em `single-cases.php`) que deixa o
editor de conteúdo escolher qualquer Google Font por case — não dá pra self-hostear isso porque a
fonte varia por post, é conteúdo editorial, não uma fonte fixa da marca. (2)
`single-signatures.php` (gerador de assinatura de e-mail, página isolada/baixo tráfego) também
carrega Inter via Google Fonts direto — deixado de lado por ser um contexto separado e de baixa
prioridade, não a página principal do site.

Se `$font-alt`/Montserrat passar a ser usado em mais lugares no futuro, ajuste o `wght@` da URL
de acordo — não volte para o range completo sem necessidade real.

## Preload da imagem de fundo do hero (corrigido)

O hero da home (`template-pages/home-old.php:15`, campo ACF `imagem_tophome`) é um
`background-image` CSS inline, não uma tag `<img>` — sem preload, o navegador só descobre que
precisa dela depois de processar o CSS. Adicionado em `header.php`, gated por
`is_page_template()` (cobre `home.php`/`home-old.php`/`home-new.php`, os 3 templates de home
possíveis):
```php
if (is_page_template('template-pages/home-old.php') || is_page_template('template-pages/home.php') || is_page_template('template-pages/home-new.php')) {
  $hero_img_id = get_field('imagem_tophome', get_queried_object_id());
  if ($hero_img_id) {
    $hero_img_url = wp_get_attachment_image_url($hero_img_id, 'full');
    if ($hero_img_url) echo '<link rel="preload" as="image" href="' . esc_url($hero_img_url) . '">';
  }
}
```
A imagem hero atual (`wp-content/uploads/2024/01/home-new-2.svg`) já é pequena (76KB) — o ganho
aqui é de *ordem de descoberta*, não de tamanho de arquivo. Se o campo `imagem_tophome` mudar
para um raster grande no futuro, considere também comprimir/webp-ificar antes de assumir que o
preload sozinho resolve.

## CLS: 4 imagens sem width/height (corrigido)

Segundo relatório de produção (2026-07-11, ~30min depois do primeiro) mostrou LCP/FCP melhorando
(3.3s→3.0s, 3.0s→2.7s — os fixes anteriores de fonte/defer/preload parecem ter surtido efeito
uma vez implantados), mas **CLS piorou (0.036→0.069)** e TBT também (30ms→140ms) — variância
normal de execução do Lighthouse lab, não necessariamente causada por alguma mudança. O relatório
apontou 4 imagens sem `width`/`height` HTML explícitos causando layout shift:
`assets/img/img-popup03.svg` (174×364, `template-parts/footer.php`), `assets/img/moon.svg`
(96×76) e `assets/img/imageDontJustWebsiteafter.svg` (563×306, viewBox — sem width/height
próprios no arquivo) — usados em `template-pages/home.php`, `home-old.php`, `home-new.php` e
`creation-sites-wordpress.php` (todas as 4 páginas, não um partial único) — e
`assets/img/btn-portifolio.png` (116×116) — usado em `home-old.php`, `home-new.php`,
`portifolios.php` e `taxonomy-categories_portifolios.php` (apareceu 8× no relatório porque a
página testada lista 8 itens de portfólio, cada um repetindo essa mesma tag `<img>`). Corrigido
adicionando os atributos `width`/`height` nos 8 pontos (2 imagens × 4 arquivos, mais os 2 casos
únicos). Se adicionar um novo uso dessas mesmas imagens em outro template, lembre de incluir os
atributos também — não há um único partial centralizando essas seções `dontJustWebsite`/
`portfolio-slide`, é markup duplicado por página.

## GTM: já otimizado, "321KB de JS não usado" é inerente à ferramenta

O Google Tag Manager (`GTM-WBSP9BT`) é carregado via `footer.php` (raiz do tema, linhas ~24-51)
com um padrão de **delay por interação**: só injeta o script `gtm.js` depois de 3.5s **ou** no
primeiro scroll/mousemove/touchstart do usuário, o que vier primeiro — já é uma implementação
correta e deliberada de "adiar terceiros até interação", não código ingênuo. Há um bloco antigo
comentado (linhas ~57-65) com a versão anterior sem delay, mantido como referência. O Lighthouse
ainda flagou ~138KB de JS "não usado" do GTM+gtag.js porque o teste em lab espera tempo
suficiente pra isso carregar de qualquer forma, e porque o pacote do GTM sempre baixa o container
inteiro (todas as tags/triggers configurados) independentemente de quais disparam numa pageview
específica — isso é inerente à arquitetura do GTM, não um bug do tema. Não há fix de código pra
isso; a única alavanca real é reduzir tags/triggers dentro do próprio container do GTM (decisão
de quem administra o Tag Manager, não do tema).

## CSS não usado em home.min.css (~12.6 KiB) — não resolvido, esforço maior

Lighthouse flagou 12.6 KiB de 21.1 KiB de `home.min.css` como não usado numa pageview específica.
Isso é esperado dado que `home.scss` é um bundle único cobrindo todas as seções da home
(incluindo blocos que podem estar desativados via campos ACF tipo `desativar_seccao_X`, modais,
estados de hover/tab). Resolver de verdade exigiria CSS crítico inline + split por seção, ou
migrar pra uma abordagade de CSS crítico como a que outro projeto da UpSites já tem (função
`US_critical_css()` — **este tema não tem isso**, ver nota no topo do arquivo). Não fiz essa
mudança por ser um esforço bem maior que os fixes pontuais desta sessão — considerar como
próximo passo se quiser continuar reduzindo LCP/SI depois que os itens de TTFB (OPcache) forem
endereçados.

## FontAwesome sem font-display (corrigido)

`assets/css/font-awesome.css`/`.min.css` são **arquivos vendorizados estáticos** (FontAwesome
4.7.0 completo, não gerados a partir de SCSS do tema — `gulpfile.js` não tem nenhuma task pra
eles, então editá-los é a única forma, não tem rebuild). O `@font-face` não tinha
`font-display` — Lighthouse flagou ~890ms de economia estimada nisso. Corrigido adicionando
`font-display: swap` no `@font-face` dos dois arquivos (`.css` e `.min.css`, precisam ser
editados os dois manualmente).

Só 6 arquivos do tema (fora backups e o icon-picker do Customizer) realmente usam classes
`fa`/`fa-*`: `single.php`, `single-glossary.php`, `template-pages/cookies.php`,
`template-parts/header.php`, `template-parts/footer.php`, `upsites/comments/comments.php`. Como
header/footer rodam em toda página, o FontAwesome é uma dependência sitewide — não dá pra
remover fácil sem migrar esses 6 arquivos pro sprite SVG (`assets/img/icons.svg`, que o tema já
usa em outros lugares via `<use xlink:href="...icons.svg#nome">`). Isso não foi feito (esforço
maior, fora do escopo da correção pontual) — mas é a próxima coisa a considerar se quiser tirar
o FontAwesome do caminho crítico de vez, já que ele aparece como o recurso mais profundo (2905ms)
na cadeia de dependências crítica do relatório de produção.

## Imagem de card de portfólio servida maior que o exibido (corrigido)

Lighthouse (produção) flagou duas imagens de portfólio servidas a 768×354 pra exibir a 581×268
(~26KiB de economia estimada). Causa: `template-parts/posts/content-portifolio.php` (usado no
grid de portfólio da home — `template-pages/home-old.php:228` — e na página
`/portifolios/`/`taxonomy-categories_portifolios.php`) pedia `wp_get_attachment_image(...,
'full', ...)` em vez de um tamanho registrado, então o `srcset` automático do WP oferecia só
`medium_large` (768px, o candidato mais próximo por cima) sem nada intermediário mais próximo de
581px. Corrigido: registrado `add_image_size('portfolio-card', 581, 268, true)` em
`upsites/functions.php` (perto de `portfolio-thumb`) e trocado o `'full'` por `'portfolio-card'`
em `content-portifolio.php`. **Importante**: `add_image_size()` só afeta uploads futuros —
rodei manualmente `wp_generate_attachment_metadata()` nas featured images dos posts `portifolios`
já existentes no ambiente local para confirmar que a nova crop é gerada corretamente (confirmado
via `/portifolios/`, o novo tamanho aparece no srcset). **Em produção isso precisa do plugin
`regenerate-thumbnails` (já instalado lá) rodado manualmente após o deploy**, senão as imagens
já existentes continuam sem a variante `portfolio-card` até serem re-salvas ou regeneradas.

## Imagens

- `add_image_size()` é registrado em `upsites/functions.php` (~linhas 18-20): `logos-thumb`
  (186×118, cropped), `portfolio-thumb` (361×304, cropped), `blog-thumb` (722×608, cropped).
  Verifique se algum tamanho já registrado atende antes de pedir `'full'` ou criar um tamanho
  novo.
- Não foram encontrados atributos explícitos `loading="lazy"` ou `fetchpriority` junto às
  chamadas `wp_get_attachment_image()`/`add_image_size()` no markup próprio do tema — o tema
  parece depender do lazy-loading automático do núcleo do WordPress em vez de dicas manuais.
  Diferente de outros temas, os templates de página deste projeto (`archive.php`, `author.php`,
  `search.php`, `inc-articles.php`, `single*.php`, etc.) **usam** o Loop real do WP
  (`have_posts()`/`the_post()`), que é a condição de que
  `wp_get_loading_optimization_attributes()` do núcleo precisa para tratar corretamente imagens
  abaixo da dobra como lazy-loadable — então é mais provável que o lazy-loading automático
  funcione aqui do que em um tema que nunca chama o Loop. Mesmo assim, confirme com um
  carregamento de página real (ver código-fonte ou uma captura de rede) antes de assumir que se
  aplica a uma imagem específica que você está mexendo, especialmente imagens renderizadas fora
  do Loop (ex.: via campos ACF em `template-pages/*.php`, ou os loops manuais de `WP_Query` nos
  handlers de AJAX em `upsites/functions.php`).
- `assets/images/` tem 6.5MB em 22 arquivos; `assets/img/` tem 19MB em 112 arquivos (essa
  segunda pasta também guarda o sprite `icons.svg` gerado no build, além de imagens fonte
  PNG/JPG/webp usadas em backgrounds CSS). Ambas são candidatas a revisão de tamanho — confira
  com `grep` se um arquivo é realmente referenciado antes de gastar esforço comprimindo algo que
  não é usado.
- Os plugins `images-to-webp` e `webp-express` estão instalados e cuidam sozinhos da
  conversão/entrega de WebP para a biblioteca de mídia — não duplique esse trabalho com código
  de conversão no tema para conteúdo enviado via upload. As imagens de background CSS em
  `src/sass/**/*.scss` (referenciadas via `url(...)` em pelo menos 13 partials, incluindo
  `_structure.scss`, `_home.scss`, `_cases.scss`, `_glossary.scss`, `_slider.scss`,
  `_utils.scss`) são uma questão separada da biblioteca de mídia — verifique se esses arquivos
  de origem de background específicos já são WebP ou ainda PNG/JPEG antes de assumir que estão
  otimizados.

## O build tooling é legado e fácil de usar errado

`gulp ^3.9.1` + `webpack ^1.14.0` (API antiga, não é a superfície de configuração do webpack
moderno) + `gulp-sass ^3.2.1` (node-sass). **`npm run build` só roda `gulp sass:release` (o
bundle único `main.scss`) + a config de produção do webpack** — ele *não* roda as outras ~17
tasks `gulp {pagina}:release` de sass específicas de página definidas no `gulpfile.js`, mesmo
essas sendo o que de fato é enfileirado na maioria das páginas. Se uma mudança de CSS específica
de página "não aparece" depois do `npm run build`, o asset de produção real daquela página nunca
foi rebuildado — rode a task específica `gulp {pagina}:release` (ou o `gulp build:min` completo)
em vez disso. Veja a skill `wordpress` para a lista completa de tasks.

## Os assets compilados do tema não são versionados no git deste repositório

`git ls-files -- "site/wp-content/themes/upsites/*"` retorna zero arquivos versionados a partir
da raiz do repositório — esta pasta de tema (incluindo todos os `assets/*.min.css`/`*.min.js`)
está efetivamente fora do controle de versão do jeito que está configurada hoje. Não assuma que
`git status`/`git diff` vai mostrar se um rebuild realmente mudou os assets publicados; confira
timestamps ou o conteúdo dos arquivos diretamente. (A pasta separada `html/` na raiz do
repositório, que É versionada, é um espelho estático mais antigo deste tema — não é o site ao
vivo.)

## Já está razoavelmente bom — não assuma que precisa de correção

- `wp_dequeue_style('wp-block-library')`, `wp_dequeue_style('wp-block-library-theme')` e
  `wp_dequeue_style('wc-blocks-style')` já são chamados (`upsites/functions.php:54-56`) — o CSS
  do editor de blocos e dos blocos do WooCommerce já é removido de toda página, mesmo este não
  sendo um block theme e o WooCommerce não estando instalado.
- O bundle principal de script do tema é enfileirado com `array('strategy' => 'defer')`
  (`upsites/functions.php:203-213`, estratégia de carregamento de script do WP 6.3+) em vez de
  uma realocação manual para o footer — isso já garante carregamento de script não bloqueante
  sem código extra. Também há um filtro `script_loader_tag` que remove o atributo redundante
  `type="text/javascript"` especificamente da tag do jQuery core.

## Sem configuração de cache-control — uma lacuna real e não resolvida

`site/.htaccess` contém apenas o bloco padrão de rewrite do WordPress — sem diretivas de
`Expires`/`Cache-Control`/gzip, e nenhum plugin de cache de página está instalado (sem W3 Total
Cache/WP Super Cache/WP Rocket/LiteSpeed Cache em `wp-content/plugins`). Se estiver investigando
uma nota ruim no Lighthouse de "política de cache eficiente" ou "compressão de texto", essa é a
causa real — não há configuração existente para checar conflitos, apenas uma ausência.

## SEO: Rank Math em produção, Yoast só no ambiente local — não é código morto

`upsites/functions.php` registra filtros em `rank_math/json_ld` (~linha 731) e
`rank_math/frontend/robots` (~linha 917). O ambiente local XAMPP tem apenas o plugin **Yoast**
(`wordpress-seo`) instalado, o que parece indicar que esses filtros são código morto — **mas
não são**: em produção o plugin de SEO real é o **Rank Math**, então esses filtros disparam e
são usados normalmente lá. O Yoast local é só um leftover/substituto de desenvolvimento; teste
JSON-LD/robots/SEO localmente sabendo que esses hooks específicos do Rank Math **não** vão
disparar nesse ambiente (o Yoast não os chama), o que pode dar a falsa impressão de que estão
quebrados. Para validar de verdade o comportamento de SEO, é preciso conferir em produção (onde
o Rank Math está ativo) ou instalar o Rank Math localmente antes de testar.

## Ambiente de teste local

PHP 7.4.16 (CLI, XAMPP). Sem WP-CLI instalado. URL local:
`http://localhost/projetos/site_upsites/site/`. **Diferença confirmada entre local e produção**:
localmente o plugin de SEO é o Yoast (`wordpress-seo`), mas em produção é o **Rank Math** — não
assuma que a lista de plugins do ambiente local reflete produção fielmente, especialmente para
SEO. Fora isso, não há outro ambiente separado de staging/produção documentado neste
repositório — confirme qualquer outra configuração de plugins/cache diretamente em vez de
assumir uma configuração de produção conhecida.
