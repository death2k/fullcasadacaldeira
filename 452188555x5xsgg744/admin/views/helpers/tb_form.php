<?php
class TbFormHelper extends FormHelper {
    public function create($model = null, $options = array()) {
        $options['inputDefaults'] = array(
            'div' => array(
                'class' => 'clearfix'
            ),
            'error' => array(
                'wrap' => 'span',
                'class' => 'help-inline',
            ),
            'between' => '<div class="input">',
            'after' => '</div>',
            'format' => array(
                'before', 'label', 'between', 'input', 'error', 'after'
            ),
        );

        echo parent::create($model, $options);
    }
}
