<?php
class TiposOpcoesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->set(array(
            'activeMenu' => 'produtos',
        ));
    }

    public function index() {
        $this->set('data', $this->TiposOpcao->find('all'));

        $this->set(array(
            'title_for_layout' => 'Propriedades Variáveis',
        ));
    }

    public function editar($id = null) {
        if (!is_null($id)) {
            $this->data = $this->TiposOpcao->read(null, $id);
            
            if (empty($this->data))
                $this->mensagemPadrao('nao.encontrado');
        }

        $this->set(array(
            'sidebar' => false,
            'title_for_layout' => 'Propriedades Variáveis',
        ));
    }

    public function criar() {
        if (!empty($this->data)) {
            $this->TiposOpcao->create();

            if ($this->TiposOpcao->save($this->data)) {
                $this->mensagemPadrao('criado.sucesso');
                $this->redirect(array(
                    'action' => 'editar',
                    $this->TiposOpcao->id,
                ));
            } else {
                $this->mensagemPadrao('corrija.formulario');
            }
        }

        $this->redirect(array('action' => 'index'));
    }

    public function atualizar($id = null) {
        if (!is_null($id) && empty($this->data)) {
            $this->mensagemPadrao('nao.encontrado');
            $this->redirect(array('action' => 'index'));
        }

        $this->TiposOpcao->id = $id;
        if ($this->TiposOpcao->save($this->data['TiposOpcao'])) {
            $this->mensagemPadrao('alterado.sucesso');
            $this->redirect(array(
                'action' => 'editar',
                $this->TiposOpcao->id
            ));
        } else {
            $this->mensagemPadrao('corrija.formulario');
        }

        $this->redirect(array('action' => 'index'));
    }

    public function excluir($id = null) {
        if (is_null($id) && empty($this->data)) {
            $this->mensagemPadrao('nao.encontrado');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->RequestHandler->isPost()
            && isset($this->data['TiposOpcao']['ids'])
            && is_array($this->data['TiposOpcao']['ids'])) {
            $ids = $this->data['TiposOpcao']['ids'];
        } else {
            $ids = array($id);
        }

        $conditions = array('TiposOpcao.id' => $ids);
        $this->TiposOpcao->deleteAll($conditions);

        $this->mensagemPadrao('excluido.sucesso');
        $this->redirect(array('action' => 'index'));
    }
}
