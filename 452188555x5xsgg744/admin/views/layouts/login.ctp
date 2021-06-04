<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-BR">
<head>
    <title>Painel de Controle | B3net</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <?php
    echo $this->Html->css(
        array(
            'bootstrap.min',
            'base',
            'login',
        )
    );
    echo PHP_EOL;
    ?>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="page-header topbar-inner">
                <h1>Painel de Controle | B3net</h1>
            </div>

            <div class="row">
                <?php echo $content_for_layout ?>
            </div>
        </div>

        <div id="footer">
            <p>
                Copyright &copy; 2011
                <?php echo $this->Html->link('B3net', 'http://www.b3net.com.br'); ?>.
            </p>
        </div>
    </div>

    <?php
    echo $this->Html->script(
        array(
            'https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js',
            'login.js',
        )
    );
    ?>
</body>
</html>