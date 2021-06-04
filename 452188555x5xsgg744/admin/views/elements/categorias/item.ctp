<?php
$zebra = ($index%2 == 0) ? 'odd' : 'even';
echo "<li class=\"{$zebra}\">";

    echo $this->Html->tag('p', $categoria->titulo, array('class' => 'titulo'));

    echo '<div class="actions-inline">';
        echo $this->Html->link(
            '+',
            array('controller' => 'categorias', 'action' => 'adicionar', 'parent' => $categoria->id),
            array('class' => 'label', 'title' => 'Adicionar Subcategoria')
        );

        echo $this->Html->link(
            'editar',
            array('controller' => 'categorias', 'action' => 'editar', $categoria->id),
            array('class' => 'label', 'title' => 'Editar Categoria')
        );

        echo $this->Html->link(
            'excluir',
            array('controller' => 'categorias', 'action' => 'excluir', $categoria->id),
            array('class' => 'label important', 'title' => 'Excluir Categoria'),
            'Deseja realmente excluir esta categoria?'
        );
    echo '</div>';

    if (!empty($childrens)):
        echo '<ul class="childrens">';
            foreach ($childrens AS $index => $children):
                echo $this->element('categorias/item', array(
                    'index' => $index,
                    'categoria' => (object) $children['Categoria'],
                    'childrens' => $children['children'],
                ));
            endforeach;
        echo '</ul>';
    endif;
echo '</li>';
?>