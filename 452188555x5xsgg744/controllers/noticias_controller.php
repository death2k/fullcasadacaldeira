<?php
class NoticiasController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->set(array(
            'activeMenu' => 'noticias',
        ));
    }

    public function index() {
        $noticias = $this->Noticia->getNoticiasAtivas();

        $this->set(array(
            'title_for_layout' => "Notícias",
            'noticias' => $noticias,
        ));
    }

    public function visualizar($id = null) {
        if (is_null($id)) $this->redirect('/');

        $this->Noticia->id = $id;
        $noticia = $this->Noticia->read();

        if (!empty($noticia)):
            $noticia = (object) $noticia['Noticia'];

            $this->set(array(
                'title_for_layout' => "{$noticia->titulo} &lsaquo; Notícias",
                'data' => $noticia,
            ));
        else:
            $this->redirect('/');
        endif;
    }
}