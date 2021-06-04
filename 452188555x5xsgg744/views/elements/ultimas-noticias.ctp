<h2>Notícias</h2>

<?php
if (!isset($sidebar)) $sidebar = false;

foreach ($ultimasNoticias as $noticia):
    echo $this->element('noticias/item', array('noticia' => $noticia, 'sidebar' => $sidebar));
endforeach;
?>