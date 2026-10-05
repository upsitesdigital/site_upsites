<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<?php
		// Inter/Montserrat agora self-hosted via core/_fonts.scss (compilado em
		// structure.min.css) - sem Google Fonts, sem preconnect necessário.
	?>
	<meta name="adopt-website-id" content="ec2f2bf4-1b01-47d1-abc6-3cb207151e14" />
	<script src="//tag.goadopt.io/injector.js?website_code=ec2f2bf4-1b01-47d1-abc6-3cb207151e14" class="adopt-injector"></script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
		<!-- global -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "Organization",
					"@id": "https://upsites.digital/#organization",
					"name": "UpSites",
					"alternateName": "UpSites Digital",
					"url": "https://upsites.digital/"
				},
				{
					"@type": "WebSite",
					"@id": "https://upsites.digital/#website",
					"url": "https://upsites.digital/",
					"name": "UpSites",
					"alternateName": "UpSites Digital",
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"inLanguage": "pt-BR"
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php if(is_single( 20917 ) ) { ?>
		<!-- tecnologia -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/criacao-de-site-para-empresas-de-tecnologia/#webpage",
					"url": "https://upsites.digital/criacao-de-site-para-empresas-de-tecnologia/",
					"name": "Criação de Sites para Empresas de Tecnologia | UpSites",
					"description": "Criação de sites profissionais para empresas de tecnologia e SaaS, com posicionamento B2B, apresentação de soluções, integrações, performance e SEO.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-web-development-technology-companies"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-web-development-technology-companies",
					"name": "Criação de Sites para Empresas de Tecnologia",
					"description": "Desenvolvimento de sites profissionais para empresas de tecnologia e SaaS, com posicionamento B2B, apresentação de soluções, integrações, performance e estrutura para SEO.",
					"serviceType": "Criação de sites profissionais para empresas de tecnologia",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/criacao-de-site-para-empresas-de-tecnologia/",
					"audience": {
						"@type": "BusinessAudience",
						"audienceType": "Empresas de tecnologia e SaaS"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 21124 )) { ?>
		<!-- construtoras -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/criacao-de-site-para-construtora/#webpage",
					"url": "https://upsites.digital/criacao-de-site-para-construtora/",
					"name": "Criação de Sites para Construtoras | UpSites",
					"description": "Criação de sites profissionais para construtoras e empresas de construção civil, com apresentação institucional, obras, serviços, portfólio e estrutura para SEO.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-web-development-construction"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-web-development-construction",
					"name": "Criação de Sites para Construtoras",
					"description": "Desenvolvimento de sites profissionais para construtoras e empresas de construção civil, com apresentação institucional, obras, serviços, portfólio e estrutura para SEO.",
					"serviceType": "Criação de sites profissionais para construtoras",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/criacao-de-site-para-construtora/",
					"audience": {
						"@type": "BusinessAudience",
						"audienceType": "Construtoras e empresas de construção civil"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 22105 )) { ?>
		<!-- psicologos -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/criacao-de-site-para-psicologos/#webpage",
					"url": "https://upsites.digital/criacao-de-site-para-psicologos/",
					"name": "Criação de Site para Psicólogos | UpSites",
					"description": "Criação de sites profissionais para psicólogos e clínicas de psicologia, com apresentação profissional, conteúdo, responsividade e estrutura para SEO.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-web-development-psychologists"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-web-development-psychologists",
					"name": "Criação de Sites para Psicólogos",
					"description": "Desenvolvimento de sites profissionais para psicólogos e clínicas de psicologia, com apresentação profissional, conteúdo informativo, canais de contato, responsividade e estrutura para SEO.",
					"serviceType": "Criação de sites profissionais para psicólogos",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/criacao-de-site-para-psicologos/",
					"audience": {
						"@type": "Audience",
						"audienceType": "Psicólogos e clínicas de psicologia"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 19908 )) { ?>
		<!-- restaurantes -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/criacao-site-para-restaurantes/#webpage",
					"url": "https://upsites.digital/criacao-site-para-restaurantes/",
					"name": "Criação de Sites para Restaurantes | UpSites",
					"description": "Criação de sites para restaurantes e negócios gastronômicos, com apresentação de cardápio, localização, reservas, contato, responsividade e SEO local.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-web-development-restaurants"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-web-development-restaurants",
					"name": "Criação de Sites para Restaurantes",
					"description": "Desenvolvimento de sites profissionais para restaurantes e negócios gastronômicos, com cardápio, localização, reservas, contato, responsividade e estrutura para SEO local.",
					"serviceType": "Criação de sites profissionais para restaurantes e gastronomia",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/criacao-site-para-restaurantes/",
					"audience": {
						"@type": "BusinessAudience",
						"audienceType": "Restaurantes e negócios gastronômicos"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 19971 )) { ?>
		<!-- contabilidade -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/criacao-site-contabilidade/#webpage",
					"url": "https://upsites.digital/criacao-site-contabilidade/",
					"name": "Criação de Sites para Contabilidade | UpSites",
					"description": "Criação de sites profissionais para contadores e escritórios contábeis, com páginas de serviços, geração de contatos, responsividade e estrutura para SEO.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-web-development-accounting"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-web-development-accounting",
					"name": "Criação de Sites para Contabilidade",
					"description": "Desenvolvimento de sites profissionais para contadores, escritórios e assessorias contábeis, com páginas de serviços, conteúdo, canais de contato e estrutura para SEO.",
					"serviceType": "Criação de sites profissionais para empresas contábeis",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/criacao-site-contabilidade/",
					"audience": {
						"@type": "BusinessAudience",
						"audienceType": "Contadores, escritórios e assessorias contábeis"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 19735 )) { ?>
		<!-- medicos -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/criacao-site-medicos/#webpage",
					"url": "https://upsites.digital/criacao-site-medicos/",
					"name": "Criação de Sites para Médicos | UpSites",
					"description": "Criação de sites profissionais para médicos, clínicas e consultórios, com apresentação de especialidades, informações profissionais, responsividade e estrutura para SEO.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-web-development-doctors"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-web-development-doctors",
					"name": "Criação de Sites para Médicos",
					"description": "Desenvolvimento de sites profissionais para médicos, clínicas e consultórios, com apresentação de especialidades, informações profissionais, conteúdo, canais de contato e estrutura para SEO.",
					"serviceType": "Criação de sites profissionais para médicos e clínicas",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/criacao-site-medicos/",
					"audience": {
						"@type": "Audience",
						"audienceType": "Médicos, clínicas e consultórios"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 19737 )) { ?>
		<!-- advogados -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/criacao-site-advogados/#webpage",
					"url": "https://upsites.digital/criacao-site-advogados/",
					"name": "Criação de Site para Advogados e Escritórios de Advocacia",
					"description": "Criação de sites profissionais para advogados e escritórios de advocacia, com apresentação institucional, áreas de atuação, conteúdo, responsividade e SEO técnico.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-web-development-lawyers"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-web-development-lawyers",
					"name": "Criação de Sites para Advogados",
					"description": "Desenvolvimento de sites profissionais para advogados e escritórios, com apresentação institucional, áreas de atuação, equipe, conteúdo informativo, responsividade e estrutura para SEO.",
					"serviceType": "Criação de sites profissionais para o setor jurídico",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/criacao-site-advogados/",
					"audience": {
						"@type": "Audience",
						"audienceType": "Advogados e escritórios de advocacia"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } else { ?>
		
	<?php } ?>

	<style>
		/* ========================================
			SELO RR - COPIE DAQUI PARA BAIXO
		======================================== */
    .selo-rr {
      display: inline-block;
      position: relative;
      cursor: pointer;
      width: 48px;
      height: auto;
      opacity: 0.7;
      transition: opacity 0.3s ease;
    }
    .selo-rr:hover {
      opacity: 1;
    }
    .selo-rr-wrapper {
      display: inline-block;
      position: relative;
    }
    .selo-rr-wrapper .selo-rr-tooltip {
      visibility: hidden;
      opacity: 0;
      position: absolute;
      bottom: calc(100% + 10px);
      left: 50%;
      transform: translateX(-50%);
      width: 280px;
      background-color: #333;
      color: #fff;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      font-size: 13px;
      line-height: 1.5;
      text-align: center;
      padding: 12px 16px;
      border-radius: 8px;
      transition: opacity 0.3s ease, visibility 0.3s ease;
      z-index: 9999;
      pointer-events: none;
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }
    .selo-rr-wrapper .selo-rr-tooltip::after {
      content: '';
      position: absolute;
      top: 100%;
      left: 50%;
      transform: translateX(-50%);
      border-width: 6px;
      border-style: solid;
      border-color: #333 transparent transparent transparent;
    }
    .selo-rr-wrapper:hover .selo-rr-tooltip {
      visibility: visible;
      opacity: 1;
    }
    /* ========================================
			FIM DO SELO RR
		======================================== */
  </style>
</head>
<body <?php body_class(); ?>>
<?php
get_template_part( 'template-parts/header' );
