<div class="span10">
<?php
echo $this->Session->flash();
echo $this->Session->flash('auth');

echo $this->TbForm->create('Usuario', array(
    'class' => 'form-stacked'
));

    echo '<div class="align-inputs">';
        echo $this->TbForm->input('nome', array(
            'class' => 'span7'
        ));
        
        echo $this->TbForm->input('senha', array(
            'class' => 'span7',
            'type' => 'password',
        ));
    echo '</div>';

    echo '<div class="actions">';
        echo $this->Html->link('voltar para o site', '/');
        echo '&nbsp;&nbsp;ou&nbsp;&nbsp;';
        echo $this->AdminHelper->submitButton('Entrar', 'primary');
    echo '</div>';

echo $this->TbForm->end();
?>
</div>