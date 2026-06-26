<?php
/*
Template Name: Signature
*/
get_header('land');
$logo_mobile    		    = get_theme_mod('US_logo_mobile');
?>
  
  <div id="loader-layer">
    <?php
      if ($logo_mobile != '') {
        echo wp_get_attachment_image(attachment_url_to_postid($logo_mobile), 'full', '', array( "loading" => "lazy" ));
      }
    ?>
  </div>
  <!-- main -->
  <main id="main">
    <section id="contato" class="formRequestQuote signature" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
      <div class="container">
        <div class="grid">
          <div class="text">
            <h3 class="subtitle">Assinatura</h3>
            <h2>Gerar uma assinatura</h2>
            <p>Preencha o formulário abaixo para gerar uma assinatura da upsites especialmente para você.</p>
            <img width="1" height="1" src="<?= get_bloginfo('template_url') ?>/assets/img/formRequestQuote.svg" class="attachment-full size-full" alt="" loading="lazy">
            
          </div>
          <div class="form">
            <form method="post" id="code-upload" enctype="multipart/form-data">
              <label class="row" for="">
                <input type="text" name="name" id="" placeholder="Nome">
              </label>
              <label class="row" for="">
                <input type="text" name="office" id="" placeholder="Cargo">
              </label>
              <label class="row" for="">
                <input type="text" name="mail" id="" placeholder="E-mail">
              </label>
              <label class="row" for="">
                <input type="text" name="phone" id="" placeholder="Telefone">
              </label>
              <label class="row" for="">
                <div class="file-box">
                  <div class="text-file">Avatar</div>
                  <div class="btn-box">
                    Selecionar arquivo
                  </div>
                  <input type="file" name="avatar" id="" placeholder="Avatar">
                </div>
                <span class="text-support">Imagem quadrada e preferencialmente 100x100 px</span>
              </label>
              <div class="row">
                <button class="btnBudgets submit_signature" name="save_support">
                  <svg class="icon">
                    <use xlink:href="http://localhost/projetos/site_upsites/site/wp-content/themes/upsites/assets/img/icons.svg#ray"></use>
                  </svg> Gerar Assinatura
                </button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </section>
    <section class="">
      <div class="container">
        <div class="form">
        
        </div>
      </div>
    </section>
  </main>
  <!-- end:main -->

  <?php get_footer('land'); ?>