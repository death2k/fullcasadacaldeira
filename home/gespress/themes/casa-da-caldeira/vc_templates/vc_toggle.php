<?php
$output = $title = $el_class = $open = $css_animation = '';
extract(shortcode_atts(array(
    'title' => __("Click to toggle", "js_composer"),
    'el_class' => '',
    'open' => 'no',
    'css_animation' => '',
    'show_icon' => false,
    'icon' => '',
), $atts));

$el_class = $this->getExtraClass($el_class);
$el_class .= ( $open == 'true' ) ? ' active' : '';

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'toggle '.$el_class, $this->settings['base']);
$css_class .= $this->getCSSAnimation($css_animation);

$output .= "\n" . '<section class="' . $css_class . '">';
$output .= "\n\t" . '<label>' . ( $show_icon && $icon ? '<i class="' . $icon . '"></i>' : '' ) . $title . '</label>';
$output .= "\n\t" . '<div class="toggle-content">' . wpb_js_remove_wpautop($content, true) . '</div>';
$output .= "\n" . '</section>';

echo $output;