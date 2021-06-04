<?php

add_action('vc_build_admin_page', 'porto_load_shortcodes');
add_action('vc_after_init', 'porto_load_shortcodes');

function porto_load_shortcodes() {

    if ( function_exists('vc_map') ) {
        /* ---------------------------- */
        /* Customize Tabs, Tab
        /* ---------------------------- */
        vc_remove_param('vc_tabs', 'interval');
        vc_add_param('vc_tabs', array(
            'type' => 'dropdown',
            'heading' => __('Position', 'porto'),
            'param_name' => 'position',
            'value' => porto_vc_commons('tabs'),
            'description' => __('Select the position of the tab header.', 'porto'),
            'admin_label' => true
        ));
        vc_add_param('vc_tabs', array(
            'type' => 'colorpicker',
            'heading' => __('Color', 'porto'),
            'param_name' => 'color'
        ));
        vc_add_param('vc_tabs', array(
            'type' => 'dropdown',
            'heading' => __('Type', 'porto'),
            'param_name' => 'type',
            'value' => porto_vc_commons('tabs_type'),
            'admin_label' => true
        ));
        vc_add_param('vc_tabs', array(
            'type' => 'dropdown',
            'heading' => __('Icon Style', 'porto'),
            'param_name' => 'icon_style',
            'value' => porto_vc_commons('tabs_icon_style'),
            'admin_label' => true,
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'tabs-simple' )
            ),
        ));
        vc_add_param('vc_tabs', array(
            'type' => 'dropdown',
            'heading' => __('Icon Effect', 'porto'),
            'param_name' => 'icon_effect',
            'value' => porto_vc_commons('tabs_icon_effect'),
            'admin_label' => true,
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'tabs-simple' )
            ),
        ));
        vc_add_param('vc_tab', array(
            'type' => 'checkbox',
            'heading' => __('Show FontAwesome Icon', 'porto'),
            'param_name' => 'show_icon',
            'value' => array(__('Yes, please', 'js_composer') => 'yes'),
            'description' => ''
        ));
        vc_add_param('vc_tab', array(
            'type' => 'iconpicker',
            'heading' => __('Select FontAwesome Icon', 'porto'),
            'param_name' => 'icon',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));
        vc_add_param('vc_tab', array(
            'type' => 'colorpicker',
            'heading' => __('Icon Color', 'porto'),
            'param_name' => 'icon_color',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));
        vc_add_param('vc_tab', array(
            'type' => 'colorpicker',
            'heading' => __('Icon Background Color', 'porto'),
            'param_name' => 'icon_bg_color',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));
        vc_add_param('vc_tab', array(
            'type' => 'colorpicker',
            'heading' => __('Icon Border Color', 'porto'),
            'param_name' => 'icon_border_color',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));
        vc_add_param('vc_tab', array(
            'type' => 'colorpicker',
            'heading' => __('Icon Wrap Border Color', 'porto'),
            'param_name' => 'icon_wrap_border_color',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));
        vc_add_param('vc_tab', array(
            'type' => 'colorpicker',
            'heading' => __('Icon Box Shadow Color', 'porto'),
            'param_name' => 'icon_shadow_color',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));
        vc_add_param('vc_tab', array(
            'type' => 'colorpicker',
            'heading' => __('Icon Hover Color', 'porto'),
            'param_name' => 'icon_hcolor',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));
        vc_add_param('vc_tab', array(
            'type' => 'colorpicker',
            'heading' => __('Icon Hover Background Color', 'porto'),
            'param_name' => 'icon_hbg_color',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));
        vc_add_param('vc_tab', array(
            'type' => 'colorpicker',
            'heading' => __('Icon Hover Border Color', 'porto'),
            'param_name' => 'icon_hborder_color',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));
        vc_add_param('vc_tab', array(
            'type' => 'colorpicker',
            'heading' => __('Icon Wrap Hover Border Color', 'porto'),
            'param_name' => 'icon_wrap_hborder_color',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));
        vc_add_param('vc_tab', array(
            'type' => 'colorpicker',
            'heading' => __('Icon Hover Box Shadow Color', 'porto'),
            'param_name' => 'icon_hshadow_color',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));


        /* ---------------------------- */
        /* Customize Tour
        /* ---------------------------- */
        vc_remove_param('vc_tour', 'interval');
        vc_add_param('vc_tour', array(
            'type' => 'dropdown',
            'heading' => __('Position', 'porto'),
            'param_name' => 'position',
            'value' => porto_vc_commons('tour'),
            'description' => __('Select the position of the tab header.', 'porto'),
            'admin_label' => true
        ));
        vc_add_param('vc_tour', array(
            'type' => 'colorpicker',
            'heading' => __('Color', 'porto'),
            'param_name' => 'color'
        ));
        vc_add_param('vc_tour', array(
            'type' => 'dropdown',
            'heading' => __('Type', 'porto'),
            'param_name' => 'type',
            'value' => porto_vc_commons('tour_type'),
            'admin_label' => true
        ));

        /* ---------------------------- */
        /* Customize Separator
        /* ---------------------------- */
        vc_add_param('vc_separator', array(
            'type' => 'checkbox',
            'heading' => __('Show Gradient', 'porto'),
            'param_name' => 'gradient',
            'std' => 'yes',
            'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
        ));
        vc_add_param('vc_separator', array(
            'type' => 'dropdown',
            'heading' => __('Gap Size', 'porto'),
            'param_name' => 'gap',
            'value' => porto_vc_commons('separator')
        ));

        /* ---------------------------- */
        /* Customize Text Separator
        /* ---------------------------- */
        vc_add_param('vc_text_separator', array(
            'type' => 'checkbox',
            'heading' => __('Show Gradient', 'porto'),
            'param_name' => 'gradient',
            'std' => 'yes',
            'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
        ));

        /* ---------------------------- */
        /* Customize Accordion, Accordion Tab
        /* ---------------------------- */
        vc_remove_param('vc_accordion', 'disable_keyboard');
        vc_add_param('vc_accordion', array(
            'type' => 'dropdown',
            'heading' => __('Type', 'porto'),
            'param_name' => 'type',
            'value' => porto_vc_commons('accordion'),
        ));
        vc_add_param('vc_accordion', array(
            'type' => 'dropdown',
            'heading' => __('Size', 'porto'),
            'param_name' => 'size',
            'value' => porto_vc_commons('accordion_size'),
        ));
        vc_add_param('vc_accordion', array(
            'type' => 'colorpicker',
            'heading' => __('Heading Color', 'porto'),
            'param_name' => 'heading_color',
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
        ));
        vc_add_param('vc_accordion', array(
            'type' => 'colorpicker',
            'heading' => __('Heading Background Color', 'porto'),
            'param_name' => 'heading_bg_color',
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
        ));
        vc_add_param('vc_accordion_tab', array(
            'type' => 'checkbox',
            'heading' => __('Show FontAwesome Icon', 'porto'),
            'param_name' => 'show_icon',
            'value' => array(__('Yes, please', 'js_composer') => 'yes'),
            'description' => ''
        ));
        vc_add_param('vc_accordion_tab', array(
            'type' => 'iconpicker',
            'heading' => __('Select FontAwesome Icon', 'porto'),
            'param_name' => 'icon',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));

        /* ---------------------------- */
        /* Customize Toggle
        /* ---------------------------- */
        vc_remove_param('vc_toggle', 'style');
        vc_remove_param('vc_toggle', 'color');
        vc_remove_param('vc_toggle', 'size');
        vc_add_param('vc_toggle', array(
            'type' => 'checkbox',
            'heading' => __('Show FontAwesome Icon', 'porto'),
            'param_name' => 'show_icon',
            'value' => array(__('Yes, please', 'js_composer') => 'yes'),
            'description' => ''
        ));
        vc_add_param('vc_toggle', array(
            'type' => 'iconpicker',
            'heading' => __('Select FontAwesome Icon', 'porto'),
            'param_name' => 'icon',
            'dependency' => array('element' => 'show_icon', 'not_empty' => true)
        ));

        /* ---------------------------- */
        /* Customize Buttons
        /* ---------------------------- */
        vc_add_param('vc_button', array(
            'type' => 'checkbox',
            'heading' => __('Disable', 'porto'),
            'param_name' => 'disabled',
            'value' => array(__('Disable button.', 'porto') => 'yes')
        ));
        vc_add_param('vc_button', array(
            'type' => 'checkbox',
            'heading' => __('Show as Label', 'porto'),
            'param_name' => 'label',
            'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
        ));
        vc_add_param('vc_btn', array(
            'type' => 'checkbox',
            'heading' => __('Show as Label', 'porto'),
            'param_name' => 'label',
            'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
        ));

        /* ---------------------------- */
        /* Add Single Image Parameters
        /* ---------------------------- */
        vc_add_param('vc_single_image', array(
            'type' => 'checkbox',
            'heading' => __('LightBox', 'porto'),
            'param_name' => 'lightbox',
            'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
            'dependency' => array('element' => 'img_link_large', 'not_empty' => true),
            'description' => __('Check it if you want to link to the lightbox with the large image.', 'porto')
        ));
        vc_add_param('vc_single_image', array(
            'type' => 'checkbox',
            'heading' => __('Show Zoom Icon', 'porto'),
            'param_name' => 'zoom_icon',
            'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
            'dependency' => array('element' => 'img_link_large', 'not_empty' => true)
        ));

        /* ---------------------------- */
        /* Customize Pie Chart
        /* ---------------------------- */
        vc_remove_param('vc_pie', 'color');

        // Used in 'Button', 'Call __( 'Blue', 'js_composer' )to Action', 'Pie chart' blocks
        $colors_arr = array(
            __( 'Grey', 'js_composer' ) => 'wpb_button',
            __( 'Blue', 'js_composer' ) => 'btn-primary',
            __( 'Turquoise', 'js_composer' ) => 'btn-info',
            __( 'Green', 'js_composer' ) => 'btn-success',
            __( 'Orange', 'js_composer' ) => 'btn-warning',
            __( 'Red', 'js_composer' ) => 'btn-danger',
            __( 'Black', 'js_composer' ) => 'btn-inverse'
        );

        vc_add_param('vc_pie', array(
            'type' => 'dropdown',
            'heading' => __('Type', 'porto'),
            'param_name' => 'type',
            'value' => array(
                __('Custom', 'porto') => 'custom',
                __('Default', 'porto') => 'default',
            ),
            'description' => __( 'Select pie chart type.', 'porto' ),
            'admin_label' => true
        ));
        vc_add_param('vc_pie', array(
            'type' => 'dropdown',
            'heading' => __( 'Bar color (default)', 'porto' ),
            'param_name' => 'color',
            'value' => $colors_arr, //$pie_colors,
            'description' => __( 'Select pie chart color.', 'js_composer' ),
            'admin_label' => true,
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'default' )
            ),
            'param_holder_class' => 'vc_colored-dropdown'
        ));
        vc_add_param('vc_pie', array(
            'type' => 'textfield',
            'heading' => __('Size', 'porto'),
            'param_name' => 'size',
            'std' => 175,
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
            'description' => __('Enter the size of the chart in px.', 'porto')
        ));
        vc_add_param('vc_pie', array(
            'type' => 'colorpicker',
            'heading' => __('Track Color', 'porto'),
            'param_name' => 'trackcolor',
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
            'description' => __('Choose the color of the track. Please clear this if you want to use the default color.', 'porto')
        ));
        vc_add_param('vc_pie', array(
            'type' => 'colorpicker',
            'heading' => __('Bar color (custom)', 'porto'),
            'param_name' => 'barcolor',
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
            'description' => __('Select pie chart color. Please clear this if you want to use the default color.', 'porto'),
            'admin_label' => true
        ));
        vc_add_param('vc_pie', array(
            'type' => 'textfield',
            'heading' => __('Animation Speed', 'porto'),
            'param_name' => 'speed',
            'std' => 2500,
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
            'description' => __('Enter the animation speed in milliseconds.', 'porto')
        ));
        vc_add_param('vc_pie', array(
            'type' => 'textfield',
            'heading' => __('Line Width', 'porto'),
            'param_name' => 'line',
            'std' => 14,
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
            'description' => __('Enter the width of the line bar in px.', 'porto')
        ));
        vc_add_param('vc_pie', array(
            'type' => 'dropdown',
            'heading' => __('Line Cap', 'porto'),
            'param_name' => 'linecap',
            'value' => array(__('Round', 'porto') => 'round', __('Square', 'porto') => 'square'),
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
            'description' => __('Choose how the ending of the bar line looks like.', 'porto')
        ));
    }
}

