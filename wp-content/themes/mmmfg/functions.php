<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function page_menu_args( $args ) {
    $args['show_home'] = FALSE;
    return $args;
}
add_filter( 'wp_page_menu_args', 'page_menu_args' );