---
name: wordpress
description: Convenções de desenvolvimento, revisão e teste do tema WordPress "upsites" (o próprio site institucional da UpSites Digital). Use ao editar templates PHP, upsites/functions.php ou src/js neste repositório, ao revisar o tema em busca de bugs, ou ao testar mudanças no site local via XAMPP.
---

# Tema upsites (WordPress + plugin ACF Pro, sem WooCommerce, sem Elementor)

## Estrutura do projeto

- Tema PHP clássico (`style.css` declara `Theme Name: tema`, `Author: UpSites Digital`), não é
  um block theme — não há `theme.json`, não há `block-templates/`.
- O `functions.php` na raiz do tema é um stub de 3 linhas que apenas faz `require` de
  `upsites/functions.php` (~889 linhas) — é lá que vive praticamente toda a lógica e os hooks
  customizados. Esse arquivo, por sua vez, faz `require` de vários módulos independentes:
  `upsites/customizer-repeater/inc/customizer.php`, `upsites/post-views/post-views.php`,
  `upsites/customizer-controls/customizer-controls.php`,
  `upsites/customizer-register/customizer-register.php` (**é aqui que os custom post types são
  registrados**), `upsites/comments/comments.php`, `upsites/pagination/pagination.php`.
- Custom post types (registrados em `customizer-register/customizer-register.php`):
  `signatures`, `faqs`, `portifolios`, `templates`, `clients`, `assessments`, `videos`,
  `landings`, `services`, `cases`, `glossary`.
- `header.php`/`footer.php` na raiz do tema carregam docblocks `@package HelloElementor` —
  resquício do starter theme "Hello Elementor" a partir do qual este tema foi criado. O
  Elementor em si não está de fato integrado. `footer.php` é um wrapper fino: só chama
  `get_template_part('template-parts/footer')` e depois `wp_footer()` mais o noscript inline do
  GTM. **`header.php` NÃO é um wrapper fino** — tem cerca de 28KB e contém bastante markup
  próprio dentro de `<head>` (preconnects de fontes, `wp_head()`, um bloco de schema JSON-LD
  específico da página `home-new.php`) antes de finalmente delegar para
  `template-parts/header.php` perto do final do arquivo. Não assuma que editar
  `template-parts/header.php` cobre tudo que está em `<head>`.
- **Sem WooCommerce** — `add_theme_support('woocommerce')` e os supports `wc-product-gallery-*`
  estão declarados em `upsites/functions.php:11-13`, e há um
  `wp_dequeue_style('wc-blocks-style')` na linha 56, mas o plugin do WooCommerce **não está
  instalado** (a pasta `wp-content/plugins` não tem `woocommerce`). São resquícios inertes do
  starter theme, não uma integração real — não construa em cima disso sem antes instalar o
  WooCommerce.
- O ACF Pro é um plugin normal, instalado separadamente
  (`wp-content/plugins/advanced-custom-fields-pro`, v5.11.4) — **não** vem embutido dentro do
  tema. Veja a skill `acf` para as convenções de campos e um detalhe importante sobre a falta de
  guards de segurança.
- SEO: `upsites/functions.php` registra filtros em `rank_math/json_ld` (linha ~731) e
  `rank_math/frontend/robots` (linha ~917) — **em produção o plugin de SEO real é o Rank Math**,
  então esses filtros disparam e são usados normalmente lá. O ambiente local só tem o Yoast
  (`wordpress-seo`) instalado, o que pode enganar (parece que os filtros do Rank Math são código
  morto, mas não são — é só que o Rank Math não está instalado localmente). Veja a skill
  `performance` para mais detalhes sobre essa diferença local vs. produção.

## Templates

