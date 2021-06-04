<?php
echo $this->Form->create('Produto', array(
    'class' => 'form-grid',
    'inputDefaults' => array(
        'div' => array(
            'class' => 'clearfix'
        ),
        'error' => array(
            'wrap' => 'span',
            'class' => 'help-inline',
        ),
        'between' => '<div class="input">',
        'after' => '</div>',
        'format' => array(
            'before', 'label', 'between', 'input', 'error', 'after'
        ),
    ),
));
    
    echo '<div class="actions-header">';
        if(isset($this->data['Produto']['id'])):
            //PARTE 1
            echo $this->Html->link(
                'PARTE 1',
                array('controller' => 'produtos', 'action' => 'editar', $produto_id),
                array('class' => 'btn disabled')
            );

            //PARTE 2
            echo $this->Html->link(
                'PARTE 2',
                array('controller' => 'variacoes', 'action' => 'index', $this->data['Produto']['id']),
                array('class' => 'btn primary')
            );
        endif;
    echo '</div>';


    echo $this->Form->input('titulo', array(
        'label' => 'Título',
        'class' => 'xxlarge',
    ));

    echo $this->Form->input('categoria_id', array(
        'label' => 'Categoria',
        'empty' => 'Selecione',
        'class' => 'xlarge',
        'escape' => false,
    ));

    echo $this->Form->input('marca_id', array(
        'label' => 'Marca',
        'empty' => 'Selecione',
        'class' => 'large',
    ));

    echo $this->Form->input('descricao', array(
        'label' => 'Descrição',
        'rows' => '13',
        'class' => 'xxlarge',
    ));

    echo $this->Form->input('descricao_seo', array(
        'label' => 'Descrição SEO',
        'rows' => '2',
        'class' => 'xxlarge',
    ));

    $inputs = '<label>Opções</label>';
    $inputs .= '<div class="input">';
        $inputs .= '<div class="inline-inputs">';
            $inputs .= 'Destaque? ';
            $inputs .= $this->Form->input('destaque', array(
                'label' => false, 'div' => false,
                'between' => false, 'after' => false,
            ));

            $inputs .= '&nbsp;&nbsp;&nbsp;Lançamento? ';
            $inputs .= $this->Form->input('lancamento', array(
                'label' => false, 'div' => false,
                'between' => false, 'after' => false,
            ));

            $statusCheckboxOptions = array(
                'label' => false, 'div' => false,
                'between' => false, 'after' => false,
            );
            if( !isset($this->data['Produto']['id'])
                || $this->data['Produto']['status'] == 1 ){
                $statusCheckboxOptions['checked'] = true;
            }

            $inputs .= '&nbsp;&nbsp;&nbsp;Ativo? ';
            $inputs .= $this->Form->input('status', $statusCheckboxOptions);

            $inputs .= '&nbsp;&nbsp;&nbsp;Página Inicial? ';
            $inputs .= $this->Form->input('pagina_inicial', array(
                'label' => false, 'div' => false,
                'between' => false, 'after' => false,
            ));
        $inputs .= '</div>';
    $inputs .= '<br /><br /></div>';

    echo $this->Html->tag('div', $inputs, array(
        'class' => 'clexfix',
    ));
    ?>

    <div class="actions">
        <?php
        echo $this->Html->link(
            'Voltar',
            'javascript: history.go(-1)',
            array('class' => 'btn')
        );

        echo '&nbsp;&nbsp;';

        echo '<button class="btn primary" type="submit">Salvar</button>';
        ?>
    </div>
<?php echo $this->Form->end() ?>