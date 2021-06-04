<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>
    <?php
    if(!empty($title_for_layout)):
        echo "{$title_for_layout} | Casa da Caldeira";
    else:
        echo "Casa da Caldeira - Peças e Acessórios para Caldeiras";
    endif;
    ?>
    </title>

    <?php echo $this->Html->charset(); ?>

    <meta name="description" content="" />
    <meta name="author" content="B3net" />
    <meta name="language" content="pt-br" />

    <link rel="shortcut icon" href="<?php echo Router::url('/'); ?>img/favicon.jpg" />

    <!--[if lt IE 9]>
        <?php echo $this->Html->script('IE9') . PHP_EOL; ?>
    <![endif]-->

    <?php
    echo $this->Html->css(array(
        'reset',
        '/vendor/fancybox/jquery.fancybox-1.3.4',
        '/vendor/nivo-slider/themes/default/default',
        '/vendor/nivo-slider/nivo-slider',
        'main',
    ));

    if(!empty($this->additional_styles))
        echo $this->Html->css($this->additional_styles);
    ?>

    <!--[if IE 7]>
        <?php echo $this->Html->css('ie7') . PHP_EOL; ?>
    <![endif]-->

    <!--[if IE 8]>
        <?php echo $this->Html->css('ie8') . PHP_EOL; ?>
    <![endif]-->
</head>

<?php
$bodyClass = $this->params['controller'] . '-' . $this->params['action'];
if($this->params['action'] != 'home') $bodyClass .= ' interna';
?>

<body class="<?php echo $bodyClass; ?>">
    <div id="container">
        <div id="wrapper">
            <div id="header">
                <h1 id="logo">
                    <?php
                    echo $this->Html->link('Casa da Caldeira - Peças e Acessórios para Caldeiras', '/', array(
                        'title' => 'Casa da Caldeira - Peças e Acessórios para Caldeiras'
                    ));
                    ?>
                </h1>

                <div id="main-menu"><?php echo $this->element('menu'); ?></div>

                <div id="search-bar">
                    <form action="<?php echo Router::url(array('controller' => 'produtos', 'action' => 'index')); ?>" id="search-form" method="get">
                        <label for="search-field">Buscar</label>

                        <?php $SearchFieldValue = isset($searchTerm) ? $searchTerm : 'Procurar...'; ?>
                        <input type="text" name="s" id="search-field" value="<?php echo $SearchFieldValue; ?>" />

                        <button type="submit" id="search-button">Ok</button>
                    </form>
                </div>
            </div><!-- div#header -->

            <div id="middle">
                <?php echo $this->element('sidebar-left'); ?>

                <?php
                $apenasContent = 'apenas-content';
                if (
                    ($this->params['controller'] == 'pages' && $this->params['action'] == 'home')
                    OR ($this->params['controller'] == 'produtos' && $this->params['action'] == 'index')
                ):
                    $apenasContent = '';
                endif;
                ?>

                <div id="content" class="<?php echo $apenasContent; ?>">
                    <?php echo $session->flash(); ?>
                    <?php echo $content_for_layout; ?>
                </div>
            </div><!-- div#middle -->
        </div><!-- div#wrapper -->

        <div id="footer">
            <div id="menu-footer">
                <?php echo $this->element('menu'); ?>
            </div>

            <p class="endereco">Avenida Colombo, 7734 - CEP 87080-190 - Maringá - PR</p>

            <p class="copywrite">
                <?php echo $this->Html->link('Casa da Caldeira', '/'); ?> © <?php echo date('Y'); ?> - Todos os direitos reservados.
                <?php
                echo $this->Html->link('B3net', 'http://www.b3net.com.br', array(
                    'title' => 'Site desenvolvido pela B3net',
                    'id' => 'logo-b3net',
                    'target' => '_blank',
                ));
                ?>
            </p>
        </div><!-- div#footer -->
    </div><!-- div#container -->

    <script type="text/javascript">
        var baseUrl = '<?php echo Router::url('/'); ?>';
        var sessionID = '<?php echo $session->id(); ?>';
    </script>

    <?php
    echo $this->Html->script(array(
        'jquery-1.6.4.min.js',
        '/vendor/fancybox/jquery.fancybox-1.3.4.pack',
        '/vendor/nivo-slider/jquery.nivo.slider.pack',
        'main.js'
    ));

    if(!empty($this->additional_scripts))
        echo $this->Html->script($this->additional_scripts);
    ?>
</body>
</html>

