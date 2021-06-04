<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-BR">
<head>
    <title>Painel de Controle | B3net</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <?php
    echo $this->Html->css(
        array(
            'bootstrap.min',
            '/vendor/fancybox/jquery.fancybox-1.3.4',
            'base',
            'main',
            'simples',
        )
    );
    echo PHP_EOL;
    ?>
</head>

<body>
    <div class="containerSimples">
        <?php echo $content_for_layout ?>
    </div>

    <?php
    echo $this->Html->script(
        array(
            'https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js',
            '/vendor/fancybox/jquery.easing-1.3.pack.js',
            '/vendor/fancybox/jquery.fancybox-1.3.4.pack.js',
            'bootstrap-dropdown.js',
            'bootstrap-modal.js',
            'jquery.maskMoney.js',
            '/vendor/ckeditor/ckeditor.js',
            '/vendor/ckeditor/lang/_languages.js',
            '/vendor/ckeditor/config.js',
            'main.js',
        )
    );
    ?>
</body>
</html>