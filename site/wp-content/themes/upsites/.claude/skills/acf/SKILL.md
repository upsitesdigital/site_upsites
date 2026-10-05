---
name: acf
description: Convenções do Advanced Custom Fields (ACF Pro) e padrões de nomenclatura de campos no tema upsites. Use ao ler ou escrever chamadas get_field()/get_sub_field()/have_rows(), ao adicionar um novo campo ACF a um template, ou ao debugar um campo que retorna vazio.
---

# ACF Pro no tema upsites

O ACF Pro é um plugin normal, instalado separadamente
(`wp-content/plugins/advanced-custom-fields-pro`, versão 5.11.4) — **não** vem embutido dentro
do tema como acontece em outros projetos da UpSites. `upsites/functions.php` nunca faz
`require` de um arquivo do ACF; ele simplesmente chama as funções globais do ACF (`get_field`,
`get_sub_field`, `have_rows`) assumindo que o plugin está ativo. Também **não há pasta de
sincronização `acf-json`** em nenhum lugar do tema — os grupos de campos existem só no banco de
dados (wp-admin → Custom Fields). Para ver as chaves/labels reais de um grupo de campos, consulte
o wp-admin ou faça query direto em `wp_postmeta`/`wp_posts`.

## Importante: nenhum guard de segurança em lugar nenhum — diferente de um tema defensivo

Buscando por `function_exists('get_field'` (ou qualquer guard de "ACF ativo") em todo o tema,
o resultado é **zero ocorrências**. Todos os mais de 40 arquivos de template/partial que chamam
`get_field`/`get_sub_field`/`have_rows` — incluindo `template-pages/home.php`,
`template-pages/landing.php`, `single-cases.php`, `single.php` e o próprio
`upsites/functions.php` — fazem isso sem nenhuma proteção. Se o plugin ACF Pro fosse desativado,
isso causaria erros fatais de "call to undefined function" em todo o site, sem nenhuma
degradação graciosa. **Não adicione um guard `function_exists()` só no seu código novo** — isso
seria inconsistente com todas as chamadas já existentes no tema e também não protegeria nada (o
resto da página ainda daria erro fatal). Se pedirem para tornar o tema mais resiliente, isso é
uma lacuna do tema inteiro, não algo para corrigir chamada por chamada.

**Mitigação operacional já implementada** (`upsites/functions.php`, perto do topo): em vez de
mexer nas 40+ chamadas, foi adicionado um filtro `auto_update_plugin` que desativa
especificamente o update automático do `advanced-custom-fields-pro/acf.php` (para que um update
automático incompatível não quebre o site sem ninguém perceber), mais um hook `admin_notices`
que mostra um aviso vermelho no wp-admin se `get_field` não existir (ou seja, o plugin foi
desativado). Isso não evita o erro fatal no frontend caso o ACF seja desativado, mas remove a
causa mais provável de isso acontecer silenciosamente (update automático) e torna uma
desativação acidental visível rapidamente para um admin. Se pedirem para reforçar ainda mais,
os guards por chamada continuam sendo a lacuna descrita acima — essa mitigação foi deliberadamente
operacional, não uma correção no nível do código.

## Nomenclatura de campos: português, por padrão de bloco, reutilizada entre páginas

Os campos são nomeados em português e geralmente seguem um padrão `{finalidade}_{bloco}`, onde
`{bloco}` identifica a qual "bloco" reutilizável de landing page o campo pertence (muitos
templates em `template-pages/*.php` compartilham o mesmo markup de bloco via partials
`template-parts/inc-*.php`, e cada padrão de bloco tem seu próprio conjunto de campos repetido).
Rode `grep -rohE "(get_field|get_sub_field|have_rows)\('[a-zA-Z_0-9]+'" .` a partir da raiz do
tema primeiro, para checar se já existe um campo com nome parecido, em vez de chutar um nome
novo — há centenas de nomes de campos distintos neste tema, um conjunto por página/padrão de
bloco.

Campos comuns que aparecem repetidamente entre blocos: `icone`, `titulo`, `texto` (sub-campos
dentro de repeaters), `itens` (um repeater), `texto_botao_tab`, `link_botao_tab`,
`texto_botao_toppage`, `titulo_toppage`, `subtitulo_toppage`, `texto_toppage`,
`imagem_toppage`, `funcionalidades_func` (um repeater), `titulo_func`, `texto_func`,
`banner_blog`. Além desses, espere muitos campos específicos de página seguindo a mesma
convenção `{finalidade}_{chave_da_pagina}` (ex.: `titulo_porthome`, `titulo_recpen`,
`titulo_otimseo`, `titulo_howtowork4`) — verifique as chamadas `get_field()`/`have_rows()` já
existentes no template específico antes de assumir um nome.

Dois exemplos concretos e não óbvios que vale conhecer:
- `upsites/functions.php` (~linhas 169-181) implementa um carregador customizado de fontes
  Google/self-hosted para `single-cases.php` via `have_rows('fontslist_casesletter')` com
  sub-campos `origem`, `fontname`, `archive`, `urlgoogle`.
- A função `get_load_segment()` de `upsites/functions.php` (~linhas 809-812), usada pelo filtro
  de segmentos via AJAX, lê `get_field('cor_seglanding')`, `get_field('icone_seglanding')`,
  `get_field('texto_seglanding')`.

Ao adicionar o uso de um novo campo, sempre rode o grep acima antes de chutar um nome novo — a
convenção de nomenclatura é inconsistente o suficiente entre páginas (português, sufixos por
bloco) para que um palpite plausível fique errado facilmente.
