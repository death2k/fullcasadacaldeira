<?php
$mensagemExcluir = 'Você tem certeza? Todos os registros relacionados a esta propriedade também serão deletados.';
echo $this->Form->create('TiposOpcao', array(
    'url' => array('action' => 'excluir'),
    'class' => 'form-stacked',
));
?>
    <table class="zebra-striped">
        <thead>
            <tr>
                <th width="10"><input type="checkbox" class="checkbox toggle" /></th>
                <th width="30">ID</th>
                <th>Nome</th>
                <th width="100" align="center">Exibir Imagem?</th>
                <th width="100">Ações</th>
            </tr>
        </thead>

        <tbody>
        <?php
        foreach ($data as $id => $item):
            echo $this->element('tipos_opcoes/item', array(
                'id' => $id,
                'item' => $item,
                'mensagemExcluir' => $mensagemExcluir,
            ));
        endforeach;
        ?>
        </tbody>
    </table>

<?php
    echo '<div class="actions">';
        $this->AdminHelper->excluirSelecionadosButton($mensagemExcluir);
    echo '</div>';
echo $this->Form->end();
?>