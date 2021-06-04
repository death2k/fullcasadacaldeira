<div id="IndicarProdutoWrapper">
    <p>
        Envie este produto para um amigo,
        <br />
        preencha seus nomes e emails e clique em enviar.
    </p>
<?php
echo $this->Form->create('IndicarProduto', array(
    'url' => array(
        'controller' => 'produtos',
        'action' => 'indicar',
        'produto' => $produto_id,
        'variacao' => $variacao_id,
    ),
    'id' => 'IndicarProdutoForm',
    'class' => 'pretty',
));
    echo $this->Form->input('nome', array(
        'label' => 'Seu Nome <span class="required">*</span>',
        'size' => '30',
    ));

    echo $this->Form->input('email', array(
        'label' => 'Seu Email <span class="required">*</span>',
        'size' => '30',
    ));

    echo $this->Form->input('nomeAmigo', array(
        'label' => 'Nome do Amigo <span class="required">*</span>',
        'size' => '30',
    ));

    echo $this->Form->input('emailAmigo', array(
        'label' => 'Email do Amigo <span class="required">*</span>',
        'size' => '30',
    ));

    echo '<div class="actions">';
        echo $this->Form->submit('Enviar');
    echo '</div>';
echo $this->Form->end();
?>
</div>