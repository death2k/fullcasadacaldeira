<?php

// Insert View Meta Boxes
function porto_page_view_meta_boxes() {
    
    global $page_view_meta_boxes;

    porto_show_meta_boxes($page_view_meta_boxes);
}

// Insert Skin Meta Boxes
function porto_page_skin_meta_boxes() {

    global $page_skin_meta_boxes;

    porto_show_meta_boxes($page_skin_meta_boxes);
}

function porto_add_page_meta_box() {
    global $porto_settings;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'view-meta-boxes', __('View Options', 'porto'), 'porto_page_view_meta_boxes', 'page', 'normal', 'low' );
        if ($porto_settings['show-content-type-skin']) {
            add_meta_box( 'skin-meta-boxes', __('Skin Options', 'porto'), 'porto_page_skin_meta_boxes', 'page', 'normal', 'low' );
        }
    }
}

// Save View Metas
function porto_page_view_save_postdata( $post_id ) {
    global $page_view_meta_boxes;
    
    return porto_save_postdata( $post_id, $page_view_meta_boxes );
}

// Save Skin Metas
function porto_page_skin_save_postdata( $post_id ) {
    global $page_skin_meta_boxes;

    return porto_save_postdata( $post_id, $page_skin_meta_boxes );
}

// Get Page Metas
function porto_page_get_postdata() {
    global $page_view_meta_boxes, $page_skin_meta_boxes;

    // Page Meta Boxes
    $page_view_meta_boxes = porto_ct_default_meta_view_boxes();
    $page_skin_meta_boxes = porto_ct_default_meta_skin_boxes();

    // Layout
    $page_view_meta_boxes['layout']['default'] = 'fullwidth';

    // Get menus
    $menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
    $menu_options = array();
    if (!empty($menus)) {
        foreach ($menus as $menu) {
            $menu_options[$menu->term_id] = $menu->name;
        }
    }

    // Select main menu
    $page_view_meta_boxes = array_insert_before('default', $page_view_meta_boxes, "main_menu", array(
        "name" => "main_menu",
        "title" => __("Main Menu", 'porto'),
        "desc" => __("Select the main menu you would like to display.", 'porto'),
        "type" => "select",
        "default" => "",
        "options" => $menu_options
    ));
}

add_action('add_meta_boxes', 'porto_add_page_meta_box');
add_action('admin_menu', 'porto_page_get_postdata');
add_action('save_post', 'porto_page_view_save_postdata');
add_action('save_post', 'porto_page_skin_save_postdata');

