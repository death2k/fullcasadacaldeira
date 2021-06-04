<?php
echo $this->TbForm->create('Variacao', array(
    'url' => array('action' => 'salvar'),
));
    
    //ID
    if (isset($this->data['Variacao']['id'])) echo $this->TbForm->hidden('id');

    //PRODUTO_ID
    echo $this->TbForm->hidden('produto_id', array('value' => $produto_id));


    //ACTIONS
    if(isset($this->data['Variacao']['id'])):
        echo '<div class="actions-header">';
            //NOVA VARIAÇÃO
            echo $this->Html->link(
                'Nova Variação',
                array('controller' => 'variacoes', 'action' => 'adicionar', $produto_id),
                array('class' => 'btn success')
            );
        echo '</div>';
    endif;


    if(isset($this->data['Variacao']['id'])):
        $urlIframe = Router::url(array(
            'controller' => 'imagens',
            'action' => 'index',
            $produto_id,
            'variacao' => $this->data['Variacao']['id']
        ));
        echo "<iframe src=\"{$urlIframe}\" id=\"iframeImages\" width=\"540\" height=\"520\" frameborder=\"0\" hspace=\"0\" scrolling=\"auto\"></iframe>";
    endif;


    //OPÇÕES
    echo '<fieldset>';
        echo '<legend>Opções</legend>';

        $x = 0;
        foreach ($produtosTiposOpcoes as $item):
            $selectedId = null;
            if (isset($this->data['OpcoesVariacao'])):
                foreach($this->data['OpcoesVariacao'] AS $opcoesVariacao):
                    $produtosTiposOpcao = $item['ProdutosTiposOpcao'];
                    if(
                        $produtosTiposOpcao['tipos_opcao_id']
                        == $opcoesVariacao['tipos_opcao_id']
                   ):
                       $selectedId = $opcoesVariacao['opcao_id'];
                   endif;
                endforeach;
            endif;


            $tiposOpcao = '';
            foreach ($tiposOpcoes as $tiposOpcoesItem):
                if(
                    $tiposOpcoesItem['TiposOpcao']['id']
                    == $item['ProdutosTiposOpcao']['tipos_opcao_id']
                ):
                    $tiposOpcao = $tiposOpcoesItem;
                endif;
            endforeach;


            echo $this->TbForm->hidden("Variacao.opcoes.{$x}.tipos_opcao_id", array(
                'value' => $tiposOpcao['TiposOpcao']['id'],
            ));

            echo $this->TbForm->input("Variacao.opcoes.{$x}.opcao_id", array(
                // 'checked' => $checked,
                'label' => $tiposOpcao['TiposOpcao']['nome'],
                'options' => $tiposOpcao['Opcao'],
                'selected' => $selectedId,
            ));

            $x++;
        endforeach;
    echo '</fieldset>';


    //INFORMAÇÕES
    echo '<fieldset>';
        echo '<legend>Informações</legend>';

        echo $this->TbForm->input('codigo', array(
            'label' => 'Código',
            'class' => 'medium',
        ));

        echo $this->TbForm->input('preco', array(
            'label' => 'Preço',
            'class' => 'small mask-money',
        ));

        echo $this->TbForm->input('promocao', array(
            'label' => 'Promoção',
            'class' => 'small mask-money',
        ));

        echo $this->TbForm->input('quantidade', array(
            'label' => 'Quantidade',
            'class' => 'mini',
        ));
    echo '</fieldset>';


    //FRETE
    echo '<fieldset>';
        echo '<legend>Frete</legend>';

        echo $this->TbForm->input('peso', array(
            'label' => 'Peso (kg)',
            'class' => 'small',
        ));

        echo $this->TbForm->input('altura', array(
            'label' => 'Altura (cm)',
            'class' => 'small',
        ));

        echo $this->TbForm->input('largura', array(
            'label' => 'Largura (cm)',
            'class' => 'small',
        ));

        echo $this->TbForm->input('comprimento', array(
            'label' => 'Comprimento (cm)',
            'class' => 'small',
        ));
    echo '</fieldset>';


    //AÇÕES
    echo '<div class="actions">';
        echo $this->Html->link(
            'voltar',
            array('controller' => 'variacoes', 'action' => 'index', $produto_id),
            array('class' => 'btn')
        );

        echo '&nbsp;&nbsp;';

        echo $this->AdminHelper->submitButton('Salvar', 'primary');
    echo '</div>';
echo $this->TbForm->end();
?>