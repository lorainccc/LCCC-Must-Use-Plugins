<?php

add_filter( 'manage_pages_columns', 'lc_columns_head');
add_action( 'manage_pages_custom_column', 'lc_list_page_template', 10, 2);

function lc_columns_head($defaults){
	$defaults['lc_page_template'] = 'Page Template';
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
				case 'Standard Sub Page - No Left Navigation';
				break;
				
			default:
				echo $page_template;
				
		}
		
	}
}

?>

