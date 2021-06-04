<?php
if (isset($produto['Imagem'][0]->id))
    $imagem = $produto['Imagem'][0];
elseif (isset($produto['Variacao'][0]->imagens[0]))
    $imagem = $produto['Variacao'][0]->imagens[0];

$variacao = $produto['Variacao'][0];
$produto = (object) $produto['Produto'];

$link = array(
    'controller' => 'produtos',
    'action' => 'visualizar',
    $produto->id,
);

$titulo = "Produto &ldquo;{$produto->titulo}&rdquo;";

$bodyClass = (($index+1)%3 == 0) ? 'last' : '';
echo "<div class=\"produto {$bodyClass}\">";
    echo '<div class="wrapper">';

        //Imagem
        if (isset($imagem->id)):
            $imageTag = '<img src="' . Router::url('/uploads/produtos/thumb/destaque/'.$imagem->nome_arquivo) . '" />';
        else:
            $imageTag = $this->Html->image('no-photo-135.jpg');
        endif;
        
        echo $this->Html->link(
            $imageTag,
            $link,
            array(
                'title' => $titulo,
                'class' => 'imagem',
                'escape' => false
            )
        );

        echo $this->Html->tag('h3',
            $this->Html->link(
                $produto->titulo,
                $link,
                array('title' => $titulo)
            )
        );


        echo '<div class="actions">';
            echo $this->Html->link(
                'Cotar',
                array(
                    'controller' => 'carrinho',
                    'action' => 'adicionar',
                    'produto' => $produto->id,
                    'variacao' => $variacao->id,
                ),
                array('title' => 'Cotar', 'class' => 'cotarBtn')
            );

            echo $this->Html->link(
                'Detalhes',
                array(
                    'controller' => 'produtos',
                    'action' => 'visualizar',
                    $produto->id,
                ),
                array('title' => 'Cotar', 'class' => 'detalhesBtn')
            );
        echo '</div>';

        //Categoria
        /*echo $this->Html->tag(
            'div', $this->Categorias->getPath($produto->categoria_id), array(
                'class' => 'categoria'
            )
        );*/

        //Preço
        /*if(
            (!empty($produto->preco)
            || !empty($produto->promocao))
            && isset($home)
        ):
            $precoContent = 'R$ ' . $produto->preco;

            if (!empty($produto->promocao)):
                $precoContent = '<span class="de">R$ ' . $produto->preco . '</span>';
                $precoContent .= '<span class="por">R$ ' . $produto->promocao . '</span>';
            endif;

            echo $this->Html->tag('p', $precoContent, array('class' => 'preco'));

            //Parcelas
            /*$precoParcela = str_replace(',', '.', $produto->preco);
            
            if (!empty($produto->promocao)):
                $precoParcela = str_replace(',', '.', $produto->promocao);                
            endif;

            $precoParcela = $precoParcela / 12;
            $precoParcela = round($precoParcela, 2);
            $precoParcela = number_format($precoParcela, 2, ',', '.');

            echo $this->Html->tag(
                'p',
                "em até 12x s/ juros de<br /><span>R$ {$precoParcela}</span> no cartão",
                array('class' => 'parcelamento')
            );
        endif;*/

    echo '</div>';
echo '</div>';


echo (($index+1)%3 == 0) ? '<div class="fix-float"></div>' : '';
?>