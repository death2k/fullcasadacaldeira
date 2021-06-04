<?php
            //Header principal
            include('./model/tubo-para-caldeira.php'); 
            ?>
<!doctype html>
<html>

<link rel="stylesheet" href="tabs.css">

   <head>
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
   <script>
      (function(w,d,u){
              var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
              var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
      })(window,document,'https://cdn.bitrix24.com/b16679885/crm/site_button/loader_2_m3guj0.js');
   </script>
</html>