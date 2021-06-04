<div class="span11">
    <h3>Nova Opção</h3>
    
    <div id="lista-opcoes">
    <?php
    echo $this->element('opcoes/form', array(
        'tipos_opcao_id' => $this->data['TiposOpcao']['id'],
    ));
    
    foreach ($this->data['Opcao'] as $id => $item):
        echo $this->element('opcoes/form', array(
            'item' => $item,
            'tipos_opcao_id' => $this->data['TiposOpcao']['id'],
        ));
    endforeach;
    ?>
    </div>
</div>

<div id="sidebar" class="span4">
    <h3>Editar propriedade variável</h3>
    <?php echo $this->element('tipos_opcoes/form'); ?>
</div>