<ul class="sidebar-menu">
    <?php
    /**
     * Menu: Dados do Produto
     */
    $dadosDoProdutoActive = 
        ($this->params['controller'] == 'produtos')
        && ($this->params['action'] == 'editar') ?
        'active' : '';
    echo $this->Html->tag('li', $this->Html->link(
        'Dados do Produto',
        array(
            'controller' => 'produtos',
            'action' => 'editar',
            $produto_id,
        ),
        array(
            'class' => $dadosDoProdutoActive
        )
    ));



    /**
     * Menu: Imagens
     */
    $imagensActive = ($this->params['controller'] == 'imagens') ?
        'active' : '';
    echo $this->Html->tag('li', $this->Html->link(
        'Imagens do Produto',
        array(
            'controller' => 'imagens',
            'action' => 'index',
            $produto_id,
        ),
        array(
            'class' => $imagensActive
        )
    ));



    $variacoesDoProdutoActive = ($this->params['controller'] == 'variacoes') ?
        'active' : '';
    echo $this->Html->tag('li', $this->Html->link(
        'Variações do Produto',
        array(
            'controller' => 'variacoes',
            'action' => 'index',
            $produto_id,
        ),
        array(
            'class' => $variacoesDoProdutoActive
        )
    ));
    ?>
</ul>