<?php $this->botaoHeader = ''; ?>

<div class="span11">
    <?php
    if(!empty($categorias)):
        echo $this->element('categorias/lista');
    else:
        echo $this->Html->tag(
            'p', 'Nenhuma categoria cadastrada até o momento.', array(
                'class' => 'sem-registros'
            )
        );
    endif;
    ?>
</div>

<div id="sidebar" class="span4">
    <?php echo $this->element('categorias/form-simples'); ?>
</div>