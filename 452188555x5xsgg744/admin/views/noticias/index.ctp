<div class="span16">
<?php
if(!empty($noticias)):
    echo $this->element('noticias/lista');
else:
    echo $this->Html->tag(
        'p', 'Nenhuma notícia cadastrada até o momento.', array(
            'class' => 'sem-registros'
        )
    );
endif;
?>
</div>