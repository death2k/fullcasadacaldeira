<div class="span16">
<?php
if(!empty($marcas)):
    echo $this->element('marcas/lista');
else:
    echo $this->Html->tag(
        'p', 'Nenhuma marca cadastrada até o momento.', array(
            'class' => 'sem-registros'
        )
    );
endif;
?>
</div>