<?php
echo $this->TbForm->create('ProdutosTiposOpcao', array(
    'url' => array(
        'controller' => 'variacoes',
        'action' => 'salvarProdutosTiposOpcoes',
    ),
    'class' => 'form-stacked inline-checkbox',
));
    
    echo $this->TbForm->hidden('produto_id', array(
        'value' => $produto_id,
    ));

    echo '<fieldset>';
        echo '<legend>Escolha as propriedadades variáveis para este produto.</legend>';

        echo '<div class="clearfix"><div class="input">';
        foreach ($tiposOpcoesList as $id => $label) {
            echo '<div class="checkbox">';
                $checked = false;
                foreach($produtosTiposOpcoes AS $item):
                    $item = $item['ProdutosTiposOpcao'];
                    if($item['tipos_opcao_id'] == $id) $checked = true;
                endforeach;

                echo $this->TbForm->checkbox("ProdutosTiposOpcao.TiposOpcao.{$id}", array(
                    'hiddenField' => false,
                    'type' => 'checkbox',
                    'checked' => $checked,
                    'value' => $id,
                ));
                echo $this->TbForm->label("ProdutosTiposOpcao.TiposOpcao.{$id}", $label);
            echo '</div>';
        }
        echo '</div></div>';
    echo '</fieldset>';


    echo '<div class="actions">';
        echo $this->AdminHelper->submitButton('Salvar', 'primary');

        //VARIAÇÃO
        if (!empty($produtosTiposOpcoes)):
            echo $this->Html->link(
                'Adicionar Variação',
                array('controller' => 'variacoes', 'action' => 'adicionar', $produto_id),
                array('class' => 'btn success', 'style' => 'float:right;')
            );
        endif;
    echo '</div>';

echo $this->TbForm->end();
?>