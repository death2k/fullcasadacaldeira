<?php
class AppController extends Controller {

    //Helpers
    public $helpers = array(
        'Session', 'Html', 'Form', 'Time', 'Number', 'TbForm', 'AdminHelper',
        'Menu', 'Text', 'Categorias',
    );

    //Components
    public $components = array('Auth', 'Session', 'RequestHandler', 'Email');

    //Paginação
    public $paginate = array('limit' => 10);


    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->userModel = 'Usuario';
        $this->Auth->fields = array('username' => 'nome', 'password' => 'senha');

        $this->Auth->loginAction = array('controller' => 'usuarios', 'action' => 'login');
        $this->Auth->loginRedirect = '/';

        $this->Auth->loginError = 'O usuário ou a senha estão errados.';
        $this->Auth->authError = 'Desculpe, mas você precisa de autenticação para acessar esta página.';
        $this->Auth->flashElement = "flash/alert";

        $this->Email->smtpOptions = array(
            'port'     => B3CMS_EMAIL_PORT,
            'host'     => B3CMS_EMAIL_HOST,
            'username' => B3CMS_EMAIL_USERNAME,
            'password' => B3CMS_EMAIL_PASSWORD,
        );
        $this->Email->to       = B3CMS_EMAIL_TO;
        $this->Email->from     = B3CMS_EMAIL_FROM;
        $this->Email->delivery = 'smtp';
        $this->Email->sendAs   = 'html';

        $this->set('showSidebar', true);

        $baseUrl = Router::url('/');
        $baseUrl = str_replace('admin/', '', $baseUrl);
        $baseUploadsUrl = $baseUrl . 'webroot/uploads/';

        $this->set(array(
            'uploadsPaths' => (object) array(
                'marcas' => $baseUploadsUrl.'marcas/',
                'noticias' => $baseUploadsUrl.'noticias/',
                'produtos' => $baseUploadsUrl.'produtos/',
                'propVar' => $baseUploadsUrl.'propriedades-variaveis/',
            ),
            'baseUrl' => $baseUrl,
        ));
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
            ));
        }

        return $produto;
    }
}