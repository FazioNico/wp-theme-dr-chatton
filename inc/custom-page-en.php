<?php

function page_en_module() {
  $labels = array(
		'name'                => _x( 'EN: Pages', 'Pages', 'text_domain' ),
		'singular_name'       => _x( 'EN | Page', 'Page', 'text_domain' ),
		'menu_name'           => __( 'EN | Pages', 'text_domain' ),
		//'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All pages', 'text_domain' ),
		'view_item'           => __( 'View page', 'text_domain' ),
		'add_new_item'        => __( 'Add New page', 'text_domain' ),
		'add_new'             => __( 'Add page', 'text_domain' ),
		'edit_item'           => __( 'Edit page', 'text_domain' ),
		'update_item'         => __( 'Update page', 'text_domain' ),
		'search_items'        => __( 'Search page', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
    'label'           => __('EN: Pages'),
		'labels'          => $labels,
		'singular_label'  => __('EN: Page'),
    'has_archive'     => true,
		'public'          => true,
		'show_ui'         => true,
		'_builtin'        => false, // It's a custom post type, not built in
		'_edit_link'      => 'post.php?post=%d',
		'capability_type' => 'page',
    'menu_icon'       => 'dashicons-admin-page',
    'menu_position'   => 20,
		'hierarchical'    => true,
		'rewrite'         => array("slug" => "en"),
		'query_var'       => "en", // This goes to the WP_Query schema
		'supports'        => array('title', 'editor', 'page-attributes', 'post-formats')
	);
	register_post_type( 'en' , $args ); // enregistrement de l'entité projet basé sur les arguments ci-dessus
	add_action('save_post', 'save_page_en'); //function pour la sauvegarde de nos champs personnalisés
}
add_action('init', 'page_en_module', 0);

function save_page_en(){

}
