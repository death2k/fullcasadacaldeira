<?php
class OpcoesController extends AppController {

    public function salvar() {
        if(empty($this->data)) $this->tiposOpcoesPath();        

        if (isset($this->data['Opcao']['id'])):
            $mensagem = 'alterado.sucesso';
        else:
            $this->Opcao->create();
            $mensagem = 'criado.sucesso';
        endif;

        if ($this->data['Opcao']['imagem']['error'] == '4'):
            unset($this->data['Opcao']['imagem']);
        endif;

        if ($this->Opcao->save($this->data)):
            $this->mensagemPadrao($mensagem);
        else:
            $this->mensagemPadrao('corrija.formulario');
        endif;

        $this->redirect(array(
            'controller' => 'tipos_opcoes',
            'action' => 'editar',
            $this->data['Opcao']['tipos_opcao_id'],
        ));
    }

    public function excluir($id = null, $tipos_opcao_id = null) {
        if (is_null($id) || is_null($tipos_opcao_id)) {
            $this->errorFlash('Registro não encontrado');
            $this->redirect(array('action' => 'index'));
        }

        $this->Opcao->delete($id);

        $this->successFlash('Registro excluído com sucesso');
        $this->redirect(array(
            'controller' => 'tipos_opcoes',
            'action' => 'editar',
            $tipos_opcao_id
        ));
    }




    protected function tiposOpcoesPath() {
        $this->redirect(array(
            'controller' => 'tipos_opcoes',
            'action' => 'index',
        ));
    }
}
