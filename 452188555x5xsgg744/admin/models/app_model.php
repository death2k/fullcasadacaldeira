<?php
class AppModel extends Model {
    public $cacheQueries = true;

    public $estadosBrasil = array(
        'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
        'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo', 'GO' => 'Goiás', 'MA' => 'Maranhão',
        'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba',
        'PR' => 'Paraná', 'PE' => 'Pernambuco', 'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima',
        'SC' => 'Catarina', 'SP' => 'São Paulo', 'SE' => 'Sergipe',
        'TO' => 'Tocantins', 'EX' => 'Exterior'
    );

    public function validateEstadoBrasil($data) {
        $estado = array_shift($data);
        return in_array($estado, array_keys($this->estadosBrasil));
    }




    /*
     * Protected methods
    */
    protected function limparDinheiro($dinheiro) {
        $dinheiro = str_replace('R$ ', '', $dinheiro);
        $dinheiro = str_replace(',', '.', str_replace('.', '', $dinheiro));

        return ($dinheiro == 0) ? null : $dinheiro;
    }
    protected function formatarDinheiro($dinheiro) {
        return number_format($dinheiro, '2', ',', '.');
    }

    protected function limparFloat($string) {
        return str_replace(',', '.', $string);
    }
    protected function formatarFloat($float) {
        return str_replace('.', ',', $float);
    }
}