- `template-pages/*.php` tem cerca de 30 templates de página (`home.php`, `blog.php`,
  `cases.php`, `landing.php`, `segments.php`, `shop.php`, `seo.php`, `glossary.php`,
  `portifolios.php`, `signature-site.php`, etc.). **Vários arquivos são cópias antigas/stale**
  com sufixos `-bkp`/`-Copia`/`.php-bkp` (ex.: `home-old.php` + 2 variantes de backup,
  `seo - Copia.php`, `partners.php-bkp`, `video.php-bkp`) — confirme que está editando o
  template ativo, e não um backup, antes de assumir que a mudança chega ao site. Esses arquivos
  e pastas de backup (`bkp/`, `bkp-2023-*/`, `src-bkp/`, `*-bkp*`, `*-Copia*`, ~92MB no total)
  eram acessíveis publicamente via URL direta (alguns `.php` executavam normalmente, outros sem
  extensão `.php` reconhecida expunham o código-fonte em texto puro).

  **Tentativa de correção via `.htaccess` (2026-07) não funciona em produção** — descoberto ao
  testar contra `novo.siteup.dev` depois do deploy: **produção roda Nginx** (`server: nginx` no
  header de resposta, LiteSpeed como cache/handler por cima), e `.htaccess` é um mecanismo
  **exclusivo do Apache** — Nginx simplesmente ignora esse arquivo. O `wp-content/themes/upsites/.htaccess`
  criado (regra de `mod_rewrite` para pastas com "bkp" no nome + `FilesMatch` para arquivos soltos
  com `-bkp`/`-Copia`) só tem efeito no ambiente local XAMPP (Apache). Confirmado ao vivo em
  produção: as pastas dedicadas (`bkp/`, `src-bkp/`, `bkp-2023-*/`) retornam 404 lá — mas isso é
  porque **não foram incluídas no deploy** (motivo desconhecido, possivelmente exclusão do
  processo de deploy do host "Cloudez", não relacionado ao `.htaccess`), não porque o bloqueio
  funcionou. Os **arquivos soltos continuam 100% expostos em produção** (`single-bkp.php`,
  `header.php-bkp20240515`, `template-pages/partners.php-bkp`, `video.php-bkp`,
  `home-old.php-bkp-*`, `template-parts/inc-other-pages*-bkp*`,
  `template-parts/posts/content-video.php-bkp`, `assets/img/before-after-bkp.png`,
  `assets/img/hero-partners - Copia.svg` — todos confirmados HTTP 200 via curl em 2026-07-11).
  Um deles (`seo - Copia.php`) retorna 500 ao ser acessado direto (mas sem vazar stack
  trace/paths — `WP_DEBUG`/`display_errors` estão off em produção, corpo da resposta vazio).

  **Isso ainda é uma exposição de segurança real e não resolvida em produção.** Antes de repetir
  a tentativa de bloqueio via `.htaccess`, confirme o web server real de cada ambiente (não
  assuma Apache só porque o ambiente de dev local usa XAMPP/Apache) — regras de servidor não são
  portáveis entre Apache e Nginx. A correção que de fato funciona independente do servidor é
  remover/mover esses arquivos do document root — o Claude não tem acesso a filesystem/FTP de
  produção neste fluxo de trabalho, só HTTP, então não consegue fazer essa remoção diretamente.

  **Decisão (2026-07-11): o Bruno remove esses arquivos manualmente direto em produção** (via
  painel do host/FTP), fora deste fluxo de trabalho. Não é necessário sugerir de novo uma
  correção via `.htaccess`/tema para esse problema específico — já se sabe que não funciona no
  servidor de produção (Nginx) e a remoção direta é o caminho escolhido. Os arquivos locais no
  ambiente XAMPP não foram tocados (ficam protegidos ali pelo `.htaccess` do Apache mesmo).
- `template-parts/*.php` contém partials compartilhados (`header.php`, `footer.php`,
  `archive.php`, `author.php`, `search.php`, `inc-articles.php`, `inc-clients.php`,
  `inc-faqs.php`, `inc-other-pages.php`, `inc-prices.php`) mais
  `template-parts/posts/content-*.php` para o markup dos cards por post type. Muitos arquivos
  em `template-pages/*.php` compartilham os mesmos partials `template-parts/inc-*.php` em vez de
  duplicar markup — verifique se já existe um partial compartilhado antes de adicionar novo
  markup específico de página.
- O Loop do WordPress (`have_posts()`/`the_post()`) **é** usado neste tema — em
  `template-parts/archive.php`, `author.php`, `search.php`, `inc-articles.php`,
  `taxonomy-categories_templates.php`, e os vários templates `single*.php`.
  `upsites/functions.php` também monta loops manuais de `WP_Query` para infinite scroll/filtros
  via AJAX (`get_load_more`, `get_load_cases`, `get_load_segment`).

