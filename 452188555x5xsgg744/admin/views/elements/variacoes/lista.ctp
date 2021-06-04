<?php
$mensagemExcluir = 'Deseja realmente excluir esta variação?';
echo $this->Form->create('Variacao', array(
    'url' => array(
        'controller' => 'variacoes',
        'action' => 'excluir',
        $produto_id,
    ),
    'class' => 'form-stacked',
));
?>
    <table class="zebra-striped">
        <thead>
            <tr>
                <th width="10"><input type="checkbox" class="checkbox toggle" /></th>
                <th width="30">ID</th>
                <th>Propriedades</th>
                <th width="10">&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($variacoes as $index => $item): ?>
            <tr class="<?= ($index%2 == 0) ? 'odd' : 'even' ?>">
                <td><input type="checkbox" class="checkbox" name="data[Variacao][ids][]" value="<?= $item['Variacao']['id'] ?>" /></td>
                <td><?php echo $item['Variacao']['id'] ?></td>
                <td>
                    <?php
                    $separador = ';&nbsp;&nbsp;&nbsp;';

                    foreach($tiposOpcoes AS $tiposOpcao):
                        foreach($item['OpcoesVariacao'] AS $opcaoVariacao):
                            if(
                                $opcaoVariacao['tipos_opcao_id']
                                == $tiposOpcao['TiposOpcao']['id']
                            ):
                                echo $tiposOpcao['TiposOpcao']['nome'] . ': ';

                                echo $this->Html->tag(
                                    'strong',
                                    $tiposOpcao['Opcao'][$opcaoVariacao['opcao_id']]
                                );

                                echo $separador;
                            endif;
                        endforeach;
                    endforeach;

                    if(!empty($item['Variacao']['codigo'])):
                        echo 'Código: ';
                        echo $this->Html->tag('strong', $item['Variacao']['codigo']);
                        echo $separador;
                    endif;
                    ?>
                </td>
                <td  align="right">
                    <?php
                    echo $this->Html->link(
                        'editar',
                        array(
                            'controller' => 'variacoes',
                            'action' => 'editar',
                            $produto_id,
                            $item['Variacao']['id'],
                        ),
                        array(
                            'class' => 'label',
                        )
                    );

                    echo $this->Html->link(
                        'excluir',
                        array(
                            'controller' => 'variacoes',
                            'action' => 'excluir',
                            $produto_id,
                            $item['Variacao']['id'],
                        ),
                        array(
                            'class' => 'label important'
                        ),
                        $mensagemExcluir
                    );
                    ?>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <div class="actions">
        <input type="submit"
               class="btn danger"
               value="Excluir Selecionados"
               onclick="javascript:return confirm('<?php echo $mensagemExcluir; ?>');" />
        
        <?php
        //VARIAÇÃO
        if (!empty($produtosTiposOpcoes)):
            echo $this->Html->link(
                'Adicionar Variação',
                array('controller' => 'variacoes', 'action' => 'adicionar', $produto_id),
                array('class' => 'btn success', 'style' => 'float:right;')
            );
        endif;
        ?>
    </div>
<?php echo $this->Form->end(); ?>