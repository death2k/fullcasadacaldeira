<?php
class VariacoesController extends AppController {

    public $uses = array(
        'Variacao', 'Produto', 'ProdutosTiposOpcao',
        'TiposOpcao', 'Variacao', 'OpcoesVariacao', 'Imagem'
    );

    public $paginate = array(
        'limit' => 1
    );

    public function beforeFilter() {
        parent::beforeFilter();

        $this->set(array(
            'activeMenu' => 'produtos',
        ));
    }

    public function index($produto_id = null) {
        $produto = $this->getProduto($produto_id);
        $tituloProduto = $produto['Produto']['titulo'];
        $produto_id = $produto['Produto']['id'];


        $produtosTiposOpcoes = $this->ProdutosTiposOpcao->find('all', array(
            'conditions' => array('produto_id' => $produto_id)
        ));


        $variacoes = $this->Variacao->find('all', array(
            'conditions' => array('produto_id' => $produto_id),
        ));

        $tiposOpcoes = $this->TiposOpcao->getFormatado();
        $tiposOpcoesList = $this->getTiposOpcoesList($tiposOpcoes);
        
        $this->set(array(
            'title_for_layout' => "Editando produto \"$tituloProduto\"",
            'produto_id' => $produto_id,
            'produtosTiposOpcoes' => $produtosTiposOpcoes,
            'tiposOpcoes' => $tiposOpcoes,
            'tiposOpcoesList' => $tiposOpcoesList,
            'variacoes' => $variacoes,
        ));
    }

    public function adicionar($produto_id = null) {
        $this->setAction('editar', $produto_id);
    }

    public function editar($produto_id = null, $id = null) {
        $produto = $this->getProduto($produto_id);
        $tituloProduto = $produto['Produto']['titulo'];
        $produto_id = $produto['Produto']['id'];


        if($this->Session->check('formData')):
            $this->data = $this->Session->read('formData', $this->data);
            $this->Session->delete('formData');
        else:
            if(!is_null($id)):
                $this->data = $this->Variacao->find('first', array(
                    'conditions' => array('Variacao.id' => $id)
                ));
            else:
                $this->data = $this->Variacao->create();
            endif;
        endif;


        $produtosTiposOpcoes = $this->ProdutosTiposOpcao->find('all', array(
            'conditions' => array('produto_id' => $produto_id)
        ));

        $tiposOpcoes = $this->TiposOpcao->getFormatado();

        $imagens = $this->Imagem->find('all', array(
            'conditions' => array('variacao_id' => $id)
        ));

        $this->set(array(
            'title_for_layout' => "Editando produto \"$tituloProduto\"",
            'produto_id' => $produto_id,
            'produtosTiposOpcoes' => $produtosTiposOpcoes,
            'tiposOpcoes' => $tiposOpcoes,
            'imagens' => $imagens,
        ));
    }

    public function salvar() {
        if(empty($this->data)):
            $this->redirect(array(
                'controller' => 'produtos', 'action' => 'index'
            ));
        endif;

        $opcoes = $this->data['Variacao']['opcoes'];
        unset($this->data['Variacao']['opcoes']);

        if(isset($this->data['Variacao']['id'])):
            $mensagem = 'alterado.sucesso';
        else:
            $mensagem = 'criado.sucesso';
            $this->Variacao->create();
        endif;

        if ($this->Variacao->save($this->data)):
            $this->OpcoesVariacao->deleteAll(array(
                'variacao_id' => $this->Variacao->id
            ));

            foreach ($opcoes as $key => $opcao):
                $opcao['variacao_id'] = $this->Variacao->id;
                $this->OpcoesVariacao->create();
                $this->OpcoesVariacao->save($opcao);
            endforeach;

            $this->mensagemPadrao($mensagem);
            if (
                isset($this->params['named']['variacao'])
                && $this->params['named']['variacao'] == 'true'
            ):
                $this->redirect(array(
                    'controller' => 'variacoes',
                    'action' => 'editar',
                    $this->data['Variacao']['produto_id'],
                    $this->Variacao->id,
                ));
            else:
                $this->redirect(array(
                    'action' => 'editar',
                    $this->data['Variacao']['produto_id'],
                    $this->Variacao->id,
                ));
            endif;
        else:
            $this->data['Variacao']['opcoes'] = $opcoes;
            $this->Session->write('formData', $this->data);
            $this->setAction(
                'editar',
                $this->data['Variacao']['produto_id'],
                $this->Variacao->id
            );
        endif;
    }

    public function excluir($produto_id = null, $id = null) {
        if (is_null($produto_id) && empty($this->data)) {
            $this->mensagemPadrao('nao.encontrado');
            $this->redirect(array(
                'controller' => 'produtos',
                'action' => 'index',
            ));
        }

        if ($this->RequestHandler->isPost()
            && isset($this->data['Variacao']['ids'])
            && is_array($this->data['Variacao']['ids'])
        ):
            $ids = $this->data['Variacao']['ids'];
        else:
            $ids = array($id);
        endif;

        $conditions = array('Variacao.id' => $ids);
        $this->Variacao->deleteAll($conditions);

        $this->mensagemPadrao('excluido.sucesso');
        $this->redirect(array(
            'controller' => 'variacoes',
            'action' => 'index',
            $produto_id,
        ));
    }














    public function salvarProdutosTiposOpcoes() {
        if (!empty($this->data)) {
            $data = $this->data['ProdutosTiposOpcao'];

            $produto_id = $data['produto_id'];

            $this->ProdutosTiposOpcao->deleteAll(array(
                'produto_id' => $produto_id
            ));

            foreach ($data['TiposOpcao'] as $id) {
                $this->ProdutosTiposOpcao->create();
                $this->ProdutosTiposOpcao->save(array(
                    'produto_id' => $produto_id,
                    'tipos_opcao_id' => $id,
                ));
            }

            $this->redirect(array('action' => 'index', $produto_id));
        }

        $this->redirect(array('controller' => 'produtos'));
    }










    protected function getTiposOpcoesList($tiposOpcoes) {
        $return = array();
        foreach ($tiposOpcoes as $key => $tiposOpcao):
            $return[$tiposOpcao['TiposOpcao']['id']] 
                = $tiposOpcao['TiposOpcao']['nome'];
        endforeach;

        return $return;
    }
}