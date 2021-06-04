<?php
class TiposOpcao extends AppModel {
    public $actsAs = array('Containable');

    public $displayField = 'nome';

    public $hasMany = array(
        'Opcao' => array(
            'dependent' => true,
        )
    );
    
    public $validate = array(
        'nome' => array(
            array(
                'required' => true,
                'rule' => 'notEmpty',
                'message' => 'este campo é necessário'
            )
        )
    );


    public function getFormatado() {
        $tiposOpcoes = $this->find('all');

        foreach ($tiposOpcoes as $key => $tiposOpcao):
            $temp = array();
            foreach ($tiposOpcao['Opcao'] as $opcao) {
                $temp[$opcao['id']] = $opcao['nome'];
            }

            $tiposOpcoes[$key]['Opcao'] = $temp;
        endforeach;

        return $tiposOpcoes;
    }


    public function afterFind($resultados) {
        foreach ($resultados as $key => $val) {
            if(!empty($val['Opcao'])):
                $output = ' (';
                    $last = count($val['Opcao']);
                    foreach ($val['Opcao'] as $index => $opcao):
                        $output .= $opcao['nome'];
                        $output .= (($index+1) < $last) ? ', ' : '';
                    endforeach;
                $output .= ')';

                $resultados[$key]['TiposOpcao']['opcoes_formatadas'] = $output;
            endif;
        }

        return $resultados;
    }
}