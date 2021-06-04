<?php
class Marca extends AppModel {
    public $displayField = 'nome';
    public $order = array('Marca.nome' => 'ASC');

    public $actsAs = array(
        'MeioUpload' => array(
            'logo' => array(
                'dir' => UPLOADS_PATH_MARCAS,
                'zoomCrop' => true,
                'thumbsizes' => array(
                    'small' => array('width' => 130, 'height' => 80)
                ),
            )
        )
    );

    public $validate = array(
        'nome' => array(
            array(
                'required' => true,
                'rule' => 'notEmpty',
                'message' => 'Preencha o campo nome'
            )
        ),
        'logo' => array(
            'Empty' => array('check' => false)
        )
    );
}