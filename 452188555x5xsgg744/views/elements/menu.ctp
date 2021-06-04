<ul>
<?php
    $menu = array(
        array(
            'nome' => 'Empresa',
            'url' => array('controller' => 'pages', 'action' => 'empresa'),
        ),
        array(
            'nome' => 'Lançamentos',
            'url' => array('controller' => 'pages', 'action' => 'lancamentos'),
        ),
        array(
            'nome' => 'Localização',
            'url' => array('controller' => 'pages', 'action' => 'localizacao'),
        ),
        array(
            'nome' => 'Contato',
            'url' => array('controller' => 'pages', 'action' => 'contato'),
        ),
        array(
            'nome' => 'Meu Carrinho',
            'url' => array('controller' => 'carrinho', 'action' => 'index'),
        ),
    );

    foreach ($menu as $item):
        if (!isset($item['verifiyAction']))
            $item['verifiyAction'] = true;

        if (!isset($item['url']['action'])):
            $item['url']['action'] = 'index';
        endif;

        $class = '';
        if (
            $this->params['controller'] == $item['url']['controller']
            && $this->params['action'] == $item['url']['action']
            || (
                $this->params['controller'] == $item['url']['controller']
                && !$item['verifiyAction']
            )
        ):
            $class = 'actived';
        endif;

        $class .= ' item-' . $item['url']['controller'] . '-' . $item['url']['action'];

        echo $this->Html->tag('li', $this->Html->link(
            $item['nome'], $item['url'],
            array('title' => $item['nome'])
        ), array(
            'class' => $class,
        ));
    endforeach;
?>
</ul>