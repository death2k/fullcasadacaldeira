<ul id="categorias">
    <?php
    foreach ($categorias as $index => $item):
        $categoria = (object) $item['Categoria'];
        $childrens = $item['children'];

        echo $this->element('categorias/item', array(
            'index' => $index,
            'categoria' => $categoria,
            'childrens' => $childrens,
        ));
    endforeach;
    ?>
</ul>