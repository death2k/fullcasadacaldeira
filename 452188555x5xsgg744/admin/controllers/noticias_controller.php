<?php
class NoticiasController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->set(array(
            'activeMenu' => 'noticias',
        ));
    }

    public function index() {
        $noticias = $this->Noticia->find('all');

        $this->set(array(
            'title_for_layout' => 'Notícias',
            'noticias' => $noticias,
        ));
    }

    public function adicionar() {
        $this->data = $this->Noticia->create();

        $this->set(array(
            'title_for_layout' => 'Adicionar notícia',
        ));

        $this->render('editar');
    }

    public function editar($id = null) {
        $this->data = $this->Noticia->read(null, $id);

        if (empty($this->data)):
            $this->mensagemPadrao('nao.encontrado');
            $this->redirect(array('action' => 'index'));
        endif;

        $titulo = $this->data['Noticia']['titulo'];

        $this->set(array(
            'title_for_layout' => "Editando notícia \"{$titulo}\"",
        ));
    }

    public function salvar($id = null) {
        if(empty($this->data)) $this->redirect(array('action' => 'index'));

        if ($this->data['Noticia']['miniatura']['error'] == '4')
            unset($this->data['Noticia']['miniatura']);

        if(is_null($id)):
            $this->Noticia->create();
            $mensagem = 'criado.sucesso';
        else:
            $this->data['Noticia']['id'] = $id;
            $mensagem = 'alterado.sucesso';
        endif;

        if ($this->Noticia->save($this->data)):
            $this->mensagemPadrao($mensagem);
            $this->redirect(array('action' => 'editar', $this->Noticia->id));
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
            && isset($this->data['Noticia']['ids'])
            && is_array($this->data['Noticia']['ids'])
        ):
            $ids = $this->data['Noticia']['ids'];
        else:
            $ids = array($id);
        endif;


        $conditions = array('Noticia.id' => $ids);
        $this->Noticia->deleteAll($conditions, true, true);

        $this->mensagemPadrao('excluido.sucesso');
        $this->redirect(array('action' => 'index'));
    }
}