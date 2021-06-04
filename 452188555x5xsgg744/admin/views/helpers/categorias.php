<?php
class CategoriasHelper extends HtmlHelper {
    public function getPath($id, $comLinks = true) {
        App::import('model','Categoria');
        $Categoria = new Categoria();

        $path = $Categoria->getpath($id);

        $out = array();
        foreach ($path AS $step):
            if ($comLinks):
                $out[] = $this->link(
                    $step['Categoria']['titulo'],
                    array(
                        'controller' => 'produtos',
                        'action' => 'index',
                        'categoria' => $step['Categoria']['id'],
                    ),
                    array(
                        'title' => 'Produtos da categoria &ldquo;' . $step['Categoria']['titulo'] . '&rdquo;',
                        'escape' => false,
                    )
                );
            else:
                $out[] = $step['Categoria']['titulo'];
            endif;
        endforeach;

        return implode(' » ', $out);
    }
}