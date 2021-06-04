<?php
echo $this->element('imagens/form');

echo '<div class="fix-float"></div>';

if(!empty($imagens)):
    echo $this->element('imagens/lista');
else:
    echo $this->Html->tag(
        'p', 'Nenhuma imagem cadastrada até o momento.', array(
            'class' => 'sem-registros'
        )
    );
endif;
?>