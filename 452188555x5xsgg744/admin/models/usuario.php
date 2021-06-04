<?php
class Usuario extends AppModel {
    public $validate = array(
        'nome' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Campo obrigatório',   
                'required' => true
            ),
        ),
    );


    public function equalToField($data, $field) {
        $data = array_shift($data);
        
        return isset($this->data[$this->alias][$field]) && ($data == $this->data[$this->alias][$field]);
    }
}