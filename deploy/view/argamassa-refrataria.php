<?php
            //Header principal
            include('./model/argamassa-refrataria.php'); 
            ?>
<!doctype html>
<html>

<link rel="stylesheet" href="tabs.css">

   <head>
    <!-- Analytics -->
       <script async src="https://www.googletagmanager.com/gtag/js?id=G-DBW8KD7JVP"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-DBW8KD7JVP');
        </script>
        <?php
         //Head principal
         include('./includes/seo-head.php');
         ?>
   </head>
   <!-- <body oncontextmenu='return false' class='snippet-body'> -->
   <body class='snippet-body'>
      
      <div class="super_container">
            <!-- Header -->
            <?php
            //Header principal
            include('./includes/seo-header.php'); 
            ?>


            <?php
            //SEO Produto / Info 
            include('./sources/seo-sources.php'); 
            ?>


            <?php
            //SEO Banner principal
            include('./includes/seo-banner.php'); //incluindo o head.php
            ?>
      </div>

   </body>

      <?php
                  //footer principal 
                  include('./includes/seo-footer.php'); //incluindo o footer.php
                  ?>
   
</html>