<table border="1" cellspacing="1" cellpadding="5">
    <thead>
        <tr>
            <th>#</th>
            <th>Produto</th>
            <th>Quant.</th>
        </tr>
    </thead>

    <tbody>
        <?php
        foreach ($carrinho as $item):
            $variacao = $item['produto']['Variacao'][0];
            $tipos_opcao = $variacao->tipos_opcoes[0];
        ?>
            <tr>
                <td><?php echo $variacao->codigo; ?></td>

                <td>
                <?php
                    echo $this->Html->tag(
                        'p',
                        $item['produto']['Produto']['titulo'],
                        array('class' => 'titulo')
                    );

                    echo $this->Html->tag(
                        'p',
                        'Categoria: ' . 
                        $this->Categorias->getPath(
                            $item['produto']['Produto']['categoria_id'], false
                        )
                    );

                    echo '<p class="variacao">';
                        echo "{$tipos_opcao->nome}: {$tipos_opcao->opcao->nome};";
                    echo '</p>';
                ?>
                </td>

                <td align="center"><?php echo $item['quantidade']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>