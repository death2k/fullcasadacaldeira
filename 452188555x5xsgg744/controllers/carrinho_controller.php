<?php
class CarrinhoController extends AppController {

    public $uses = array('CarrinhoProduto', 'Produto', 'Variacao');

    public function beforeFilter() {
        parent::beforeFilter();

        /*$this->set(array(
            'activeMenu' => 'produtos',
        ));*/
    }

    public function index() {
        $carrinho = $this->__getCarrinhoComProdutos($this->session_id);

        $this->set(array(
            'title_for_layout' => 'Carrinho',
            'carrinho' => $carrinho,
        ));
    }

    public function adicionar() {
        if(
            !isset($this->params['named']['produto'])
            && !isset($this->params['named']['variacao'])
        ):
            $this->redirect(array(
                'controller' => 'carrinho',
                'action' => 'index',
            ));
        endif;

        $carrinhoProduto = $this->CarrinhoProduto->find('first', array(
            'conditions' => array(
                'sessao' => $this->session_id,
                'produto_id' => $this->params['named']['produto'],
                'variacao_id' => $this->params['named']['variacao'],
            )
        ));

        $this->CarrinhoProduto->create();
        
        if(empty($carrinhoProduto)):
            $item = array(
                'produto_id' => $this->params['named']['produto'],
                'variacao_id' => $this->params['named']['variacao'],
                'quantidade' => 1,
                'sessao' => $this->session_id,
            );
        else:
            $carrinhoProduto = $carrinhoProduto['CarrinhoProduto'];

            $this->CarrinhoProduto->id = $carrinhoProduto['id'];
            $item = array(
                'quantidade' => $carrinhoProduto['quantidade']+1,
            );
        endif;

        if($this->CarrinhoProduto->save($item)):
            $this->successFlash('Produto adicionado ao carrinho com sucesso!');
        else:
            $this->errorFlash('Não foi possível adicionar o produto ao carrinho!');
        endif;

        $this->redirect(array(
            'controller' => 'carrinho',
            'action' => 'index',
        ));
    }

    public function atualizar() {
        $items = $this->data['CarrinhoProduto']['quantidade'];
        
        foreach ($items AS $carrinho_produto_id => $quantidade):
            $this->CarrinhoProduto->create();
            $this->CarrinhoProduto->id = $carrinho_produto_id;
            $this->CarrinhoProduto->save(array(
                'quantidade' => $quantidade
            ));
        endforeach;
        
        $this->alertFlash('Produtos atualizados com sucesso.');

        $this->redirect(array(
            'controller' => 'carrinho',
            'action' => 'index',
        ));
    }

    public function excluir($id = null) {
        if (is_null($id)):
            $this->redirect(array(
                'controller' => 'carrinho',
                'action' => 'index',
            ));
        endif;

        $this->CarrinhoProduto->delete($id);
        $this->successFlash('Produto removido com sucesso!');
        $this->redirect(array(
            'controller' => 'carrinho',
            'action' => 'index',
        ));
    }

    public function enviarCotacao() {
        if (empty($this->data)) $this->redirect('/carrinho');

        $data = $this->data['EnviarCotacao'];
        $erros = $this->__validateData($data);

        if(empty($erros)):
            
            //Obtem todos os itens que estão no carrinho...
            $carrinho = $this->__getCarrinhoComProdutos($this->session_id);


            //Determina as variáveis utilizadas nas views...
            $this->set(array('data' => $data, 'carrinho' => $carrinho));


            //Envia email para o administrador do site...
            $body = $this->__renderHtmlMessage('cotacao-administracao');
            $this->Email->subject = 'Pedido de "' . $data['nome'] . '"';
            $this->Email->send($body);


            //Envia email para o cliente...
            $body = $this->__renderHtmlMessage('cotacao-cliente');
            $this->Email->subject = 'Novo pedido na Aros GT';
            $this->Email->to = $data['email'];
            $this->Email->send($body);


            //Deleta todos os produtos do carrinho...
            $this->CarrinhoProduto->deleteAll(array(
                'sessao' => $this->session_id
            ));

            $this->successFlash('Cotação enviada com sucesso!');
            $this->redirect('/carrinho');
        else:
            $mensagem = 'Por favor, corrija os seguintes campos:';
            $erros = implode('<br />', $erros);
            $this->alertFlash("{$mensagem}<br /><br />{$erros}");
            $this->redirect('/carrinho');
        endif;
    }


    protected function __validateData($data) {
        $erros = array();

        if (empty($data['nome'])) $erros[] = 'Preencha o nome';
        if (empty($data['email'])
            || !filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            $erros[] = 'Preencha o email corretamente';
        if (empty($data['telefone'])) $erros[] = 'Preencha o telefone';
        if (empty($data['cidade'])) $erros[] = 'Preencha a cidade';
        if (empty($data['estado'])) $erros[] = 'Escolha o estado';

        return $erros;
    }

    protected function __getCarrinhoComProdutos($session_id) {
        $carrinho = $this->CarrinhoProduto->findAllBySessao($session_id);

        foreach ($carrinho AS $index => $item):
            $item = $item['CarrinhoProduto'];

            $this->Produto->recursive = -1;
            $produto = $this->Produto->findById($item['produto_id']);
            $variacao = $this->Variacao->getFormatada(
                $item['produto_id'], $item['variacao_id']
            );
            $produto['Variacao'] = $variacao;

            $item['produto'] = $produto;

            $carrinho[$index] = $item;
        endforeach;

        return $carrinho;
    }

    protected function __renderHtmlMessage($file) {
        return $this->getRenderedView(
            "../elements/email/html/{$file}", 'email/html/default'
        );
    }
}