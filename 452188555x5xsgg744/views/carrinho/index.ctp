<h2 class="titulo">Carrinho</h2>

<?php
if(!empty($carrinho)):
    echo $this->Form->create('CarrinhoProduto', array(
        'url' => array(
            'controller' => 'carrinho',
            'action' => 'atualizar',
        ),
    ));
        echo $this->Form->hidden('sessao', array(
            'value' => session_id()
        ));
?>
        <table class="carrinho bordered-table">
            <thead>
                <tr>
                    <th colspan="2" class="produto-header">Produto</th>
                    <th class="quantidade-header">Quant.</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($carrinho as $item):
                    $variacao = $item['produto']['Variacao'][0];

                    if (!empty($variacao->imagens)):
                        $imagem = $variacao->imagens[0];
                    elseif (!empty($item['produto']['Imagem'])):
                        $imagem = $item['produto']['Imagem'][0];
                    endif;

                    $tipos_opcao = $variacao->tipos_opcoes[0];
                ?>
                    <tr>
                        <td class="image-collum">
                        <?php
                            if (isset($imagem)):
                                echo '<img src="' . Router::url('/uploads/produtos/thumb/small/'.$imagem->nome_arquivo) . '" />';
                            else:
                                echo $this->Html->image('no-photo-50.jpg');
                            endif;
                        ?>
                        </td>

                        <td class="produto-collum"><?php
                        echo $this->Html->tag(
                            'p',
                            $item['produto']['Produto']['titulo'],
                            array('class' => 'titulo')
                        );

                        if (!empty($variacao->codigo)):
                            echo $this->Html->tag(
                                'p',
                                "Código: <strong>{$variacao->codigo}</strong>",
                                array('class' => 'codigo')
                            );
                        endif;

                        echo $this->Html->tag(
                            'p',
                            'Categoria: ' . 
                            $this->Categorias->getPath($item['produto']['Produto']['categoria_id']),
                            array('class' => 'categoria')
                        );

                        echo '<p class="variacao">';
                            echo $tipos_opcao->nome . ': ';
                                echo '<img src="' . Router::url('/uploads/propriedades-variaveis/'.$tipos_opcao->opcao->imagem) . '" width="15" />';
                            echo " ({$tipos_opcao->opcao->nome})";
                            echo ';';
                        echo '</p>';
                        ?></td>

                        <td class="quantidade-collum"><?php
                        echo $this->Form->input(
                            'quantidade.' . $item['id'],
                            array(
                                'value' => $item['quantidade'],
                                'label' => false, 'div' => false,
                                'size' => '5',
                            )
                        );
                        echo $this->Form->submit(
                            'Atualizar',
                            array('div' => false)
                        );
                        ?></td>

                        <td class="acoes-collum">
                        <?php
                        echo $this->Html->link(
                            'excluir',
                            array(
                                'controller' => 'carrinho',
                                'action' => 'excluir',
                                $item['id'],
                            ),
                            array(),
                            'Tem certeza?'
                        );
                        ?>
                        </td>
                    </tr>
                <?php
                    unset($imagem);
                endforeach;
                ?>
            </tbody>
        </table>

        <div class="actions">
            <?php
            echo $this->Html->link(
                'Enviar Cotação',
                '#EnviarCotacaoWrapper',
                array('id' => 'EnviarCotacaoBtn')
            );
            ?>
        </div>
<?php
    echo $this->Form->end();

    echo $this->element('carrinho/cotacao');
else:
    echo '<p class="sem-registros">Nenhum produto adicionado até o momento.</p>';
endif;
?>