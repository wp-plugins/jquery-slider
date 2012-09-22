<?php
/*
Plugin Name: jQuery Slider
Description: jQuery slider with lots of customization options
Author: vijaybidla
Version: 1.4.2
Author URI: http://www.iwebrays.com
Plugin URI: http://www.iwebrays.com/jquery-slider/

 Copyright 2011  Vijay Kumar  (email : bidla.vijay@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('JSLIDER_DIR', WP_PLUGIN_DIR.'/jquery-slider');
define('JSLIDER_URL', WP_PLUGIN_URL.'/jquery-slider');

include_once 'settings.php';

// Activating plugin
register_activation_hook(__FILE__, 'js_activate');
function js_activate(){
	add_option('js_width', '750');
	add_option('js_height', '345');
	add_option('js_pause', 'true');
	add_option('js_paging', 'true');
	add_option('js_nav', 'true');
	add_option('js_timer', 'true');
	add_option('js_thumbtype', 'tooltip');
}

/* Slider Post Types */
add_action('init', 'js_custom_init');
function js_custom_init() {
	load_plugin_textdomain( 'jquery_slider', false, basename(dirname(__FILE__)) . '/languages' );
	
	$labels = array(
		'name' => _x('Slides', 'post type general name'),
		'singular_name' => _x('Slide', 'post type singular name'),
		'add_new' => _x('Add New', 'slide'),
		'add_new_item' => __('Add New Slide'),
		'edit_item' => __('Edit Slide'),
		'new_item' => __('New Slide'),
		'view_item' => __('View Slide'),
		'search_items' => __('Search Slides'),
		'not_found' =>  __('No slides found'),
		'not_found_in_trash' => __('No slides found in Trash'), 
		'parent_item_colon' => '',
		'menu_name' => 'Slides');

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array('editor','thumbnail')); 
  
  register_post_type('slide',$args);
}

add_filter( 'manage_edit-slide_columns', 'set_custom_edit_slide_columns' );
add_action( 'manage_slide_posts_custom_column' , 'custom_slide_column', 10, 2 );

function set_custom_edit_slide_columns($columns) {
    unset($columns['title']);
	unset($columns['date']);
    return $columns+array('title' => __('Title'),
                          'thumbnail' => __('Thumbnail'), 
                 );
}

function custom_slide_column( $column, $post_id ) {
    switch ( $column ) {
		case 'edit':
			echo edit_post_link('Edit', '<p>', '</p>', $post_id);
			break;
		
		case 'thumbnail':
			$images = get_posts( 'post_parent='.$post_id.'&post_type=attachment&post_mime_type=image' );
			if ( !empty($images) ) {
				$imgAttr = wp_get_attachment_image_src( $images[0]->ID );
				echo '<img src="'.JSLIDER_URL.'/timthumb.php?src='.$images[0]->guid.'&w=50&h=50" />';
			} else {
				echo 'No Image';
			}
			break;
			
		case 'title':
			echo the_excerpt(); 
			break;
    }
}

// Load javascripts and css files
if(!is_admin()){
	add_action('wp_print_scripts', 'js_load_js');
	function js_load_js(){
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquerySliderJs', JSLIDER_URL.'/js/jquerySlider.min.js');
	}

	add_action('wp_print_styles', 'js_load_css');
	function js_load_css(){
		wp_enqueue_style('jquerySliderCss', JSLIDER_URL.'/css/jquery-slider.css');
	}

	add_action('wp_head', 'js_head_code');
	function js_head_code(){
		$out = "<script type='text/javascript'>
					jQuery(document).ready(function(){
						jQuery('.slider').jquerySlider({
							width:".get_option('js_width').", 
							height:".get_option('js_height').",
							pauseSlideshowOnHover:".get_option('js_pause').",
							navigationArrows:".get_option('js_nav').",
							navigationButtons:".get_option('js_paging').",
							thumbnailsType:'".get_option('js_thumbtype')."',
							timerAnimation:".get_option('js_timer').",
							slideProperties:{
								0:{effectType:'fade', horizontalSlices:'1', verticalSlices:'1', slicePattern:'leftToRight', captionPosition:'left', captionShowEffect:'slide', captionHeight:220, slideshowDelay:2000},
								1:{effectType:'fade', horizontalSlices:'1', verticalSlices:'1', slicePattern:'leftToRight', captionPosition:'left', captionShowEffect:'fade', captionHeight:120, slideshowDelay:2000},
								2:{effectType:'slide', horizontalSlices:'10', verticalSlices:'1', slicePattern:'rightToLeft', sliceDuration:'700'},
								3:{effectType:'height', horizontalSlices:'10', verticalSlices:'1', slicePattern:'leftToRight', slicePoint:'centerBottom', sliceDuration:'500', captionSize:'45'},
								4:{effectType:'scale', horizontalSlices:'10', verticalSlices:'5', sliceDuration:'800'},
								5:{effectType:'height', horizontalSlices:'1', verticalSlices:'15', slicePattern:'bottomToTop', slicePoint:'centerTop', sliceDuration:'700', captionPosition:'left', captionSize:'150', captionHideEffect:'slide'}
							}
						});
					});
				</script>";

		echo $out;
	}
}

function jquery_slider(){
	global $post;
	
	$qry = new WP_Query('post_type=slide&showposts=-1');
	if($qry->have_posts()):
	  
	  $out = '<div class="slider">';
		while($qry->have_posts()) : $qry->the_post();
		$out .= '<div class="slider-item">';

		  $images = get_posts( 'post_parent='.$post->ID.'&post_type=attachment&post_mime_type=image' );

		  if ( !empty($images) ) {
			  $imgAttr = wp_get_attachment_image_src( $images[0]->ID );
			  $out .= '<img src="'.JSLIDER_URL.'/timthumb.php?src='.$images[0]->guid.'&w='.get_option('js_width').'&h='.get_option('js_height').'" />';
			  $out .= '<img class="thumbnail" src="'.$imgAttr[0].'" />';
		  }

		$out .= '<div class="caption">'.get_the_content($post->ID).'</div>';
	  $out .= '</div>';
	  endwhile;
	$out .= '</div>';
	endif;
	wp_reset_postdata();

	return $out;
}

add_shortcode('jQuery Slider', 'jquery_slider');
add_theme_support('post-thumbnails');