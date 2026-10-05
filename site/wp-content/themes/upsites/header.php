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

		// Preload da imagem de fundo do hero (CSS background-image, então o navegador
		// só a descobriria depois de processar o CSS sem este hint).
		if (is_page_template('template-pages/home-old.php') || is_page_template('template-pages/home.php') || is_page_template('template-pages/home-new.php')) {
			$hero_img_id = get_field('imagem_tophome', get_queried_object_id());
			if ($hero_img_id) {
				$hero_img_url = wp_get_attachment_image_url($hero_img_id, 'full');
				if ($hero_img_url) {
					echo '<link rel="preload" as="image" href="' . esc_url($hero_img_url) . '">' . "\n";
				}
			}
		}
	?>
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

	<?php //if(is_page_template( 'template-pages/home-new.php' )) { ?>
		<!-- Início da Marcação Schema.org home-new ->
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@graph": [
					{
						"@type": ["Organization", "ProfessionalService"],
						"@id": "https://upsites.digital/#organization",
						"name": "UpSites Digital",
						"url": "https://upsites.digital/",
						"logo": {
							"@type": "ImageObject",
							"url": "https://upsites.digital/wp-content/uploads/2023/01/logo.png"
						},
						"image": "https://upsites.digital/wp-content/uploads/2023/01/logo.png",
						"description": "A UpSites é uma agência de criação de sites profissionais em São Paulo especializada em desenvolvimento e gestão de sites de alto impacto para empresas.",
						"telephone": "+551141303275",
						"email": "comercial@upsites.digital",
						"address": {
							"@type": "PostalAddress",
							"streetAddress": "Rua Professor Ernest Marcus, 65 - Pacaembu",
							"addressLocality": "São Paulo",
							"addressRegion": "SP",
							"postalCode": "01246-080",
							"addressCountry": "BR"
						},
						"taxID": "25.139.884/0001-90",
						"sameAs": [
							"https://facebook.com/upsites.dig",
							"https://www.instagram.com/upsites.digital/",
							"https://www.linkedin.com/company/upsites-digital/",
							"https://br.pinterest.com/UpsitesDigital/boards/"
						],
						"aggregateRating": {
							"@type": "AggregateRating",
							"ratingValue": "4.9",
							"reviewCount": "315"
						}
					},
					{
						"@type": "WebPage",
						"@id": "https://upsites.digital/criacao-sites-wordpress/#webpage",
						"url": "https://upsites.digital/criacao-sites-wordpress/",
						"name": "Desenvolvimento De Sites WordPress Para Empresas | UpSites",
						"description": "A UpSites é especialista em desenvolvimento de sites WordPress para empresas. Mais de 200 sites criados por ano desde 2016. Peça orçamento!",
						"isPartOf": {
							"@id": "https://upsites.digital/#website"
						},
						"about": {
							"@id": "https://upsites.digital/#organization"
						}
					},
					{
						"@type": "Service",
						"@id": "https://upsites.digital/criacao-sites-wordpress/#service",
						"serviceType": "Desenvolvimento de Sites WordPress",
						"provider": {
							"@id": "https://upsites.digital/#organization"
						},
						"mainEntityOfPage": {
							"@id": "https://upsites.digital/criacao-sites-wordpress/#webpage"
						},
						"description": "Criamos sites WordPress profissionais, personalizados e preparados para SEO, performance e geração de leads.",
						"offers": {
							"@type": "AggregateOffer",
							"priceCurrency": "BRL",
							"lowPrice": "609.00",
							"offerCount": "2",
							"offers": [
								{
									"@type": "Offer",
									"name": "Site Expresso",
									"price": "609.00",
									"priceCurrency": "BRL",
									"description": "Site entregue em até 5 dias, feito a partir de um modelo de site."
								},
								{
									"@type": "Offer",
									"name": "Site WordPress Sob Medida",
									"priceSpecification": {
										"@type": "PriceSpecification",
										"price": "0",
										"priceCurrency": "BRL",
										"description": "Sob Orçamento"
									},
									"description": "Site feito de forma artesanal, com layout do zero e gestor de projeto exclusivo."
								}
							]
						}
					},
					{
						"@type": "BreadcrumbList",
						"@id": "https://upsites.digital/criacao-sites-wordpress/#breadcrumb",
						"itemListElement": [
							{
								"@type": "ListItem",
								"position": 1,
								"name": "Home",
								"item": "https://upsites.digital/"
							},
							{
								"@type": "ListItem",
								"position": 2,
								"name": "Serviços"
							},
							{
								"@type": "ListItem",
								"position": 3,
								"name": "Site WordPress",
								"item": "https://upsites.digital/criacao-sites-wordpress/"
							}
						]
					},
					{
						"@type": "FAQPage",
						"@id": "https://upsites.digital/criacao-sites-wordpress/#faq",
						"mainEntity": [
							{
								"@type": "Question",
								"name": "Vale a pena usar WordPress para site de empresa?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Sim, na maioria dos casos o WordPress é uma excelente escolha para site de empresa. A plataforma oferece flexibilidade, facilidade de gestão, boa capacidade de personalização e uma estrutura muito favorável para SEO, produção de conteúdo e crescimento do projeto ao longo do tempo. Além disso, permite desenvolver desde sites institucionais até blogs, landing pages, áreas restritas e lojas virtuais. Quando o projeto é bem planejado e desenvolvido de forma profissional, o WordPress se torna uma solução confiável, escalável e adequada para empresas que buscam autonomia, presença digital mais forte e melhores resultados online."
								}
							},
							{
								"@type": "Question",
								"name": "Quanto custa um site WordPress profissional?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "O valor de um site WordPress profissional pode variar bastante conforme o tipo de projeto, a quantidade de páginas, o nível de personalização do layout, as integrações necessárias e os recursos que serão desenvolvidos. Um site institucional mais enxuto tende a ter um investimento menor do que um projeto com blog estruturado, landing pages, área de membros, loja virtual ou funcionalidades sob medida. Mais do que olhar apenas para preço, o ideal é avaliar o custo-benefício de ter um site bem planejado, com boa base técnica, design profissional, foco em desempenho e potencial real de gerar oportunidades para a empresa."
								}
							},
							{
								"@type": "Question",
								"name": "Quanto tempo leva para desenvolver um site WordPress?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "O prazo para desenvolver um site em WordPress varia de acordo com a complexidade do projeto, a quantidade de páginas, o nível de personalização do layout e as funcionalidades necessárias. Projetos mais simples costumam ser concluídos mais rápido, enquanto sites com integrações, áreas restritas, blog estruturado, páginas estratégicas ou recursos sob medida exigem um cronograma maior. Além do desenvolvimento em si, também entram no prazo etapas como briefing, layout, aprovações, inserção de conteúdo, testes e publicação. Aqui na UpSites, cada projeto recebe um planejamento claro para que o processo aconteça com organização, qualidade e previsibilidade."
								}
							},
							{
								"@type": "Question",
								"name": "O site é desenvolvido com foco em desempenho e velocidade?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Sim. Aplicamos práticas técnicas para melhorar carregamento, como otimização de imagens, estrutura de código limpa e configuração adequada do WordPress."
								}
							},
							{
								"@type": "Question",
								"name": "O site funciona bem em celular, tablet e computador?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Sim. Todos os projetos são desenvolvidos com design responsivo, garantindo boa experiência em dispositivos móveis, tablets e desktops."
								}
							},
							{
								"@type": "Question",
								"name": "O projeto é feito com layout personalizado ou baseado em tema pronto?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Os sites são desenvolvidos com layout personalizado, alinhado à identidade visual e aos objetivos do negócio. Não utilizamos temas genéricos sem adaptação."
								}
							},
							{
								"@type": "Question",
								"name": "A UpSites também ajuda com hospedagem e domínio?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Podemos orientar sobre escolha e configuração de hospedagem e registro de domínio, e também gerenciar esses serviços para você caso necessário, integrando tudo ao projeto sem complicações."
								}
							},
							{
								"@type": "Question",
								"name": "O WordPress é seguro e atualizado?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Sim. Trabalhamos com práticas e plugins atualizados para manter a segurança do site e podemos incluir em planos de manutenção a atualização contínua do WordPress e extensões, reduzindo riscos de vulnerabilidades."
								}
							},
							{
								"@type": "Question",
								"name": "É possível integrar CRM, ERP, automações e outras ferramentas ao site?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Sim. Integramos sistemas como CRM, plataformas de pagamento, serviços de email marketing e ferramentas de análise, garantindo que seu site funcione de forma conectada com suas operações digitais. Também trabalhamos com desenvolvimento de chatbots e outras ferramentas que podem ser integradas ao seu site."
								}
							},
							{
								"@type": "Question",
								"name": "O que diferencia um site WordPress criado pela UpSites de outros desenvolvedores?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "A UpSites combina design personalizado com experiência em otimização para SEO, além de treinamento para uso da plataforma e suporte contínuo. Temos histórico de entregas e portfólio que refletem qualidade técnica e foco em resultados."
								}
							},
							{
								"@type": "Question",
								"name": "Vocês criam sites com funcionalidades específicas, como área de membros ou loja virtual?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Sim. Podemos desenvolver sites com recursos avançados como área de membros, portal de cursos online ou integração com e-commerce, conforme o escopo do projeto e necessidade do cliente. Também oferecemos projetos específicos em criação de loja virtual."
								}
							},
							{
								"@type": "Question",
								"name": "O que é necessário para começar o projeto?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Para iniciar, precisamos de informações básicas sobre seu negócio, objetivos do site, exemplos de referências visuais e acesso aos ativos (domínio e hospedagem, se já existirem). A partir disso, elaboramos o briefing e contrato. Você precisa também ter definido o quanto quer investir. Na UpSites oferecemos planos com sites complexos que demanda mais investimentos, mas também oferecemos criação de sites baratos."
								}
							},
							{
								"@type": "Question",
								"name": "Vocês oferecem suporte após a entrega do site?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Sim. Além da entrega do site, oferecemos planos de suporte contínuo que incluem atualizações, manutenção técnica, backups e assistência para alterações ou melhorias após o lançamento."
								}
							},
							{
								"@type": "Question",
								"name": "O site será otimizado para mecanismos de busca (SEO)?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Sim. O desenvolvimento segue boas práticas de SEO on-page, garantindo que o site seja amigável aos mecanismos de busca, com estrutura que facilita a indexação e performance inicial otimizada para resultados orgânicos."
								}
							},
							{
								"@type": "Question",
								"name": "Posso gerenciar o conteúdo do meu site depois que ele estiver pronto?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Sim. Todos os sites WordPress são entregues com acesso ao painel administrativo, permitindo que você edite textos, imagens, vídeos e crie novas páginas de forma independente, sem necessidade de suporte técnico contínuo."
								}
							},
							{
								"@type": "Question",
								"name": "O que está incluído no desenvolvimento de um site WordPress?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "O serviço inclui planejamento do layout, desenvolvimento do site no WordPress, otimização básica para SEO, responsividade (mobile, tablet e desktop), integração com ferramentas de análise e formulários de contato, além de treinamento para uso da área administrativa."
								}
							}
						]
					}
				]
			}
		</script>
		<- Fim da Marcação Schema.org -->
	<?php if(is_category( 16 )) { ?>
		<!-- desenvolvimento-web -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "CollectionPage",
					"@id": "https://upsites.digital/desenvolvimento-web/#collectionpage",
					"url": "https://upsites.digital/desenvolvimento-web/",
					"name": "Desenvolvimento Web: Conteúdos & Dicas | UpSites",
					"description": "Coleção de conteúdos da UpSites sobre desenvolvimento web, criação de sites, WordPress, layout, performance e experiência do usuário.",
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"about": {
						"@id": "https://upsites.digital/#term-web-development"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "DefinedTerm",
					"@id": "https://upsites.digital/#term-web-development",
					"name": "Desenvolvimento web",
					"description": "Disciplina relacionada à criação e evolução técnica de sites e aplicações web.",
					"subjectOf": {
						"@id": "https://upsites.digital/desenvolvimento-web/#collectionpage"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_category( 6 )) { ?>
		<!-- trafego-organico -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "CollectionPage",
					"@id": "https://upsites.digital/trafego-organico/#collectionpage",
					"url": "https://upsites.digital/trafego-organico/",
					"name": "Tráfego Orgânico (SEO): Conteúdos & Dicas | UpSites",
					"description": "Coleção de conteúdos da UpSites sobre SEO, tráfego orgânico, autoridade, link building e otimização para mecanismos de busca.",
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"about": {
						"@id": "https://upsites.digital/#term-seo"
					},
					"inLanguage": "pt-BR"
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_author( 4 )) { ?>
		<!-- lucas-pelisari -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "ProfilePage",
					"@id": "https://upsites.digital/author/lucas-widmar-pelisari/#profilepage",
					"url": "https://upsites.digital/author/lucas-widmar-pelisari/",
					"name": "Lucas Pelisari | Especialista em SEO | UpSites",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#person-lucas-widmar-pelisari"
					},
					"inLanguage": "pt-BR",
					"description": "Perfil de Lucas Pelisari, especialista em SEO e conteúdo na UpSites."
				},
				{
					"@type": "Person",
					"@id": "https://upsites.digital/#person-lucas-widmar-pelisari",
					"name": "Lucas Pelisari",
					"url": "https://upsites.digital/author/lucas-widmar-pelisari/",
					"jobTitle": "Especialista em SEO e Conteúdo",
					"worksFor": {
						"@id": "https://upsites.digital/#organization"
					},
					"knowsAbout": [
						{
							"@id": "https://upsites.digital/#term-seo"
						},
						{
							"@id": "https://upsites.digital/#term-seo-tecnico"
						},
						{
							"@id": "https://upsites.digital/#term-link-building"
						}
					]
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_author( 3 )) { ?>
		<!-- joao-vicente-farias-santos -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "ProfilePage",
					"@id": "https://upsites.digital/author/joao-vicente-farias-santos/#profilepage",
					"url": "https://upsites.digital/author/joao-vicente-farias-santos/",
					"name": "João Vicente Farias Santos | Cofundador da UpSites",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#person-joao-vicente-farias-santos"
					},
					"inLanguage": "pt-BR",
					"description": "Perfil de João Vicente Farias Santos, cofundador da UpSites."
				},
				{
					"@type": "Person",
					"@id": "https://upsites.digital/#person-joao-vicente-farias-santos",
					"name": "João Vicente Farias Santos",
					"url": "https://upsites.digital/author/joao-vicente-farias-santos/",
					"jobTitle": "Cofundador da UpSites",
					"worksFor": {
						"@id": "https://upsites.digital/#organization"
					},
					"sameAs": [
						"https://br.linkedin.com/in/joaovicentefarias"
					]
				},
				{
					"@id": "https://upsites.digital/#organization",
					"founder": {
						"@id": "https://upsites.digital/#person-joao-vicente-farias-santos"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_author( 2 )) { ?>
		<!-- caio-nogueira -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "ProfilePage",
					"@id": "https://upsites.digital/author/caio-nogueira/#profilepage",
					"url": "https://upsites.digital/author/caio-nogueira/",
					"name": "Caio Nogueira | Cofundador da UpSites",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#person-caio-nogueira"
					},
					"inLanguage": "pt-BR",
					"description": "Perfil de Caio Nogueira, cofundador da UpSites e autor de conteúdos sobre desenvolvimento de sites e SEO."
				},
				{
					"@type": "Person",
					"@id": "https://upsites.digital/#person-caio-nogueira",
					"name": "Caio Nogueira",
					"url": "https://upsites.digital/author/caio-nogueira/",
					"jobTitle": "Cofundador da UpSites",
					"worksFor": {
						"@id": "https://upsites.digital/#organization"
					},
					"sameAs": [
						"https://br.linkedin.com/in/caionog"
					],
					"knowsAbout": [
						{
							"@id": "https://upsites.digital/#term-criacao-sites"
						},
						{
							"@id": "https://upsites.digital/#term-seo"
						},
						{
							"@id": "https://upsites.digital/#term-web-development"
						}
					]
				},
				{
					"@id": "https://upsites.digital/#organization",
					"founder": {
						"@id": "https://upsites.digital/#person-caio-nogueira"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 24819 )) { ?>
		<!-- pillar-seo-internacional -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/trafego-organico/seo-internacional/#webpage",
					"url": "https://upsites.digital/trafego-organico/seo-internacional/",
					"name": "SEO Internacional: Como Posicionar Fora do País em 2026",
					"description": "Guia sobre SEO internacional, definição de mercados, estruturas multilíngues, hreflang, localização, SEO técnico, link building e monitoramento por país.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/trafego-organico/seo-internacional/#article"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "BlogPosting",
					"@id": "https://upsites.digital/trafego-organico/seo-internacional/#article",
					"url": "https://upsites.digital/trafego-organico/seo-internacional/",
					"headline": "SEO Internacional: como posicionar seu site em outros países e idiomas",
					"description": "Guia sobre SEO internacional, definição de mercados, estruturas multilíngues, hreflang, localização, SEO técnico, link building e monitoramento por país.",
					"image": "https://upsites.digital/wp-content/uploads/2025/07/seo-internacional01.jpg",
					"datePublished": "2025-07-10",
					"author": {
						"@type": "Person",
						"@id": "https://upsites.digital/#person-caio-nogueira",
						"name": "Caio Nogueira",
						"url": "https://upsites.digital/author/caio-nogueira/"
					},
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"mainEntityOfPage": {
						"@id": "https://upsites.digital/trafego-organico/seo-internacional/#webpage"
					},
					"articleSection": "Tráfego Orgânico",
					"about": {
						"@id": "https://upsites.digital/#term-seo-internacional"
					},
					"inLanguage": "pt-BR",
					"dateModified": "2026-09-04",
					"mentions": [
						{
							"@id": "https://upsites.digital/#service-seo-geo"
						},
						{
							"@id": "https://upsites.digital/#term-seo"
						},
						{
							"@id": "https://upsites.digital/#term-link-building"
						}
					]
				},
				{
					"@type": "DefinedTerm",
					"@id": "https://upsites.digital/#term-seo-internacional",
					"name": "SEO internacional",
					"description": "Otimização de sites para diferentes países, idiomas e mercados.",
					"subjectOf": {
						"@id": "https://upsites.digital/trafego-organico/seo-internacional/#article"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 28137 )) { ?>
		<!-- pillar-layout-site -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/desenvolvimento-web/criar-layout-de-site/#webpage",
					"url": "https://upsites.digital/desenvolvimento-web/criar-layout-de-site/",
					"name": "Guia Completo para Criar Layout de Site em 2026 | UpSites",
					"description": "Guia sobre planejamento e criação de layout de site com foco em estratégia visual, experiência do usuário, responsividade, performance e conversão.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/desenvolvimento-web/criar-layout-de-site/#article"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "BlogPosting",
					"@id": "https://upsites.digital/desenvolvimento-web/criar-layout-de-site/#article",
					"url": "https://upsites.digital/desenvolvimento-web/criar-layout-de-site/",
					"headline": "Guia completo para criar layout de site 2026",
					"description": "Guia sobre planejamento e criação de layout de site com foco em estratégia visual, experiência do usuário, responsividade, performance e conversão.",
					"image": "https://upsites.digital/wp-content/uploads/2026/07/criar-layout-de-site.jpg",
					"datePublished": "2026-07-09",
					"author": {
						"@type": "Person",
						"@id": "https://upsites.digital/#person-lucas-widmar-pelisari",
						"name": "Lucas Pelisari",
						"url": "https://upsites.digital/author/lucas-widmar-pelisari/"
					},
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"mainEntityOfPage": {
						"@id": "https://upsites.digital/desenvolvimento-web/criar-layout-de-site/#webpage"
					},
					"articleSection": "Desenvolvimento Web",
					"about": {
						"@id": "https://upsites.digital/#term-web-design"
					},
					"inLanguage": "pt-BR",
					"dateModified": "2026-09-04",
					"mentions": [
						{
							"@id": "https://upsites.digital/#service-web-development"
						},
						{
							"@id": "https://upsites.digital/#term-criacao-sites"
						}
					]
				},
				{
					"@type": "DefinedTerm",
					"@id": "https://upsites.digital/#term-web-design",
					"name": "Web design e layout de sites",
					"description": "Planejamento da estrutura visual, hierarquia e experiência de interface de sites.",
					"subjectOf": {
						"@id": "https://upsites.digital/desenvolvimento-web/criar-layout-de-site/#article"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 25387 )) { ?>
		<!-- pillar-seo-para-ia -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/trafego-organico/seo-para-ia/#webpage",
					"url": "https://upsites.digital/trafego-organico/seo-para-ia/",
					"name": "SEO para IA: Como Fazer para Otimizar seu Site em 2026",
					"description": "Guia sobre otimização de conteúdo, autoridade e estrutura de sites para mecanismos de busca e experiências de resposta baseadas em inteligência artificial.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/trafego-organico/seo-para-ia/#article"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "BlogPosting",
					"@id": "https://upsites.digital/trafego-organico/seo-para-ia/#article",
					"url": "https://upsites.digital/trafego-organico/seo-para-ia/",
					"headline": "SEO para IA: Como Otimizar seu site para buscas na IA?",
					"description": "Guia sobre otimização de conteúdo, autoridade e estrutura de sites para mecanismos de busca e experiências de resposta baseadas em inteligência artificial.",
					"image": "https://upsites.digital/wp-content/uploads/2025/08/SEO-para-IA.jpg",
					"datePublished": "2025-08-22",
					"author": {
						"@type": "Person",
						"@id": "https://upsites.digital/#person-caio-nogueira",
						"name": "Caio Nogueira",
						"url": "https://upsites.digital/author/caio-nogueira/"
					},
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"mainEntityOfPage": {
						"@id": "https://upsites.digital/trafego-organico/seo-para-ia/#webpage"
					},
					"articleSection": "Tráfego Orgânico",
					"about": {
						"@id": "https://upsites.digital/#term-geo"
					},
					"inLanguage": "pt-BR",
					"dateModified": "2026-09-04",
					"mentions": [
						{
							"@id": "https://upsites.digital/#service-seo-geo"
						},
						{
							"@id": "https://upsites.digital/#term-seo"
						},
						{
							"@type": "SoftwareApplication",
							"@id": "https://chatgpt.com/",
							"name": "ChatGPT",
							"url": "https://chatgpt.com/"
						}
					],
					"citation": [
						{
							"@id": "https://cetic.br/pesquisa/domicilios/",
							"@type": "CreativeWork",
							"name": "TIC Domicílios",
							"url": "https://cetic.br/pesquisa/domicilios/"
						}
					]
				},
				{
					"@type": "DefinedTerm",
					"@id": "https://upsites.digital/#term-geo",
					"name": "Generative Engine Optimization (GEO)",
					"alternateName": "GEO",
					"description": "Otimização de conteúdo, autoridade e estrutura para experiências de busca e respostas baseadas em inteligência artificial.",
					"subjectOf": {
						"@id": "https://upsites.digital/trafego-organico/seo-para-ia/#article"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 28335 )) { ?>
		<!-- pillar-seo-tecnico -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/trafego-organico/guia-seo-tecnico-completo/#webpage",
					"url": "https://upsites.digital/trafego-organico/guia-seo-tecnico-completo/",
					"name": "Guia de SEO Técnico Completo 2026 | UpSites",
					"description": "Guia sobre SEO técnico, rastreamento, indexação, robots.txt, sitemap, Core Web Vitals, mobile-first, URLs, redirecionamentos e dados estruturados.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/trafego-organico/guia-seo-tecnico-completo/#article"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "BlogPosting",
					"@id": "https://upsites.digital/trafego-organico/guia-seo-tecnico-completo/#article",
					"url": "https://upsites.digital/trafego-organico/guia-seo-tecnico-completo/",
					"headline": "Guia de SEO técnico completo para 2026",
					"description": "Guia sobre SEO técnico, rastreamento, indexação, robots.txt, sitemap, Core Web Vitals, mobile-first, URLs, redirecionamentos e dados estruturados.",
					"image": "https://upsites.digital/wp-content/uploads/2026/08/guia-de-seo-tecnico-completo.jpg",
					"datePublished": "2026-08-14",
					"author": {
						"@type": "Person",
						"@id": "https://upsites.digital/#person-lucas-widmar-pelisari",
						"name": "Lucas Pelisari",
						"url": "https://upsites.digital/author/lucas-widmar-pelisari/"
					},
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"mainEntityOfPage": {
						"@id": "https://upsites.digital/trafego-organico/guia-seo-tecnico-completo/#webpage"
					},
					"articleSection": "Tráfego Orgânico",
					"about": {
						"@id": "https://upsites.digital/#term-seo-tecnico"
					},
					"inLanguage": "pt-BR",
					"dateModified": "2026-09-04",
					"mentions": [
						{
							"@id": "https://upsites.digital/#service-seo-geo"
						},
						{
							"@id": "https://upsites.digital/#term-seo"
						}
					],
					"citation": [
						{
							"@id": "https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data?hl=pt-br",
							"@type": "CreativeWork",
							"name": "Introdução à marcação de dados estruturados na Pesquisa Google",
							"url": "https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data?hl=pt-br"
						}
					]
				},
				{
					"@type": "DefinedTerm",
					"@id": "https://upsites.digital/#term-seo-tecnico",
					"name": "SEO técnico",
					"description": "Otimizações técnicas que facilitam rastreamento, indexação, renderização e interpretação de páginas.",
					"subjectOf": {
						"@id": "https://upsites.digital/trafego-organico/guia-seo-tecnico-completo/#article"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 28130 )) { ?>
		<!-- pillar-guia-seo -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/trafego-organico/guia-completo-seo/#webpage",
					"url": "https://upsites.digital/trafego-organico/guia-completo-seo/",
					"name": "Guia Completo de SEO em 2026 | UpSites",
					"description": "Guia de SEO em 2026 com estratégias de conteúdo, SEO técnico, autoridade, GEO, dados estruturados e presença orgânica em mecanismos de busca e ambientes com IA.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/trafego-organico/guia-completo-seo/#article"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "BlogPosting",
					"@id": "https://upsites.digital/trafego-organico/guia-completo-seo/#article",
					"url": "https://upsites.digital/trafego-organico/guia-completo-seo/",
					"headline": "Guia Completo de SEO em 2026",
					"description": "Guia de SEO em 2026 com estratégias de conteúdo, SEO técnico, autoridade, GEO, dados estruturados e presença orgânica em mecanismos de busca e ambientes com IA.",
					"image": "https://upsites.digital/wp-content/uploads/2026/07/Guia-completo-de-SEO.jpg",
					"datePublished": "2026-07-08",
					"author": {
						"@type": "Person",
						"@id": "https://upsites.digital/#person-lucas-widmar-pelisari",
						"name": "Lucas Pelisari",
						"url": "https://upsites.digital/author/lucas-widmar-pelisari/"
					},
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"mainEntityOfPage": {
						"@id": "https://upsites.digital/trafego-organico/guia-completo-seo/#webpage"
					},
					"articleSection": "Tráfego Orgânico",
					"about": {
						"@id": "https://upsites.digital/#term-seo"
					},
					"inLanguage": "pt-BR",
					"mentions": [
						{
							"@id": "https://upsites.digital/#service-seo-geo"
						},
						{
							"@id": "https://upsites.digital/#term-seo-tecnico"
						},
						{
							"@id": "https://upsites.digital/#term-geo"
						},
						{
							"@id": "https://upsites.digital/#term-link-building"
						}
					]
				},
				{
					"@type": "DefinedTerm",
					"@id": "https://upsites.digital/#term-seo",
					"name": "Search Engine Optimization (SEO)",
					"alternateName": "SEO",
					"description": "Otimização de sites e conteúdos para mecanismos de busca.",
					"subjectOf": {
						"@id": "https://upsites.digital/trafego-organico/guia-completo-seo/#article"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 26967 )) { ?>
		<!-- pillar-guia-criacao-sites -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/desenvolvimento-web/guia-completo-criacao-sites/#webpage",
					"url": "https://upsites.digital/desenvolvimento-web/guia-completo-criacao-sites/",
					"name": "Guia Completo de Criação de Sites para 2026 | UpSites",
					"description": "Guia abrangente sobre criação de sites profissionais, incluindo planejamento, tipos de site, custos, prazos, design, SEO, performance e processo de desenvolvimento.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/desenvolvimento-web/guia-completo-criacao-sites/#article"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "BlogPosting",
					"@id": "https://upsites.digital/desenvolvimento-web/guia-completo-criacao-sites/#article",
					"url": "https://upsites.digital/desenvolvimento-web/guia-completo-criacao-sites/",
					"headline": "Guia Completo de Criação de Sites",
					"description": "Guia abrangente sobre criação de sites profissionais, incluindo planejamento, tipos de site, custos, prazos, design, SEO, performance e processo de desenvolvimento.",
					"image": "https://upsites.digital/wp-content/uploads/2026/03/Guia-Completo-de-Criacao-de-Sites-8.jpg",
					"datePublished": "2026-03-13",
					"author": {
						"@type": "Person",
						"@id": "https://upsites.digital/#person-caio-nogueira",
						"name": "Caio Nogueira",
						"url": "https://upsites.digital/author/caio-nogueira/"
					},
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"mainEntityOfPage": {
						"@id": "https://upsites.digital/desenvolvimento-web/guia-completo-criacao-sites/#webpage"
					},
					"articleSection": "Desenvolvimento Web",
					"about": {
						"@id": "https://upsites.digital/#term-criacao-sites"
					},
					"inLanguage": "pt-BR",
					"dateModified": "2026-09-04",
					"mentions": [
						{
							"@id": "https://upsites.digital/#service-web-development"
						},
						{
							"@id": "https://upsites.digital/#service-wordpress"
						},
						{
							"@id": "https://upsites.digital/#term-seo"
						},
						{
							"@id": "https://upsites.digital/#term-web-design"
						}
					],
					"citation": [
						{
							"@id": "https://support.google.com/adsense/answer/7450973?hl=pt-BR",
							"@type": "CreativeWork",
							"name": "Reduza o tempo de carregamento das suas páginas para dispositivos móveis",
							"url": "https://support.google.com/adsense/answer/7450973?hl=pt-BR"
						}
					]
				},
				{
					"@type": "DefinedTerm",
					"@id": "https://upsites.digital/#term-criacao-sites",
					"name": "Criação de sites profissionais",
					"description": "Planejamento, design e desenvolvimento de sites profissionais para empresas.",
					"subjectOf": {
						"@id": "https://upsites.digital/desenvolvimento-web/guia-completo-criacao-sites/#article"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 24590 )) { ?>
		<!-- estatisticas-link-building -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/trafego-organico/estatisticas-link-building/#webpage",
					"url": "https://upsites.digital/trafego-organico/estatisticas-link-building/",
					"name": "Estatísticas de Link Building em 2026: Pesquisa Completa",
					"description": "Análise da pesquisa da UpSites com mais de 100 profissionais de SEO sobre custos, ferramentas, aquisição de backlinks, métricas e práticas de link building.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/trafego-organico/estatisticas-link-building/#article"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "BlogPosting",
					"@id": "https://upsites.digital/trafego-organico/estatisticas-link-building/#article",
					"url": "https://upsites.digital/trafego-organico/estatisticas-link-building/",
					"headline": "Estatísticas de Link Building 2026: Uma Pesquisa com Mais de 100 SEOs",
					"description": "Análise da pesquisa da UpSites com mais de 100 profissionais de SEO sobre custos, ferramentas, aquisição de backlinks, métricas e práticas de link building.",
					"image": "https://upsites.digital/wp-content/uploads/2025/05/estatisticas-de-link-building00.jpg",
					"datePublished": "2025-05-13",
					"author": {
						"@type": "Person",
						"@id": "https://upsites.digital/#person-caio-nogueira",
						"name": "Caio Nogueira",
						"url": "https://upsites.digital/author/caio-nogueira/"
					},
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"mainEntityOfPage": {
						"@id": "https://upsites.digital/trafego-organico/estatisticas-link-building/#webpage"
					},
					"articleSection": "Tráfego Orgânico",
					"about": {
						"@id": "https://upsites.digital/#term-link-building"
					},
					"inLanguage": "pt-BR",
					"dateModified": "2026-06-26",
					"mentions": [
						{
							"@id": "https://upsites.digital/#service-link-building-digital-pr"
						},
						{
							"@id": "https://upsites.digital/#term-seo"
						}
					]
				},
				{
					"@type": "DefinedTerm",
					"@id": "https://upsites.digital/#term-link-building",
					"name": "Link building",
					"description": "Estratégias de aquisição e desenvolvimento de backlinks e autoridade externa.",
					"subjectOf": {
						"@id": "https://upsites.digital/trafego-organico/estatisticas-link-building/#article"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 8563 )) { ?>
		<!-- testar-site-responsivo -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/responsividade/testar-site-responsivo/#webpage",
					"url": "https://upsites.digital/responsividade/testar-site-responsivo/",
					"name": "Teste de Responsividade: Saiba se Site é Responsivo em 2026",
					"description": "Guia prático para testar a responsividade de um site em diferentes tamanhos de tela usando emuladores, Chrome DevTools e verificações de layout.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/responsividade/testar-site-responsivo/#article"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "BlogPosting",
					"@id": "https://upsites.digital/responsividade/testar-site-responsivo/#article",
					"url": "https://upsites.digital/responsividade/testar-site-responsivo/",
					"headline": "Teste de responsividade: Como testar se o site é responsivo?",
					"description": "Guia prático para testar a responsividade de um site em diferentes tamanhos de tela usando emuladores, Chrome DevTools e verificações de layout.",
					"image": "https://upsites.digital/wp-content/uploads/2019/05/testar-site-responsivo01.jpg",
					"datePublished": "2025-10-07",
					"author": {
						"@type": "Person",
						"@id": "https://upsites.digital/#person-caio-nogueira",
						"name": "Caio Nogueira",
						"url": "https://upsites.digital/author/caio-nogueira/"
					},
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"mainEntityOfPage": {
						"@id": "https://upsites.digital/responsividade/testar-site-responsivo/#webpage"
					},
					"articleSection": "Responsividade",
					"about": {
						"@id": "https://upsites.digital/#term-web-design"
					},
					"inLanguage": "pt-BR",
					"dateModified": "2026-06-26",
					"hasPart": {
						"@id": "https://upsites.digital/responsividade/testar-site-responsivo/#howto"
					}
				},
				{
					"@type": "HowTo",
					"@id": "https://upsites.digital/responsividade/testar-site-responsivo/#howto",
					"name": "Como testar a responsividade de um site com o Chrome DevTools",
					"description": "Passo a passo para simular diferentes dispositivos e verificar o comportamento responsivo de um site no Google Chrome.",
					"mainEntityOfPage": {
						"@id": "https://upsites.digital/responsividade/testar-site-responsivo/#webpage"
					},
					"step": [
						{
							"@type": "HowToStep",
							"position": 1,
							"name": "Abra o site no Google Chrome",
							"text": "Acesse o site que deseja testar usando o Google Chrome."
						},
						{
							"@type": "HowToStep",
							"position": 2,
							"name": "Abra as ferramentas de desenvolvedor",
							"text": "Pressione F12 ou clique com o botão direito na página e selecione Inspecionar."
						},
						{
							"@type": "HowToStep",
							"position": 3,
							"name": "Ative o modo de dispositivo",
							"text": "Clique no ícone de dispositivo ou use Ctrl + Shift + M."
						},
						{
							"@type": "HowToStep",
							"position": 4,
							"name": "Selecione um dispositivo",
							"text": "Escolha o modelo de dispositivo que deseja simular, como iPhone, Galaxy ou iPad."
						},
						{
							"@type": "HowToStep",
							"position": 5,
							"name": "Teste orientação e interações",
							"text": "Ajuste a escala, altere a orientação e teste interações como toques e deslizes."
						},
						{
							"@type": "HowToStep",
							"position": 6,
							"name": "Simule conexões mais lentas",
							"text": "Use a aba Network para observar o desempenho em condições de rede diferentes."
						}
					]
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 8554 )) { ?>
		<!-- site-institucional -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/desenvolvimento-web/site-institucional/#webpage",
					"url": "https://upsites.digital/desenvolvimento-web/site-institucional/",
					"name": "Site Institucional: O Que é e Quais as Boas Práticas?",
					"description": "Guia sobre a função de um site institucional, sua estrutura, boas práticas de navegação, credibilidade, conteúdo, SEO e geração de oportunidades.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/desenvolvimento-web/site-institucional/#article"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "BlogPosting",
					"@id": "https://upsites.digital/desenvolvimento-web/site-institucional/#article",
					"url": "https://upsites.digital/desenvolvimento-web/site-institucional/",
					"headline": "Site institucional: o que é e quais as boas práticas?",
					"description": "Guia sobre a função de um site institucional, sua estrutura, boas práticas de navegação, credibilidade, conteúdo, SEO e geração de oportunidades.",
					"image": "https://upsites.digital/wp-content/uploads/2019/05/site-institucional-4.jpg",
					"datePublished": "2025-09-23",
					"author": {
						"@type": "Person",
						"@id": "https://upsites.digital/#person-caio-nogueira",
						"name": "Caio Nogueira",
						"url": "https://upsites.digital/author/caio-nogueira/"
					},
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"mainEntityOfPage": {
						"@id": "https://upsites.digital/desenvolvimento-web/site-institucional/#webpage"
					},
					"articleSection": "Desenvolvimento Web",
					"about": {
						"@id": "https://upsites.digital/#term-criacao-sites"
					},
					"inLanguage": "pt-BR",
					"dateModified": "2026-09-04",
					"mentions": [
						{
							"@id": "https://upsites.digital/#service-web-development"
						}
					]
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 8893 )) { ?>
		<!-- quanto-custa-manter-site -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-manter-site-no-ar/#webpage",
					"url": "https://upsites.digital/desenvolvimento-web/quanto-custa-manter-site-no-ar/",
					"name": "Quanto Custa Manter um Site? Preços em 2026 | UpSites",
					"description": "Guia sobre os principais custos para manter um site no ar, incluindo hospedagem, domínio, segurança, manutenção, atualizações e suporte.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-manter-site-no-ar/#article"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "BlogPosting",
					"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-manter-site-no-ar/#article",
					"url": "https://upsites.digital/desenvolvimento-web/quanto-custa-manter-site-no-ar/",
					"headline": "Quanto custa manter um site no ar em 2026: Preços e Despesas",
					"description": "Guia sobre os principais custos para manter um site no ar, incluindo hospedagem, domínio, segurança, manutenção, atualizações e suporte.",
					"image": "https://upsites.digital/wp-content/uploads/2019/06/quanto_custa_manter_um_site_no_ar.jpg",
					"datePublished": "2025-11-11",
					"author": {
						"@type": "Person",
						"@id": "https://upsites.digital/#person-caio-nogueira",
						"name": "Caio Nogueira",
						"url": "https://upsites.digital/author/caio-nogueira/"
					},
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"mainEntityOfPage": {
						"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-manter-site-no-ar/#webpage"
					},
					"articleSection": "Desenvolvimento Web",
					"about": {
						"@id": "https://upsites.digital/#term-web-development"
					},
					"inLanguage": "pt-BR",
					"dateModified": "2026-06-26"
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 8126 )) { ?>
		<!-- quanto-custa-site-profissional -->
		<!-- Início da Marcação Schema.org Quanto custa um site profissional em 2026 -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/#webpage",
					"url": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/",
					"name": "Quanto Custa um Site Profissional em 2026 | UpSites",
					"description": "Análise dos fatores que influenciam o custo de criação e manutenção de sites profissionais, incluindo tipo de projeto, tecnologia, design e funcionalidades.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/#article"
					},
					"inLanguage": "pt-BR",
					"reviewedBy": {
						"@type": "Person",
						"@id": "https://upsites.digital/#person-lucas-widmar-pelisari",
						"name": "Lucas Pelisari",
						"url": "https://upsites.digital/author/lucas-widmar-pelisari/"
					}
				},
				{
					"@type": "BlogPosting",
					"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/#article",
					"url": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/",
					"headline": "Quanto custa um site profissional em 2026?",
					"description": "Análise dos fatores que influenciam o custo de criação e manutenção de sites profissionais, incluindo tipo de projeto, tecnologia, design e funcionalidades.",
					"image": "https://upsites.digital/wp-content/uploads/2019/03/quanto_custa_site_profissional-1.jpg",
					"datePublished": "2025-09-11",
					"author": {
						"@type": "Person",
						"@id": "https://upsites.digital/#person-caio-nogueira",
						"name": "Caio Nogueira",
						"url": "https://upsites.digital/author/caio-nogueira/"
					},
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"isPartOf": {
						"@id": "https://upsites.digital/#blog"
					},
					"mainEntityOfPage": {
						"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/#webpage"
					},
					"articleSection": "Desenvolvimento Web",
					"about": {
						"@id": "https://upsites.digital/#term-criacao-sites"
					},
					"inLanguage": "pt-BR",
					"dateModified": "2026-07-07",
					"mentions": [
						{
							"@id": "https://upsites.digital/#service-web-development"
						}
					]
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_page( 17931 )) { ?>
		<!-- chatbot -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/desenvolvimento-chatbot/#webpage",
					"url": "https://upsites.digital/desenvolvimento-chatbot/",
					"name": "Desenvolvimento de Chatbots Profissionais | UpSites",
					"description": "Desenvolvimento de chatbots para atendimento, qualificação de leads, automação de processos, integrações e experiências conversacionais.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-chatbot-development"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-chatbot-development",
					"name": "Desenvolvimento de Chatbots",
					"description": "Desenvolvimento de chatbots e assistentes digitais para atendimento, qualificação de leads, automação de processos e integrações.",
					"serviceType": "Desenvolvimento de chatbots e assistentes digitais",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/desenvolvimento-chatbot/",
					"audience": {
						"@type": "BusinessAudience",
						"audienceType": "Empresas que buscam automatizar atendimento e processos"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_page( 23198 )) { ?>
		<!-- software-house -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/software-house/#webpage",
					"url": "https://upsites.digital/software-house/",
					"name": "Software House | Empresa de Desenvolvimento de Software",
					"description": "Desenvolvimento de software sob medida, sistemas empresariais, plataformas web, APIs, integrações e automações para empresas.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-software-development"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-software-development",
					"name": "Desenvolvimento de Software Sob Medida",
					"description": "Desenvolvimento de sistemas, plataformas e aplicações web personalizadas, incluindo UX/UI, APIs, integrações, automações e evolução de software.",
					"serviceType": "Desenvolvimento de software sob medida",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/software-house/",
					"audience": {
						"@type": "BusinessAudience",
						"audienceType": "Empresas que precisam de software personalizado"
					},
					"alternateName": [
						"Software House"
					]
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_page( 25528 )) { ?>
		<!-- hub-segmentos -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "CollectionPage",
					"@id": "https://upsites.digital/criacao-sites-segmentos/#collectionpage",
					"url": "https://upsites.digital/criacao-sites-segmentos/",
					"name": "Criação de Sites por Segmentos | UpSites",
					"description": "Página que reúne soluções de criação de sites profissionais para diferentes segmentos e tipos de empresa.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"about": {
						"@id": "https://upsites.digital/#service-web-development"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/criacao-sites-segmentos/#segment-list"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "ItemList",
					"@id": "https://upsites.digital/criacao-sites-segmentos/#segment-list",
					"name": "Segmentos atendidos pela UpSites",
					"itemListElement": [
						{
							"@type": "ListItem",
							"position": 1,
							"name": "Site para Insurtech",
							"url": "https://upsites.digital/criacao-de-site-para-insurtech/"
						},
						{
							"@type": "ListItem",
							"position": 2,
							"name": "Site para Lawtech",
							"url": "https://upsites.digital/criacao-de-site-para-lawtech/"
						},
						{
							"@type": "ListItem",
							"position": 3,
							"name": "Site para Fintech",
							"url": "https://upsites.digital/criacao-de-site-para-fintech/"
						},
						{
							"@type": "ListItem",
							"position": 4,
							"name": "Site para Healthtech",
							"url": "https://upsites.digital/criacao-de-site-para-healthtech/"
						},
						{
							"@type": "ListItem",
							"position": 5,
							"name": "Site para Indústria",
							"url": "https://upsites.digital/criacao-de-site-para-industria/"
						},
						{
							"@type": "ListItem",
							"position": 6,
							"name": "Site para Prefeitura",
							"url": "https://upsites.digital/criacao-de-site-para-prefeitura/"
						},
						{
							"@type": "ListItem",
							"position": 7,
							"name": "Site para Transportadora",
							"url": "https://upsites.digital/criacao-de-site-para-transportadora/"
						},
						{
							"@type": "ListItem",
							"position": 8,
							"name": "Site para Startup",
							"url": "https://upsites.digital/criacao-de-site-para-startup/"
						},
						{
							"@type": "ListItem",
							"position": 9,
							"name": "Site para Hospitais",
							"url": "https://upsites.digital/criacao-de-site-para-hospitais/"
						},
						{
							"@type": "ListItem",
							"position": 10,
							"name": "Site para Relações com Investidores",
							"url": "https://upsites.digital/criacao-de-site-de-relacoes-com-investidores/"
						},
						{
							"@type": "ListItem",
							"position": 11,
							"name": "Site para Psiquiatras",
							"url": "https://upsites.digital/criacao-de-site-para-psiquiatras/"
						},
						{
							"@type": "ListItem",
							"position": 12,
							"name": "Site para Psicólogos",
							"url": "https://upsites.digital/criacao-de-site-para-psicologos/"
						},
						{
							"@type": "ListItem",
							"position": 13,
							"name": "Site para Pousada",
							"url": "https://upsites.digital/criacao-de-site-para-pousada/"
						},
						{
							"@type": "ListItem",
							"position": 14,
							"name": "Site para Empresa de Ônibus",
							"url": "https://upsites.digital/criacao-de-site-para-empresa-de-onibus/"
						},
						{
							"@type": "ListItem",
							"position": 15,
							"name": "Site para Empresa de Logística",
							"url": "https://upsites.digital/criacao-de-site-para-empresa-de-logistica/"
						},
						{
							"@type": "ListItem",
							"position": 16,
							"name": "Site para Clínica Veterinária",
							"url": "https://upsites.digital/criacao-de-site-para-clinica-veterinaria/"
						},
						{
							"@type": "ListItem",
							"position": 17,
							"name": "Site para Influenciadores",
							"url": "https://upsites.digital/criacao-de-site-para-influenciadores/"
						},
						{
							"@type": "ListItem",
							"position": 18,
							"name": "Site para Advogados",
							"url": "https://upsites.digital/criacao-site-advogados/"
						},
						{
							"@type": "ListItem",
							"position": 19,
							"name": "Site para Médicos",
							"url": "https://upsites.digital/criacao-site-medicos/"
						},
						{
							"@type": "ListItem",
							"position": 20,
							"name": "Site para Dentistas",
							"url": "https://upsites.digital/criacao-de-site-para-dentista/"
						},
						{
							"@type": "ListItem",
							"position": 21,
							"name": "Site para Contabilidade",
							"url": "https://upsites.digital/criacao-site-contabilidade/"
						},
						{
							"@type": "ListItem",
							"position": 22,
							"name": "Site para Construtora",
							"url": "https://upsites.digital/criacao-de-site-para-construtora/"
						},
						{
							"@type": "ListItem",
							"position": 23,
							"name": "Site para Engenheiros",
							"url": "https://upsites.digital/criacao-de-site-para-engenheiros/"
						},
						{
							"@type": "ListItem",
							"position": 24,
							"name": "Site para Empresas de Segurança",
							"url": "https://upsites.digital/criacao-de-site-para-empresas-de-seguranca/"
						},
						{
							"@type": "ListItem",
							"position": 25,
							"name": "Site para Escolas de Idiomas",
							"url": "https://upsites.digital/criacao-de-site-para-escolas-de-idiomas/"
						},
						{
							"@type": "ListItem",
							"position": 26,
							"name": "Site para Empresas de Tecnologia",
							"url": "https://upsites.digital/criacao-de-site-para-empresas-de-tecnologia/"
						},
						{
							"@type": "ListItem",
							"position": 27,
							"name": "Site para Agência de Viagens",
							"url": "https://upsites.digital/criacao-de-site-para-agencia-de-viagens/"
						},
						{
							"@type": "ListItem",
							"position": 28,
							"name": "Site para Fisioterapeutas",
							"url": "https://upsites.digital/criacao-de-site-para-fisioterapeutas/"
						},
						{
							"@type": "ListItem",
							"position": 29,
							"name": "Site para Nutricionistas",
							"url": "https://upsites.digital/criacao-de-site-para-nutricionistas/"
						},
						{
							"@type": "ListItem",
							"position": 30,
							"name": "Site para Energia Solar",
							"url": "https://upsites.digital/criacao-de-site-para-energia-solar/"
						},
						{
							"@type": "ListItem",
							"position": 31,
							"name": "Site para Faculdade",
							"url": "https://upsites.digital/criacao-de-site-para-faculdade/"
						},
						{
							"@type": "ListItem",
							"position": 32,
							"name": "Site para Político",
							"url": "https://upsites.digital/criacao-site-politico/"
						},
						{
							"@type": "ListItem",
							"position": 33,
							"name": "Site para Provedor de Internet",
							"url": "https://upsites.digital/criacao-site-para-provedor-de-internet/"
						},
						{
							"@type": "ListItem",
							"position": 34,
							"name": "Site para Corretora de Seguros",
							"url": "https://upsites.digital/criacao-site-para-corretora-de-seguros/"
						},
						{
							"@type": "ListItem",
							"position": 35,
							"name": "Site para Imobiliária",
							"url": "https://upsites.digital/site-para-imobiliaria/"
						},
						{
							"@type": "ListItem",
							"position": 36,
							"name": "Site para Escola",
							"url": "https://upsites.digital/criacao-site-para-escolas/"
						},
						{
							"@type": "ListItem",
							"position": 37,
							"name": "Site para Restaurante",
							"url": "https://upsites.digital/criacao-site-para-restaurantes/"
						},
						{
							"@type": "ListItem",
							"position": 38,
							"name": "Site para Academia",
							"url": "https://upsites.digital/criacao-site-para-academias/"
						},
						{
							"@type": "ListItem",
							"position": 39,
							"name": "Site para Terapeutas",
							"url": "https://upsites.digital/criacao-site-para-terapeutas/"
						},
						{
							"@type": "ListItem",
							"position": 40,
							"name": "Site para Arquitetos",
							"url": "https://upsites.digital/criacao-site-para-arquitetos/"
						},
						{
							"@type": "ListItem",
							"position": 41,
							"name": "Site para Fotógrafos",
							"url": "https://upsites.digital/criacao-site-para-fotografos/"
						}
					]
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_page( 41 )) { ?>
		<!-- portfolio -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "CollectionPage",
					"@id": "https://upsites.digital/portfolio/#collectionpage",
					"url": "https://upsites.digital/portfolio/",
					"name": "Portfólio de Sites Profissionais | UpSites",
					"description": "Portfólio de projetos de sites e experiências digitais apresentados pela UpSites.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/portfolio/#portfolio-list"
					},
					"about": {
						"@id": "https://upsites.digital/#service-web-development"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "ItemList",
					"@id": "https://upsites.digital/portfolio/#portfolio-list",
					"name": "Projetos em destaque no portfólio da UpSites",
					"itemListElement": [
						{
							"@type": "ListItem",
							"position": 1,
							"item": {
								"@type": "WebSite",
								"@id": "https://parcerseguros.com.br/",
								"name": "Parcer",
								"url": "https://parcerseguros.com.br/",
								"description": "Site para uma rede nacional de seguros"
							}
						},
						{
							"@type": "ListItem",
							"position": 2,
							"item": {
								"@type": "WebSite",
								"@id": "https://dbtesser.com.br/",
								"name": "DB Tesser",
								"url": "https://dbtesser.com.br/",
								"description": "Site corporativo bilíngue para escritório jurídico"
							}
						},
						{
							"@type": "ListItem",
							"position": 3,
							"item": {
								"@type": "WebSite",
								"@id": "https://premioibest.com/",
								"name": "Prêmio iBest",
								"url": "https://premioibest.com/",
								"description": "Portal de votação e premiação digital"
							}
						},
						{
							"@type": "ListItem",
							"position": 4,
							"item": {
								"@type": "WebSite",
								"@id": "https://infleet.com.br/",
								"name": "Infleet",
								"url": "https://infleet.com.br/",
								"description": "Site corporativo B2B para empresa de tecnologia e gestão de frotas"
							}
						},
						{
							"@type": "ListItem",
							"position": 5,
							"item": {
								"@type": "WebSite",
								"@id": "https://asksuite.com/",
								"name": "Asksuite",
								"url": "https://asksuite.com/",
								"description": "Site global para empresa SaaS de IA voltada à hotelaria"
							}
						},
						{
							"@type": "ListItem",
							"position": 6,
							"item": {
								"@type": "WebSite",
								"@id": "https://flowgames.gg/",
								"name": "Flow Games",
								"url": "https://flowgames.gg/",
								"description": "Portal editorial de notícias e cultura gamer"
							}
						}
					]
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_page( 2 )) { ?>
		<!-- blog -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "CollectionPage",
					"@id": "https://upsites.digital/blog/#collectionpage",
					"url": "https://upsites.digital/blog/",
					"name": "Blog de Web Design, SEO e Vendas Online | UpSites",
					"description": "Blog da UpSites com conteúdos sobre desenvolvimento web, SEO, marketing, vendas online e crescimento digital.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#blog"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Blog",
					"@id": "https://upsites.digital/#blog",
					"name": "Blog da UpSites",
					"url": "https://upsites.digital/blog/",
					"publisher": {
						"@id": "https://upsites.digital/#organization"
					},
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"about": [
						{
							"@id": "https://upsites.digital/#term-web-development"
						},
						{
							"@id": "https://upsites.digital/#term-seo"
						}
					],
					"inLanguage": "pt-BR"
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_page( 19210 )) { ?>
		<!-- site-por-assinatura -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/site-por-assinatura/#webpage",
					"url": "https://upsites.digital/site-por-assinatura/",
					"name": "Site por Assinatura | Site Expresso | UpSites",
					"description": "Site por assinatura da UpSites, oferecido pelo modelo Site Expresso, com criação profissional, layout personalizável, edição visual e suporte.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-site-expresso"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-site-expresso",
					"name": "Site Expresso",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"alternateName": [
						"Site por Assinatura"
					]
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_page( 206 )) { ?>
		<!-- site-expresso -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/criacao-sites-baratos/#webpage",
					"url": "https://upsites.digital/criacao-sites-baratos/",
					"name": "Criação de Sites Baratos | Site Expresso | UpSites",
					"description": "Site Expresso da UpSites: criação de site profissional com modelo personalizável, editor visual, responsividade e estrutura técnica para empresas.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-site-expresso"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-site-expresso",
					"name": "Site Expresso",
					"description": "Modelo de criação de site profissional com implantação rápida, layout personalizável, edição visual e suporte.",
					"serviceType": "Criação de sites profissionais com modelo personalizável",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"audience": {
						"@type": "BusinessAudience",
						"audienceType": "Empresas que precisam lançar um site com rapidez"
					},
					"alternateName": [
						"Site por Assinatura"
					],
					"subjectOf": [
						{
							"@id": "https://upsites.digital/criacao-sites-baratos/#webpage"
						},
						{
							"@id": "https://upsites.digital/site-por-assinatura/#webpage"
						}
					]
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_page( 314 )) { ?>
		<!-- ecommerce -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/criacao-loja-virtual-wordpress/#webpage",
					"url": "https://upsites.digital/criacao-loja-virtual-wordpress/",
					"name": "Criação de Loja Virtual Profissional | Criação de E-commerce",
					"description": "Desenvolvimento de lojas virtuais profissionais com catálogo, meios de pagamento, logística, integrações, responsividade e estrutura para SEO.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-ecommerce"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-ecommerce",
					"name": "Desenvolvimento de E-commerce",
					"description": "Desenvolvimento de lojas virtuais e e-commerces para empresas, com catálogo, pagamentos, logística, integrações, responsividade e estrutura para SEO.",
					"serviceType": "Desenvolvimento de lojas virtuais e e-commerce",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/criacao-loja-virtual-wordpress/",
					"audience": {
						"@type": "BusinessAudience",
						"audienceType": "Empresas que vendem produtos ou serviços online"
					},
					"alternateName": [
						"Criação de Loja Virtual"
					]
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_page( 391 )) { ?>
		<!-- consultoria-seo -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/consultoria-seo/#webpage",
					"url": "https://upsites.digital/consultoria-seo/",
					"name": "Consultoria de SEO para Empresas | Otimização de Sites",
					"description": "Consultoria de SEO para empresas com análise técnica, conteúdo, autoridade, link building e estratégias para buscas tradicionais e experiências com IA.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-seo-geo"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-seo-geo",
					"name": "Consultoria de SEO para Empresas",
					"description": "Consultoria de SEO para empresas envolvendo SEO técnico, conteúdo, autoridade, link building e otimização para experiências de busca baseadas em inteligência artificial.",
					"serviceType": "Consultoria de SEO, SEO técnico, conteúdo, autoridade e GEO",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/consultoria-seo/",
					"audience": {
						"@type": "BusinessAudience",
						"audienceType": "Empresas que buscam ampliar visibilidade orgânica"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_page( 19315 )) { ?>
		<!-- wordpress -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/criacao-sites-wordpress/#webpage",
					"url": "https://upsites.digital/criacao-sites-wordpress/",
					"name": "Desenvolvimento de Sites WordPress para Empresas | UpSites",
					"description": "Desenvolvimento de sites WordPress profissionais para empresas, com design responsivo, estrutura gerenciável, SEO técnico e integrações.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#service-wordpress"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-wordpress",
					"name": "Desenvolvimento de Sites WordPress",
					"description": "Desenvolvimento de sites profissionais em WordPress para empresas, com arquitetura, UX/UI, responsividade, SEO técnico, performance e integrações.",
					"serviceType": "Desenvolvimento de sites WordPress para empresas",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/criacao-sites-wordpress/",
					"audience": {
						"@type": "BusinessAudience",
						"audienceType": "Empresas e organizações"
					}
				}
			]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_page( 63 )) { ?>
		<!-- home -->
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@graph": [
				{
					"@type": "WebPage",
					"@id": "https://upsites.digital/#webpage",
					"url": "https://upsites.digital/",
					"name": "Criação de Sites Profissionais SP | Desenvolvimento de Sites",
					"description": "Agência de criação de sites profissionais com foco em geração de leads, SEO e performance. Desenvolvimento de sites personalizados para empresas.",
					"isPartOf": {
						"@id": "https://upsites.digital/#website"
					},
					"mainEntity": {
						"@id": "https://upsites.digital/#organization"
					},
					"inLanguage": "pt-BR"
				},
				{
					"@type": "Organization",
					"@id": "https://upsites.digital/#organization",
					"description": "Agência brasileira de criação de sites profissionais, desenvolvimento web e SEO, fundada em 2016, com sede em São Paulo, atuação em todo o Brasil e mais de 200 sites por ano.",
					"foundingDate": "2016",
					"taxID": "25.139.884/0001-90",
					"telephone": "+55-11-4130-3275",
					"email": "comercial@upsites.digital",
					"address": {
						"@type": "PostalAddress",
						"streetAddress": "Rua Professor Ernest Marcus, 65 - Pacaembu",
						"addressLocality": "São Paulo",
						"addressRegion": "SP",
						"postalCode": "01246-080",
						"addressCountry": "BR"
					},
					"contactPoint": {
						"@type": "ContactPoint",
						"contactType": "sales",
						"telephone": "+55-11-4130-3275",
						"email": "comercial@upsites.digital",
						"availableLanguage": "pt-BR",
						"areaServed": "BR"
					},
					"sameAs": [
						"https://www.linkedin.com/company/upsites-digital",
						"https://www.instagram.com/upsites.digital/"
					],
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"knowsAbout": [
						{
							"@id": "https://upsites.digital/#term-criacao-sites"
						},
						{
							"@id": "https://upsites.digital/#term-web-development"
						},
						"WordPress",
						{
							"@id": "https://upsites.digital/#term-seo"
						},
						{
							"@id": "https://upsites.digital/#term-geo"
						},
						"E-commerce",
						"Desenvolvimento de software",
						"Chatbots",
						{
							"@id": "https://upsites.digital/#term-link-building"
						},
						"Digital PR"
					],
					"hasOfferCatalog": {
						"@type": "OfferCatalog",
						"@id": "https://upsites.digital/#service-catalog",
						"name": "Serviços da UpSites",
						"itemListElement": [
							{
								"@type": "Offer",
								"itemOffered": {
									"@id": "https://upsites.digital/#service-web-development"
								}
							},
							{
								"@type": "Offer",
								"itemOffered": {
									"@id": "https://upsites.digital/#service-site-expresso"
								}
							},
							{
								"@type": "Offer",
								"itemOffered": {
									"@id": "https://upsites.digital/#service-wordpress"
								}
							},
							{
								"@type": "Offer",
								"itemOffered": {
									"@id": "https://upsites.digital/#service-ecommerce"
								}
							},
							{
								"@type": "Offer",
								"itemOffered": {
									"@id": "https://upsites.digital/#service-seo-geo"
								}
							},
							{
								"@type": "Offer",
								"itemOffered": {
									"@id": "https://upsites.digital/#service-software-development"
								}
							},
							{
								"@type": "Offer",
								"itemOffered": {
									"@id": "https://upsites.digital/#service-chatbot-development"
								}
							},
							{
								"@type": "Offer",
								"itemOffered": {
									"@id": "https://upsites.digital/#service-link-building-digital-pr"
								}
							}
						]
					}
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-web-development",
					"name": "Criação de Sites Profissionais",
					"description": "Criação e desenvolvimento de sites profissionais para empresas, com arquitetura, UX/UI, design responsivo, SEO técnico, performance, integrações e treinamento.",
					"serviceType": "Criação e desenvolvimento de sites profissionais para empresas",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"url": "https://upsites.digital/",
					"audience": {
						"@type": "BusinessAudience",
						"audienceType": "Empresas e organizações"
					}
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-site-expresso",
					"name": "Site Expresso",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"alternateName": [
						"Site por Assinatura"
					]
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-wordpress",
					"name": "Desenvolvimento de Sites WordPress",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"url": "https://upsites.digital/criacao-sites-wordpress/"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-ecommerce",
					"name": "Desenvolvimento de E-commerce",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"url": "https://upsites.digital/criacao-loja-virtual-wordpress/"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-seo-geo",
					"name": "Consultoria de SEO para Empresas",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"url": "https://upsites.digital/consultoria-seo/"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-software-development",
					"name": "Desenvolvimento de Software Sob Medida",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"url": "https://upsites.digital/software-house/"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-chatbot-development",
					"name": "Desenvolvimento de Chatbots",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"url": "https://upsites.digital/desenvolvimento-chatbot/"
				},
				{
					"@type": "Service",
					"@id": "https://upsites.digital/#service-link-building-digital-pr",
					"name": "Link Building e Digital PR",
					"description": "Serviço de aquisição de backlinks e menções editoriais em portais para ampliar autoridade, relevância e presença digital.",
					"serviceType": "Link Building e Digital PR",
					"provider": {
						"@id": "https://upsites.digital/#organization"
					},
					"areaServed": {
						"@type": "Country",
						"name": "Brasil"
					},
					"audience": {
						"@type": "BusinessAudience",
						"audienceType": "Empresas e marcas que buscam ampliar autoridade e presença digital"
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
