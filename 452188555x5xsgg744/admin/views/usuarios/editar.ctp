<div class="span16">
    <?php
    echo $this->TbForm->create('Usuario');
        echo $this->TbForm->input('nome', array(
            'label' => 'Nome de Usuário',
            'class' => 'xlarge',
        ));

        echo $this->TbForm->input('senha', array(
            'label' => 'Senha',
            'class' => 'xlarge',
            'type' => 'password',
        ));

        echo $this->TbForm->input('senha_verify', array(
            'label' => 'Verificação de Senha',
            'class' => 'xlarge',
            'type' => 'password',
        ));

        echo '<div class="actions">';
            echo $this->Html->link('voltar', array('action' => 'index'), array('class' => 'btn'));

            echo '&nbsp;&nbsp;';

            $textoBotao = isset($this->data['Usuario']['id']) ? 'Salvar' : 'Adicionar';

            echo $this->AdminHelper->submitButton($textoBotao, 'primary');
        echo '</div>';
    echo $this->TbForm->end();
    ?>
</div>