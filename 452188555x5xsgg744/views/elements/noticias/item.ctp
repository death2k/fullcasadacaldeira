<?php
$noticia = (object) $noticia['Noticia'];

$link = array(
    'controller' => 'noticias',
    'action' => 'visualizar',
    $noticia->id,
);

$noticia->resumo = $this->Text->truncate(
    preg_replace('/&[a-z]{1,};/', '', strip_tags($noticia->conteudo)),
    '100', array('exact' => false)
);

echo '<div class="noticia">';
    if (isset($interno) && $interno):
        echo $this->Html->link(
            $this->Html->image("uploads/noticias/thumb/small/{$noticia->miniatura}"),
            $link,
            array(
                'class' => 'imagem',
                'escape' => false,
                'title' => $noticia->titulo,
            )
        );
    endif;
    
    echo $this->Html->tag(
        'h3',
        $this->Html->link(
            $noticia->titulo,
            $link,
            array('title' => $noticia->titulo)
        )
    );

    echo $this->Html->tag(
        'p',
        $this->Time->format('d/m/Y', $noticia->created),
        array('class' => 'data')
    );

    if (isset($interno) && $interno):
        echo $this->Html->tag(
            'p',
            $this->Html->link(
                $noticia->resumo,
                $link,
                array('title' => $noticia->titulo)
            ),
            array('class' => 'resumo')
        );
    endif;
echo '</div>';
?>