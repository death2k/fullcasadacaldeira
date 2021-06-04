<?php
class Imagem extends AppModel {

    public $order = 'Imagem.id DESC';
    
    public $actsAs = array(
        'MeioUpload' => array(
            'nome_arquivo' => array(
                'dir' => UPLOADS_PATH_PRODUTOS,
                'uploadName' => 'image_name',
                'zoomCrop' => true,
                'thumbsizes' => array(
                    'small' => array('width' => 50, 'height' => 50),
                    'medium' => array('width' => 280, 'height' => 280),
                    'destaque' => array('width' => 180, 'height' => 135),
                ),
            )
        )
    );
}
?>