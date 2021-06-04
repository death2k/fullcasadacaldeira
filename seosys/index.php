<?php
         //Head principal
         include('../seosys/model/index.php');
         ?>

<!doctype html>
<html>

<link rel="stylesheet" href="../seosys/css/tabs.css">

   <head>
        <?php
         //Head principal
         include('../seosys/includes/seo-head.php');
         ?>
   </head>
   <!-- <body oncontextmenu='return false' class='snippet-body'> -->
   <body class='snippet-body'>
      
      <div class="super_container">
            <!-- Header -->
            <?php
            //Header principal
            include('../seosys/includes/seo-header.php'); 
            ?>
            
            <br>

        <?php
            //Header principal
            include('../seosys/produtos-lista.php'); 
            ?>

<?php
            //SEO Banner principal
            include('../seosys/includes/seo-banner.php'); //incluindo o head.php
            ?>
      </div>

   </body>

      <?php
                  //footer principal 
                  include('../seosys/includes/seo-footer.php'); //incluindo o footer.php
                  ?>
  
</html>