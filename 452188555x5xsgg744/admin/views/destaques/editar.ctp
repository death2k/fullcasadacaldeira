<div class="span16">
<?php
echo $this->TbForm->create('Destaque', array(
    'url' => array('action' => 'salvar'),
));

    echo $this->TbForm->input('destaques_secao_id', array(
        'label' => 'Seção',
        'class' => 'large',
        'options' => $destaquesSecao,
    ));

    echo $this->TbForm->input('produto_id', array(
        'label' => 'ID do Produto',
        'class' => 'large',
        'type' => 'text',
    ));


    echo '<div class="actions">';
        echo $this->Html->link(
            'voltar',
            array('action' => 'index'),
            array('class' => 'btn')
        );

        echo '&nbsp;&nbsp;';

        $textoBotao = isset($this->data['Destaque']['id']) ? 'Salvar' : 'Adicionar';

        echo $this->AdminHelper->submitButton($textoBotao, 'primary');
    echo '</div>';
echo $this->TbForm->end();
?>
</div>