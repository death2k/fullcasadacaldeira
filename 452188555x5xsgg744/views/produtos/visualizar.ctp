<?php
$miniaturas = array();
if (isset($variacao->imagens[0]->id)):
    $imagemPrincipal = (object) $variacao->imagens[0];
    unset($variacao->imagens[0]);
    $miniaturas = $variacao->imagens;
elseif (isset($produto['Imagem'][0]->id)):
    $imagemPrincipal = $produto['Imagem'][0];
    unset($produto['Imagem'][0]);
endif;

if (!empty($produto['Imagem'])):
    $miniaturas += $produto['Imagem'];
endif;

$variacoes = $produto['Variacao'];
$categoria = (object) $produto['Categoria'];
$produto = (object) $produto['Produto'];

$categoriaPath = $this->Categorias->getPath($categoria->id);

$link = array(
    'controller' => 'produtos',
    'action' => 'visualizar',
    $produto->id,
);

echo '<div id="produto-visualizar">';
    //Categorias
    echo $this->Html->tag(
        'div',
        'Categoria: ' . $categoriaPath,
        array('class' => 'categoria subtitulo')
    );


    echo '<div class="detalhes">';
        echo '<div id="galeria">';
            //Imagem Principal
            if (isset($imagemPrincipal)):
                echo '<a href="' . Router::url('/uploads/produtos/'.$imagemPrincipal->nome_arquivo) . '" title="' . $produto->titulo . '" rel="gallery" class="principal">';
                    echo '<img src="' . Router::url('/uploads/produtos/thumb/destaque/'.$imagemPrincipal->nome_arquivo) . '" />';
                echo '</a>';
            else:
                echo $this->Html->link(
                    $this->Html->image('no-photo-180.jpg', array('alt' => 'Sem Imagem')),
                    '/img/no-photo-180.jpg',
                    array('class' => 'principal', 'title' => $produto->titulo, 'rel' => 'gallery', 'escape' => false)
                );
            endif;


            //Miniaturas
            if (!empty($miniaturas)):
                echo '<div class="miniaturas">';
                    foreach ($miniaturas AS $index => $imagem):
                        echo '<a href="' . Router::url('/uploads/produtos/'.$imagem->nome_arquivo) . '" rel="gallery">';
                            echo '<img src="' . Router::url('/uploads/produtos/thumb/small/'.$imagem->nome_arquivo) . '" />';
                        echo '</a>';

                        if (($index)%4 == 0) echo '<div class="fix-float"></div>';
                    endforeach;
                echo '</div>';
            endif;

            echo '<p class="ampliar">Clique na miniatura para ampliar</p>';
        echo '</div>';


        echo '<div id="infos">';
            //Título
            echo $this->Html->tag(
                'h2',
                $produto->titulo,
                array('class' => 'titulo')
            );


            //Código
            if (isset($variacao->codigo)):
                echo $this->Html->tag(
                    'p',
                    'Código: <strong>' . $variacao->codigo . '</strong>',
                    array('class' => 'codigo')
                );
            endif;


            //Variações
            if(!empty($variacoes)):
                echo '<div class="variacoes">';
                    echo $this->Html->tag('h3', 'Cores Disponíveis');
                    
                    foreach ($variacoes AS $item):
                        $tipos_opcao = $item->tipos_opcoes[0];
                        $imagePath = Router::url('/uploads/propriedades-variaveis/'.$tipos_opcao->opcao->imagem);

                        $selected = '';
                        if ($item->id == $variacao->id)
                            $selected = ' selected';

                        echo $this->Html->link(
                            '<img src="' . $imagePath . '" />',
                            array('controller' => 'produtos', 'action' => 'visualizar', $produto->id, 'variacao' => $item->id),
                            array(
                                'escape' => false,
                                'class' => $selected,
                            )
                        );
                    endforeach;
                echo '</div>';
            endif;


            echo '<div class="actions">';
                //Adicionar ao Carrinho
                if (isset($variacao->id)):
                    echo $this->Html->link(
                        'Adicionar ao Carrinho',
                        array('controller' => 'carrinho', 'action' => 'adicionar', 'produto' => $produto->id, 'variacao' => $variacao->id),
                        array(
                            'title' => 'Adicionar produto no carrinho para cotação',
                            'class' => 'btn-adicionar',
                        )
                    );
                endif;


                //Indique o Produto
                echo $this->Html->link(
                    'Indique este Produto',
                    '#IndicarProdutoWrapper',
                    array(
                        'title' => 'Enviar este produto para algum amigo',
                        'class' => 'btn-indicar',
                    )
                );

                echo $this->element('produtos/indicar', array(
                    'produto_id' => $produto->id,
                    'variacao_id' => $variacao->id,
                ));
            echo '</div>';
        echo '</div>';
    echo '</div>';

    echo '<div class="descricao">';
        echo $this->Html->tag(
            'h3',
            'Descrição',
            array('class' => 'subtitulo')
        );
                
        //Descrição
        $produto->resumo = $this->Text->truncate(
            preg_replace('/&[a-z]{1,};/', '', strip_tags($produto->descricao)),
            '100', array('exact' => false)
        );
        echo $this->Html->tag(
            'p', nl2br($produto->descricao), array(
                'class' => 'resumo'
            )
        );
    echo '</div>';
echo '</div>';
?>