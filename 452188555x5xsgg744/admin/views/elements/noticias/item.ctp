<tr class="<?php echo ($x%2 == 0) ? 'odd' : 'even' ?>">
    <td><input type="checkbox" class="checkbox" name="data[Noticia][ids][]" value="<?php echo $item['Noticia']['id'] ?>" /></td>
    
    <td><?php echo $item['Noticia']['id'] ?></td>

    <td>
    <?php
    if(isset($item['Noticia']['miniatura'])):
        echo "<img src=\"{$uploadsPaths->noticias}thumb/small/" . $item['Noticia']['miniatura'] . "\" width=\"80\" />";
    endif;
    ?>
    </td>

    <td><?php echo $item['Noticia']['titulo'] ?></td>

    <td>
    <?php
    echo $item['Noticia']['status'] ? 'Ativo' : 'Inativo';
    ?>
    </td>
    
    <td>
        <?php
        echo $this->Html->link(
            'editar',
            array('controller' => 'noticias', 'action' => 'editar', $item['Noticia']['id']),
            array('class' => 'label')
        );

        echo $this->Html->link(
            'excluir',
            array('controller' => 'noticias', 'action' => 'excluir', $item['Noticia']['id']),
            array('class' => 'label important'),
            $mensagemExcluir
        );
        ?>
    </td>
</tr>