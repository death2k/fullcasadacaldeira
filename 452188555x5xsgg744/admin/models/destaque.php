<?php
class Destaque extends AppModel {
    public $displayField = 'produto_id';
    public $order = 'Destaque.destaques_secao_id ASC, Destaque.produto_id DESC';

    public $belongsTo = array(
        'DestaquesSecao', 'Produto'
    );

    public $validate = array(
        'destaques_secao_id' => array(
            array(
                'required' => true,
                'rule' => 'notEmpty',
                'message' => 'Selecione uma seção'
            )
        ),
        'produto_id' => array(
            array(
                'required' => true,
                'rule' => 'notEmpty',
                'message' => 'Selecione um produto'
            )
        )
    );

    public function getDestaquesSecoes() {
        return $this->DestaquesSecao->find('list', array(
            'order' => 'id ASC'
        ));
    }
}