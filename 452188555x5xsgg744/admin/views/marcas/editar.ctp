<div class="span16">
<?php
echo $this->TbForm->create('Marca', array(
    'type' => 'file',
    'url' => array('action' => 'salvar'),
));

    echo $this->TbForm->input('nome', array(
        'label' => 'Nome',
        'class' => 'large',
    ));

    echo $this->TbForm->input('url', array(
        'label' => 'URL',
        'class' => 'large',
    ));

    echo $this->TbForm->input('logo', array(
        'label' => 'Logo',
        'type' => 'file',
        'class' => 'large',
    ));


    echo '<div class="actions">';
        echo $this->Html->link(
            'voltar',
            array('action' => 'index'),
            array('class' => 'btn')
        );

        echo '&nbsp;&nbsp;';

        $textoBotao = isset($this->data['Marca']['id']) ? 'Salvar' : 'Adicionar';

        echo $this->AdminHelper->submitButton($textoBotao, 'primary');
    echo '</div>';
echo $this->TbForm->end();
?>
</div>