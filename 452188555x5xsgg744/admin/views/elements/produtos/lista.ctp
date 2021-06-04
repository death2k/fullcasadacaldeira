<?php
$mensagemExcluir = 'Deseja realmente excluir este arquivo?';
echo $this->Form->create('Produto', array(
    'action' => 'excluir',
    'class' => 'form-stacked',
));
?>
    <table class="zebra-striped">
        <thead>
            <tr>
                <th width="10"><input type="checkbox" class="checkbox toggle" /></th>
                <th width="30">ID</th>
                <th>Título</th>
                <th width="150">Categoria</th>
                <th width="130">Marca</th>
                <th width="100" align="right">&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($data as $index => $item):
                echo $this->element('produtos/item', array(
                    'index' => $index,
                    'item' => $item,
                    'mensagemExcluir' => $mensagemExcluir,
                ));
            endforeach;
            ?>
        </tbody>
    </table>

<?php
    echo $this->element('pagination');

    echo '<div class="actions">';
        $this->AdminHelper->excluirSelecionadosButton($mensagemExcluir);
    echo '</div>';
echo $this->Form->end();
?>