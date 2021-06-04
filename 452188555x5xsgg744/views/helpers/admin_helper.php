<?php
class AdminHelperHelper extends HtmlHelper {
    public function submitButton($value = null, $class = null) {
        $options = array(
            'type' => 'submit',
            'class' => 'btn',
        );

        if(!is_null($class)) {
            $options['class'] .= ' ' . $class;
        }

        return $this->tag('button', $value, $options);
    }

    public function excluirSelecionadosButton($mensagem) {
        echo "<input type=\"submit\"
                     class=\"btn danger\"
                     value=\"Excluir Selecionados\"
                     onclick=\"javascript:return confirm('{$mensagem}');\" />";
    }
}