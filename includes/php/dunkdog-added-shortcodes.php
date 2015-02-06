<?php

//really a bunch of utilites

function my_url($atts, $content = null) {
  return get_bloginfo('url'); 
}
add_shortcode("url", "my_url");  
 
function my_template_url($atts, $content = null) {
  return get_bloginfo('template_url'); 
}
add_shortcode("template_url", "my_template_url");  
 
function my_images_url($atts, $content = null) {
  return get_bloginfo('template_url') . '/images'; 
}
add_shortcode("images_url", "my_images_url");


function bloginfo_shortcode( $atts ) {
    extract(shortcode_atts(array(
        'key' => '',
    ), $atts));
    return get_bloginfo($key);
}
add_shortcode('bloginfo', 'bloginfo_shortcode');






function dunkdog_home_slider_draw(){
	//register_new_royalslider_files(1);
	$free = dunkdog_get_latest_free_posts(3); 
	echo get_new_royalslider(1);
}

add_shortcode('dunkdog_home_slider', 'dunkdog_home_slider_draw');




//if(!function_exists('dunkdog_get_latest_free_posts')){
	function dunkdog_get_latest_free_posts($cnt=1){
		// first get all non-free postIDs
		$first = array_unique(preg_split("/[\r\n\t\s;,]+/", $GLOBALS["WS_PLUGIN__"]["s2member"]["o"]["level0_posts"]));
		$second = array_unique(preg_split("/[\r\n\t\s;,]+/", $GLOBALS["WS_PLUGIN__"]["s2member"]["o"]["level1_posts"]));
		$notin = array_merge((array)$first, (array)$second);

		$args = array('post__not_in' => $notin, 'posts_per_page' => $cnt);

		$ret = new WP_Query($args);
		return $ret;
		//krumo($notin, $ret);
	}
//}
add_action( 'dunkdog_get_latest_free','dunkdog_get_latest_free_posts', $priority = 10, $accepted_args = 1 );


// check to see if current user can access current post
if(!function_exists('dunkdog_current_user_can_access')){
	function dunkdog_current_user_can_access($postID){
		//$GLOBALS["WS_PLUGIN__"]["s2member"]["o"]['level0_post'];
	}
}
//add_action('dunkdog_current_user_can_access', 'dunkdog_current_user_can_access_check');


if(!function_exists('dunkdog_check_if_premium_content')){
	function dunkdog_check_if_premium_content($postID){
		$found = false;		
		for($n=0; $n<=2; $n++){
			$p = "level".$n;
			$target = array_unique(preg_split("/[\r\n\t\s;,]+/", $GLOBALS["WS_PLUGIN__"]["s2member"]["o"][$p."_posts"]));
			if(in_array($postID, $target)){
				$found = $p;
			}
			$target = array_unique(preg_split("/[\r\n\t\s;,]+/", $GLOBALS["WS_PLUGIN__"]["s2member"]["o"][$p."_pages"]));
			if(in_array($postID, $target)){
				$found = $p;
			}
			// checking uris
		}
		


		return $found;
	}
}

//add_action('dunkdog_check_if_premium', 'dunkdog_check_if_premium_content');

if(!function_exists('dunkdog_no_access')){
	function dunkdog_no_access($lvl='paid'){
		$fld = $lvl . '_membership_prompt';
		$message = get_field($fld, 'option');
		echo '<center>'. $message .'</center>';
		//echo '<center><b>NOT FOR YOU</b></center>';
	}
}


?>