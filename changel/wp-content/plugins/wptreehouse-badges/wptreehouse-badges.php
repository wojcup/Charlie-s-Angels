<?php
/*
* Plugin Name: Official TR
* Plugin URI: wp.pl
* Description: long description
* Version: 1.0
* Author: Wojciech Cupa (wojcup)
* Author URI: wojcup.com
* License: GPL2
*/




/* 
 * Assign global variables
 *
 */
  
$plugin_url=WP_PLUGIN_URL.'/wptreehouse-badges';

$options=array();

$display_json=false;


/* 
 * Add a link to our plugin in the admin menu
 * under 'settings > Treehouse badges '
 *
 */

function wptreehouse_badges_menu(){
	/* 
	 * Use the add_options_page function
	 * add_options_page( $page_title, $menu_title, $capability, $menu-slug, $function )
	 *
	 */
	 
	 add_options_page(
		 'Official T B Plugin',
		 'Treehouse Badges',
		 'manage_options',
		 'wptreehouse-badges',
		 'wptreehouse_badges_options_page'
	 );
}

add_action( 'admin_menu', 'wptreehouse_badges_menu' );


function wptreehouse_badges_options_page(){
	if(!current_user_can( 'manage_options' )){
		wp_die( 'You do not have sufficient permissions to access this page.' );
	}
	
	global $plugin_url;
	global $options;
	global $display_json;
	
	if( isset( $_POST['wptreehouse_form_submitted'])){
		$hidden_field=esc_html( $_POST['wptreehouse_form_submitted'] );
		if($hidden_field=='Y'){
			$wptreehouse_username=esc_html($_POST['wptreehouse_username']);
			
			$wptreehouse_profile=wptreehouse_badges_get_profile( $wptreehouse_username );
			
			$options['wptreehouse_username']=$wptreehouse_username;
			$options['last_updated']=time();
			$options['wptreehouse_profile']=$wptreehouse_profile;
			
			update_option( 'wptreehouse_badges', $options);

		}
		
	}
	
	
	$options=get_option( 'wptreehouse_badges' );
	if($options != ''){
		$wptreehouse_username=$options['wptreehouse_username'];
		$wptreehouse_profile=$options['wptreehouse_profile'];
		
	}
	require( 'inc/options-page-wrapper.php' );
}


class Wptreehouse_Badges_Widget extends WP_Widget {

	function wptreehouse_badges_widget() {
		// Instantiate the parent object
		parent::__construct( false, 'Officil 3House Badges Widget' );
	}

	function widget( $args, $instance ) {
		// Widget output
		
		extract( $args );
		$title=apply_filters( 'widget_title', $instance['title'] );
		$num_badges=$instance['num_badges'];
		$display_tooltip=$instance['display_tooltip'];
		
		$options=get_option( 'wptreehouse_badges' );
		$wptreehouse_profile = $options['wptreehouse_profile'];
		
		require( 'inc/front-end.php' );
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance=$old_instance;
		$instance['title']=strip_tags($new_instance['title']);
		$instance['num_badges']=strip_tags($new_instance['num_badges']);
		$instance['display_tooltip']=strip_tags($new_instance['display_tooltip']);
		
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		
		$title=esc_attr( $instance['title'] );
		$num_badges=esc_attr( $instance['num_badges'] );
		$display_tooltip=esc_attr( $instance['display_tooltip'] );
		
		$options=get_option( 'wptreehouse_badges' );
		$wptreehouse_profile = $options['wptreehouse_profile'];
		
		require( 'inc/widget-fields.php' );
		
	}
}

function wptreehouse_badges_register_widgets() {
	register_widget( 'Wptreehouse_Badges_Widget' );
}

add_action( 'widgets_init', 'wptreehouse_badges_register_widgets' );


function wptreehouse_badges_get_profile( $wptreehouse_username ){
	$json_feed_url='http://teamtreehouse.com/'.$wptreehouse_username.'.json';
	$arg=array( 'timeout'=>120);
	
	$json_feed=wp_remote_get( $json_feed_url, $arg );
	
	$wptreehouse_profile=json_decode( $json_feed['body'] );
	
	return $wptreehouse_profile;
	
}

function wptreehouse_badges_styles(){
	wp_enqueue_style( 'wptreehouse_badges_styles', plugins_url( '/wptreehouse-badges/wpt.css' )  );
}
add_action( 'admin_head', 'wptreehouse_badges_styles' );


?>