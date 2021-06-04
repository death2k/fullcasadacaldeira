<?php
class Categoria extends AppModel {
    public $displayField = 'titulo';
    public $order = array('Categoria.titulo' => 'ASC');

    public $hasMany = array('Produto');

    public $actsAs = array('Tree');
    
    public $validate = array(
        'titulo' => array(
            array(
                'required' => true,
                'rule' => 'notEmpty',
                'message' => 'Preencha o campo título'
            )
        )
    );

    public function retornaTree($separator = '&nbsp;&nbsp;&nbsp;&nbsp;') {
        return $this->generateTreeList(null, null, null, $separator);
    }

    public function getChildrensList($id) {
        $childrens = $this->children($id, false, 'id');

        $temp = array();
        if (!empty($childrens))
            foreach ($childrens AS $children)
                $temp[] = $children['Categoria']['id'];

        return $temp;
    }

    public function getAll() {
        return $this->find('threaded', array(
            'order' => 'Categoria.titulo ASC',
            'recursive' => '-1',
        ));
    }

    public function getRoots() {
        $roots = $this->find('all', array(
            'conditions' => array('ISNULL(parent_id)'),
            'recursive' => '-1'
        ));
    }
}