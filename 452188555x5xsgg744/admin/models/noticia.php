<?php
class Noticia extends AppModel {
    public $displayField = 'titulo';
    public $order = 'id DESC';

    public $actsAs = array(
        'MeioUpload' => array(
            'miniatura' => array(
                'dir' => UPLOADS_PATH_NOTICIAS,
                'zoomCrop' => true,
                'thumbsizes' => array(
                    'medium' => array('width' => 300, 'height' => 300),
                    'small' => array('width' => 100, 'height' => 75, 'zoomCrop' => true),
                ),
            )
        )
    );
    
    public $validate = array(
        'titulo' => array(
            array(
                'required' => true,
                'rule' => 'notEmpty',
                'message' => 'O título deve ser preenchido'
            )
        )
    );


    public function getNoticiasAtivas($options = array()) {
        $options['conditions']['status'] = '1';
        return $this->find('all', $options);
    }
}