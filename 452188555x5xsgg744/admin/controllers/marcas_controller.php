<?php
class MarcasController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->set(array(
            'activeMenu' => 'produtos',
        ));
    }
    
    public function index() {
        $marcas = $this->Marca->find('all');

        $this->set(array(
            'title_for_layout' => 'Marcas',
            'marcas' => $marcas,
        ));
    }

    public function adicionar() {
        $this->set(array(
            'title_for_layout' => 'Adicionar marca',
        ));

        $this->render('editar');
    }

    public function editar($id = null) {
        $this->data = $this->Marca->read(null, $id);

        if (empty($this->data)):
            $this->mensagemPadrao('nao.encontrado');
            $this->redirect(array('action' => 'index'));
        endif;

        $nome = $this->data['Marca']['nome'];

        $this->set(array(
            'title_for_layout' => "Editando marca \"{$nome}\"",
        ));
    }

    public function salvar($id = null) {
        if (!empty($this->data)):
            if(is_null($id)):
                $this->Marca->create();
                $mensagem = 'criado.sucesso';
            else:
                $this->data['Marca']['id'] = $id;
                $mensagem = 'alterado.sucesso';
            endif;

            if ($this->Marca->save($this->data['Marca'])):
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
            && isset($this->data['Marca']['ids'])
            && is_array($this->data['Marca']['ids'])
        ):
            $ids = $this->data['Marca']['ids'];
        else:
            $ids = array($id);
        endif;


        $conditions = array('Marca.id' => $ids);
        $this->Marca->deleteAll($conditions, true, true);

        $this->mensagemPadrao('excluido.sucesso');
        $this->redirect(array('action' => 'index'));
    }
}