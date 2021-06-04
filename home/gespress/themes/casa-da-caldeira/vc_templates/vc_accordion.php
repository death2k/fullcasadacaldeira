<?php
//wp_enqueue_script('jquery-ui-accordion');
$output = $title = $interval = $el_class = $collapsible = $type = $heading_color = $header_bg_color = $size = $disable_keyboard = $active_tab = '';

extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'collapsible' => 'no',
    'type' => '',
    'heading_color' => '',
    'heading_bg_color' => '',
    'size' => '',
    'disable_keyboard' => 'no',
    'active_tab' => '1'
), $atts));

$id = 'accordion' . rand();
$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'panel-group '.$el_class.' '.$type.' '.$size, $this->settings['base']);

if ($type == 'custom' && ($heading_color || $heading_bg_color)) {
    $output .= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
    if ($heading_color) $output .= '#' . $id . '.panel-group .panel-heading a { color: ' . $heading_color . ' }';
    if ($heading_bg_color) $output .= '#' . $id . '.panel-group .panel-heading { background-color: ' . $heading_bg_color . ' }';
    $output .= '</style>';
}

$output .= "\n\t".'<div class="'.$css_class.'" id="' . $id . '" data-collapsible="'.$collapsible.'" data-active-tab="'.$active_tab.'">'; //data-interval="'.$interval.'"
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_accordion_heading'));

$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t".'</div> '.$this->endBlockComment('vc_accordion');

echo $output;