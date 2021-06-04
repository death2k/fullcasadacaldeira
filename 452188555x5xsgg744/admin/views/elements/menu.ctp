<ul class="nav">
    <?php
    $nav = array(
        '' => array(
            'label' => 'Home',
        ),
        'produtos' => array(
            'label' => 'Produtos',
            'url' => '#',
            'subItens' => array(
                'produtos' => array(
                    'label' => 'Produtos',
                ),
                array('label' => 'divider'),
                'categorias' => array(
                    'label' => 'Categorias',
                ),
                'marcas' => array(
                    'label' => 'Marcas',
                ),
                array('label' => 'divider'),
                'tipos_opcoes' => array(
                    'label' => 'Propriedades Variáveis',
                ),
            ),
        ),
        'usuarios' => array(
            'label' => 'Usuários',
        ),
    );

    $activeMenu = isset($activeMenu) ? $activeMenu : '';
    echo $this->Menu->mount($nav, $activeMenu);
    ?>
</ul>


<ul class="nav secondary-nav">
    <li><a href="<?php echo $baseUrl ?>">Ir para o Site</a></li>
    <?php
    $nav = array(
        'sair' => array(
            'label' => 'Sair',
            'url' => array(
                'controller' => 'usuarios',
                'action' => 'logout',
            ),
        ),
    );

    echo $this->Menu->mount($nav, 'ergaer');
    ?>
</ul>