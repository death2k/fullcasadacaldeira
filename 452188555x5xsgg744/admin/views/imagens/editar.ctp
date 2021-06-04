<div class="span16">
<?php
echo $this->TbForm->create('Imagem', array(
    'url' => array('controller' => 'imagens', 'action' => 'salvar'),
    'type' => 'file',
));
    /*if(
        isset($this->data['Imagem']['nome_arquivo'])
        && !empty($this->data['Imagem']['nome_arquivo'])
        && !is_array($this->data['Imagem']['nome_arquivo'])
    ):
        $miniatura = $this->data['Imagem']['nome_arquivo'];

        echo '<div class="media-grid miniatura-lateral-direita">';
            echo '<label>Miniatura: </label>';
            echo $this->Html->link(
                $this->Html->image('uploads/produtos/thumb/small/' . $miniatura),
                '/img/uploads/produtos/' . $miniatura,
                array(
                    'class' => 'fancybox',
                    'escape' => false,
                )
            );
        echo '</div>';
    endif;*/


    echo $this->TbForm->hidden('produto_id', array('value' => $produto_id));

    if (isset($this->params['named']['variacao'])):
        echo $this->TbForm->hidden("variacao_id", array(
            'value' => $this->params['named']['variacao'],
        ));
    endif;

    echo $this->TbForm->input("nome_arquivo", array(
        'type' => 'file',
        'label' => "Arquivo da Imagem: ",
    ));

    echo $this->AdminHelper->submitButton('Salvar', 'primary');
echo $this->TbForm->end();
?>
</div>