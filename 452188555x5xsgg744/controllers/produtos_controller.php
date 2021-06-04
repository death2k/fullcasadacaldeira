<?php
class ProdutosController extends AppController {

    public $uses = array(
        'Produto', 'Categoria', 'Imagem', 'Variacao', 'OpcoesVariacao',
        'TiposOpcao', 'Opcao'
    );

    public $paginate = array(
        'limit' => 8,
        'recursive' => -1,
    );

    public function beforeFilter() {
        parent::beforeFilter();

        $this->set(array(
            'activeMenu' => 'produtos',
        ));
    }


    public function index() {
        $produtos = array();

        if (isset($this->params['url']['s'])):
            $searchTerm = $this->params['url']['s'];

            $this->paginate['conditions'] = array(
                 "OR" => array(
                    'Produto.titulo LIKE' => "%{$searchTerm}%",
                    'Produto.descricao LIKE' => "%{$searchTerm}%",
                )
            );
            $produtos = $this->paginate('Produto');

            $this->set(array('searchTerm' => $searchTerm));
        elseif (isset($this->params['named']['categoria'])):
            $categoria_id = $this->params['named']['categoria'];

            $childrens = $this->Categoria->getChildrensList($categoria_id);
            $categoria_ids = array_merge(array($categoria_id) ,$childrens);

            $this->paginate['conditions'] = array('categoria_id' => $categoria_ids);
            $produtos = $this->paginate('Produto');

            $this->set(array('categoria_id' => $categoria_id));
        else:
            $produtos = $this->paginate('Produto');
        endif;

        $this->set(array(
            'title_for_layout' => 'Produtos',
            'produtos' => $produtos,
        ));
    }

    public function visualizar($id = null) {
        $produto = $this->Produto->find('first', array(
            'conditions' => array('Produto.id' => $id),
            'recursive' => '0',
        ));

        if (empty($produto))
            $this->redirect(array('controller' => 'produtos', 'action' => 'index'));

        $categoria_id = $produto['Categoria']['id'];
        $produto_id = $produto['Produto']['id'];
        $produto_titulo = $produto['Produto']['titulo'];

        $variacoes = $produto['Variacao'];

        if(isset($this->params['named']['variacao'])):
            $variacao_id = $this->params['named']['variacao'];

            foreach ($variacoes AS $item):
                if ($item->id == $variacao_id):
                    $variacao = $item;
                    break;
                endif;
            endforeach;

            $this->set(array('variacao' => $variacao));
        else:
            if (isset($variacoes[0])):
                $this->set(array('variacao' => $variacoes[0]));
            else:
                $this->set(array('variacao' => array()));
            endif;
        endif;

        $this->set(array(
            'title_for_layout' => "{$produto_titulo} « Produtos",
            'categoria_id' => $categoria_id,
            'produto' => $produto,
        ));
    }

    public function indicar() {
        if (
            !isset($this->params['named']['produto'])
            || empty($this->params['named']['produto'])
        )
            $this->redirect('/');

        $produto_id = $this->params['named']['produto'];
        $variacao_id = $this->params['named']['variacao'];

        $data = $this->data['IndicarProduto'];
        $erros = $this->__validateData($data);

        if(empty($erros)):
            $produto = $this->Produto->find('first', array(
                'conditions' => array(
                    'Produto.id' => $produto_id,
                ),
                'recursive' => -1,
            ));

            $linkProduto = Router::url(array(
                'controller' => 'produtos',
                'action' => 'visualizar',
                $produto_id,
                'variacao' => $variacao_id,
            ), true);
            $tituloProduto = $produto['Produto']['titulo'];
            $descricaoProduto = $produto['Produto']['descricao'];

            $this->set(array(
                'data' => $data,
                'linkProduto' => $linkProduto,
                'tituloProduto' => $tituloProduto,
                'descricaoProduto' => $descricaoProduto,
            ));

            $body = $this->getRenderedView(
                "../elements/email/html/indicacao", 'email/html/default'
            );

            $this->Email->subject = 'Indicação de Produto de ' . $data['nome'];
            $this->Email->to = $data['nomeAmigo'] . '<' . $data['emailAmigo'] . '>';
            $this->Email->send($body);

            $this->successFlash('Indicação enviada com sucesso!');
            $this->redirect(array(
                'controller' => 'produtos',
                'action' => 'visualizar',
                $produto_id,
                'variacao' => $variacao_id,
            ));
        else:
            $mensagem = 'Por favor, corrija os seguintes campos:';
            $erros = implode('<br />', $erros);
            $this->alertFlash("{$mensagem}<br /><br />{$erros}");
            $this->redirect(array(
                'controller' => 'produtos',
                'action' => 'visualizar',
                $produto_id,
                'variacao' => $variacao_id,
            ));
        endif;
    }





    protected function __validateData($data) {
        $erros = array();

        if (empty($data['nome'])) $erros[] = 'Preencha seu nome';
        if (empty($data['email'])
            || !filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            $erros[] = 'Preencha o email corretamente';

        if (empty($data['nomeAmigo'])) $erros[] = 'Preencha o nome do seu amigo(a)';
        if (empty($data['emailAmigo'])
            || !filter_var($data['emailAmigo'], FILTER_VALIDATE_EMAIL))
            $erros[] = 'Preencha corretamente o email do seu amigo(a)';

        return $erros;
    }
}
