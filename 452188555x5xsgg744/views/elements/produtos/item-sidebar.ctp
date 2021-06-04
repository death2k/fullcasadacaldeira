<?php
if(isset($produto['Variacao'][0]->imagens[0]))
    $imagem = $produto['Variacao'][0]->imagens[0];

$produto = (object) $produto['Produto'];

$link = array(
    'controller' => 'produtos',
    'action' => 'visualizar',
    $produto->id,
);

$titulo = "Produto &ldquo;{$produto->titulo}&rdquo;";

echo '<div class="produto">';
    //Imagem
    if (isset($imagem->id)):
        $imageTag = $this->Html->image(
            'uploads/produtos/thumb/small/' . $imagem->nome_arquivo
        );
    else:
        $imageTag = $this->Html->image('no-photo-135.jpg', array('width' => '135', 'height' => '135'));
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

    //Categoria
    echo $this->Html->tag(
        'div', $this->Categorias->getPath($produto->categoria_id), array(
            'class' => 'categoria'
        )
    );
echo '</div>';
?>