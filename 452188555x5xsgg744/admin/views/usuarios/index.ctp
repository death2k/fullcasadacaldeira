<div class="span16">
    <?php if(!empty($this->data)) { ?>
        <table class="zebra-striped">
            <thead>
                <tr>
                    <th width="2">ID</th>
                    <th>Nome de Usuário</th>
                    <th width="100">&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($this->data as $row):
                    extract($row);
                ?>
                    <tr>
                        <td><?php echo $Usuario['id'] ?></td>

                        <td><?php echo $Usuario['nome'] ?></td>

                        <td>
                            <?php
                            echo $this->Html->link(
                                'editar',
                                array('action' => 'editar', $Usuario['id']),
                                array('class' => 'label')
                            );

                            echo $this->Html->link(
                                'excluir',
                                array('action' => 'excluir', $Usuario['id']),
                                array('class' => 'label important'),
                                'Deseja realmente excluir este usuário?'
                            );
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php } else { ?>
        <?php echo $this->Html->tag('p', 'Nenhum usuário cadastrado até o momento.', array('class' => 'sem-registros')) ?>
    <?php } ?>
</div>