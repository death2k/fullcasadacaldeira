	

        <script>
        jQuery(function ($) {
          $('.mm-up-to-top').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
          });
        });
        </script>

        <?php get_sidebar(); ?>

        <?php if (porto_get_meta_value('footer', true)) : ?>

            <?php

            global $porto_settings;

            $footer_type = $porto_settings['footer-type'];

            $cols = 0;
            for ($i = 1; $i <= 4; $i++) {
                if ( is_active_sidebar( 'content-bottom-'. $i ) )
                    $cols++;
            }

            if (is_404()) $cols = 0;

            if ($cols) : ?>
                <div class="sidebar content-bottom-wrapper">
                    <?php
                    $col_class = array();
                    switch ($cols) {
                        case 1:
                            $col_class[1] = 'col-sm-12';
                            break;
                        case 2:
                            $col_class[1] = 'col-sm-12';
                            $col_class[2] = 'col-sm-12';
                            break;
                        case 3:
                            $col_class[1] = 'col-sm-12 col-md-4';
                            $col_class[2] = 'col-sm-12 col-md-4';
                            $col_class[3] = 'col-sm-12 col-md-4';
                            break;
                        case 4:
                            $col_class[1] = 'col-sm-12 col-md-3';
                            $col_class[2] = 'col-sm-12 col-md-3';
                            $col_class[3] = 'col-sm-12 col-md-3';
                            $col_class[4] = 'col-sm-12 col-md-3';
                            break;
                    }
                    ?>
                    <div class="container">
                        <div class="row">
                            <?php
                            $cols = 1;
                            for ($i = 1; $i <= 4; $i++) {
                                if ( is_active_sidebar( 'content-bottom-'. $i ) ) {
                                    ?>
                                    <div class="<?php echo $col_class[$cols++] ?>">
                                        <?php dynamic_sidebar( 'content-bottom-'. $i ); ?>
                                    </div>
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            $footer_view = porto_get_meta_value('footer_view');
            ?>

            <div class="footer-wrapper<?php if ($porto_settings['footer-wrapper'] == 'wide') echo ' wide' ?> <?php echo $footer_view ?>">

                <?php if ($porto_settings['footer-wrapper'] == 'boxed') : ?>
                <div id="footer-boxed" class="container">
                <?php endif; ?>

                    <?php
                    get_template_part('footer/footer_'.$footer_type);
                    ?>

                <?php if ($porto_settings['footer-wrapper'] == 'boxed') : ?>
                </div>
                <?php endif; ?>

            </div>

            <?php porto_blueimp_gallery_html() ?>

        <?php endif; ?>

        <div class="panel-overlay"></div>

    </div><!-- end wrapper -->

<?php

// navigation panel

get_template_part('panel');

?>

<!--[if lt IE 9]>
<script src="<?php echo esc_url(porto_js) ?>/html5shiv.min.js"></script>
<script src="<?php echo esc_url(porto_js) ?>/respond.min.js"></script>
<![endif]-->

<?php wp_footer(); ?>

<?php
// js code (Theme Settings/General)
if (isset($porto_settings['js-code'])) { ?>
    <script type="text/javascript">
        <?php echo $porto_settings['js-code']; ?>
    </script>
<?php } ?>

 <script src="https://use.fontawesome.com/093c0a375b.js"></script>

               <script src="https://use.fontawesome.com/093c0a375b.js"></script>

          
<style>

.float-telefone {
    text-decoration: none;
    position: fixed;
    padding: 8px;
    padding-right: 15px;
    bottom: 30px;
    right: 35px;
    background-color: #5517da8c;
    color: #FFF;
    border-radius: 10px;
    text-align: center;
    font-size: 30px;
    
    z-index: 100;
    font-family: arial;
    font-size: 18px;
    animation: whatsapp-animation 0.5s ease-in-out;
    transition: background-color 0.3s ease;
}

.float-telefone:hover {
    background-color: #825fcf;
    color: #FFF;
}

.float-mail {
    text-decoration: none;
    position: fixed;
    padding: 8px;
    padding-right: 15px;
    bottom: 30px;
    right: 35px;
    background-color: #ff9b008c;
    color: #FFF;
    border-radius: 10px;
    text-align: center;
    font-size: 30px;
    
    z-index: 100;
    font-family: arial;
    font-size: 18px;
    animation: whatsapp-animation 0.5s ease-in-out;
    transition: background-color 0.3s ease;
}

.float-mail:hover {
    background-color: #fcd290;
    color: #FFF;
}

.float-button {
    text-decoration: none;
    position: fixed;
    padding: 8px;
    padding-right: 15px;
    bottom: 30px;
    right: 35px;
    background-color: #009e538c;
    color: #FFF;
    border-radius: 10px;
    text-align: center;
    font-size: 30px;
    
    z-index: 100;
    font-family: arial;
    font-size: 18px;
    animation: whatsapp-animation 0.5s ease-in-out;
    transition: background-color 0.3s ease;
}

.float-button:hover {
    background-color: #90d573;
    color: #FFF;
}

.fa-whatsapp {
    font-size: 20px !important;
    padding-right: 5px;
    padding-left: 5px;
}

@keyframes whatsapp-animation {
    from {opacity: 0%;}
    to {opacity: 100%}
}

@media screen and (max-width: 545px) {
    span {
        display: none;
    }
    .float-button {
        width: 35px;
        border-radius: 10px;
        height: 38px;
    }
    .fa-whatsapp {
        font-size: 40px !important;
    }
}
</style>
   <a class="float-telefone" style="margin-bottom: 150px;" target="_blank" href="tel:443244-1734" title="Ligue">
   <img src="https://img.icons8.com/android/24/000000/phone.png"/>
   <span style="margin: 5px;">Contato: Telefone<span>
   </a>
   
   <a class="float-button" style="margin-bottom: 100px;" target="_blank" href="https://wa.me/554432441734?text=Olá,%20preciso%20de%20informações" title="Whatsapp Vendas 1">
   <img src="https://img.icons8.com/color/24/000000/whatsapp--v2.png" alt="">
   <span style="margin: 5px;">Whatsapp Vendas 1<span>
   </a>

   <a class="float-button" style="margin-bottom: 50px;" target="_blank" href="https://wa.me/554432442584?text=Olá,%20preciso%20de%20informações" title="Whatsapp Vendas 2">
   <img src="https://img.icons8.com/color/24/000000/whatsapp--v2.png" alt="">
   <span style="margin: 5px;">Whatsapp Vendas 2<span>
   </a>

   <a class="float-mail" title="E-mail" target="_blank" href="mailto:gustavo@casadacaldeira.com.br">
   <img src="https://img.icons8.com/wired/24/000000/new-message.png"/>
   <span style="margin: 5px;">Contato: E-mail<span>
   </a>

<footer style="padding-top:30px">
      <div class="bg-white">
         <div class="container py-5" style=" padding-bottom: 02em!important;">
            <div class="row py-3">
               <div class="col-lg-4 col-md-6 mb-4 mb-lg-0"">
                  <div class="sidepanel widget_text">
                     <div class="textwidget">
                        <img src="../seosys/img/logocasadacaldeira.png"><br><br>
                        <h6 class="text-uppercase font-weight-bold mb-4">Administracão | Matriz Paiçandu - PR</h6>
                        <p class="text-muted mb-4">Casa da Caldeira. Rua Curitiba, 25 - Jardim Capital </br>CEP: 87140-000 Paiçandu-PR  </p>
                        <br>
                     </div>
                  </div>
               </div>
               <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                  <h6 class="text-uppercase font-weight-bold mb-4">Empresa</h6>
                  <ul class="list-unstyled mb-0">
                     <li class="mb-2"><a href="http://www.casadacaldeira.com.br/home/contato/" class="text-muted">Contato</a></li>
                     <li class="mb-2"><a href="http://www.casadacaldeira.com.br/home/empresa/" class="text-muted">A Empresa</a></li>
                     <li class="mb-2"><a href="http://www.casadacaldeira.com.br/home/categoria-produto/informacoes/" class="text-muted">Serviços</a></li>
                     <li class="mb-2"><a href="http://www.casadacaldeira.com.br/home/categoria-produto/informacoes/" class="text-muted">Manutenção</a></li>
                     <li class="mb-2"><a href="http://www.casadacaldeira.com.br/home/localizacao/" class="text-muted">Localização</a></li>
                  </ul>
               </div>
               <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                  <h6 class="text-uppercase font-weight-bold mb-4">Política</h6>
                  <ul class="list-unstyled mb-0">
                     <li class="mb-2"><a href="#" class="text-muted">Política LGPD</a></li>
                     <li class="mb-2"><a href="#" class="text-muted">Termo de Uso</a></li>
                     <li class="mb-2"><a href="#" class="text-muted">Segurança</a></li>
                     <li class="mb-2"><a href="#" class="text-muted">Privacidade</a></li>
                  </ul>
               </div>
               <div class="col-lg-4 col-md-6 mb-lg-0">
                  <h6 class="text-uppercase font-weight-bold mb-4">Central de Relacionamento</h6>
                  <p class="text-muted "><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918577/phone.png" alt="">&nbsp;&nbsp;  (44) 3244-1734</p>
                  
                  <p class="text-muted "><img src="https://img.icons8.com/color/24/000000/whatsapp--v2.png" alt="">&nbsp;  (44) 3244-1734</p>
                  
                  <p class="text-muted "><img src="https://img.icons8.com/color/24/000000/whatsapp--v2.png" alt="">&nbsp;  (44) 3244-2584</p>
                
<!--
		  <ul class="list-inline mt-4">
                     <li class="list-inline-item"><a href="https://www.facebook.com/casadacaldeiraltda" target="_blank" title="facebook"><i class="fab fa-2x fa-facebook-f"></i></a></li>
                     <li class="list-inline-item"><a href="https://www.youtube.com/channel/UCY_mePyaz9uhR9X6KaoO1oA" target="_blank" title="youtube"><i class="fab fa-2x fa-youtube"></i></a></li>
                     <li class="list-inline-item"><a href="https://www.google.com/search?client=firefox-b-d&q=casa+da+caldeira" target="_blank" title="google"><i class="fab fa-2x fa-google"></i></a></li>
                  </ul>
-->

               </div>
            </div>
         </div>
         <div class="bg-light py-2" style="background: #f0f0ed;">
            <div class="container text-center">
               <p class="text-muted mb-0 py-2">
               <div class="copyright">
                  <p>
                     Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <i  aria-hidden="true"></i> by <a href="https://www.casadacaldeira.com.br" target="_blank"><span><img style="width: 150px;" src="../seosys/img/logocasadacaldeira.png" alt=""></span> </a> 
                  </p>
               </div>
               </p>
            </div>
         </div>
      </div>

      </footer>



<!--Start of Zopim Live Chat Script-->
<!-- <script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?37Q9W6evWWmX1XL49aby44eSBQdil69l";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script> -->
<!--End of Zopim Live Chat Script-->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64507006-1', 'auto');
  ga('send', 'pageview');

 	ga('create', 'G-ZZ0LLJH1B9', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>