## Build system

- **Toolchain legado e congelado**: `gulp ^3.9.1` + `webpack ^1.14.0` (API antiga —
  `module.loaders`/`UglifyJsPlugin`/`DedupePlugin`, não funciona com webpack moderno) +
  `babel-preset-es2015` + `gulp-sass ^3.2.1` (baseado em node-sass). Não assuma que comandos de
  build modernos se aplicam aqui. Testado e confirmado funcionando com Node v8.11.3 (o Node
  instalado neste ambiente local) em 2026-07 — mas **não atualize o Node deste XAMPP sem
  avaliar o impacto**: esse `node-sass ^gulp-sass 3.2.1` depende de um binário nativo compilado
  para a ABI exata dessa versão de Node, e node-sass está descontinuado (não recebe mais
  releases) — um Node mais novo pode não ter binário pré-compilado disponível e quebrar o build
  inteiro sem aviso prévio. Essa é a peça mais frágil do toolchain. Decisão consciente (2026-07):
  não migrar para webpack 4+/gulp 5/dart-sass agora — o tema não tem testes automatizados nem
  git, então o risco de regressão silenciosa numa migração grande foi considerado maior que o
  benefício no momento. Se precisar migrar no futuro, comece pelo node-sass → `sass` (Dart Sass,
  ainda mantido) isoladamente, sem tocar em webpack/gulp/babel — é a troca de menor risco e
  resolve o ponto mais frágil.
- `gulpfile.js` (579 linhas) define **uma task de gulp para cada entrada Sass específica de
  página** — `sass`, `sasshome`, `sassstructure`, `sasspostinternal`, `sasssignaturesite`,
  `sassshop`, `sassseo`, `sasschat`, `sassportfolio`, `sassblog`, `sasspartners`,
  `sasslandings`, `sasscookies`, `sasssegments`, `sasscases`, `sasscasessingle`,
  `sassglossary`, `sasssingleglossary` — cada uma com uma task `*:release` correspondente
  (autoprefixer → rename `.min` → clean-css) que gera o CSS minificado realmente usado em
  produção. `scripts` roda o bundle webpack (`src/js/main.js` → `assets/js/bundle.js`);
  `js:release` faz uglify para `bundle.min.js`. Tasks compostas: `build` (todas as sass de dev +
  `scripts`), `build:min` (todas as tasks `:release` + `js:release`), `watch`, `default`. Há
  também tasks `svg2png`/`svgicons` que geram o sprite `assets/img/icons.svg` a partir de
  `src/img/icons/*.svg`.
- **`npm run build` está desatualizado/incompleto** — ele só roda `gulp sass:release` (o bundle
  único `main.scss`) + a config de produção do webpack, **não** as outras ~17 tasks de release
  de sass específicas de página. Se precisar do conjunto completo de assets de produção, rode o
  pipeline real `gulp build:min` (ou a task específica `gulp {pagina}:release` da página que
  você alterou), não `npm run build`.
- O que é enfileirado: o hook `wp_enqueue_scripts` em `upsites/functions.php` (~linhas 53-223,
  prioridade 999) enfileira dinamicamente CSS/JS por tipo de template, alternando entre arquivos
  não minificados e `.min` conforme a URL do site contenha `local.wp4` ou `localhost`. Cada
  arquivo `src/sass/*.scss` de nível superior corresponde 1:1 a um handle de estilo enfileirado —
  mas só depois que a task de gulp correspondente tiver realmente rodado.
- **Os assets compilados não são versionados no git para esta pasta de tema** —
  `git ls-files -- "site/wp-content/themes/upsites/*"` retorna zero resultados a partir da raiz
  do repositório. A pasta `html/` na raiz do repositório, que é versionada, é um espelho estático
  mais antigo e separado deste mesmo tema (tem seu próprio `gulpfile.js`,
  `assets/css/main.min.css`, `src/js`, `src/sass`) — **não** é a pasta do tema ao vivo. Não
  confunda a saída de `git status`/`git diff` em `html/` com mudanças neste tema de fato; e não
  assuma que fluxos de "commitar os assets buildados" se aplicam aqui, já que nada sob este
  caminho de tema está versionado neste repositório do jeito que está configurado hoje.

