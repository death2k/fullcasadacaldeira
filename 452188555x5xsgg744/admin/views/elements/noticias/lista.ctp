<?php
$mensagemExcluir = 'Deseja realmente excluir esta notícia?';
echo $this->Form->create('Noticia', array(
    'action' => 'excluir',
    'class' => 'form-stacked',
));
?>
    <table class="zebra-striped">
        <thead>
            <tr>
                <th width="10"><input type="checkbox" class="checkbox toggle" /></th>
                <th width="30">ID</th>
                <th width="80">Miniatura</th>
                <th>Título</th>
                <th width="60">Status</th>
                <th width="100">&nbsp;</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $x = 0;
        foreach ($noticias as $item):
            echo $this->element('noticias/item', array(
                'item' => $item,
                'x' => $x,
                'mensagemExcluir' => $mensagemExcluir,
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