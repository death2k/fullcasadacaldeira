<div id="sidebar-left" class="sidebar">
    <?php
    /*$activedClass = ($this->params['controller'] == 'carrinho') ?
        'actived' : '';
    
    echo $this->Html->link(
        'Carrinho de Compras',
        array(
            'controller' => 'carrinho',
            'action' => 'index',
        ),
        array(
            'id' => 'carrinhoCompras',
            'class' => $activedClass,
        )
    );*/
    ?>

    <div class="categorias-box">
        <h2 class="titulo">Categorias</h2>
     
        <ul id="categorias">
        <?php
        $Categoria = Classregistry::init('Categoria');
        $categorias = $Categoria->getAll();
        
        foreach ($categorias as $categoria):
            $categoriaActived = '';
            if(
                isset($categoria_id)
                && $categoria['Categoria']['id'] == $categoria_id
            ):
                $categoriaActived = 'actived';
            endif;

            $childrens = '';
            if (!empty($categoria['children'])):
                $childrens .= '<ul class="dropdown">';
                foreach ($categoria['children'] as $subcategoria):
                    $subcategoriaActived = '';
                    if(
                        isset($categoria_id)
                        && $subcategoria['Categoria']['id'] == $categoria_id
                    ):
                        $categoriaActived = 'actived';
                        $subcategoriaActived = 'actived';
                    endif;


                    $childrens .= "<li class=\"{$subcategoriaActived}\">";
                        $childrens .= $this->Html->link(
                            $subcategoria['Categoria']['titulo'],
                            array(
                                'controller' => 'produtos',
                                'action' => 'index',
                                'categoria' => $subcategoria['Categoria']['id'],
                            )
                        );
                    $childrens .= '</li>';
                endforeach;
                $childrens .= '</ul>';
            endif;

            echo "<li class=\"{$categoriaActived}\">";
                echo $this->Html->link(
                    $categoria['Categoria']['titulo'],
                    array(
                        'controller' => 'produtos',
                        'action' => 'index',
                        'categoria' => $categoria['Categoria']['id'],
                    )
                );

                echo $childrens;
            echo '</li>';
        endforeach;
        ?>
        </ul>
    </div>
</div>