

 <!-- Google Tag Manager -->
 <noscript>
      <iframe src="https://www.googletagmanager.com/ns.html?id="GTM-5H24CK7"
      height="0" width="0" style="display:none;visibility:hidden">
      </iframe>
    </noscript>


<div style="height: auto">
   
        <?php
         //Exemplo de utilização da função include()
         include('./seosys/includes/breadcrumb.php'); //incluindo o footer.php
         ?>
         
            <div class="container">
               <div class="row">

<div class="col-md-8 blog-main">
   <h3 class="pb-4 mb-4 font-italic border-bottom">
      <? echo $title ?>
   </h3>
   <div class="blog-post">
      <h1 class="blog-post-title"><? echo $h1 ?></h1>
      <p class="blog-post-meta"><img meta property=”og:type” content="<? echo $title?>" src="../seosys/imagens/<? echo $url_imagem ?>" align="left" alt="" srcset="" style="padding: 10px;"> <a href="#"></a></p>
      <p style="padding-left:10px"><? echo $texto1 ?></p>
      <hr>
      <? echo $texto2 ?>
      <blockquote>
      <?php
         //Exemplo de utilização da função include()
         include('./seosys/includes/seo-regioes.php'); //incluindo o footer.php
         ?>
   </div>
   <!-- /.blog-post -->
</div>
<!-- /.blog-main -->
<aside class="col-md-4 blog-sidebar">
<?php
         //Exemplo de utilização da função include()
         include('./seosys/includes/seo-menu-lateral.php'); //incluindo o footer.php
         ?>
</aside>
<!-- /.blog-sidebar -->

</div>
</div>
</div>