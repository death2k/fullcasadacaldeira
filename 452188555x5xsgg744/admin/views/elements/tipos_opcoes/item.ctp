<tr>
    <td>
        <input type="checkbox"
               class="checkbox"
               name="data[TiposOpcao][ids][]"
               value="<?php echo $item['TiposOpcao']['id'] ?>" />
    </td>

    <td><?php echo $item['TiposOpcao']['id'] ?></td>

    <td>
    <?php
    echo $item['TiposOpcao']['nome'];
    if(!empty($item['Opcao'])):
        echo ' (';
            $last = count($item['Opcao']);
            foreach ($item['Opcao'] as $index => $opcao):
                echo $opcao['nome'];
                echo (($index+1) < $last) ? ', ' : '';
            endforeach;
        echo ')';
    endif;
    ?>
    </td>

    <td>
    <?php
        echo $item['TiposOpcao']['imagem'] ? 'Sim' : 'Não';
    ?>
    </td>

    <td class="last">
        <?php
        echo $this->Html->link(
            'editar',
            array(
                'action' => 'editar',
                $item['TiposOpcao']['id'],
            ),
            array(
                'class' => 'label',
            )
        );

        echo $this->Html->link(
            'excluir',
            array(
                'action' => 'excluir',
                $item['TiposOpcao']['id'],
            ),
            array(
                'class' => 'label important'
            ),
            $mensagemExcluir
        );
        ?>
    </td>
</tr>