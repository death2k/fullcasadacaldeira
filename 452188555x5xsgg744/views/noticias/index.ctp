<h2 class="titulo"><?php echo $title_for_layout; ?></h2>

<?php
echo '<div class="noticias">';
    foreach ($noticias as $noticia):
        echo $this->element('noticias/item', array('noticia' => $noticia, 'interno' => true));
    endforeach;
echo '</div>';
?>