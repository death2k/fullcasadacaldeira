<?php
if (isset($categoria_id)):
    $path = $this->Html->link(
        'Produtos',
        array('controller' => 'produtos', 'action' => 'index'),
        array('title' => 'Todos os produtos')
    );
    $path .= ' » ';
    $path .= $this->Categorias->getPath($categoria_id);

    $tituloPagina = $path;
else:
    $tituloPagina = 'Produtos';
endif;

echo $this->Html->tag('h2', $tituloPagina, array('class' => 'titulo'));
?>

<?php
if (!empty($produtos)):
    echo '<div class="produtos">';
    $count = count($produtos);
    foreach ($produtos as $index => $produto):
        echo $this->element('produtos/item', array(
            'produto' => $produto,
            'index' => $index,
            'count' => $count,
        ));
    endforeach;
    echo '</div>';


    if($this->Paginator->hasPrev() || $this->Paginator->hasNext()):
        echo '<div class="pagination">';
            if ($this->Paginator->hasPrev()):
                echo $this->Paginator->prev(
                    '« Anterior', null, null, array('class' => 'disabled')
                );
            endif;

            echo $this->Paginator->numbers(array('separator' => ''));
            
            if ($this->Paginator->hasNext()):
                echo $this->Paginator->next(
                    'Próximo »', null, null, array('class' => 'disabled')
                );
            endif;
        echo '</div>';
    endif;
else:
    echo $this->Html->tag(
        'p', 'Nenhum produto cadastrado até o momento.', array(
            'class' => 'sem-registros'
        )
    );
endif;
?>