<?php $this->botaoHeader = ''; ?>
<div class="span11">
<?php
if(!empty($data)):
    echo $this->element('tipos_opcoes/lista');
else:
    echo $this->Html->tag(
        'p', 'Nenhuma propriedade variável cadastrada até o momento.', array(
            'class' => 'sem-registros'
        )
    );
endif;
?>
</div>

<div id="sidebar" class="span4">
    <h3>Adicionar nova propriedade</h3>
    <?php echo $this->element('tipos_opcoes/form'); ?>
</div>