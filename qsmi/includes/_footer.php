<footer>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo $url; ?>qsmi/imagens/footer-1.jpg" alt="Fale Conosco" title="Fale Conosco" class="img-responsive">
                </div>
                <div class="col-md-6">
                    <img src="<?php echo $url; ?>qsmi/imagens/footer-2.jpg" alt="Fale Conosco" title="Fale Conosco" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="col-md-8 col-xs-12 col-sm-12 pd-l-0">
                <p><?php echo $nome_empresa; ?>. <?php echo $unidades[1]["rua"]; ?> - <?php echo $unidades[1]["bairro"]; ?> CEP: <?php echo $unidades[1]["cep"]; ?>  <?php echo $unidades[1]["cidade"]; ?>/<?php echo $unidades[1]["uf"]; ?>  (<?php echo $unidades[1]["ddd"]; ?>) <?php echo $unidades[1]["telefone"]; ?>  /  (<?php echo $unidades[1]["ddd"]; ?>) <?php echo $unidades[1]["celular"]; ?></p>
                <a href="<?php echo $url; ?>informacoes.php" title="Informações">Informações</a>
                -
                <a href="<?php echo $url; ?>mapa-site.php" title="Mapa do Site">Mapa do Site</a>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-12 pd-r-0">
                <div class="selos-validadores text-right">
                    <a rel="nofollow" href="http://validator.w3.org/check?uri=<?php echo $canonical; ?>" target="_blank" title="HTML 5 - Site Desenvolvido nos padrões W3C">
                        <img src="<?php echo $url; ?>qsmi/img/icons/gray-selo-html5.png" alt="HTML 5 - Site Desenvolvido nos padrões W3C">
                    </a>
                    <a rel="nofollow" href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo $canonical; ?>" target="_blank" title="CSS 3 - Site Desenvolvido nos padrões W3C">
                        <img src="<?php echo $url; ?>qsmi/img/icons/gray-selo-css3.png" alt="CSS 3 - Site Desenvolvido nos padrões W3C">
                    </a>
                    <img src="<?php echo $url; ?>qsmi/img/icons/gray-selo-1.png" alt="Selo Quality">
                    - 
                    <a href="https://www.b2best.com.br/" title="B2Best, Cotações Online" target="_blank">
                        <img src="https://www.b2best.com.br/imagens/selo-perfil-b2best-cotacoes-online.png" alt="B2Best, Cotações Online" title="B2Best, Cotações Online">
                    </a>
                </div>
            </div>
        </div>
    </div>    
    <ul class="menu-footer-mobile">
        <li><a href="tel:<?php echo $unidades[1]["ddd"].$unidades[1]["telefone"]; ?>" class="mm-call" title="Ligue"></a></li>
        <li><a href="https://wa.me/554432441734?text=Olá,%20preciso%20de%20informações" target="_blank" class="mm-whatsapp" title="Whats App"></a></li>
        <li><a href="mailto:<?php echo $emailContato; ?>" class="mm-email" title="E-mail"></a></li>
        <li><button type="button" class="mm-up-to-top" title="Volte ao Topo"></button></li>
    </ul>
</footer>
<?php include "qsmi/js/_js-default.php"; ?>
<script>
    var arue = {
        aruo: function(){
            $(document).on("scroll", function(){   
                if($(document).scrollTop() > 80)
                {
                    $("header .header-bottom").css("position","fixed");
                    $("header .header-bottom").css("width","100%");
                    $("header .header-bottom").css("background","#f0f0ed");
                    $("header .header-bottom").css("top","0");
                    $("header .header-bottom").css("z-index","99999");
                    $("header .header-bottom").css("box-shadow","0 1px 10px 0 rgba(0, 0, 0, 0.2)");
                    $("nav.menu").css("margin-top","0");
                    $("nav.menu").css("padding","1px 0");
                }
                else
                {
                    $("header .header-bottom").css("position","");
                    $("header .header-bottom").css("width","");
                    $("header .header-bottom").css("background","");
                    $("header .header-bottom").css("top","");
                    $("header .header-bottom").css("z-index","");
                    $("header .header-bottom").css("box-shadow","");
                    $("nav.menu").css("margin-top","");
                    $("nav.menu").css("padding","");
                }
            });
        }
    };
    $(function(){
        arue.aruo();
    });
</script>
<?php if($_SERVER["SERVER_NAME"] != "localhost"){ ?>
    <!-- Código do Analytics aqui! -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132532457-14"></script>
    <script>
       window.dataLayer = window.dataLayer || [];
       function gtag(){dataLayer.push(arguments);}
       gtag('js', new Date());

       gtag('config', 'UA-132532457-14');
   </script>
   <?php } ?>