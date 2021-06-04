<?php
$this->additional_styles = array('mapa-brasil');

echo '<h2 class="titulo">Representantes</h2>';

echo '<ul id="mapa-brasil">';
    $estados = array(
        'RS' => 'Rio Grande do Sul', 'SC' => 'Santa Catarina', 'PR' => 'Paraná',
        'SP' => 'São Paulo', 'MS' => 'Mato Grosso do Sul', 'RJ' => 'Rio de Janeiro',
        'ES' => 'Espírito Santo', 'MG' => 'Minas Gerais', 'GO' => 'Goiás',
        'BA' => 'Bahia', 'MT' => 'Mato Grosso', 'RO' => 'Rondônia', 'AC' => 'Acre',
        'AM' => 'Amazonas', 'RR' => 'Roraima', 'PA' => 'Pará', 'AP' => 'Amapá',
        'MA' => 'Maranhão', 'TO' => 'Tocantins', 'SE' => 'Sergipe', 'AL' => 'Alagoas',
        'PE' => 'Pernambuco', 'PB' => 'Paraíba', 'RN' => 'Rio Grande do Norte',
        'CE' => 'Ceará', 'PI' => 'Piauí', /*'DF' => 'Distrito Federal',*/
    );

    $estadosAtivos = array('PR', 'RS', 'RJ', 'RS', 'MT', 'MS', 'MG', 'SC', 'GO');

    foreach ($estados AS $sigla => $estado):
        $actived = in_array($sigla, $estadosAtivos) ? ' actived' : '';
        echo $this->Html->tag(
            'li',
            $this->Html->link(
                $this->Html->image('mapa-brasil/null.gif', array('alt' => $estado)),
                '#',
                array(
                    'title' => "{$sigla} - {$estado}",
                    'escape' => false,
                )
            ),
            array('class' => strtolower($sigla) . $actived)
        );
    endforeach;
echo '</ul>';
?>

<div class="representante">
    <h3>JM Representações</h3>
    <ul>
        <li>Telefone: <strong>41 9908-2223</strong></li>
        <li>Email: <a href="mailto:ismaelmattos@ig.com.br" title="ismaelmattos@ig.com.br">ismaelmattos@ig.com.br</a></li>
    </ul>
</div>