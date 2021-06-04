<?php
echo $this->TbForm->create('Categoria', array(
    'url' => array('action' => 'salvar'),
    'class' => 'srthr',
));
    if (isset($parent_id)):
        echo $this->TbForm->hidden('parent_id', array('value' => $parent_id));
    endif;

    echo $this->TbForm->input('titulo', array(
        'label' => 'Título',
        'class' => 'large',
    ));

    echo '<div class="actions">';
        echo $this->Html->link(
            'voltar',
            array('action' => 'index'),
            array('class' => 'btn')
        );

        echo '&nbsp;&nbsp;';

        $textoBotao = isset($this->data['Categoria']['id']) ? 'Salvar' : 'Adicionar';

        echo $this->AdminHelper->submitButton($textoBotao, 'primary');
    echo '</div>';
echo $this->TbForm->end();
?>