## Acessibilidade: cores da marca são intocáveis, mesmo falhando WCAG

**Nunca altere cores** (`$color-green`, `$color-navy`, `$font-color`, ou qualquer hex hardcoded
de botão/heading/link) para corrigir contraste, mesmo que um relatório do Lighthouse/axe aponte
falha real — isso já foi pedido explicitamente para não fazer (2026-07-11), mesmo depois de eu
confirmar matematicamente que várias falham WCAG AA: `.btnBudgets` (texto branco sobre
`$color-green` #00B48F) ≈ 2.65:1, `.subtitle` (#008cff sobre branco, 13px) ≈ 3.39:1, `.link`
"LEIA MAIS" (`$color-green` sobre branco) ≈ 2.65:1, `$font-color` (#8c8c8c, usado em texto de
parágrafo) ≈ 3.36:1 — todos abaixo do mínimo de 4.5:1 pra texto normal. Se um relatório futuro
apontar contraste, **reporte os achados mas não edite cor nenhuma** — é decisão de design/marca,
fora do escopo de correção técnica. Só corrija a11y que não muda a aparência: `aria-label` em
links só-ícone, `alt` de imagem, links duplicados pro mesmo destino (marcar o decorativo com
`aria-hidden="true" tabindex="-1"` e deixar o link com texto real como o único focável),
estrutura de heading, labels de formulário.

**Corrigido (2026-07-11, sem mexer em cor)**: setas de slider (`a.prev`/`a.next` com só um ícone
SVG dentro, em `home-old.php`, `home-new.php`, `portifolios.php`,
`taxonomy-categories_portifolios.php`, `seo.php`) ganharam `aria-label="Slide anterior"`/`"Próximo
slide"`. O botão-ícone `btn-portifolio.png` (link pro site do cliente, só imagem sem texto) ganhou
`aria-label="Ver projeto {título}"` nos mesmos 4 arquivos de listagem de portfólio. Os cards de
portfólio (`content-portifolio.php`) e blog (`content-blog.php`) tinham dois `<a>` apontando pro
mesmo destino — um só com imagem (sem nome acessível) e um com texto real ao lado; o link-imagem
virou `aria-hidden="true" tabindex="-1"` (decorativo, redundante) em vez de ganhar texto duplicado.

## Testando no site local

- URL de dev local: `http://localhost/projetos/site_upsites/site/` (conforme
  `RewriteBase /projetos/site_upsites/site/` em `site/.htaccess`; XAMPP, PHP 7.4.16 CLI).
  `wp-config.php` define `DB_NAME` = `upsites`. Sem WP-CLI instalado (`wp` não está no PATH).
- Checagem rápida de sintaxe: `php -l <arquivo>` (ou varrer o tema inteiro — é rápido).
- A checagem de URL `local.wp4`/`localhost` espalhada por `upsites/functions.php` é o que
  alterna entre assets normais e `.min` — tenha isso em mente quando uma mudança de CSS/JS "não
  aparece" localmente; pode ser que ela esteja lendo um arquivo que sua task de gulp não acabou
  de rebuildar.

## Plugins instalados (contexto do que está disponível)

`advanced-custom-fields-pro` (5.11.4), `akismet`, `all-in-one-wp-migration`, `cf7-to-zapier`,
`classic-editor`, `contact-form-7` (+ `contact-form-7-database`), `duplicate-post`,
`images-to-webp`, `regenerate-thumbnails`, `remove-cpt-base`, `svg-support`,
`table-of-contents-plus`, `translatepress-developer` + `translatepress-multilingual`,
`webp-express`, `wordpress-importer`, `wordpress-seo` (Yoast — **só neste ambiente local**;
em produção o plugin de SEO é o **Rank Math**, não o Yoast), `wpcf7-redirect`. Nenhum plugin
de cache (W3TC/WP Rocket/etc.) e nenhum WooCommerce, apesar dos resquícios de WooCommerce no
tema descritos acima.
