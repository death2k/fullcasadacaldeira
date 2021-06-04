<h2 class="titulo"><?php echo $data->titulo ?></h2>

<?php
echo $this->Html->link(
    $this->Html->image("uploads/noticias/thumb/medium/{$data->miniatura}"),
    "/img/uploads/noticias/{$data->miniatura}",
    array('class' => 'alignRight', 'escape' => false)
);

echo $this->Html->tag(
    'div', $data->conteudo,
    array(
        'class' => 'conteudo'
    )
);
?>