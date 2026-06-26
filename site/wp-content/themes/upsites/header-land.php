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
	<meta name="adopt-website-id" content="ec2f2bf4-1b01-47d1-abc6-3cb207151e14" />
	<script src="//tag.goadopt.io/injector.js?website_code=ec2f2bf4-1b01-47d1-abc6-3cb207151e14" class="adopt-injector"></script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>

	<?php if(is_single( 19737 ) ) { ?>
	<!-- Início da Marcação Schema.org -->
	<script type="application/ld+json">
	{
	"@context": "https://schema.org",
	"@graph": [
		{
		"@type": "WebSite",
		"@id": "https://upsites.digital/#website",
		"url": "https://upsites.digital/",
		"name": "UpSites",
		"publisher": {
			"@id": "https://upsites.digital/#organization"
		}
		},
		{
		"@type": "Organization",
		"@id": "https://upsites.digital/#organization",
		"name": "UpSites",
		"url": "https://upsites.digital/",
		"logo": {
			"@type": "ImageObject",
			"url": "https://upsites.digital/caminho-para-o-seu-logo.jpg"
		}
		},
		{
		"@type": ["WebPage", "FAQPage"],
		"@id": "https://upsites.digital/criacao-site-advogados/#webpage",
		"url": "https://upsites.digital/criacao-site-advogados/",
		"name": "Criação de sites para advogados - UpSites",
		"description": "Tenha um site profissional para seu escritório de advocacia. Ele irá ajudá-lo a conquistar mais clientes, mostrar seu trabalho e compartilhar conhecimento.",
		"isPartOf": {
			"@id": "https://upsites.digital/#website"
		},
		"about": {
			"@id": "https://upsites.digital/criacao-site-advogados/#service"
		},
		"mainEntity": [
			{
			"@type": "Question",
			"name": "Quais são os custos associados à criação e manutenção de um site para advogados?",
			"acceptedAnswer": {
				"@type": "Answer",
				"text": "O custo para criação de site para advogados é a partir de R$609. Para saber exatamente quanto custa um site, temos que ver as necessidades específicas do seu projeto."
			}
			},
			{
			"@type": "Question",
			"name": "Quanto tempo leva para criar e lançar meu novo site de advocacia?",
			"acceptedAnswer": {
				"@type": "Answer",
				"text": "O tempo necessário para criar e lançar seu site para advogados pode variar dependendo da complexidade do projeto e dos recursos envolvidos. Geralmente, podemos concluir o processo dentro de 5 dias úteis."
			}
			},
			{
			"@type": "Question",
			"name": "Como um site pode ajudar a expandir minha base de clientes como advogado?",
			"acceptedAnswer": {
				"@type": "Answer",
				"text": "Um site para advogados é uma ferramenta poderosa para expandir sua base de clientes. Ao disponibilizar informações sobre sua expertise, áreas de atuação e casos anteriores, você pode atrair potenciais clientes que estão buscando assistência jurídica."
			}
			},
			{
			"@type": "Question",
			"name": "Posso personalizar o design do site para refletir a identidade visual da minha marca?",
			"acceptedAnswer": {
				"@type": "Answer",
				"text": "Sim, você pode personalizar completamente o design do seu site para advogados para refletir a identidade e a personalidade única da sua firma de advocacia."
			}
			},
			{
			"@type": "Question",
			"name": "Meu site será otimizado para dispositivos móveis e para o Google?",
			"acceptedAnswer": {
				"@type": "Answer",
				"text": "Sim, o seu site será otimizado para garantir uma ótima experiência em todos os dispositivos, incluindo desktops, laptops, tablets e smartphones."
			}
			},
			{
			"@type": "Question",
			"name": "O que acontece se eu precisar de suporte técnico ou atualizações futuras para o meu site?",
			"acceptedAnswer": {
				"@type": "Answer",
				"text": "Nosso compromisso com o suporte técnico contínuo significa que estaremos sempre disponíveis para ajudá-lo com quaisquer dúvidas, problemas ou atualizações relacionadas ao seu site."
			}
			},
			{
			"@type": "Question",
			"name": "O site terá ferramentas de agendamento ou formulários de contato?",
			"acceptedAnswer": {
				"@type": "Answer",
				"text": "Sim, seu site pode ser integrado com ferramentas de agendamento de consultas jurídicas e formulários de contato personalizados para facilitar a comunicação com seus clientes em potencial."
			}
			},
			{
			"@type": "Question",
			"name": "Tenho um site antigo e desatualizado, preciso mesmo de um novo?",
			"acceptedAnswer": {
				"@type": "Answer",
				"text": "Se você é um advogado e possui um site antigo e desatualizado, é fundamental considerar a importância de ter uma presença online atualizada e profissional."
			}
			},
			{
			"@type": "Question",
			"name": "Quais são os tipos de sites que a UpSites cria?",
			"acceptedAnswer": {
				"@type": "Answer",
				"text": "Na UpSites, criamos sites para diferentes nichos e necessidades, desde profissionais liberais até empresas de diversos setores."
			}
			}
		]
		},
		{
		"@type": "Service",
		"@id": "https://upsites.digital/criacao-site-advogados/#service",
		"name": "Criação de sites para advogados",
		"description": "Desenvolvimento de sites eficientes e profissionais para escritórios de advocacia, focados em design, conversão, experiência do usuário e captação de novos clientes.",
		"provider": {
			"@id": "https://upsites.digital/#organization"
		},
		"mainEntityOfPage": {
			"@id": "https://upsites.digital/criacao-site-advogados/#webpage"
		},
		"offers": {
			"@type": "Offer",
			"price": "609.00",
			"priceCurrency": "BRL",
			"priceValidUntil": "2026-12-31",
			"url": "https://upsites.digital/criacao-site-advogados/",
			"description": "O custo para criação de site para advogados é a partir de R$609."
		}
		}
	]
	}
	</script>
	
	<!-- Fim da Marcação Schema.org -->
	<?php } else { ?>
	<script>
		jQuery(document).ready(function() {
			var schema = {
				"@context": "https://schema.org",
				"@graph": [{
						"@id": "#Organization",
						"aggregateRating": {
							"@type": "AggregateRating",
							"ratingValue": 5,
							"worstRating": 2,
							"bestRating": 5,
							"ratingCount": 71262
						},
						"@type": "Organization",
						"email": "comercial@upsites.digital",
						"image": "https://upsites.digital/wp-content/uploads/2024/02/logo-1024-transparente.png",
						"name": "UpSites Digital",
						"slogan": "Transformando ideias em sites profissionais",
						"description": "Agência de criação de sites profissionais, especializada em desenvolver, gerenciar e otimizar sites para posicionar no Google.",
						"disambiguatingDescription": "Criação de Sites Profissionais desde 2016. A UpSites é uma agência de criação de sites que atende todo o Brasil, peça um orçamento de site!",
						"alternateName": "UPSITES DESENVOLVIMENTO DE SITES LTDA",
						"url": "https://upsites.digital",
						"foundingDate": "15 de Fevereiro de 2017",
						"hasOfferCatalog": {
							"@type": "OfferCatalog",
							"itemListElement": [{
									"@type": "Service",
									"name": "Criação de sites profissionais",
									"url": "https://upsites.digital",
									"slogan": "Transformando ideias em sites profissionais",
									"description": "Agência de criação de sites profissionais, especializada em desenvolver, gerenciar e otimizar sites para posicionar no Google."
								},
								{
									"@type": "Service",
									"name": "Criação de sites baratos",
									"url": "https://upsites.digital/criacao-sites-baratos/",
									"slogan": "Site profissional feito em até 5 dias!",
									"description": "Criação de sites baratos e profissionais, feito por especialistas. Conheça o site expresso!"
								},
								{
									"@type": "Service",
									"name": "Criação de E-Commerce",
									"url": "https://upsites.digital/criacao-loja-virtual-wordpress/",
									"slogan": "Desenvolvimento de Loja Virtual",
									"description": "Invista na criação de e-commerce profissional e tenha uma plataforma de vendas online integrada aos Correios e às principais transportadoras."
								},
								{
									"@type": "Service",
									"name": "Consultoria seo",
									"url": "https://upsites.digital/consultoria-seo/",
									"slogan": "Seu site na 1ª página do google",
									"description": "Solicite um contato de nossos especialistas para entender como podemos te ajudar através da Consultoria SEO"
								},
								{
									"@type": "Service",
									"name": "Desenvolvimento de chatbot",
									"url": "https://upsites.digital/desenvolvimento-chatbot/",
									"slogan": "Transforme visitantes em clientes fiéis",
									"description": "Aumente sua receita, corte custos operacionais e encante seus clientes com a criação de chatbots dinâmicos e inteligentes."
								}
							]
						},
						"sameAs": [
							"https://www.behance.net/jeferson_arantes/resume",
							"https://elementor.com/blog/introducing-flexible-layout/",
							"https://tableless.netlify.app/mobile-first-a-arte-de-pensar-com-foco/",
							"https://neilpatel.com/br/blog/site-responsivo/",
							"https://www.crunchbase.com/organization/upsites-digital",
							"https://clutch.co/profile/upsites-digital",
							"https://systeme.io/pt/blog/lead-magnet",
							"https://hackernoon.com/i-switched-to-seo-after-20-years-as-a-journalist-heres-what-ive-learned-f17432ic",
							"https://www.ee.usp.br/residencia/",
							"https://rockcontent.com/br/blog/marketing-de-conteudo-para-linkedin/",
							"https://pt.venngage.com/blog/layout-de-site/",
							"https://www.hostinger.com.br/tutoriais/melhores-empresas-desenvolvimento-de-sites",
							"https://blog.duda.co/es/mapa-del-sitio-web",
							"https://fixthephoto.com/pt/upsites-avalia%C3%A7%C3%A3o.html",
							"https://www.nuvemshop.com.br/blog/como-criar-uma-loja-virtual/",
							"https://themanifest.com/br/seo/mobile-optimization/agencies",
							"https://www.locaweb.com.br/blog/temas/marketing-e-seo/seo-tecnico-o-guia-definitivo/",
							"https://omelhor.app.br/criar-site-profissional-veja-5-dicas-essenciais/",
							"https://snov.io/blog/br/suporte-ao-cliente/",
							"https://www.ecommercebrasil.com.br/artigos/intencao-de-pesquisa-entenda-o-comportamento-do-usuario-e-turbine-seu-seo",
							"https://rohitink.com/2020/03/16/ux-trends-2020-designers-know/",
							"https://www.migalhas.com.br/depeso/305291/por-que-os-advogados-do-futuro-precisarao-entender-de-inteligencia-artificial-e-outros-conhecimentos-tecnologicos",
							"https://www.kommo.com/br/blog/especialista-em-seo/",
							"https://sitechecker.pro/pt/how-to-create-a-website/",
							"https://www.hostgator.com.br/blog/como-implementar-amp-no-site/",
							"https://king.host/blog/empreendedorismo/branding-para-e-commerce-como-construir-uma-marca-forte-para-sua-loja/",
							"https://www.liguesite.com.br/blog/faca-seu-o-site-atrair/",
							"http://webscan.hol.es/upsites.digital",
							"https://blog.solucoesindustriais.com.br/convidados/7-dicas-para-promover-sua-marca-na-internet/",
							"https://catracalivre.com.br/viagem-livre/viagem-a-trabalho-como-conciliar-negocios-com-lazer/",
							"https://bagy.com.br/blog/chatbots-e-jornada-do-cliente/",
							"https://ppgee.uerj.br/",
							"https://blog.workana.com/pt/emprendimientopt/como-iniciar-um-negocio-lucrativo-de-web-design/",
							"https://jnews.dev.br/a-importancia-da-segmentacao-de-publico-alvo-para-personalizar-o-conteudo-do-seu-site-e-melhorar-a-experiencia-do-usuario/",
							"https://blog.umbler.com/br/como-criar-conteudos-que-chamam-atencao-das-pessoas/",
							"https://www.idealmarketing.com.br/blog/design-responsivo-e-mobile-first-entenda-a-abordagem/",
							"https://www.minhaconexao.com.br/blog/software/navegador-de-internet",
							"https://www.jornalcontabil.com.br/as-vantagens-da-digitalizacao-do-setor-financeiro/",
							"https://www.iebschool.com/pt-br/blog/marketing/marketing-digital/5-erros-em-webdesign-que-voce-deve-evitar-para-aumentar-a-conversao/",
							"https://conteudo.movidesk.com/como-fazer-um-faq/",
							"https://pagar.me/blog/inteligencia-artificial-aplicada-em-chatbots/",
							"https://www.jivochat.com.br/blog/vendas/estrategias-quebrar-objecoes-em-vendas.html",
							"https://www.glassdoor.com.br/Vis%C3%A3o-geral/Trabalhar-na-UpSites-EI_IE3855197.13,20.htm",
							"https://www.dooca.com.br/blog/dicas-para-criar-funil-de-vendas-para-o-seu-e-commerce/",
							"https://zlabs.tec.br/",
							"https://blog.clubedeautores.com.br/2020/02/sinopse-o-que-e-e-como-escrever.html",
							"https://blog.bling.com.br/sete-dicas-praticas-para-vender-mais/",
							"https://sleekflow.io/pt-br/blog/chat-ao-vivo",
							"https://toptohigh.com/all-you-would-want-to-know-about-service-marketing-724/"
						],
						"foundingLocation": {
							"@type": "Place",
							"@id": "#Place"
						},
						"location": {
							"@type": "Place",
							"@id": "#Place"
						},
						"founders": [{
								"@type": "Person",
								"@id": "#Caio"
							},
							{
								"@type": "Person",
								"@id": "#Joao"
							}
						],
						"identifier": [
							"https://pt.wikipedia.org/wiki/Desenvolvimento_web",
							"https://pt.wikipedia.org/wiki/Hospedagem_de_s%C3%ADtios_web"
						],
						"keywords": [
							"sites",
							"criação de sites",
							"criação",
							"site",
							"criar",
							"profissionais",
							"empresa",
							"criar um site",
							"marketing",
							"digital",
							"profissional",
							"marketing digital",
							"site profissional",
							"criação de sites profissionais",
							"clientes",
							"negócio",
							"www",
							"google",
							"redes sociais",
							"sites profissionais",
							"serviços",
							"suporte",
							"conteúdo",
							"blog",
							"criador de sites",
							"contato",
							"online",
							"loja virtual",
							"melhor",
							"hospedagem",
							"seo",
							"desenvolvimento",
							"internet",
							"criação de site",
							"criador",
							"loja",
							"web",
							"virtual",
							"empresas",
							"sociais",
							"redes",
							"domínio",
							"cliente",
							"plataforma",
							"email",
							"produtos",
							"precisa",
							"fácil",
							"portfólio",
							"desenvolvimento de sites",
							"experiência",
							"grátis",
							"agência",
							"sucesso",
							"ferramentas",
							"segurança",
							"facebook",
							"conheça",
							"hospedagem de sites",
							"busca",
							"instagram",
							"marca",
							"página",
							"crie",
							"wordpress",
							"vendas",
							"brasil",
							"processo de criação",
							"serviço",
							"equipe",
							"negócios",
							"ajudar",
							"presença",
							"especialistas",
							"simples",
							"informações",
							"recursos",
							"dias",
							"soluções",
							"rápido",
							"escolha",
							"personalizado",
							"whatsapp",
							"criar sites",
							"design",
							"saiba",
							"páginas",
							"ajuda",
							"projeto",
							"escolher",
							"lojas virtuais",
							"responsivo",
							"criar site",
							"dados",
							"qualidade",
							"imagens",
							"gestão",
							"layout",
							"website",
							"lojas",
							"atendimento",
							"presença online",
							"conteúdos",
							"orçamento",
							"processo",
							"mercado",
							"fale",
							"perguntas frequentes",
							"completa",
							"acesso",
							"faça",
							"personalizados",
							"resultados",
							"crie um site",
							"email",
							"mundo",
							"construtor de sites",
							"uso",
							"plano",
							"pagamento",
							"ferramenta",
							"endereço",
							"solução",
							"opções",
							"confira",
							"melhores",
							"principais",
							"projetos",
							"alta",
							"otimização",
							"dúvidas",
							"performance",
							"completo",
							"manutenção",
							"pronto",
							"otimização de sites",
							"produtos e serviços",
							"virtuais",
							"criação do site",
							"linkedin",
							"frequentes",
							"público",
							"oferece",
							"funciona",
							"hospedagem de site",
							"necessidade",
							"rápida",
							"comece",
							"criar seu site",
							"tecnologia"
						],
						"telephone": "+551141303275",
						"contactPoint": [{
								"@type": "ContactPoint",
								"telephone": "+551141303275",
								"contactType": "customer support"
							},
							{
								"@type": "ContactPoint",
								"telephone": "comercial@upsites.digital",
								"contactType": "email"
							},
							{
								"@type": "ContactPoint",
								"url": "https://upsites.digital/orcamentos/",
								"contactType": "ChatBot"
							}
						],
						"review": [{
								"@type": "Review",
								"description": "Com a Upsites, tivemos um upgrade incrível do nosso site. E o melhor: todo o processo de criação de site foi extremamente simplificado, mas sem deixar de atender a todas as nossas demandas. Agradeço à gerente de projetos Thaís Miranda que nos acompanhou durante o desenvolvimento web com toda a paciência do mundo, sempre tirando todas as nossas dúvidas da forma mais completa e didática possível! Para criação de sites corporativos / site para empresas indico muito a UpSites à todos!",
								"author": {
									"@type": "Person",
									"name": "Daniele Neves",
									"memberOf": {
										"@type": "Organization",
										"name": "Aldanth"
									}
								}
							},
							{
								"@type": "Review",
								"description": "Estamos muito satisfeitos com todo o processo de criação do nosso site. A equipe da Upsites foi sempre muito atenciosa, com bons insights e muito dispostos a nos atender. O resultado final do site foi excelente. Tanto em termos de performance (carregamento das páginas, navegabilidade, etc) quanto em termos de SEO, nossa empresa melhorou bastante com o novo site. Recomendamos muito!",
								"author": {
									"@type": "Person",
									"name": "Marco Castello",
									"memberOf": {
										"@type": "Organization",
										"name": "Essential Idiomas"
									}
								}
							},
							{
								"@type": "Review",
								"description": "A experiência de trabalhar com o time da UpSites foi muito boa. Superou as minhas expectativas e de todas da empresa. Tem ferramentas excelentes para acompanhar todo o processo de desenvolvimento web e o custo benefício foi excelente. Certamente recomendo contratar a equipe da UpSites para a criação de sites. O site da mindself.com.br ficou muito mais funcional, bonito e adequado ao nosso posicionamento.",
								"author": {
									"@type": "Person",
									"name": "Alexandre Ayres",
									"memberOf": {
										"@type": "Organization",
										"name": "Mindself"
									}
								}
							},
							{
								"@type": "Review",
								"description": "Tivemos um projeto desafiador em termos de prazo já que a construção do site estava ligada a um rebranding da empresa. Durante todo o processo a comunicação com o time da UpSites foi muito fluida, inclusive fazendo a entrega antes do previsto. O custo-beneficio do projeto tbm foi um fator decisivo na escolha. Parabéns ao time pelo trabalho e profissionalismo.",
								"author": {
									"@type": "Person",
									"name": "Ricardo Porcher",
									"memberOf": {
										"@type": "Organization",
										"name": "Versi BR"
									}
								}
							},
							{
								"@type": "Review",
								"description": "A empresa é organizada e tem uma esquemática boa para criação de sites. O sistema de revisões é bom e eles fazem tudo no tempo que se comprometeram a fazer. Não analisei ainda o impacto de resultado SEO mas da análise inicial também está tudo ok. Indicaria a empresa principalmente para confecção rápida e com design legal de sites.",
								"author": {
									"@type": "Person",
									"name": "Jaque Pivato",
									"memberOf": {
										"@type": "Organization",
										"name": "Refrisat"
									}
								}
							}
						]
					},
					{
						"@type": "WebSite",
						"@id": "#WebSite",
						"url": "https://upsites.digital",
						"name": "UpSites Digital",
						"creator": {
							"@type": "Organization",
							"@id": "#Organization"
						},
						"publisher": {
							"@type": "Organization",
							"@id": "#Organization"
						},
						"producer": {
							"@type": "Organization",
							"@id": "#Organization"
						},
						"sourceOrganization": {
							"@type": "Organization",
							"@id": "#Organization"
						},
						"inLanguage": "pt-BR",
						"potentialAction": {
							"@type": "SearchAction",
							"target": "https://upsites.digital/?s={search_term_string}",
							"query-input": "required name=search_term_string"
						}
					},
					{
						"@type": "Place",
						"@id": "#Place",
						"geo": {
							"@type": "GeoCoordinates",
							"latitude": "-23.556760551580517",
							"longitude": " -46.66537470728619"
						},
						"hasMap": "https://www.google.com/maps/search/?api=1&amp;query=-23.556760551580517, -46.66537470728619",
						"address": {
							"@type": "PostalAddress",
							"streetAddress": "Rua Professor Ernest Marcus, 65 - Pacaembu",
							"addressLocality": "São Paulo",
							"addressRegion": "São Paulo",
							"postalCode": "01246-080",
							"addressCountry": "Brasil"
						}
					},
					{
						"@type": "Person",
						"@id": "#Caio",
						"name": "Caio Nogueira de Oliveira e Silva",
						"email": "caio@upsites.digital"
					},
					{
						"@type": "Person",
						"@id": "#Joao",
						"name": "João Vicente Farias Santos",
						"email": "joao@upsites.digital"
					}
				]
			};
			if(jQuery(".land-faq").length != 0) {
				var faqpage = {
					"@type": "FAQPage",
					"@id": "#FAQPage",
					"name": "UpSites Digital",
					"url": "https://upsites.digital",
					/*"breadcrumb":{
            "@id":"#BreadcrumbList"
          },*/
					"isPartOf": {
						"@id": "#WebSite"
					},
					"mainEntity": []
				}
				jQuery('.land-faq .grid .cols').children().each(function (el, index) {
					let $this = jQuery(this);
					if($this.hasClass('item')) {
						faqpage.mainEntity.push({
							"@type": "Question",
							"name": jQuery.trim($this.find('h3').text()),
							"acceptedAnswer": {
								"@type": "Answer",
								"text": jQuery.trim($this.find('.box-content').text()).replace('\n', '')
							}
						});
					}
				});
				if(jQuery(".rank-math-breadcrumb").length != 0) {
					faqpage["breadcrumb"] = {
						"@id":"#BreadcrumbList"
					}
				}

				schema['@graph'].push(
					faqpage
				);
			} else {
				/*var faqpage = {
					"@type": "FAQPage",
					"@id": "#FAQPage",
					"name": "UpSites Digital",
					"url": "https://upsites.digital",
					"isPartOf": {
						"@id": "#WebSite"
					},
					"mainEntity": []
				}
				if(jQuery(".rank-math-breadcrumb").length != 0) {
					faqpage["breadcrumb"] = {
						"@id":"#BreadcrumbList"
					}
				}
				schema['@graph'].push(
					faqpage
				);*/
			}

			if(jQuery(".rank-math-breadcrumb").length != 0) {
				var bread = {
					"@type": "BreadcrumbList",
					"@id": "#BreadcrumbList",
					/*"isPartOf": {
						"@id": "#WebSite"
					},*/
					"itemListElement": []
				}
				var idx = 1;
				jQuery('.rank-math-breadcrumb p').children().each(function (index) {
					var item = {}
					let $this = jQuery(this);
					if ($this.prop('localName') == 'a') {
						item["@id"] = $this.attr('href');
						item["name"] = jQuery.trim($this.text());
						bread.itemListElement.push({
							"@type": "ListItem",
							"position": idx,
							item
						});
						idx++;
					} else if ($this.prop('localName') == 'span' && $this.hasClass('last')) {
						item["@id"] = window.location.href;
						item["name"] = jQuery.trim($this.text());
						bread.itemListElement.push({
								"@type": "ListItem",
								"position": idx,
								item
						});
						idx++;
					}

				});

				schema['@graph'].push(
					bread
				);

			}

			if(jQuery("#index-list").length != 0) {
				var summary = {
					"@type": "ItemList",
					"@id": "#ItemList",
					/*"isPartOf": {
						"@id": "#WebSite",
						"@type": "WebSite"
					},*/
					"mainEntityOfPage":{
						"@id": "#BlogPosting"
					},
					"itemListElement": []
				}
				var idx = 1;
				jQuery('#index-list ul').children().each(function (index) {
					var item = {}
					let $this = jQuery(this);

					item["@id"] = $this.find('a').attr('href');
					item["name"] = jQuery.trim($this.find('a').text());
					summary.itemListElement.push({
						"@type": "ListItem",
						"position": idx,
						item
					});
					idx++;

				});

				schema['@graph'].push(
					summary
				);


			}

			if (jQuery('body').hasClass('single-post')) {
				var single = {
					"@id": "#BlogPosting",
					"@type": "BlogPosting",
					"author": {},
					"inLanguage": "pt-BR",
					"image": {
							"@type": "ImageObject",
					},
					"mainEntityOfPage":{
						"@id":"#FAQPage"
					},
					"publisher": {
						"@id": "#organization"
					}
				};
				single["name"] = jQuery('meta[property="og:title"]').attr('content');
				single["articleSection"] = jQuery('meta[property="article:section"]').attr('content');
				single["headline"] = jQuery('meta[property="og:title"]').attr('content');
				single["datePublished"] = "<?php echo get_the_date('Y-m-d'); ?>";
				single["dateModified"] = "<?php echo get_the_modified_date('Y-m-d'); ?>";
				single["keywords"] = "<?php echo get_post_meta( get_the_ID(), 'rank_math_focus_keyword', true ); ?>";
				single["description"] = jQuery('meta[property="og:description"]').attr('content');
				single.author["@id"] = "<?php echo get_author_posts_url($post->post_author); ?>";
				single.author["name"] = jQuery('meta[name="twitter:data1"]').attr('content');
				single.image["url"] = jQuery('meta[property="og:image"]').attr('content');
	
				schema['@graph'].push(
					single
				);
			}

			console.log("schema['@graph']");
			console.log(schema);
			
			var jsonSchema = JSON.stringify(schema);
			var s2 = document.createElement("script");
			s2.type = "application/ld+json";
			s2.id = "SchemaJson";
			jQuery("head").append(s2);
			jQuery('#SchemaJson').append(jsonSchema);


		});
	</script>
	<?php } ?>
</head>
<body <?php body_class(); ?>>
<?php

