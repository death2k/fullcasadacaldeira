<?php
class DestaquesController extends AppController {

    public $use = array('Destaque');

    public function beforeFilter() {
        parent::beforeFilter();

        $this->set(array(
            'activeMenu' => 'produtos',
        ));
    }
    
    public function index() {
        $destaques = $this->Destaque->find('all');

        $this->set(array(
            'title_for_layout' => 'Destaques',
            'destaques' => $destaques,
        ));
    }

    public function adicionar() {
        $destaquesSecao = $this->Destaque->getDestaquesSecoes();

        $this->set(array(
            'title_for_layout' => 'Adicionar destaque',
            'destaquesSecao' => $destaquesSecao,
        ));

        $this->render('editar');
    }

    public function editar($id = null) {
        $this->data = $this->Destaque->read(null, $id);

        if (empty($this->data)):
            $this->mensagemPadrao('nao.encontrado');
            $this->redirect(array('action' => 'index'));
        endif;

        $destaquesSecao = $this->Destaque->getDestaquesSecoes();
        
        $this->set(array(
            'title_for_layout' => "Editando destaque",
            'destaquesSecao' => $destaquesSecao,
        ));
    }

    public function salvar($id = null) {
        if (!empty($this->data)):
            if(is_null($id)):
                $this->Destaque->create();
                $mensagem = 'criado.sucesso';
            else:
                $this->data['Destaque']['id'] = $id;
                $mensagem = 'alterado.sucesso';
            endif;

            if ($this->Destaque->save($this->data)):
                $this->mensagemPadrao($mensagem);
                $this->redirect(array('action' => 'index'));
            else:
                $this->mensagemPadrao('corrija.formulario');
                $this->render('editar');
            endif;
        endif;
    }

    public function excluir($id = null) {
        if (is_null($id) && empty($this->data)):
            $this->mensagemPadrao('nao.encontrado');
            $this->redirect(array('action' => 'index'));
        endif;


        if (
            $this->RequestHandler->isPost()
            && isset($this->data['Destaque']['ids'])
            && is_array($this->data['Destaque']['ids'])
        ):
            $ids = $this->data['Destaque']['ids'];
        else:
            $ids = array($id);
        endif;


        $conditions = array('Destaque.id' => $ids);
        $this->Destaque->deleteAll($conditions, true, true);

        $this->mensagemPadrao('excluido.sucesso');
        $this->redirect(array('action' => 'index'));
    }
}