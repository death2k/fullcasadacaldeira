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
        if(isset($this->data['ProdutoSearch'])):
            $ProdutoSearch = $this->data['ProdutoSearch'];

            if(!empty($ProdutoSearch['codigo'])):
                $produtoId = $this->Variacao->find('first', array(
                    'conditions' => array('Variacao.codigo' => $ProdutoSearch['codigo']),
                    'fields' => array('produto_id'),
                    'recursive' => -1,
                ));

                $this->paginate['conditions']['Produto.id']
                    = $produtoId['Variacao']['produto_id'];
            endif;
            
            if(!empty($ProdutoSearch['titulo'])):
                $this->paginate['conditions']['Produto.titulo LIKE'] = 
                    '%' . $ProdutoSearch['titulo'] . '%';
            endif;
            
            if($ProdutoSearch['categoria_id'] != ''):
                $this->paginate['conditions']['Produto.categoria_id']
                    = $ProdutoSearch['categoria_id'];
            endif;
            
            if($ProdutoSearch['pagina_inicial'] != ''):
                $this->paginate['conditions']['Produto.pagina_inicial']
                    = $ProdutoSearch['pagina_inicial'];
            endif;
            
            if($ProdutoSearch['status'] != ''):
                $this->paginate['conditions']['Produto.status']
                    = $ProdutoSearch['status'];
            endif;
        endif;

        $this->paginate['recursive'] = 1;
        $produtos = $this->paginate();

        $categorias = $this->Categoria->retornaTree();

        $this->set(array(
            'title_for_layout' => 'Produtos',
            'data' => $produtos,
            'categorias' => $categorias,
        ));
    }

    public function adicionar() {
        if (!empty($this->data)) {
            $this->Produto->create();

            if ($this->Produto->save($this->data)) {
                $this->mensagemPadrao('criado.sucesso');
                $this->redirect(array(
                    'action' => 'editar',
                    $this->Produto->id
                ));
            } else {
                $this->mensagemPadrao('corrija.formulario');
            }
        }

        $categorias = $this->Categoria->retornaTree();
        
        $this->set(array(
            'title_for_layout' => 'Novo Produto',
            'categorias' => $categorias,
            'marcas' => $this->Produto->Marca->find('list'),
        ));
        
        $this->render('editar');
    }

    public function editar($id = null) {
        if (!$id && empty($this->data)) {
            $this->mensagemPadrao('nao.encontrado');
            $this->redirect(array('action' => 'index'));
        }
        
        if (!empty($this->data)) {
            $this->data['Produto']['id'] = $id;
            if ($this->Produto->save($this->data['Produto'])) {
                $this->mensagemPadrao('alterado.sucesso');
                $this->redirect(array(
                    'action' => 'editar',
                    $this->Produto->id
                ));
            } else {
                $this->mensagemPadrao('corrija.formulario');
            }
        }

        if (empty($this->data)) {
            $this->data = $this->Produto->find('first', array(
                'conditions' => array('id' => $id),
                'recursive' => '-1',
            ));
            
            if (empty($this->data)) {
                $this->mensagemPadrao('nao.encontrado');
                $this->redirect(array('action' => 'index'));
            }
        }

        $tituloProduto = $this->data['Produto']['titulo'];
        $produto_id = $this->data['Produto']['id'];
        
        $this->set(array(
            'title_for_layout' => "Editando produto \"$tituloProduto\"",
            'categorias' => $this->Categoria->retornaTree(),
            'marcas' => $this->Produto->Marca->find('list'),
            'produto_id' => $produto_id,
        ));
    }

    public function excluir($id = null) {
        if (is_null($id) && empty($this->data)) {
            $this->mensagemPadrao('nao.encontrado');
            $this->redirect(array('action' => 'index'));
        }


        if ($this->RequestHandler->isPost()
            && isset($this->data['Produto']['ids'])
            && is_array($this->data['Produto']['ids'])) {
            $ids = $this->data['Produto']['ids'];
        } else {
            $ids = array($id);
        }

        $conditions = array('Produto.id' => $ids);
        $this->Produto->deleteAll($conditions);

        $this->mensagemPadrao('excluido.sucesso');
        $this->redirect(array('action' => 'index'));
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