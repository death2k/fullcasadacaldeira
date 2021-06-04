<?php
class CategoriasController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->set(array(
            'activeMenu' => 'produtos',
        ));
    }

    public function index() {
        $categorias = $this->Categoria->getAll();

        $this->set(array(
            'title_for_layout' => 'Categorias',
            'categorias' => $categorias,
        ));
    }

    public function adicionar() {
        if (isset($this->params['named']['parent'])):
            $this->set(array(
                'parent_id' => $this->params['named']['parent']
            ));
        endif;

        $this->set(array('title_for_layout' => 'Adicionar categoria'));

        $this->render('editar');
    }

    public function editar($id = null) {
        $this->data = $this->Categoria->read(null, $id);

        if (empty($this->data)):
            $this->mensagemPadrao('nao.encontrado');
            $this->redirect(array('action' => 'index'));
        endif;

        $titulo = $this->data['Categoria']['titulo'];

        $this->set(array(
            'title_for_layout' => "Editando categoria \"{$titulo}\"",
        ));
    }

    public function salvar($id = null) {
        if(empty($this->data)) $this->redirect(array('action' => 'index'));

        if(is_null($id)):
            $this->Categoria->create();
            $mensagem = 'criado.sucesso';
        else:
            $this->data['Categoria']['id'] = $id;
            $mensagem = 'alterado.sucesso';
        endif;

        if ($this->Categoria->save($this->data)):
            $this->mensagemPadrao($mensagem);
            $this->redirect(array('action' => 'index'));
        else:
            $this->mensagemPadrao('corrija.formulario');
            $this->render('editar');
        endif;
    }

    public function excluir($id = null) {
        if (is_null($id) && empty($this->data)):
            $this->mensagemPadrao('nao.encontrado');
            $this->redirect(array('action' => 'index'));
        endif;


        if (
            $this->RequestHandler->isPost()
            && isset($this->data['Categoria']['ids'])
            && is_array($this->data['Categoria']['ids'])
        ):
            $ids = $this->data['Categoria']['ids'];
        else:
            $ids = array($id);
        endif;


        $conditions = array('Categoria.id' => $ids);
        $this->Categoria->deleteAll($conditions);

        $this->mensagemPadrao('excluido.sucesso');
        $this->redirect(array('action' => 'index'));
    }


    public function ajaxTeste() {
        $this->layout = false;
        $this->render(false);
        echo 'alert("ergaergaerg");';
    }
}