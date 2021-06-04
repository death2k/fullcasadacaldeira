<div class="produtos-home produtos">
	<h2><span>Produtos em Destaque</span></h2>

    <?php
    foreach ($produtos as $index => $produto):
        echo $this->element('produtos/item', array(
            'produto' => $produto,
            'index' => $index,
            'home' => true,
        ));
    endforeach;
    ?>
</div>