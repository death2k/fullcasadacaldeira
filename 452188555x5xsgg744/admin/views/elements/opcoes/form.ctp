<?php
if(isset($item) && !empty($item)):
    $data = $item;
    $submitButton = 'Salvar';
else:
    $data = array('id' => '', 'nome' => '', 'imagem' => '');
    $submitButton = 'Criar';
endif;

$class = '';
if (empty($data['id'])):
    $class = 'novo';
endif;

echo $this->TbForm->create('Opcao', array(
	'id' => false,
	'url' => array('action' => 'salvar'),
    'class' => $class,
	'type' => 'file',
));
    

    if (!empty($data['id'])):
        echo $this->TbForm->hidden('id', array(
            'value' => $data['id'],
        ));
    endif;


    echo $this->TbForm->hidden('tipos_opcao_id', array(
        'value' => $tipos_opcao_id,
    ));

    
    $opcoesInput = array(
        'label' => 'Nome',
        'value' => $data['nome'],
    );
    if(empty($data['id'])) $opcoesInput['autofocus'] = '';
    echo $this->TbForm->input('nome', $opcoesInput);

    
    if (!empty($data['imagem'])):
        echo "<img src=\"{$uploadsPaths->propVar}" . $data['imagem'] . "\" class=\"imagem\" />";
    endif;
    echo $this->TbForm->input('imagem', array(
        'label' => 'Imagem',
        'value' => $data['imagem'],
        'type' => 'file',
    ));


    echo $this->AdminHelper->submitButton($submitButton, 'small primary');


    if (!empty($data['id'])):
        echo $this->Html->link(
            'x',
            array(
                'controller' => 'opcoes',
                'action' => 'excluir',
                $item['id'],
                $item['tipos_opcao_id'],
            ),
            array('class' => 'label important destroy-item'),
            'Tem certeza? Esta ação irá excluir também todos os ítens associados a este opção.'
        );
    endif;
echo $this->Form->end();