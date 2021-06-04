<tr class="<?= ($x%2 == 0) ? 'odd' : 'even' ?>">
    <td><input type="checkbox" class="checkbox" name="data[Marca][ids][]" value="<?php echo $item['Marca']['id'] ?>" /></td>
    <td><?php echo $item['Marca']['id'] ?></td>

    <td>
        <?php
        if (!empty($item['Marca']['url'])):
            echo $this->Html->link(
                $item['Marca']['nome'],
                $item['Marca']['url'],
                array(
                    'title' => 'Ir para: "' . $item['Marca']['url'] . '"',
                )
            );
        else:
            echo $item['Marca']['nome'];
        endif;
        ?>
    </td>

    <td>
        <?php
        if (!empty($item['Marca']['logo'])):
            echo "<img src=\"{$uploadsPaths->marcas}thumb/small/" . $item['Marca']['logo'] . "\" />";
        endif;
        ?>
    </td>

    <td>
        <?php
        echo $this->Html->link(
            'editar',
            array('controller' => 'marcas', 'action' => 'editar', $item['Marca']['id']),
            array('class' => 'label')
        );

        echo $this->Html->link(
            'excluir',
            array('controller' => 'marcas', 'action' => 'excluir', $item['Marca']['id']),
            array('class' => 'label important'),
            $mensagemExcluir
        );
        ?>
    </td>
</tr>