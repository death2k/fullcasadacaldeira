<?php
if(isset($this->data['TiposOpcao']['id'])):
    $action = 'atualizar';
    $submitButton = 'Salvar';
else:
    $action = 'criar';
    $submitButton = 'Adicionar';
endif;

echo $this->TbForm->create('TiposOpcao', array(
    'url' => array('action' => $action),
    'class' => 'form-stacked',
));
    echo $this->TbForm->input('nome', array(
        'label' => 'Nome',
    ));

    if (isset($this->data['TiposOpcao']['id'])):
        echo $this->TbForm->input('imagem', array(
            'label' => 'Listar como Imagem',
            'div' => array('class' => 'clearfix checkbox-inline'),
        ));
    endif;

    echo '<div class="actions">';
        echo $this->AdminHelper->submitButton($submitButton, 'primary');
    echo '</div>';
echo $this->TbForm->end();
?>