if (!function_exists('porto_vc_commons')) {
    function porto_vc_commons($asset = '') {
        switch ($asset) {
            case 'accordion':         return Porto_VcSharedLibrary::getAccordionType();
            case 'accordion_size':    return Porto_VcSharedLibrary::getAccordionSize();
            case 'toggle_type':       return Porto_VcSharedLibrary::getToggleType();
            case 'toggle_size':       return Porto_VcSharedLibrary::getToggleSize();
            case 'align':             return Porto_VcSharedLibrary::getTextAlign();
            case 'tabs':              return Porto_VcSharedLibrary::getTabsPositions();
            case 'tabs_type':         return Porto_VcSharedLibrary::getTabsType();
            case 'tabs_icon_style':   return Porto_VcSharedLibrary::getTabsIconStyle();
            case 'tabs_icon_effect':  return Porto_VcSharedLibrary::getTabsIconEffect();
            case 'tour':              return Porto_VcSharedLibrary::getTourPositions();
            case 'tour_type':         return Porto_VcSharedLibrary::getTourType();
            case 'separator':         return Porto_VcSharedLibrary::getSeparator();
            case 'blog_layout':       return Porto_VcSharedLibrary::getBlogLayout();
            case 'blog_grid_columns': return Porto_VcSharedLibrary::getBlogGridColumns();
            case 'portfolio_layout':  return Porto_VcSharedLibrary::getPortfolioLayout();
            case 'portfolio_grid_columns': return Porto_VcSharedLibrary::getPortfolioGridColumns();
            case 'portfolio_grid_view':    return Porto_VcSharedLibrary::getPortfolioGridView();
            case 'products_view_mode':     return Porto_VcSharedLibrary::getProductsViewMode();
            case 'products_columns':       return Porto_VcSharedLibrary::getProductsColumns();
            case 'products_column_width':  return Porto_VcSharedLibrary::getProductsColumnWidth();
            case 'products_addlinks_pos':  return Porto_VcSharedLibrary::getProductsAddlinksPos();
            case 'product_view_mode':      return Porto_VcSharedLibrary::getProductViewMode();
            case 'content_boxes_bg_type':    return Porto_VcSharedLibrary::getContentBoxesBgType();
            case 'content_boxes_style':      return Porto_VcSharedLibrary::getContentBoxesStyle();
            case 'content_box_effect':     return Porto_VcSharedLibrary::getContentBoxEffect();
            default: return array();
        }
    }
}

