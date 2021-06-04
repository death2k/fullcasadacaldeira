<?php
$this->botaoHeader = $this->Html->link(
    'Voltar',
    array('controller' => 'produtos', 'action' => 'index'),
    array('class' => 'btn small primary')
);
?>
<div class="span16">
    <?php echo $this->element('variacoes/form'); ?>
</div>