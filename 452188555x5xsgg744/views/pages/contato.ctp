<h2 class="titulo">Contato</h2>

<?php
echo $this->Session->flash();

echo $this->Form->create('Contato', array(
    'url' => '/contato',
    'class' => 'pretty',
    'id' => 'contato-form'
));
    echo $this->Form->inputs(array(
        'legend' => false,
        'fieldset' => false,
        
        'nome' => array(
            'label' => 'Nome <span class="required">*</span>',
            'size' => '40',
        ),

        'email' => array(
            'label' => 'Email <span class="required">*</span>',
            'size' => '40',
        ),

        'telefone' => array(
            'label' => 'Telefone',
            'size' => '15',
        ),

        'mensagem' => array(
            'label' => 'Mensagem <span class="required">*</span>',
            'type' => 'textarea',
            'cols' => '66', 'rows' => '9',
        )
    ));

    echo $this->Html->tag(
        'p',
        'Os campos com (*) são obrigatórios.',
        array('class' => 'infos')
    );
echo $this->Form->end('Enviar Mensagem');
?>