<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php get_template_part('head'); ?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WTMT4QZHKE"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-WTMT4QZHKE');

</script>
</head>
<?php
global $porto_settings, $porto_design;
$body_class = ($porto_settings['wrapper']) ? ($porto_settings['wrapper']) : '';
?>
<body <?php body_class(array($body_class)); ?> id="home">
<!-- 
<style>
 .menu-whats{/* display: auto; */}

  @media(max-width: 2000px){
    .menu-whats{
      z-index: 9999;
      display: inline-block;
      width: 100%;
      position: fixed;
      bottom: 0;
      left: 0;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      white-space: nowrap;
      background: #d8d8d8;
      padding: 0 80px;
      margin: 0;
    }
    .menu-whats li{
      float: left;
      width: 25%;
      display: block;
    }
.menu-whats ul{
      top: 670px;
    }
    .menu-whats li a, .menu-whats li button{
      display: block;
      height: 49px;
    }
    .mm-call{height: 42px; width: 42px; background: url(http://www.casadacaldeira.com.br/home/gespress/uploads/2019/04/mm-phone-icon.png) no-repeat center center;}
    .mm-whatsapp{height: 42px; width: 42px; background: url(http://www.casadacaldeira.com.br/home/gespress/uploads/2019/04/mm-whatsapp-icon.png) no-repeat center center;}
    .mm-email{height: 42px; width: 42px; background: url(http://www.casadacaldeira.com.br/home/gespress/uploads/2019/04/mm-email-icon.png) no-repeat center center;}
    .mm-up-to-top{height: 42px; width: 42px; background: url(http://www.casadacaldeira.com.br/home/gespress/uploads/2019/04/mm-up-icon.png) no-repeat center center;}
}

@media(max-width: 380px){
  .menu-whats{padding: 0 20px}
}

</style>       
<div style="">
 <ul class="menu-whats" style="height: 50px;">
	
          <li><a href="tel:443244-1734" class="mm-call" title="Ligue"></a></li>
          <li><a href="https://wa.me/554432441734?text=Olá,%20preciso%20de%20informações" target="_blank" class="mm-whatsapp" title="Whats App"></a>VENDAS 1</li>
	  <li><a href="https://wa.me/554432442584?text=Olá,%20preciso%20de%20informações" target="_blank" class="mm-whatsapp" title="Whats App"></a>VENDAS 2</li>
          <li><a href="mailto:gustavo@casadacaldeira.com.br" class="mm-email" title="E-mail"></a>E-MAIL</li>
        </ul>
</div>

<div style="">
 <ul class="menu-footer-mobile">
          <li><a href="tel:443244-1734" class="mm-call" title="Ligue"></a></li>
          <li><a href="https://wa.me/554432441734?text=Olá,%20preciso%20de%20informações" target="_blank" class="mm-whatsapp" title="Whats App"></a></li>
	  <li><a href="https://wa.me/554432442584?text=Olá,%20preciso%20de%20informações" target="_blank" class="mm-whatsapp" title="Whats App"></a></li>
          <li><a href="mailto:gustavo@casadacaldeira.com.br" class="mm-email" title="E-mail"></a></li>
        </ul>
</div>

-->



    <?php
    // Get Meta Values
    wp_reset_postdata();
    global $porto_layout, $porto_sidebar;

    $porto_layout = porto_meta_layout();
    $porto_sidebar = porto_meta_sidebar();
    $porto_banner_pos = porto_get_meta_value('banner_pos');
    if (($porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') && (!$porto_sidebar || !is_active_sidebar( $porto_sidebar ))) {
        $porto_layout = 'fullwidth';
    }
    if (($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar') && (!$porto_sidebar || !is_active_sidebar( $porto_sidebar ))) {
        $porto_layout = 'widewidth';
    }

    $breadcrumbs = $porto_settings['show-breadcrumbs'] ? porto_get_meta_value('breadcrumbs', true) : false;
    $page_title = $porto_settings['show-pagetitle'] ? porto_get_meta_value('page_title', true) : false;
    $content_top = porto_get_meta_value('content_top');
    $content_inner_top = porto_get_meta_value('content_inner_top');

    if (( is_front_page() && is_home()) || is_front_page() ) {
        $breadcrumbs = false;
        $page_title = false;
    }

    $header_type = $porto_settings['header-type'];

    ?>

    <div class="page-wrapper<?php if ($header_type == 'side') echo ' side-nav' ?>"><!-- page wrapper -->

        <?php
        if ($porto_banner_pos == 'before_header') {
            porto_banner('banner-before-header');
        }
        ?>

        <?php if (porto_get_meta_value('header', true)) : ?>
            <div class="header-wrapper<?php if ($porto_settings['header-wrapper'] == 'wide') echo ' wide' ?><?php if ($porto_banner_pos == 'below_header' || $porto_banner_pos == 'fixed') echo ' fixed-header' ?><?php if ($header_type == 'side') echo ' header-side-nav' ?> clearfix"><!-- header wrapper -->
                <?php

                global $porto_settings;

                ?>
                <?php if ($porto_settings['header-wrapper'] == 'boxed') : ?>
                <div id="header-boxed" class="container">
                <?php endif; ?>

                    <?php
                    get_template_part('header/header_'.$header_type);
                    ?>

                <?php if ($porto_settings['header-wrapper'] == 'boxed') : ?>
                </div>
                <?php endif; ?>
            </div><!-- end header wrapper -->
        <?php endif; ?>

        <?php
        if ($porto_banner_pos != 'before_header') {
            porto_banner($porto_banner_pos == 'fixed' ? 'banner-fixed' : '');
        }
        ?>

        <?php get_template_part('breadcrumbs'); ?>

        <div id="main" class="<?php if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') echo 'column2' . ' column2-' . str_replace('wide-', '', $porto_layout); else echo 'column1'; ?><?php if ($porto_layout == 'widewidth') echo ' wide' ?><?php if (!$breadcrumbs && !$page_title) echo ' no-breadcrumbs' ?>"><!-- main -->

            <?php if ($content_top) : ?>
            <div id="content-top"><!-- begin content top -->
                <?php echo do_shortcode('[porto_block name="'.$content_top.'"]') ?>
            </div><!-- end content top -->
            <?php endif; ?>

            <?php if ($porto_layout == 'fullwidth' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') : ?>
            <div class="container">
                <div class="row">
            <?php endif; ?>

            <!-- main content -->
            <div class="main-content <?php if (($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') && $porto_sidebar && is_active_sidebar( $porto_sidebar )) echo 'col-md-9'; else echo 'col-md-12'; ?>">

            <?php if (function_exists('wc_print_notices')) : ?>
                <?php wc_print_notices(); ?>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
                <?php if ($content_inner_top) : ?>
                    <div id="content-inner-top"><!-- begin content inner top -->
                        <?php echo do_shortcode('[porto_block name="'.$content_inner_top.'"]') ?>
                    </div><!-- end content inner top -->
                <?php endif; ?>
