<?php
         //Head principal
         include('seosys/model/index.php');
         ?>

<!doctype html>
<html>

 <link rel="stylesheet" href="./seosys/css/tabs.css">

   <head>
       
       
            <!-- Global site tag (gtag.js) - Google Analytics -->
  <!--  <script async src="https://www.googletagmanager.com/gtag/js?id=G-JJYYKKBCNK"></script>
         <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());

         gtag('config', 'G-JJYYKKBCNK');
</script> -->
        <?php
         //Head principal
         include('seosys/includes/seo-head.php');
         ?>
   </head>
   <!-- <body oncontextmenu='return false' class='snippet-body'> -->
   <body class='snippet-body'>
      
      <div class="super_container">
            <!-- Header -->
            <?php
            //Header principal
            include('seosys/includes/seo-header.php'); 
            ?>
            
            <br>

        <?php
            //Header principal
            include('seosys/produtos-lista.php'); 
            ?>

<?php
            //SEO Banner principal
            include('seosys/includes/seo-banner.php'); //incluindo o head.php
            ?>
      </div>

   </body>

      <?php
                  //footer principal 
                  include('seosys/includes/seo-footer.php'); //incluindo o footer.php
                  ?>
  <!-- <script>
      (function(w,d,u){
              var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
              var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
      })(window,document,'https://cdn.bitrix24.com/b16679885/crm/site_button/loader_2_m3guj0.js');
   </script> -->
</html>