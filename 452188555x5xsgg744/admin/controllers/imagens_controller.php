<?php
class ImagensController extends AppController {

    public $uses = array('Imagem', 'Produto', 'Variacao', 'TiposOpcao');

    public function beforeFilter() {
        parent::beforeFilter();

        $this->set(array(
            'activeMenu' => 'produtos',
        ));

        $this->layout = 'simples';
    }

    public function index($produto_id = null) {
        $produto = $this->getProduto($produto_id, '1');
        $tituloProduto = $produto['Produto']['titulo'];
        $produto_id = $produto['Produto']['id'];

        if (isset($this->params['named']['variacao'])):
            $imagens = $this->Imagem->find('all', array(
                'conditions' => array(
                    'produto_id' => $produto_id,
                    'variacao_id' => $this->params['named']['variacao'],
                ),
                'order' => 'Imagem.id DESC',
            ));
        else:
            $imagens = $this->Imagem->find('all', array(
                'conditions' => array(
                    'produto_id' => $produto_id,
                    'ISNULL(variacao_id)',
                ),
                'order' => 'Imagem.id DESC',
            ));
        endif;

        $this->set(array(
            'title_for_layout' => "Editando produto \"$tituloProduto\"",
            'produto_id' => $produto_id,
            'imagens' => $imagens,
        ));
    }

    /*public function adicionar($produto_id = null) {
        $variacoes = $this->Variacao->getListaFormatada($produto_id);

        $this->set(array(
            'title_for_layout' => 'Adicionar imagem',
            'produto_id' => $produto_id,
            'variacoes' => $variacoes,
        ));

        $this->render('editar');
    }

    public function editar($produto_id = null, $id = null) {
        $this->data = $this->Imagem->read(null, $id);

        $variacoes = $this->Variacao->getListaFormatada($produto_id);

        $this->set(array(
            'title_for_layout' => 'Editando imagem',
            'produto_id' => $produto_id,
            'variacoes' => $variacoes,
        ));

        $this->render('editar');
    }*/

    public function salvar() {
        if(empty($this->data)) $this->produtosIndexPath();
        
        $produto_id = $this->data['Imagem']['produto_id'];

        $this->Imagem->create();
        
        $image_name = md5(uniqid($this->data['Imagem']['nome_arquivo']['name']));
        $this->data['Imagem']['image_name'] = $image_name;

        $this->Imagem->save($this->data);

        if (isset($this->data['Imagem']['variacao_id'])):
            $this->redirect(array(
                'controller' => 'imagens',
                'action' => 'index',
                $produto_id,
                'variacao' => $this->data['Imagem']['variacao_id'],
            ));
        else:
            $this->redirect(array('controller' => 'imagens', 'action' => 'index', $produto_id));
        endif;
    }

    public function excluir($produto_id, $id) {
        $this->Imagem->delete($id);

        if (isset($this->params['named']['variacao'])):
            $this->redirect(array(
                'controller' => 'imagens',
                'action' => 'index',
                $produto_id,
                'variacao' => $this->params['named']['variacao'],
            ));
        else:
            $this->redirect(array('controller' => 'imagens', 'action' => 'index', $produto_id));
        endif;
    }
}
?>