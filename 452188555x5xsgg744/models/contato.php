<?php
class Contato extends AppModel {
    public $name = 'Contato';
    public $useTable = false;

    public $_schema = array(
        'nome'      => array('type'=>'string', 'length'=>100),
        'email'     => array('type'=>'string', 'length'=>255),
        'telefone'  => array('type'=>'string', 'length'=>255),
        'mensagem'   => array('type'=>'text'),
    );

    public $validate = array(
        'name' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo deve ser preenchido',
        ),
        'email' => array(
            'rule' => 'email',
            'message' => 'O email deve ser válido',
        ),
        'mensagem' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo deve ser preenchido',
        ),
    );
}
?>