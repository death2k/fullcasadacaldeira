<?php
class Opcao extends AppModel {
    public $displayField = 'nome';
    
    public $belongsTo = array('TiposOpcao');

    public $actsAs = array(
        'MeioUpload' => array(
            'imagem' => array(
                'dir' => UPLOADS_PATH_PROP_VAR,
            )
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
}