<?php
class UsuariosController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->set(array(
            'activeMenu' => 'usuarios',
        ));
    }


    public function login() {
	    $this->layout = 'login';
	}

    public function logout() {
	    $this->redirect($this->Auth->logout());
	}



    public function index() {
        $this->data = $this->Usuario->find('all');

        $this->set(array(
            'title_for_layout' => 'Usuários',
        ));
    }

    public function adicionar() {
        if(!empty($this->data)) {
            if (!empty($this->data['Usuario']['senha'])) {
                $this->data['Usuario']['senha_verify'] = 
                    AuthComponent::password($this->data['Usuario']['senha_verify']);

                if ($this->data['Usuario']['senha'] != $this->data['Usuario']['senha_verify']) {
                    $this->alertFlash('A confirmação de senha não confere com a senha.');
                    $this->data['Usuario']['senha'] = '';
                    $this->data['Usuario']['senha_verify'] = '';
                } else {
                    if ($this->Usuario->save($this->data)) {
                        $this->mensagemPadrao('criado.sucesso');
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->data['Usuario']['senha'] = '';
                        $this->data['Usuario']['senha_verify'] = '';
                        $this->mensagemPadrao('corrija.formulario');
                    }
                }
            } else {
                $this->alertFlash('A senha deve ser preenchida.');
            }
        }

        $this->set(array(
            'title_for_layout' => 'Adicionar usuário',
        ));

        $this->render('editar');
    }

    public function editar($id) {
        $this->Usuario->id = $id;

        if(!empty($this->data)) {

            $senhaOk = true;

            if ($this->data['Usuario']['senha'] != AuthComponent::password('')) {
                $this->data['Usuario']['senha_verify'] = 
                    AuthComponent::password($this->data['Usuario']['senha_verify']);

                if ($this->data['Usuario']['senha'] != $this->data['Usuario']['senha_verify']) {
                    $this->alertFlash('A confirmação de senha não confere com a senha.');
                    $this->data['Usuario']['senha'] = '';
                    $this->data['Usuario']['senha_verify'] = '';
                    $senhaOk = false;
                }
            } else {
                unset($this->data['Usuario']['senha']);
                unset($this->data['Usuario']['senha_verify']);
            }

            if($senhaOk) {
                if ($this->Usuario->save($this->data)) {
                    $this->mensagemPadrao('alterado.sucesso');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->data['Usuario']['senha'] = '';
                    $this->data['Usuario']['senha_verify'] = '';
                    $this->mensagemPadrao('corrija.formulario');
                }
            }
        }

        $this->data = $this->Usuario->read();

        $this->data['Usuario']['senha'] = '';

        $this->set(array(
            'title_for_layout' => 'Editar usuário',
        ));
    }

    public function excluir($id = null) {
        $this->Usuario->delete($id);
        $this->mensagemPadrao('excluido.sucesso');
        $this->redirect(array('action' => 'index'));
    }
}