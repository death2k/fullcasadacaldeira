<div class="span16">
<?php
if(!empty($destaques)):
    echo $this->element('destaques/lista');
else:
    echo $this->Html->tag(
        'p', 'Nenhum destaque cadastrado até o momento.', array(
            'class' => 'sem-registros'
        )
    );
endif;
?>
</div>