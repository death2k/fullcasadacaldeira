<div class="span16">
<?php
echo $this->TbForm->create('Noticia', array(
    'type' => 'file',
    'url' => array('action' => 'salvar'),
    'class' => 'com-miniatura',
));
    
    if(
        isset($this->data['Noticia']['miniatura'])
        && !empty($this->data['Noticia']['miniatura'])
    ):
        $miniatura = $this->data['Noticia']['miniatura'];

        echo '<div class="media-grid miniatura-lateral-direita">';
            echo '<label>Miniatura: </label>';
            echo "<a href=\"{$uploadsPaths->noticias}thumb/medium/{$miniatura}\" class=\"imagemLink fancybox\">";
                echo "<img src=\"{$uploadsPaths->noticias}thumb/small/{$miniatura}\" class=\"fancybox\" />";
            echo "</a>";
        echo '</div>';
    endif;

    echo $this->TbForm->input('titulo', array(
        'label' => 'Título',
        'class' => 'xxlarge',
    ));


    $miniaturaHelp = $this->Html->tag(
        'span',
        'Para não alterar a imagem, não selecione nada.',
        array('class' => 'help-block')
    );
    echo $this->TbForm->input('miniatura', array(
        'label' => 'Miniatura',
        'type' => 'file',
        'class' => 'large',
        'after' => "{$miniaturaHelp}</div>",
    ));

    echo $this->TbForm->input('status', array(
        'label' => 'Ativo?',
        'default' => true,
    ));

    echo $this->TbForm->input('conteudo', array(
        'label' => 'Conteúdo',
        'class' => 'ckeditor',
        'rows' => '15',
    ));

    echo '<div class="actions">';
        echo $this->Html->link(
            'voltar',
            array('action' => 'index'),
            array('class' => 'btn')
        );

        echo '&nbsp;&nbsp;';

        $textoBotao = isset($this->data['Noticia']['id']) ? 'Salvar' : 'Adicionar';

        echo $this->AdminHelper->submitButton($textoBotao, 'primary');
    echo '</div>';
echo $this->TbForm->end();
?>
</div>