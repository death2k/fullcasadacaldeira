<tr class="<?= ($x%2 == 0) ? 'odd' : 'even' ?>">
    <td><input type="checkbox" class="checkbox" name="data[Destaque][ids][]" value="<?php echo $item['Destaque']['id'] ?>" /></td>
    <td><?php echo $item['Destaque']['id'] ?></td>

    <td><?php echo $item['DestaquesSecao']['titulo']; ?></td>
    <td><?php echo $item['Produto']['titulo']; ?></td>

    <td>
        <?php
        echo $this->Html->link(
            'editar',
            array('controller' => 'destaques', 'action' => 'editar', $item['Destaque']['id']),
            array('class' => 'label')
        );

        echo $this->Html->link(
            'excluir',
            array('controller' => 'destaques', 'action' => 'excluir', $item['Destaque']['id']),
            array('class' => 'label important'),
            $mensagemExcluir
        );
        ?>
    </td>
</tr>