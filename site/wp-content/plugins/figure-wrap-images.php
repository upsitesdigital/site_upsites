<?php
/**
 * Plugin Name: Figure Wrap Images
 * Description: Envolve automaticamente as imagens do conteúdo dos posts em <figure> (com <figcaption> quando há legenda).
 * Version: 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1) Legendas do WordPress (shortcode [caption]) passam a usar
 *    <figure>/<figcaption> em vez de <div class="wp-caption">.
 */
add_filter( 'img_caption_shortcode', function ( $output, $attr, $content ) {
    $atts = shortcode_atts(
        array(
            'id'      => '',
            'align'   => 'alignnone',
            'width'   => '',
            'caption' => '',
            'class'   => '',
        ),
        $attr,
        'caption'
    );

    if ( (int) $atts['width'] < 1 || empty( $atts['caption'] ) ) {
        return '';
    }

    $id    = $atts['id'] ? 'id="' . esc_attr( $atts['id'] ) . '" ' : '';
    $class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );

    return '<figure ' . $id . 'style="width: ' . (int) $atts['width'] . 'px" class="' . esc_attr( $class ) . '">'
        . do_shortcode( $content )
        . '<figcaption class="wp-caption-text">' . $atts['caption'] . '</figcaption>'
        . '</figure>';
}, 10, 3 );

/**
 * Verifica se $img é o único conteúdo "real" dentro de $p
 * (ignorando nós de texto em branco, como espaços/quebras de linha).
 */
function figure_wrap_images_is_only_content( DOMElement $p, DOMElement $img ) {
    foreach ( $p->childNodes as $child ) {
        if ( $child === $img ) {
            continue;
        }
        if ( $child->nodeType === XML_TEXT_NODE && trim( $child->nodeValue ) === '' ) {
            continue;
        }
        return false;
    }
    return true;
}

/**
 * 2) Imagens "soltas" no conteúdo (sem legenda, digitadas direto no editor
 *    clássico ou vindas de HTML importado) são envolvidas em <figure>.
 *    Imagens que já estão dentro de um <figure> (ex.: bloco de imagem do
 *    Gutenberg) são ignoradas para não duplicar a tag.
 *    Se a imagem for o único conteúdo de um <p>, o próprio <p> é removido
 *    (substituído pelo <figure>), pois <figure> não pode ficar dentro de <p>.
 */
add_filter( 'the_content', function ( $content ) {
    if ( ! is_singular() || trim( $content ) === '' || stripos( $content, '<img' ) === false ) {
        return $content;
    }

    libxml_use_internal_errors( true );
    $dom = new DOMDocument();
    $dom->loadHTML(
        '<?xml encoding="utf-8" ?><div id="figure-wrap-root">' . $content . '</div>',
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
    );
    libxml_clear_errors();

    $images = $dom->getElementsByTagName( 'img' );

    // Percorre de trás para frente pois a NodeList é "viva".
    for ( $i = $images->length - 1; $i >= 0; $i-- ) {
        $img    = $images->item( $i );
        $parent = $img->parentNode;

        if ( $parent && strtolower( $parent->nodeName ) === 'figure' ) {
            continue;
        }

        $figure = $dom->createElement( 'figure' );
        $figure->setAttribute( 'class', 'wp-post-image' );

        if ( $parent && strtolower( $parent->nodeName ) === 'p' && figure_wrap_images_is_only_content( $parent, $img ) ) {
            // Imagem sozinha dentro de um <p>: remove o <p> e coloca o <figure> no lugar dele.
            $grandparent = $parent->parentNode;
            if ( $grandparent ) {
                $grandparent->replaceChild( $figure, $parent );
                $figure->appendChild( $img );
                continue;
            }
        }

        $parent->replaceChild( $figure, $img );
        $figure->appendChild( $img );
    }

    $root = $dom->getElementById( 'figure-wrap-root' );
    $html = '';
    foreach ( $root->childNodes as $node ) {
        $html .= $dom->saveHTML( $node );
    }

    return $html;
}, 20 );