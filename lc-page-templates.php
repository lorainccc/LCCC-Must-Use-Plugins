<?php
add_filter( 'manage_pages_columns', 'lc_columns_head');
add_action( 'manage_pages_custom_column', 'lc_list_page_template', 10, 2);

function lc_columns_head($defaults){
	$defaults['lc_page_template'] = 'Page Template';
	$defaults['lc_content_age']	  = 'Content Age';
	return $defaults;
}

function lc_list_page_template( $column_name, $post_id ){
 if ( $column_name == 'lc_page_template' ){
		$page_template = get_post_meta( $post_id, '_wp_page_template', true);
		
		switch($page_template){
			case 'default':
				echo 'Default Page';
				break;
				
			case 'blank.php':
				echo 'Blank Page';
				break;
				
			case 'academic-calendar.php':
				echo 'Academic Calendar Page';
				break;
				
			case 'crime-log.php':
				echo 'Crime Log Page';
				break;
				
			case 'standard-subpage.php':
				echo 'Standard Sub Page';
				break;
			
			case 'dept-div.php';
				echo 'Department/Division Page';
				break;
	
			case 'president.php';
				echo 'LCCC President Home Page';
				break;
				
			case 'programs.php';
				echo 'Program Pathways Page';
				break;
			
			case 'programs-nolinks.php';
				echo 'Program Pathways Page - Without Links';
				break;
				
			case 'standard-subpage-no-leftnav.php';
				echo 'Standard Sub Page - No Left Navigation';
				break;

			case 'podcasts.php'
				echo 'Podcast Episode Listing';
				break;
				
			// Kiwi Templates
				
			case 'templates/template-audience.php';
				echo 'Audience Focused Page';
				break;
				
			case 'templates/template-full-width.php';
				echo 'Full-Width Page (No Sidebar)';
				break;
				
			case 'templates/template-overview.php';
				echo 'Overview Page';
				break;
				
			case 'templates/template-contact.php';
				echo 'Contact Page';
				break;
			
			case 'templates/template-home.php';
				echo 'Home Page';
				break;
				
			default:
				echo $page_template;
				
		}
		
	} elseif($column_name == 'lc_content_age') {
		if ( 'content_age' === $lc_column_name )
		$date_format = 'Y/m/d';
		$modified_date = date_create(get_the_modified_date($date_format, $post));
		$current_date = date_create(date());
	
		$interval = $modified_date->diff($current_date);
		$num_days = $interval->format('%a');
		if($num_days > 180) {
			echo '<span style="color: #7f0000;font-weight: 700;">'. $num_days . ' Days</span>';
		} elseif( ($num_days) < 180 && ($num_days) > 90 ) {
			echo '<span style="color: #aa6000;font-weight: 500;">'. $num_days . ' Days</span>';
		} elseif( ($num_days) < 90 ) {
			echo $num_days . ' Days';
		}
		return $lc_column_name;
	}
}


// Add the custom column to the post type
add_filter( 'manage_pages_columns', 'lc_add_last_modified_column' );
add_filter( 'manage_posts_columns', 'lc_add_last_modified_column' );
function lc_add_last_modified_column( $columns ) {
    $columns['modified'] = 'Last Modified';

    return $columns;
}

// Add the data to the custom column
add_action( 'manage_pages_custom_column' , 'lc_add_last_modified_data', 10, 2 );
add_action( 'manage_posts_custom_column' , 'lc_add_last_modified_data', 10, 2 );
function lc_add_last_modified_data( $column, $post_id ) {
    switch ( $column ) {
        case 'modified' :
			$date_format = 'Y/m/d';
			$post = get_post( $post_id );
			echo get_the_modified_date( $date_format, $post ); // the data that is displayed in the column
            break;
    }
}

// Make the custom column sortable
add_filter( 'manage_edit-page_sortable_columns', 'lc_add_last_modified_make_sortable' );
add_filter( 'manage_edit-post_sortable_columns', 'lc_add_last_modified_make_sortable' );
add_filter( 'manage_edit-lc_program_paths_sortable_columns', 'lc_add_last_modified_make_sortable' );
add_filter( 'manage_edit-lccc_events_sortable_columns', 'lc_add_last_modified_make_sortable' );
add_filter( 'manage_edit-lccc_announcement_sortable_columns', 'lc_add_last_modified_make_sortable' );
add_filter( 'manage_edit-student_news_sortable_columns', 'lc_add_last_modified_make_sortable' );
add_filter( 'manage_edit-badges_sortable_columns', 'lc_add_last_modified_make_sortable' );
function lc_add_last_modified_make_sortable( $columns ) {
	$columns['modified'] = 'modified';
	return $columns;
}

// Add custom column sort request to post list page
add_action( 'load-edit.php', 'lc_add_last_modified_sort_request' );
function lc_add_last_modified_sort_request() {
	add_filter( 'request', 'lc_add_last_modified_do_sortable' );
}

// Handle the custom column sorting
function lc_add_last_modified_do_sortable( $vars ) {
	// check if sorting has been applied
	if ( isset( $vars['orderby'] ) && 'modified' == $vars['orderby'] ) {

		// apply the sorting to the post list
		$vars = array_merge(
			$vars,
			array(
				'orderby' => 'post_modified'
			)
		);
	}

	return $vars;
}

?>

