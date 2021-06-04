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
        )
    );
    echo PHP_EOL;
    ?>
</head>

<body>
    <div class="topbar">
        <div class="fill">
            <div class="container">
                <?php
                echo $this->Html->tag('h3', $this->Html->link(
                    'Painel de Controle | B3net',
                    '/',
                    array('class' => 'brand')
                ));
                ?>

                <?php echo $this->element('menu'); ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content">
            <div class="page-header">
                <h1>
                    <?php
                    echo $title_for_layout;

                    if(isset($this->botaoHeader)):
                        echo $this->botaoHeader;
                    else:
                        if($this->params['action'] == 'index') {
                            echo $this->Html->link(
                                'Adicionar novo',
                                array(
                                    'action' => 'adicionar',
                                ),
                                array('class' => 'btn small primary')
                            );
                        } else {
                            echo $this->Html->link(
                                'Voltar',
                                array(
                                    'action' => 'index',
                                ),
                                array('class' => 'btn small primary')
                            );
                        }
                    endif;
                    ?>
                </h1>
            </div>

            <?php echo $this->Session->flash(); ?>

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

        <?php //if (Configure::read('debug')) echo $this->element('sql_dump'); ?>
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