<?php
class AppController extends Controller {

    //Helpers
    public $helpers = array(
        'Session', 'Html', 'Form', 'Time', 'Number', 'TbForm', 'AdminHelper',
        'Menu', 'Text', 'Categorias',
    );

    //Components
    public $components = array('Session', 'RequestHandler', 'Email');

    //Paginação
    public $paginate = array('limit' => 10);


    public function beforeFilter() {
        parent::beforeFilter();

        /*$this->Email->smtpOptions = array(
            'port'=>'587',
            'timeout'=>'30',
            'host' => 'smtp.valeatacado.com.br',
            'username' => 'naoresponda@valeatacado.com.br',
            'password' => 'jw537LSrNcYlc1',
        );
        $this->Email->delivery = 'smtp';
        // $this->Email->to = 'naoresponda@arosgt.com.br';
        $this->Email->to = 'osmar@b3net.com.br';
        $this->Email->from = 'Vale Atacado <naoresponda@valeatacado.com.br>';
        $this->Email->sendAs = 'html';*/

        $this->set('showSidebar', true);

        session_start();
        $this->session_id = session_id();
    }

    public function beforeRender() {
        parent::beforeRender();
    }

    public function getRenderedView($view, $layout) {
        $this->autoRender = false;

        $oldView = $this->view;

        $return = $this->render(false, $layout, $view);
        $this->output = '';

        $this->autoRender = true;

        return $return;
    }

    /**
     * Mensagens Flash
     */
    protected function successFlash($mensagem) {
        $this->Session->setFlash($mensagem, 'flash/success');
    }
    protected function errorFlash($mensagem) {
        $this->Session->setFlash($mensagem, 'flash/error');
    }
    protected function alertFlash($mensagem) {
        $this->Session->setFlash($mensagem, 'flash/alert');
    }

    protected function mensagemPadrao($chave) {
        switch ($chave) {
            case 'criado.sucesso':
                $this->successFlash('Registro criado com sucesso');
                break;
            case 'alterado.sucesso':
                $this->successFlash('Registro alterado com sucesso');
                break;

            case 'excluido.sucesso':
                $this->successFlash('Registro(s) excluídos com sucesso');
                break;
            case 'corrija.formulario':
                $this->alertFlash('Corrija o formulário e tente novamente');
                break;
            case 'nao.encontrado':
                $this->errorFlash('Registro não encontrado');
                break;
        }
    }

    protected function getProduto($produto_id, $recursive = '-1') {
        $produto = $this->Produto->find('first', array(
            'conditions' => array('Produto.id' => $produto_id),
            'recursive' => $recursive,
        ));

        if (empty($produto)) {
            $this->mensagemPadrao('nao.encontrado');
            $this->redirect(array(
                'controller' => 'produtos',
                'action' => 'index',
                'admin' => true,
            ));
        }

        return $produto;
    }
}
