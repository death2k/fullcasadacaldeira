<tr class="<?= ($index%2 == 0) ? 'odd' : 'even' ?>">
    <td><input type="checkbox" class="checkbox" name="data[Produto][ids][]" value="<?= $item['Produto']['id'] ?>" /></td>
    <td><?php echo $item['Produto']['id'] ?></td>
    <td><?php echo $item['Produto']['titulo'] ?></td>
    <td><?php echo $item['Categoria']['titulo'] ?></td>
    <td><?php echo $item['Marca']['nome'] ?></td>
    <td  align="right">
        <?php
        echo $this->Html->link(
            'editar',
            array(
                'controller' => 'produtos',
                'action' => 'editar',
                $item['Produto']['id'],
            ),
            array(
                'class' => 'label',
            )
        );

        echo $this->Html->link(
            'excluir',
            array(
                'controller' => 'produtos',
                'action' => 'excluir',
                $item['Produto']['id'],
            ),
            array(
                'class' => 'label important'
            ),
            $mensagemExcluir
        );
        ?>
    </td>
</tr>