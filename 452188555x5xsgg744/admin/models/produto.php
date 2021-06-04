<?php
class Produto extends AppModel {
    public $displayField = 'titulo';
    public $order = array('Produto.created' => 'DESC');
    public $conditions = array(
        'Produto.pagina_inicial' => '1',
    );
    
    public $belongsTo = array(
        'Categoria',
        'Marca',
    );
    
    public $hasMany = array(
        'Imagem' => array(
            'dependent' => true,
            'order' => 'Imagem.variacao_id ASC, Imagem.id ASC',
        ),
        'Variacao' => array(
            'dependent' => true,
        ),
        'ProdutosTiposOpcao' => array(
            'dependent' => true,
        ),
    );
    
    public $validate = array(
        'titulo' => array(
            array(
                'required' => true,
                'rule' => 'notEmpty',
                'message' => 'O título deve ser preenchido'
            )
        )
    );


    public function getImagens($produto_id) {
        $Imagem = Classregistry::init('Imagem');
        $imagens = $Imagem->find('all', array(
            'conditions' => array(
                'produto_id' => $produto_id,
                'ISNULL(variacao_id)'
            ),
            'order' => 'id DESC',
        ));

        foreach ($imagens AS $key => $imagem):
            $imagens[$key] = (object) $imagem['Imagem'];
        endforeach;
        
        return $imagens;
    }

/*
    public function getPrimeiraImagem($produto_id) {
        $Variacao = Classregistry::init('Variacao');

        $Variacao->unbindModel(array('belongsTo' => array('Produto')));
        $variacao = $Variacao->findByProdutoId($produto_id);
        
        if(empty($variacao['Imagem'])):
            return (object) array();
        else:
            return (object) $variacao['Imagem'][0];
        endif;
    }*/


    public function beforeSave($options) {
        $item = $this->data['Produto'];

        if (isset($item['preco'])) $item['preco'] = $this->limparDinheiro($item['preco']);
        if (isset($item['promocao'])) $item['promocao'] = $this->limparDinheiro($item['promocao']);
        
        if (isset($item['peso'])) $item['peso'] = $this->limparFloat($item['peso']);
        if (isset($item['altura'])) $item['altura'] = $this->limparFloat($item['altura']);
        if (isset($item['largura'])) $item['largura'] = $this->limparFloat($item['largura']);
        if (isset($item['comprimento'])) $item['comprimento'] = $this->limparFloat($item['comprimento']);

        $this->data['Produto'] = $item;
        return true;
    }

    public function afterFind($resultados) {
        foreach ($resultados as $key => $val) {
            if (isset($val['Produto']['preco']))
                $resultados[$key]['Produto']['preco'] =
                    $this->formatarDinheiro($val['Produto']['preco']);
            
            if (isset($val['Produto']['promocao']))
                $resultados[$key]['Produto']['promocao'] =
                    $this->formatarDinheiro($val['Produto']['promocao']);
                    

            if (isset($val['Produto']['peso']))
                $resultados[$key]['Produto']['peso'] =
                    $this->formatarFloat($val['Produto']['peso']);

            if (isset($val['Produto']['altura']))
                $resultados[$key]['Produto']['altura'] =
                    $this->formatarFloat($val['Produto']['altura']);

            if (isset($val['Produto']['largura']))
                $resultados[$key]['Produto']['largura'] =
                    $this->formatarFloat($val['Produto']['largura']);

            if (isset($val['Produto']['comprimento']))
                $resultados[$key]['Produto']['comprimento'] =
                    $this->formatarFloat($val['Produto']['comprimento']);


            if (isset($val['Produto']['id'])):
                $resultados[$key]['Imagem'] =
                    $this->getImagens($val['Produto']['id']);
                
                $Variacao = Classregistry::init('Variacao');
                $resultados[$key]['Variacao']
                    = $Variacao->getFormatada($val['Produto']['id']);
            endif;
        }

        return $resultados;
    }
}