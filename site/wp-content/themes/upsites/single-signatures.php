<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Template</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

 
	<style>
		main {
			padding: 150px 0;
		}
		.btnBudgets {
			-webkit-transition: all .3s ease 0s;
			-moz-transition: all .3s ease 0s;
			font-family: Inter, sans-serif;
			text-decoration: none;
    	font-style: normal;
			font-weight: 600;
			font-size: 18px;
			line-height: 100%;
			color: #fff;
			background-color: #00B48F;
			border: 2px solid #00B48F;
			padding: 21px 65px 21px 69px;
			margin-top: 23px;
			border-radius: 60px;
			display: inline-block;
			overflow: hidden;
		}
		.btnBudgets:hover {
			background-color: #FFF;
			color: #00B48F;
		}
	</style>
</head>

<body>
  <!-- main -->
  <main id="main">
    <!-- simple-page -->
    <section class="simple-page">
      <div class="container">
				<center>

					<div id="signature-box" class="signature-box">
						<table style="display: block;" border="0" cellpadding="0" cellspacing="0" width="525">
							<tr>
								<td>
									<table style="display: block; border: 1px solid #D2E7F9; border-radius: 16px; overflow: hidden;" border="0" cellpadding="0" cellspacing="0" width="525">
										<tr>
										<td width="525" height="28"></td>
										</tr>
										<tr>
										<td><table style="display: block;" align="left" border="0" cellpadding="0" cellspacing="0" width="525">
											<tr>
											<td width="24" height="343"></td>
											<td><table style="display: block;" align="left" border="0" cellpadding="0" cellspacing="0" width="477">
												<tr>
												<td><table style="display: block;" align="left" border="0" cellpadding="0" cellspacing="0" width="477">
													<tr>
													<td><a href="https://upsites.digital" style="text-decoration: none;"><img style="display: block;" name="logo" src="https://upsites.digital/assinatura/imagens/logo.png" width="127" height="74" id="logo" alt="" /></a></td>
													<td width="350" height="74" align="right">
														<img style="display: inline-block;" name="bullet" src="https://upsites.digital/assinatura/imagens/bullet.png" width="14" height="6" id="bullet" alt="" /><a href="https://upsites.digital" color="#000000" style="text-decoration: none; color: #000000"><font face="Arial, sans-serif" size="2" color="#000000" style="font-size: 11px;"><strong style="font-weight: 800;">WWW.UPSITES.DIGITAL</strong></font></a>
													</td>
													</tr>
												</table></td>
												</tr>
												<tr>
												<td><table style="display: block;" align="left" border="0" cellpadding="0" cellspacing="0" width="477">
													<tr>
													<td><table style="display: block;" align="left" border="0" cellpadding="0" cellspacing="0" width="362">
														<tr>
														<td width="362" height="68" valign="top">
															<font face="Arial, sans-serif" size="5" color="#000000" style="font-size: 20px; line-height: 28.2px;"><strong style="font-weight: 900;"><?= strtoupper(get_the_title()) ?></strong></font><br>
															<font face="Arial, sans-serif" size="2" color="#158E75" style="font-size: 12px; line-height: 13.8px; font-weight: 800;"><?= strtoupper(get_field('office_signature')) ?></font>
														</td>
														</tr>
														<tr>
														<td><table style="display: block;" align="left" border="0" cellpadding="0" cellspacing="0" width="362">
															<tr>
															<td><img style="display: block;" name="icon-mail" src="https://upsites.digital/assinatura/imagens/icon-mail.png" width="27" height="22" id="icon-mail" alt="" /></td>
															<td>
																<a href="mailto:<?= get_field('email_signature') ?>" color="#000000" style="text-decoration: none; color:#000000"><font face="Arial, sans-serif" size="2" color="#000000" style="font-size: 13px;"><strong style="font-weight: 900;"><?= strtoupper(get_field('email_signature')) ?></strong></font></a>
															</td>
															</tr>
														</table></td>
														</tr>
														<tr>
														<td><table style="display: block;" align="left" border="0" cellpadding="0" cellspacing="0" width="362">
															<tr>
															<td><img style="display: block;" name="icon-whatsapp" src="https://upsites.digital/assinatura/imagens/icon-whatsapp.png" width="27" height="26" id="icon-whatsapp" alt="" /></td>
															<td><a href="https://wa.me/55<?= str_replace(array('(', ')', '-', ' '), "", get_field('phone_signature')) ?>" color="#000000" style="text-decoration: none; color:#000000"><font face="Arial, sans-serif" size="2" color="#000000" style="font-size: 13px;"><strong style="font-weight: 900;"><?= get_field('phone_signature') ?></strong></font></a></td>
															</tr>
														</table></td>
														</tr>
													</table></td>
													<td><img style="display: block; border: 6px solid #CCE8FF; border-radius: 50%; overflow: hidden;" name="avatar-caio" src="<?= wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'full') ?>" width="100" height="100" id="avatar-caio" alt="" /></td>
													</tr>
												</table></td>
												</tr>
												<tr>
												<td><a href="https://go.upsites.digital/banner-email" style="text-decoration: none;"><img style="display: block;" name="banner" src="https://upsites.digital/assinatura/imagens/banner.png" width="477" height="153" id="banner" alt="" /></a></td>
												</tr>
											</table></td>
											<td width="24" height="343"></td>
											</tr>
										</table></td>
										</tr>
										<tr>
										<td width="525" height="25"></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>

					<a href="#" class="btnBudgets mbottom-100" id="copy-btn" data-clipboard-target="#signature-box">Copiar Assinatura</a>

				</center>
			</div>
    </section>
    <!-- end:simple-page -->



  </main>
  <!-- end:main -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
  <!-- script src="<?= get_bloginfo('template_url') ?>/assets/js/bundle.js"></script>
  <script src="assets/js/bundle.min.js"></script -->
	<script>
		new ClipboardJS('#copy-btn');

document.getElementById('copy-btn').addEventListener('click', function() {
		alert('Assinatura copiada!');
});
	</script>
</body>

</html>