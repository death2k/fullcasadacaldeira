<?php
echo $this->TbForm->create('Imagem', array(
    'url' => array('controller' => 'imagens', 'action' => 'salvar'),
    'type' => 'file',
));
    echo $this->TbForm->hidden('produto_id', array('value' => $produto_id));

    if (isset($this->params['named']['variacao'])):
        echo $this->TbForm->hidden("variacao_id", array(
            'value' => $this->params['named']['variacao'],
        ));
    endif;

    echo $this->TbForm->input("nome_arquivo", array(
        'type' => 'file',
        'label' => "Adicionar Imagem: ",
    ));

    echo $html->image('spinner.gif', array('class' => 'loader-spinner'));

    echo $this->AdminHelper->submitButton('Adicionar', 'primary addBtn');
echo $this->TbForm->end();
?>