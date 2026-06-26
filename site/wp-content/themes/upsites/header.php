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
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>

	<?php if(is_page_template( 'template-pages/home-new.php' )) { ?>
		<!-- Início da Marcação Schema.org home-new -->
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
		<!-- Fim da Marcação Schema.org -->
	<?php } elseif(is_single( 8126 )) { ?>
		<!-- Início da Marcação Schema.org Quanto custa um site profissional em 2026 -->
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
						"description": "Agência de criação de sites profissionais para empresas. Desenvolvemos plataformas de alta qualidade, estrategicamente estruturadas com foco em credibilidade, experiência do usuário (UX) e conversão para resultados de negócios.",
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
						},
						"priceRange": "BRL 609.90 - 100000.00",
						"hasOfferCatalog": {
							"@type": "OfferCatalog",
							"name": "Serviços de Criação de Sites Profissionais",
							"itemListElement": [
								{
									"@type": "Offer",
									"itemOffered": {
										"@type": "Service",
										"name": "Criação de Site Baseado em Template",
										"description": "Plataforma profissional de alto desempenho com design adaptado de template."
									},
									"price": "609.90",
									"priceCurrency": "BRL"
								}
							]
						}
					},
					{
						"@type": "WebPage",
						"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/#webpage",
						"url": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/",
						"name": "Quanto Custa Um Site Profissional Em 2026 | UpSites",
						"description": "Quanto custa um site profissional em 2026? Veja a tabela de preços de criação de sites e saiba como economizar no orçamento!",
						"isPartOf": {
							"@id": "https://upsites.digital/#website"
						},
						"about": {
							"@id": "https://upsites.digital/#organization"
						}
					},
					{
						"@type": "BlogPosting",
						"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/#article",
						"isPartOf": {
							"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/#webpage"
						},
						"mainEntityOfPage": {
							"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/#webpage"
						},
						"headline": "Quanto custa um site profissional em 2026?",
						"description": "O custo de um site depende da forma como você escolhe desenvolvê-lo, do tipo de projeto e das funcionalidades envolvidas. Veja a tabela de preços completa.",
						"image": {
							"@type": "ImageObject",
							"url": "https://upsites.digital/wp-content/uploads/2019/03/quanto_custa_site_profissional-1.jpg",
							"width": 736,
							"height": 562
						},
						"datePublished": "2025-09-11T08:00:00-03:00",
						"dateModified": "2026-03-16T20:10:07-03:00",
						"author": {
							"@id": "https://upsites.digital/author/caio/#person"
						},
						"publisher": {
							"@id": "https://upsites.digital/#organization"
						}
					},
					{
						"@type": "Person",
						"@id": "https://upsites.digital/author/caio/#person",
						"name": "Caio Nogueira",
						"url": "https://upsites.digital/author/caio/",
						"jobTitle": "Co-fundador",
						"description": "Caio Nogueira é co-fundador da UpSites e uma referência em desenvolvimento de sites e consultoria de SEO.",
						"worksFor": {
							"@id": "https://upsites.digital/#organization"
						},
						"sameAs": [
							"https://www.linkedin.com/in/caionog/"
						]
					},
					{
						"@type": "BreadcrumbList",
						"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/#breadcrumb",
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
								"name": "Desenvolvimento Web",
								"item": "https://upsites.digital/desenvolvimento-web/"
							},
							{
								"@type": "ListItem",
								"position": 3,
								"name": "Quanto custa um site profissional em 2026?"
							}
						]
					},
					{
						"@type": "FAQPage",
						"@id": "https://upsites.digital/desenvolvimento-web/quanto-custa-site-profissional/#faq",
						"mainEntity": [
							{
								"@type": "Question",
								"name": "Qual é o valor mínimo para criar um site profissional?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "O valor mínimo gira em torno de R$ 609,90, considerando um site baseado em template, com domínio e hospedagem básicos. Essa opção é recomendada para quem busca um site institucional simples e funcional."
								}
							},
							{
								"@type": "Question",
								"name": "O que influencia no preço final de um site?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Diversos fatores impactam o valor final: tipo de site (institucional, loja virtual, blog), número de páginas, design personalizado, funcionalidades extras, criação de conteúdo, plataforma usada, e forma de desenvolvimento (sozinho, freelancer ou agência)."
								}
							},
							{
								"@type": "Question",
								"name": "Vale a pena usar um criador de sites gratuito?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Criadores gratuitos como Wix ou WordPress.com podem ser úteis para testes e projetos pessoais. No entanto, possuem limitações em SEO, design e personalização, além de custo elevado para upgrades. Para projetos profissionais, o ideal é optar por soluções como WordPress.org com domínio próprio e hospedagem."
								}
							},
							{
								"@type": "Question",
								"name": "Quanto custa um domínio e uma hospedagem?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Domínio .com.br: R$ 40/ano (Registro BR). Hospedagem Compartilhada: R$ 20 a R$ 50/mês. Hospedagem VPS: R$ 50 a R$ 200/mês. Hospedagem Dedicada: A partir de R$ 400/mês. Esses valores podem variar conforme o provedor e o nível de recursos contratados."
								}
							},
							{
								"@type": "Question",
								"name": "É mais barato contratar um freelancer ou uma agência?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Freelancers costumam ter um custo inicial menor (R$ 3.000 a R$ 10.000), mas podem não oferecer suporte contínuo ou estrutura de equipe. Agências como a UpSites oferecem planos otimizados, com equipe completa e acompanhamento técnico, garantindo mais segurança e qualidade no longo prazo."
								}
							},
							{
								"@type": "Question",
								"name": "Quanto custa manter um site no ar?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Os custos de manutenção variam de R$ 95 a R$ 5.000/mês, dependendo do tamanho e complexidade do site. Esse valor inclui atualizações, backups, correções, suporte técnico e segurança."
								}
							},
							{
								"@type": "Question",
								"name": "É possível criar um site sozinho?",
								"acceptedAnswer": {
									"@type": "Answer",
									"text": "Sim, é possível criar seu próprio site com ferramentas como WordPress, mas exige tempo, aprendizado e atenção com a estrutura. O custo pode ficar entre R$ 700 e R$ 1.500 no primeiro ano. Porém, erros técnicos podem gerar retrabalho e comprometer a performance."
								}
							}
						]
					}
				]
			}
		</script>
		<!-- Fim da Marcação Schema.org -->
	<?php } else { ?>
		<!-- Marcação Schema.org Otimizada -->
		<script type="application/ld+json">
		{
		  "@context": "https://schema.org",
		  "@graph": [
		    {
		      "@type": "ProfessionalService",
		      "@id": "https://upsites.digital/#organization",
		      "name": "UpSites Digital",
		      "url": "https://upsites.digital/",
		      "logo": "https://upsites.digital/wp-content/uploads/2023/01/logo.png",
		      "image": "https://upsites.digital/wp-content/uploads/2023/01/logo.png",
		      "description": "Agência de criação de sites profissionais para empresas. Especialistas em desenvolvimento de sites personalizados desde 2016.",
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
		      },
		      "priceRange": "$$",
		      "hasOfferCatalog": {
		        "@type": "OfferCatalog",
		        "name": "Serviços da Agência",
		        "itemListElement": [
		          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Criação de Sites Sob Medida" } },
		          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Criação de Site Expresso" } },
		          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Criação de E-commerce" } },
		          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Consultoria SEO" } },
		          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Software House" } }
		        ]
		      }
		    },
		    {
		      "@type": "WebSite",
		      "@id": "https://upsites.digital/#website",
		      "url": "https://upsites.digital/",
		      "name": "UpSites Digital",
		      "description": "Criação De Sites Profissionais SP | Desenvolvimento De Sites",
		      "publisher": {
		        "@id": "https://upsites.digital/#organization"
		      },
		      "inLanguage": "pt-BR"
		    },
		    {
		      "@type": "FAQPage",
		      "@id": "https://upsites.digital/#faq",
		      "mainEntity": [
		        {
		          "@type": "Question",
		          "name": "Qual a diferença entre site profissional e site comum?",
		          "acceptedAnswer": {
		            "@type": "Answer",
		            "text": "Um site profissional é desenvolvido com foco em estratégia, desempenho e geração de resultados. Ele é pensado para atrair visitantes qualificados, oferecer uma boa experiência de navegação e facilitar a conversão em clientes."
		          }
		        },
		        {
		          "@type": "Question",
		          "name": "Como escolher uma empresa de criação de sites?",
		          "acceptedAnswer": {
		            "@type": "Answer",
		            "text": "É importante avaliar o portfólio, experiência, metodologia de trabalho e foco em resultados. Uma boa empresa de criação de sites deve entender o negócio do cliente e desenvolver projetos pensados para gerar oportunidades reais."
		          }
		        },
		        {
		          "@type": "Question",
		          "name": "Quanto custa a criação de um site profissional?",
		          "acceptedAnswer": {
		            "@type": "Answer",
		            "text": "O valor de um site profissional varia conforme a complexidade do projeto, número de páginas, funcionalidades e nível de personalização. Projetos mais simples tendem a ter um investimento menor, enquanto sites sob medida, com integrações e foco em SEO, exigem um escopo mais completo."
		          }
		        }
		      ]
		    }
		  ]
		}
		</script>
		<!-- Fim da Marcação Schema.org -->
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
