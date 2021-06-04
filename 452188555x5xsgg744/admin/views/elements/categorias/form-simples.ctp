<h3>Categoria Principal</h3>

<?php
echo $this->TbForm->create('Categoria', array(
    'url' => array('action' => 'salvar'),
    'class' => 'form-stacked',
));
    echo $this->TbForm->input('titulo', array(
        'label' => 'Título',
        'class' => 'large',
    ));

    echo '<div class="actions">';
        $textoBotao = isset($this->data['Categoria']['id']) ? 'Salvar' : 'Adicionar';

        echo $this->AdminHelper->submitButton($textoBotao, 'primary');
    echo '</div>';
echo $this->TbForm->end();
?>