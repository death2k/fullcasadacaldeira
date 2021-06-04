<?php
$this->botaoHeader = $this->Html->link(
    'Voltar',
    array(
        'controller' => 'produtos',
        'action' => 'index',
    ),
    array('class' => 'btn small primary')
);
?>
<div class="span16">
    <?php
    echo '<div class="actions-header">';
        

        //PARTE 1
        echo $this->Html->link(
            'PARTE 1',
            array('controller' => 'produtos', 'action' => 'editar', $produto_id),
            array('class' => 'btn primary')
        );

        //PARTE 2
        echo $this->Html->link(
            'PARTE 2',
            array('controller' => 'variacoes', 'action' => 'index', $this->data['Produto']['id']),
            array('class' => 'btn disabled')
        );
    echo '</div>';
    
    echo '<div class="fix-float"></div>';
    
    if (empty($variacoes)):
        echo $this->element('variacoes/escolher-propriedades-variaveis');
    else:
        echo $this->element('variacoes/lista');
    endif;
    ?>
</div>