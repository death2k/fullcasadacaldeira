<?php
class Variacao extends AppModel {

    public $order = 'Variacao.id DESC';

    public $validate = array(
        'codigo' => array(
            array(
                'rule' => 'isUnique',
                'message' => 'Esta referência já está cadastrada',
                'allowEmpty' => true,
            ),
        )
    );

    public $belongsTo = array('Produto');
    public $hasMany = array(
        'OpcoesVariacao' => array(
            'dependent' => true
        ),
        'Imagem' => array(
            'dependent' => true,
            'order' => 'Imagem.variacao_id ASC, Imagem.id ASC',
        ),
    );

    public function getImagens($variacao_id) {
        $Imagem = Classregistry::init('Imagem');
        $imagens = $Imagem->find('all', array(
            'conditions' => array(
                'variacao_id' => $variacao_id,
            ),
            'order' => 'id DESC',
        ));

        foreach ($imagens AS $key => $imagem):
            $imagens[$key] = (object) $imagem['Imagem'];
        endforeach;
        
        return $imagens;
    }

    public function getFormatada($produto_id, $variacao_id = null) {
        $return = array();

        $Opcao = Classregistry::init('Opcao');

        $this->unbindModel(array('belongsTo' => array('Produto')));

        if (is_null($variacao_id)):
            $variacoes = $this->findAllByProdutoId($produto_id);
        else:
            $variacoes = $this->find('first', array(
                'conditions' => array(
                    'id' => $variacao_id,
                    'produto_id' => $produto_id,
                )
            ));
            $variacoes = array($variacoes);
        endif;

        foreach ($variacoes AS $variacao):
            $opcoesVariacoes = $variacao['OpcoesVariacao'];
            $variacao = (object) $variacao['Variacao'];

            foreach ($opcoesVariacoes AS $opcoesVariacao):
                $opcao = $Opcao->findbyId($opcoesVariacao['opcao_id']);

                $variacao->tipos_opcoes[] = (object) array_merge(
                    $opcao['TiposOpcao'],
                    array('opcao' => (object) $opcao['Opcao'])
                );
            endforeach;

            $variacao->imagens = $this->getImagens($variacao->id);

            $return[] = $variacao;
        endforeach;

        if (is_null($variacao_id)):
            
            //Tráz para primeiro lugar, a primeira variação que conter uma foto...
            foreach ($return AS $key => $value):
                if (!empty($value->imagens)):
                    $temp = $value;
                    unset($return[$key]);
                    array_unshift($return, $temp);
                    break;
                endif;
            endforeach;

            return $return;
        else:
            return array($return[0]);
        endif;
    }

    public function getListaFormatada($produto_id, $separator = '&nbsp;&nbsp;', $strong = false) {
        $return = array();

        $Opcao = Classregistry::init('Opcao');

        $this->unbindModel(array(
            'belongsTo' => array('Produto'),
            'hasMany' => array('Imagem'),
        ));

        $variacoes = $this->findAllByProdutoId($produto_id);

        foreach ($variacoes AS $variacao):
            $opcoesVariacoes = $variacao['OpcoesVariacao'];
            $variacao = (object) $variacao['Variacao'];

            $item = array();

            foreach ($opcoesVariacoes AS $opcoesVariacao):
                $opcao = (object) $Opcao->findbyId($opcoesVariacao['opcao_id']);

                $temp = $opcao->TiposOpcao['nome'] . ': ';
                if($strong) $temp .= '<strong>';
                    $temp .= $opcao->Opcao['nome'];
                if($strong) $temp .= '</strong>';
                $temp .= ';';

                $item[] = $temp;
            endforeach;

            if($strong):
                $item[] = 'Código: <strong>' . $variacao->codigo . '<strong>;';
            else:
                $item[] = 'Código: ' . $variacao->codigo . ';';
            endif;

            $return[$variacao->id] = implode($separator, $item);
        endforeach;

        return $return;
    }

    public function beforeSave($options) {
        $item = $this->data['Variacao'];

        $item['preco'] = $this->limparDinheiro($item['preco']);
        $item['promocao'] = $this->limparDinheiro($item['promocao']);

        $item['peso'] = $this->limparFloat($item['peso']);
        $item['altura'] = $this->limparFloat($item['altura']);
        $item['largura'] = $this->limparFloat($item['largura']);
        $item['comprimento'] = $this->limparFloat($item['comprimento']);

        $this->data['Variacao'] = $item;
        return true;
    }

    public function afterFind($resultados) {
        foreach ($resultados as $key => $val):
            if (isset($val['Variacao']['preco']))
                $resultados[$key]['Variacao']['preco'] =
                    $this->formatarDinheiro($val['Variacao']['preco']);

            if (isset($val['Variacao']['promocao']))
                $resultados[$key]['Variacao']['promocao'] =
                    $this->formatarDinheiro($val['Variacao']['promocao']);


            if (isset($val['Variacao']['peso']))
                $resultados[$key]['Variacao']['peso'] =
                    $this->formatarFloat($val['Variacao']['peso']);

            if (isset($val['Variacao']['altura']))
                $resultados[$key]['Variacao']['altura'] =
                    $this->formatarFloat($val['Variacao']['altura']);

            if (isset($val['Variacao']['largura']))
                $resultados[$key]['Variacao']['largura'] =
                    $this->formatarFloat($val['Variacao']['largura']);

            if (isset($val['Variacao']['comprimento']))
                $resultados[$key]['Variacao']['comprimento'] =
                    $this->formatarFloat($val['Variacao']['comprimento']);
        endforeach;


        return $resultados;
    }
}