if (!class_exists('Porto_VcSharedLibrary')) {

    class Porto_VcSharedLibrary {

        public static function getTextAlign() {
            return array(
                __('None', 'porto') => '',
                __('Left', 'porto' ) => 'left',
                __('Right', 'porto' ) => 'right',
                __('Center', 'porto' ) => 'center',
                __('Justify', 'porto' ) => 'justify'
            );
        }

        public static function getTabsPositions() {
            return array(
                __('Top left', 'porto' ) => '',
                __('Top right', 'porto' ) => 'top-right',
                __('Bottom left', 'porto' ) => 'bottom-left',
                __('Bottom right', 'porto' ) => 'bottom-right',
                __('Top justify', 'porto' ) => 'top-justify',
                __('Bottom justify', 'porto' ) => 'bottom-justify',
                __('Top center', 'porto' ) => 'top-center',
                __('Bottom center', 'porto' ) => 'bottom-center',
            );
        }

        public static function getTabsType() {
            return array(
                __('Default', 'porto' ) => '',
                __('Simple', 'porto' ) => 'tabs-simple'
            );
        }

        public static function getTabsIconStyle() {
            return array(
                __('Default', 'porto' ) => '',
                __('Style 1', 'porto' ) => 'featured-boxes-style-1',
                __('Style 2', 'porto' ) => 'featured-boxes-style-2',
                __('Style 3', 'porto' ) => 'featured-boxes-style-3',
                __('Style 4', 'porto' ) => 'featured-boxes-style-4',
                __('Style 5', 'porto' ) => 'featured-boxes-style-5',
                __('Style 6', 'porto' ) => 'featured-boxes-style-6',
                __('Style 7', 'porto' ) => 'featured-boxes-style-7',
                __('Style 8', 'porto' ) => 'featured-boxes-style-8',
            );
        }

        public static function getTabsIconEffect() {
            return array(
                __('Default', 'porto' ) => '',
                __('Effect 1', 'porto' ) => 'featured-box-effect-1',
                __('Effect 2', 'porto' ) => 'featured-box-effect-2',
                __('Effect 3', 'porto' ) => 'featured-box-effect-3',
                __('Effect 4', 'porto' ) => 'featured-box-effect-4',
                __('Effect 5', 'porto' ) => 'featured-box-effect-5',
                __('Effect 6', 'porto' ) => 'featured-box-effect-6',
                __('Effect 7', 'porto' ) => 'featured-box-effect-7',
            );
        }

        public static function getTourPositions() {
            return array(
                __('Left', 'porto' ) => 'vertical-left',
                __('Right', 'porto' ) => 'vertical-right',
            );
        }

        public static function getTourType() {
            return array(
                __('Default', 'porto' ) => '',
                __('Navigation', 'porto' ) => 'tabs-navigation',
            );
        }

        public static function getSeparator() {
            return array(
                __('Normal', 'porto' ) => '',
                __('Short', 'porto' ) => 'short',
                __('Tall', 'porto' ) => 'tall',
                __('Taller', 'porto' ) => 'taller',
            );
        }

        public static function getAccordionType() {
            return array(
                __('Default', 'porto' ) => 'panel-default',
                __('Secondary', 'porto' ) => 'secondary',
                __('Without Background', 'porto' ) => 'without-bg',
                __('Without Borders and Background', 'porto' ) => 'without-bg without-borders',
                __('Custom', 'porto' ) => 'custom',
            );
        }

        public static function getAccordionSize() {
            return array(
                __('Default', 'porto' ) => '',
                __('Small', 'porto' ) => 'panel-group-sm',
                __('Large', 'porto' ) => 'panel-group-lg',
            );
        }

        public static function getToggleType() {
            return array(
                __('Default', 'porto' ) => '',
                __('Simple', 'porto' ) => 'toggle-simple'
            );
        }

        public static function getToggleSize() {
            return array(
                __('Default', 'porto' ) => '',
                __('Small', 'porto' ) => 'toggle-sm',
                __('Large', 'porto' ) => 'toggle-lg',
            );
        }

        public static function getBlogLayout() {
            return array(
                __('Full', 'porto' ) => 'full',
                __('Large', 'porto' ) => 'large',
                __('Large Alt', 'porto' ) => 'large-alt',
                __('Medium', 'porto' ) => 'medium',
                __('Grid', 'porto' ) => 'grid',
                __('Timeline', 'porto' ) => 'timeline'
            );
        }

        public static function getBlogGridColumns() {
            return array(
                __('2', 'porto' ) => '2',
                __('3', 'porto' ) => '3',
                __('4', 'porto' ) => '4'
            );
        }

        public static function getPortfolioLayout() {
            return array(
                __('Grid', 'porto' ) => 'grid',
                __('Timeline', 'porto' ) => 'timeline',
                __('Medium', 'porto' ) => 'medium',
                __('Large', 'porto' ) => 'large',
                __('Full', 'porto' ) => 'full'
            );
        }

        public static function getPortfolioGridColumns() {
            return array(
                __('2', 'porto' ) => '2',
                __('3', 'porto' ) => '3',
                __('4', 'porto' ) => '4',
                __('5', 'porto' ) => '5',
                __('6', 'porto' ) => '6'
            );
        }

        public static function getPortfolioGridView() {
            return array(
                __('Classic', 'porto' ) => '',
                __('Full', 'porto' ) => 'full'
            );
        }

        public static function getProductsViewMode() {
            return array(
                __( 'Grid', 'porto' )=> 'grid',
                __( 'List', 'porto' ) => 'list',
                __( 'Slider', 'porto' )  => 'products-slider',
            );
        }

        public static function getProductsColumns() {
            return array(
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
                '6' => 6,
                '7 ' . __( '(without sidebar)', 'porto' ) => 7,
                '8 ' . __( '(without sidebar)', 'porto' ) => 8
            );
        }

        public static function getProductsColumnWidth() {
            return array(
                __( 'Default', 'porto' ) => '',
                '1/1' . __( ' of content width', 'porto' ) => 1,
                '1/2' . __( ' of content width', 'porto' ) => 2,
                '1/3' . __( ' of content width', 'porto' ) => 3,
                '1/4' . __( ' of content width', 'porto' ) => 4,
                '1/5' . __( ' of content width', 'porto' ) => 5,
                '1/6' . __( ' of content width', 'porto' ) => 6,
                '1/7' . __( ' of content width (without sidebar)', 'porto' ) => 7,
                '1/8' . __( ' of content width (without sidebar)', 'porto' ) => 8
            );
        }

        public static function getProductsAddlinksPos() {
            return array(
                __( 'Default', 'porto' ) => '',
                __( 'Out of Image', 'porto' ) => 'outimage',
                __( 'On Image', 'porto' ) => 'onimage'
            );
        }

        public static function getProductViewMode() {
            return array(
                __( 'Grid', 'porto' )=> 'grid',
                __( 'List', 'porto' ) => 'list',
            );
        }

        public static function getContentBoxesBgType() {
            return array(
                __( 'Default', 'porto' )=> '',
                __( 'Flat', 'porto' ) => 'featured-boxes-flat',
                __( 'Custom', 'porto' ) => 'featured-boxes-custom',
            );
        }

        public static function getContentBoxesStyle() {
            return array(
                __('Default', 'porto' ) => '',
                __('Style 1', 'porto' ) => 'featured-boxes-style-1',
                __('Style 2', 'porto' ) => 'featured-boxes-style-2',
                __('Style 3', 'porto' ) => 'featured-boxes-style-3',
                __('Style 4', 'porto' ) => 'featured-boxes-style-4',
                __('Style 5', 'porto' ) => 'featured-boxes-style-5',
                __('Style 6', 'porto' ) => 'featured-boxes-style-6',
                __('Style 7', 'porto' ) => 'featured-boxes-style-7',
                __('Style 8', 'porto' ) => 'featured-boxes-style-8',
            );
        }

        public static function getContentBoxEffect() {
            return array(
                __('Default', 'porto' ) => '',
                __('Effect 1', 'porto' ) => 'featured-box-effect-1',
                __('Effect 2', 'porto' ) => 'featured-box-effect-2',
                __('Effect 3', 'porto' ) => 'featured-box-effect-3',
                __('Effect 4', 'porto' ) => 'featured-box-effect-4',
                __('Effect 5', 'porto' ) => 'featured-box-effect-5',
                __('Effect 6', 'porto' ) => 'featured-box-effect-6',
                __('Effect 7', 'porto' ) => 'featured-box-effect-7',
            );
        }
    }
}