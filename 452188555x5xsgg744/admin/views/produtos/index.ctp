<div class="span16">
<?php
echo $this->Form->create('ProdutoSearch', array(
    'url' => array('controller' => 'produtos', 'action' => 'index'),
    'class' => 'form-stacked filterForm',
));
	echo $this->Form->input('codigo', array(
		'label' => 'Código',
		'class' => 'small',
	));

	echo $this->Form->input('titulo', array(
		'label' => 'Título',
	));

	echo $this->Form->input('categoria_id', array(
        'label' => 'Categoria',
        'empty' => 'Selecione',
        'class' => 'medium',
        'escape' => false,
    ));

	echo $this->Form->input('pagina_inicial', array(
		'type' => 'select',
		'label' => 'Página Inicial',
		'options' => array(1 => 'Sim', 0 => 'Não'),
		'empty' => 'Selecione',
		'class' => 'small',
	));

	echo $this->Form->input('status', array(
		'type' => 'select',
		'label' => 'Ativos',
		'options' => array(1 => 'Sim', 0 => 'Não'),
		'empty' => 'Selecione',
		'class' => 'small',
	));

	echo '<button class="btn primary" type="submit">Filtrar</button>';

	if(!empty($this->data['ProdutoSearch'])):
		echo $this->Html->link(
	        'Limpar',
	        array('controller' => 'produtos', 'action' => 'index'),
	        array('class' => 'btn small')
	    );
    endif;
echo $this->Form->end();


if(!empty($data)):
    echo $this->element('produtos/lista');
else:
    echo $this->Html->tag(
        'p', 'Nenhum produto cadastrado até o momento.', array(
            'class' => 'sem-registros'
        )
    );
endif;
?>
</div>