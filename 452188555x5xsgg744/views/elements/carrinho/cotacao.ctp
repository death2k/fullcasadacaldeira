<div id="EnviarCotacaoWrapper">
<?php
echo $this->Form->create('EnviarCotacao', array(
    'url' => array(
        'controller' => 'carrinho',
        'action' => 'enviarCotacao',
    ),
    'id' => 'EnviarCotacaoForm',
    'class' => 'pretty',
));
    
    echo $this->Html->tag('p',
        'Preencha o formulário corretamente para enviar o pedido de cotação.'
    );

    echo $this->Form->input('nome', array(
        'label' => 'Nome <span class="required">*</span>',
        'size' => '30',
    ));

    echo $this->Form->input('email', array(
        'label' => 'Email <span class="required">*</span>',
        'size' => '30',
    ));

    echo $this->Form->input('telefone', array(
        'label' => 'Telefone <span class="required">*</span>',
        'size' => '14',
    ));

    echo $this->Form->input('cidade', array(
        'label' => 'Cidade <span class="required">*</span>',
        'size' => '20',
    ));

    echo $this->Form->input('estado', array(
        'label' => 'Estado <span class="required">*</span>',
        'type' => 'select',
        'options' => array(
            'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
            'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo', 'GO' => 'Goiás', 'MA' => 'Maranhão',
            'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba',
            'PR' => 'Paraná', 'PE' => 'Pernambuco', 'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima',
            'SC' => 'Catarina', 'SP' => 'São Paulo', 'SE' => 'Sergipe',
            'TO' => 'Tocantins',
        )
    ));

    echo $this->Form->input('empresa', array(
        'label' => 'Empresa',
        'size' => '30',
    ));

    echo $this->Form->input('observacoes', array(
        'label' => 'Observações: ',
        'type' => 'textarea',
        'cols' => '43',
        'rows' => '10',
    ));

    echo '<div class="actions">';
        echo $this->Form->submit('Enviar');
    echo '</div>';
echo $this->Form->end();
?>
</div>