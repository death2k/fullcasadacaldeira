<?php
echo '<div id="imagens">';
    foreach ($imagens as $index => $imagem):
        $imagem = (object) $imagem['Imagem'];

        echo '<div class="imagem">';
            echo "<a href=\"{$uploadsPaths->produtos}{$imagem->nome_arquivo}\" class=\"imagemLink fancybox\">";
                echo "<img src=\"{$uploadsPaths->produtos}thumb/small/{$imagem->nome_arquivo}\" />";
            echo "</a>";

            if (isset($this->params['named']['variacao'])):
                echo $this->Html->link(
                    'excluir',
                    array(
                        'controller' => 'imagens',
                        'action' => 'excluir',
                        $produto_id,
                        $imagem->id,
                        'variacao' => $this->params['named']['variacao'],
                    ),
                    array('class' => 'label important excluirImagem'),
                    'Deseja realmente excluir esta imagem?'
                );
            else:
                echo $this->Html->link(
                    'excluir',
                    array('controller' => 'imagens', 'action' => 'excluir', $produto_id, $imagem->id),
                    array('class' => 'label important excluirImagem'),
                    'Deseja realmente excluir esta imagem?'
                );
            endif;
        echo '</div>';

        //echo (($index+1)%4 == 0) ? '<div class="fix-float"></div>' : '';
    endforeach;
echo '</div>';
?>