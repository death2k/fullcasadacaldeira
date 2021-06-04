<?php
$mensagemExcluir = 'Deseja realmente excluir esta marca?';
echo $this->TbForm->create('Marca', array(
    'action' => 'excluir',
    'class' => 'form-stacked',
));
?>
    <table class="zebra-striped">
        <thead>
            <tr>
                <th width="10"><input type="checkbox" class="checkbox toggle" /></th>
                <th width="30">ID</th>
                <th>Nome</th>
                <th>Logo</th>
                <th width="100">&nbsp;</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $x = 0;
        foreach ($marcas as $id => $item):
            echo $this->element('marcas/item', array(
                'id' => $id,
                'item' => $item,
                'mensagemExcluir' => $mensagemExcluir,
                'x' => $x,
            ));
            $x++;
        endforeach
        ?>
        </tbody>
    </table>
    
<?php
    echo '<div class="actions">';
        $this->AdminHelper->excluirSelecionadosButton($mensagemExcluir);
    echo '</div>';
echo $this->Form->end();
?>