<?php
class PagesController extends AppController {

    public $uses = array('Contato', 'Noticia', 'Destaque', 'Produto');

    public $components = array('Session', 'Email');

    public function home() {
        $produtos = $this->Produto->find('all', array(
            'conditions' => array(
                'pagina_inicial' => '1'
            ),
            'order' => 'RAND()',
            'limit' => 9,
            'recursive' => -1,
        ));

        $this->set(array(
            'title_for_layout' => '',
            'showSidebar' => false,
            'produtos' => $produtos,
        ));
    }

    public function empresa() {
        $this->set(array(
            'title_for_layout' => 'Empresa',
        ));
    }

    public function lancamentos() {
        $produtos = $this->Produto->find('all', array(
            'conditions' => array(
                'lancamento' => '1'
            ),
            'order' => 'RAND()',
            'limit' => 9,
            'recursive' => -1,
        ));

        $this->set(array(
            'title_for_layout' => 'Lançamentos',
            'produtos' => $produtos,
        ));
    }

    public function localizacao() {
        $this->set(array(
            'title_for_layout' => 'Localização',
        ));
    }

    public function contato() {
        $this->set('title_for_layout', 'Contato');

        if (!empty($this->data)) {
            $this->Contato->set($this->data);

            if ($this->Contato->validates()) {
                $contato = (object) $this->data['Contato'];

                $mensagem = "
                    Nome: <strong>{$contato->nome}</strong>
                    <br />
                    Email: <strong>{$contato->email}</strong>
                    <br />
                    Telefone: <strong>{$contato->telefone}</strong>
                    <br />
                    <br />
                    Mensagem:
                    <br />
                    {$contato->mensagem}
                ";

                $this->Email->subject =
                    "Contato do cliente \"{$contato->nome}\"";

                if ($this->Email->send($mensagem)):
                    $this->Session->setFlash('Mensagem enviada com sucesso!');
                endif;

                $this->redirect('/contato');
            }
        }
    }
}
