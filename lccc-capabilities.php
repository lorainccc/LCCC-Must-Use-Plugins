<?php

/*
 Plugin Name: LCCC Capabilities
 Description: Adds Custom LCCC Editor and LCCC Advanced Editor Roles
*/

 // Create LCCC Editor Role - Define Capabilities

  function lccc_editor_set_capabilities(){
    add_role(
    'lccc_editor',         // Role Slug
    __( 'LCCC Editor' ),   // Role Name/Label
    array(                 // Role Capabilities
     'delete_others_pages'           => true,
     'delete_others_posts'           => true,
     'delete_pages'                  => true,
     'delete_posts'                  => true,
     'delete_private_pages'          => true,
     'delete_private_posts'          => true,
     'delete_published_pages'        => true,
     'delete_published_posts'        => true,
     'edit_others_pages'             => true,
     'edit_others_posts'             => true,
     'edit_pages'                    => true,
     'edit_posts'                    => true,
     'edit_private_pages'            => true,
     'edit_private_posts'            => true,
     'edit_published_pages'          => true,
     'edit_published_posts'          => true,
     'manage_categories'             => true,
     'manage_links'                  => true,
     'moderate_comments'             => true,
     'read'                          => true,
     'read_private_pages'            => true,
     'read_private_posts'            => true,
     'unfiltered_html'               => true,
     'upload_files'                  => true,
     'edit_theme_options'            => true,
     'gravityforms_edit_forms'       => true,
     'gravityforms_create_form'      => true,
     'gravityforms_view_entries'     => true,
     'gravityforms_edit_entries'     => true,
     'gravityforms_delete_entries'   => true,
     'gravityforms_export_entries'   => true,
     'gravityforms_view_entry_notes' => true,
     'gravityforms_edit_entry_notes' => true,
     'gravityforms_view_addons'      => true,
     'gravityforms_preview_forms'    => true,
     'gravityforms_edit_settings'    => true,
     'gravityforms_preview_forms'    => true,
     'gravityforms_view_settings'    => true,
     'lccc_edit'                     => true,
    )
   );
  }
  add_action( 'init', 'lccc_editor_set_capabilities' );


  function lc_add_cap(){
			$role = get_role('lccc_editor');
			$role->add_cap('wpseo_bulk_edit');
			$role->add_cap('delete_others_posts');
			$role->add_cap('delete_posts');
			$role->add_cap('delete_private_posts');
			$role->add_cap('delete_published_posts');
			$role->add_cap('edit_others_posts');			
			$role->add_cap('edit_posts');			
			$role->add_cap('edit_private_posts');					
		}

		add_action( 'admin_init', 'lc_add_cap');

 // Hide various menus and submenus from LCCC Editor Role

function lccc_editor_hide_menu() {
 if(current_user_can('administrator') != true ){
  if(current_user_can('lccc_edit') == true ){

    remove_submenu_page( 'themes.php', 'themes.php' );    // Themes
    remove_submenu_page( 'themes.php', 'widgets.php' );   // Widgets
    remove_menu_page( 'tools.php' );                      // Tools
    remove_menu_page( 'edit-comments.php' );              // Comments
	
			
   global $submenu;
    // Appearance Menu
    unset($submenu['themes.php'][6]); // Customize
    unset($submenu['themes.php'][15]); // Header
    unset($submenu['themes.php'][20]); // Background

   global $wp_admin_bar;
    //Admin Bar
     $wp_admin_bar->remove_menu('customize');
  }
 }
}

add_action('admin_head', 'lccc_editor_hide_menu' );

// Create LCCC Editor Role - Define Capabilities

  function lccc_adv_editor_set_capabilities(){
    add_role(
    'lccc_adv_editor',         // Role Slug
    __( 'LCCC Advanced Editor' ),   // Role Name/Label
    array(                 // Role Capabilities
     'delete_others_pages'           => true,
     'delete_others_posts'           => true,
     'delete_pages'                  => true,
     'delete_posts'                  => true,
     'delete_private_pages'          => true,
     'delete_private_posts'          => true,
     'delete_published_pages'        => true,
     'delete_published_posts'        => true,
     'edit_others_pages'             => true,
     'edit_others_posts'             => true,
     'edit_pages'                    => true,
     'edit_posts'                    => true,
     'edit_private_pages'            => true,
     'edit_private_posts'            => true,
     'edit_published_pages'          => true,
     'edit_published_posts'          => true,
     'manage_categories'             => true,
     'manage_links'                  => true,
     'moderate_comments'             => true,
     'read'                          => true,
     'read_private_pages'            => true,
     'read_private_posts'            => true,
     'unfiltered_html'               => true,
     'upload_files'                  => true,
     'edit_theme_options'            => true,
     'gravityforms_edit_forms'       => true,
     'gravityforms_create_form'      => true,
     'gravityforms_view_entries'     => true,
     'gravityforms_edit_entries'     => true,
     'gravityforms_delete_entries'   => true,
     'gravityforms_export_entries'   => true,
     'gravityforms_view_entry_notes' => true,
     'gravityforms_edit_entry_notes' => true,
     'gravityforms_view_addons'      => true,
     'gravityforms_preview_forms'    => true,
     'gravityforms_edit_settings'    => true,
     'gravityforms_preview_forms'    => true,
     'gravityforms_view_settings'    => true,
     'lccc_adv_edit'                 => true,
    )
   );
  }
  add_action( 'init', 'lccc_adv_editor_set_capabilities' );

  function lc_adv_add_cap(){
			$role = get_role('lccc_adv_editor');
			$role->add_cap('wpseo_bulk_edit');
			$role->add_cap('delete_others_posts');
			$role->add_cap('delete_posts');
			$role->add_cap('delete_private_posts');
			$role->add_cap('delete_published_posts');
			$role->add_cap('edit_others_posts');			
			$role->add_cap('edit_posts');			
			$role->add_cap('edit_private_posts');					
		}

		add_action( 'admin_init', 'lc_adv_add_cap');

 // Hide various menus and submenus from LCCC Editor Role

function lccc_adv_editor_hide_menu() {
 if(current_user_can('administrator') != true ){
  if(current_user_can('lccc_adv_edit') == true ){

    remove_submenu_page( 'themes.php', 'themes.php' );    // Themes
    remove_menu_page( 'tools.php' );                      // Tools
    remove_menu_page( 'edit-comments.php' );              // Comments

   global $submenu;
    // Appearance Menu
    unset($submenu['themes.php'][6]); // Customize
    unset($submenu['themes.php'][15]); // Header
    unset($submenu['themes.php'][20]); // Background

   global $wp_admin_bar;
    //Admin Bar
     $wp_admin_bar->remove_menu('customize');
  }
 }
}

add_action('admin_head', 'lccc_adv_editor_hide_menu' );
?>