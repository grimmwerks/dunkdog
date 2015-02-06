<?php

add_theme_support( 'post-thumbnails' );

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'player-profile', 250, 250 );
}


function setup_player_rankings_posttypes(){
	
 	register_post_type( 'dd-player-ranking', 
 		array(
 		'labels' => array('name'=> __("Player Rankings"),
 							'singular_name'=>__('Player Ranking'),
 							'add_new'=>__('Add Player Ranking'),
 							'add_new_item'=>__('Add New Player Rankings'),
 							'edit'=>__('Edit'),
 							'edit_item'=>__('Edit Player Rankings'),
 							'new_item'=>__("New Player Rankings"),
 							'view'=>__('View Player Rankings'),
 							'view_item' => __('View Player Rankings'),
 							'not_found' => __('No Player Rankings found.'),
 							'not_found_in_trash'=>__('No Player Rankings found in Trash')
 							),
 		'public'=>true,
 		'rewrite' => array('slug' => 'player-ranking' ),
 		'can_export'=>true,
 		'has_archive'=>true, 
 		'publicly_querable'=>true,
 		'exclude_from_search' => false,
 		'hierarchical' => false,
 		'supports'=> array('title', 'editor', 'author'),
		'menu_icon' => plugins_url( '/includes/images/icon-user.png', DD_BASE )
 		)
 	);

	 
 	register_post_type( 'dd-team-ranking', 
 		array(
 		'labels' => array('name'=> __("Team Rankings"),
 							'singular_name'=>__('Team Rankings'),
 							'add_new'=>__('Add Team Ranking'),
 							'add_new_item'=>__('Add New Team Ranking'),
 							'edit'=>__('Edit'),
 							'edit_item'=>__('Edit Team Ranking'),
 							'new_item'=>__("New Team Ranking"),
 							'view'=>__('View Team Ranking'),
 							'view_item' => __('View Team Ranking'),
 							'not_found' => __('No Team Rankings found.'),
 							'not_found_in_trash'=>__('No Team Rankings found in Trash')
 							),
 		'public'=>true,
		'rewrite' => array('slug' => 'team-ranking' ),
 		'can_export'=>true,
 		'publicly_querable'=>true,
 		'exclude_from_search' => false,
 		'hierarchical' => false,
 		'supports'=> array('title', 'editor', 'author'),
		'menu_icon' => plugins_url( '/includes/images/icon-trophy.png', DD_BASE )
 		)
 	);


	register_post_type( 'dd-player', 
		array(
		'labels' => array('name'=> __("Dunkdog Players"),
							'singular_name'=>__('Player'),
							'add_new'=>__('Add Player'),
							'add_new_item'=>__('Add New Player'),
							'edit'=>__('Edit'),
							'edit_item'=>__('Edit Player'),
							'new_item'=>__("New Player"),
							'view'=>__('View Player'),
							'view_item' => __('View Player'),
							'not_found' => __('No Players found.'),
							'not_found_in_trash'=>__('No Players found in Trash')
							),
		'public'=>true,
		'rewrite' => array('slug' => 'player' ),
		'show_in_menu' => 'edit.php?post_type=xxx',
		'can_export'=>true,
		'has_archive'=>true,
		'publicly_querable'=>true,
		'exclude_from_search' => false,
		'hierarchical' => false,
		'supports'=> array('title', 'editor', 'thumbnail', 'author'),
		'menu_icon'=> plugins_url( '/includes/images/icon-user.png', DD_BASE)
		)
	);

	register_post_type( 'dd-team', 
		array(
		'labels' => array('name'=> __("Dunkdog Teams"),
							'singular_name'=>__('Teams'),
							'add_new'=>__('Add Team'),
							'add_new_item'=>__('Add New Team'),
							'edit'=>__('Edit'),
							'edit_item'=>__('Edit Team'),
							'new_item'=>__("New Team"),
							'view'=>__('View Team'),
							'view_item' => __('View Team'),
							'not_found' => __('No Teams found.'),
							'not_found_in_trash'=>__('No Teams found in Trash')
							),
		'public'=>true,
		'rewrite' => array('slug' => 'team' ),
		'show_in_menu' => 'edit.php?post_type=x',
		'can_export'=>true,
		'publicly_querable'=>true,
		'has_archive'=>true,
		'exclude_from_search' => false,
		'hierarchical' => false,
		'supports'=> array('title', 'editor', 'thumbnail', 'author'),
		'menu_icon'=> plugins_url( '/includes/images/icon-trophy.png', DD_BASE)
		)
	);

	
	// taxonomy class is for all
	register_taxonomy('dd-class', array('dd-player', 'dd-team-ranking', 'dd-player-ranking'), array(
		'hierarchical' => true,
		'show_admin_column' => true,
		'show_ui' => true, 
		'sort' => true,
		'show_tagcloud'=> false,
		'label' => "Class",
		'query_var' => true,
		'rewrite' => array('slug' => 'class' )
	));

	register_taxonomy('dd-height', array('dd-player'), array(
		'hierarchical' => false,
		'show_admin_column' => true,
		'show_ui' => true, 
		'sort' => true,
		'show_tagcloud'=> false,
		'label' => "Height",
		'query_var' => true,
		'rewrite' => array('slug' => 'height' )
	));

	register_taxonomy('dd-weight', array('dd-player'), array(
		'hierarchical' => false,
		'show_admin_column' => true,
		'show_ui' => true, 
		'sort' => true,
		'show_tagcloud'=> false,
		'label' => "Weight",
		'query_var' => true,
		'rewrite' => array('slug' => 'weight' )
	));
		
	register_taxonomy('dd-position', 'dd-player', array(
		'hierarchical' => true,
		'show_admin_column' => true,
		'show_ui' => true, 
		'sort' => true,
		'show_tagcloud'=> false,
		'label' => "Player Position",
		'query_var' => true,
		'rewrite' => array('slug' => 'position' )
	));

	register_taxonomy('dd-team_type', array('dd-team', 'dd-team-ranking'), array(
		'hierarchical' => true,
		'show_admin_column' => true,
		'show_ui' => true, 
		'sort' => true,
		'show_tagcloud'=> false,
		'label' => "Team Type",
		'query_var' => true,
		'rewrite' => array('slug' => 'team-type' )
	));

	register_taxonomy('dd-conference', 'dd-team', array(
		'hierarchical' => true,
		'show_admin_column' => true,
		'show_ui' => true, 
		'sort' => true,
		'show_tagcloud'=> false,
		'label' => "Conference",
		'has_archive'=>true,
		'query_var' => true,
		'rewrite' => array('slug' => 'conference' )
	));
 
 }
add_action('init', 'setup_player_rankings_posttypes');


function edit_dunkdog_admin_menus(){
	global $menu; 
	global $submenu;
	//krumo($menu, $submenu);//edit.php?post_type=team-ranking 

	$submenu['edit.php?post_type=dd-player-ranking'][15] = array('Dunkdog Players', 'edit_posts', 'edit.php?post_type=dd-player', 'Dunkdog Players');
	$submenu['edit.php?post_type=dd-player-ranking'][16] = array('Add New Player', 'edit_posts', 'post-new.php?post_type=dd-player', 'Add New Player');

	$submenu['edit.php?post_type=dd-player-ranking'][] = array('Class', 'edit_posts', 'edit-tags.php?taxonomy=dd-class&amp;post_type=dd-player-ranking');
	$submenu['edit.php?post_type=dd-player-ranking'][] = array('Weight', 'edit_posts', 'edit-tags.php?taxonomy=dd-weight&amp;post_type=dd-player-ranking');
	$submenu['edit.php?post_type=dd-player-ranking'][] = array('Height', 'edit_posts', 'edit-tags.php?taxonomy=dd-height&amp;post_type=dd-player-ranking');
	$submenu['edit.php?post_type=dd-player-ranking'][] = array('Player Position', 'edit_posts', 'edit-tags.php?taxonomy=dd-position&amp;post_type=dd-player-ranking');

	remove_submenu_page( 'edit.php?post_type=dd-team-ranking', 'edit-tags.php?taxonomy=dd-class&amp;post_type=dd-team-ranking' );
	remove_submenu_page( 'edit.php?post_type=dd-team-ranking', 'edit-tags.php?taxonomy=dd-team_type&amp;post_type=dd-team-ranking' );
	$submenu['edit.php?post_type=dd-team-ranking'][8] = array('Dunkdog Teams', 'edit_posts', 'edit.php?post_type=dd-team', 'Dunkdog Teams');
	$submenu['edit.php?post_type=dd-team-ranking'][9] = array('Add New Team', 'edit_posts', 'post-new.php?post_type=dd-team', 'Add New Team');
	$submenu['edit.php?post_type=dd-team-ranking'][] = array('Team Type', 'edit_posts', 'edit-tags.php?taxonomy=dd-team_type&amp;post_type=dd-team');
	$submenu['edit.php?post_type=dd-team-ranking'][] = array('Conference', 'edit_posts', 'edit-tags.php?taxonomy=dd-conference&amp;post_type=dd-team');
	//$submenu['edit.php?post_type=dd-team-ranking'][] = array('Class', 'edit_posts', 'edit-tags.php?taxonomy=dd-class&amp;post_type=dd-team');
	//$submenu['edit.php?post_type=dd-team-ranking'][] = array('Team Type', 'edit_posts', 'edit-tags.php?taxonomy=dd-team_type&amp;post_type=dd-team');
}

add_action( 'admin_menu', 'edit_dunkdog_admin_menus' );


/*****  Players Columns and Headshot **********/

// adding image to player listing
function dunkdog_player_edit_columns($cols) {  
	$cols = array('cb' => '<input type="checkbox" />',
		'headshot' => 'Headshot',
		'title' => 'Title',  
		'taxonomy-dd-class' => 'Class',
  		'taxonomy-dd-height' =>  'Height',
  		'taxonomy-dd-weight' =>  'Weight',
  		'taxonomy-dd-position' =>  'Player Position',
  		'high_school' => 'High School',
  		'travel_team' => 'Travel',
  		'college_team' => 'College',
  		'news' => 'News'
  		);
   return $cols;
}  
 
add_filter("manage_dd-player_posts_columns", "dunkdog_player_edit_columns");

function dunkdog_player_headshot_column($column_name, $post_id){
	if($column_name=='headshot'){
		$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
		$thumb = wp_get_attachment_image( $thumbnail_id, array(50, 50), true );
		echo $thumb;
	}
	if($column_name=='high_school'){
		$high_school_team = get_field('high_school_team', $post_id);
		if($high_school_team){
			if(!is_string($high_school_team)){$high_school_team = $high_school_team[0]->ID;}
			echo '<a href="post.php?action=edit&post='.$high_school_team.'">'. get_the_title($high_school_team).'</a>';
			}
    }
	if($column_name=='travel_team'){
		$travel_team = get_field('travel_team', $post_id); 
		if($travel_team){
			if(!is_string($travel_team)){$travel_team = $travel_team[0]->ID;}
	    	echo '<a href="post.php?action=edit&post='.$travel_team.'">'. get_the_title($travel_team).'</a>';
	    }
	}
	if($column_name=='college_team'){
		$college_team = get_field('college_team',$post_id); 
		if($college_team){
			if(!is_string($college_team)){$college_team = $college_team[0]->ID;}
	    	echo '<a href="post.php?action=edit&post='.$college_team.'">'. get_the_title($college_team).'</a>';
	    }
	}
	if($column_name=='news'){
		global $wpdb;
		$playerReq = '%"'.$post_id.'"%';
		$sql="SELECT distinct $wpdb->posts.ID FROM $wpdb->posts INNER JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) WHERE 1=1 AND (($wpdb->postmeta.meta_key LIKE 'linked_player_items_%_linked_player_profile') or ($wpdb->postmeta.meta_key LIKE 'linked_player_items_%_linked_players')) AND (meta_value LIKE  '". $playerReq."' ) AND  ($wpdb->posts.post_status = 'publish')";
			$newsIDs = $wpdb->get_col($sql);
			$links = array();
			foreach($newsIDs as $ID){
				$links[] = '<a href="/wp-admin/post.php?action=edit&post='. $ID  . '">'. get_the_title($ID).'</a>';
			}
			echo implode(', ', $links);
		
	}
}

add_action( 'manage_dd-player_posts_custom_column', 'dunkdog_player_headshot_column', 10, 2 );


/// sorting  NOT WORKING NEED TO GO TO ADVANCED FILTER; holding off for now
// add_filter( 'manage_edit-player_sortable_columns', 'dunkdog_player_sortable_columns' );  
// function dunkdog_player_sortable_columns( $columns ) {  
//     $columns['high_school'] = 'high_school_team';
//   	$columns['travel_team'] = 'travel_team';
//   	$columns['college_team'] = 'college_team';
//     return $columns;  
// }  


// pre get posts is a function used universally but here trying to set the post meta for sorting
// add_action( 'pre_get_posts', 'dunkdog_pre_get_posts' );  
// function dunkdog_pre_get_posts( $query ) {  
//     if( ! is_admin() )  
//         return;  
//     $orderby = $query->get( 'orderby');  
//     if( 'high_school_team' == $orderby || 'travel_team' == $orderby || 'college_team' == $orderby  ) {  
//         $query->set('meta_key', $orderby);  
//         $query->set('orderby','meta_value');  

//     }  
// }  







/********   TEAM Image and Column in Admin   ***********/
function dunkdog_team_edit_columns($cols){
	//krumo($cols);
	// $cols = array('cb' => '<input type="checkbox" />',
	// 	'headshot' => 'Headshot',
	// 	'title' => 'Title',  
	// 	'taxonomy-team_type' => 'Type',
	// 	'taxonomy-conference' =>  'Conference'
 //  		);
	$cols = array_slice($cols, 0, 1, true) + array("image" => "Image") + array_slice($cols, 1, count($cols) - 2, true) ;
	return $cols;
}
add_filter("manage_dd-team_posts_columns", "dunkdog_team_edit_columns");

function dunkdog_team_custom_column($column_name, $post_id){ 
	if($column_name=='image'){
		$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
		$thumb = wp_get_attachment_image( $thumbnail_id, array(50, 50), true );
		echo $thumb;
	}
}

add_action( 'manage_dd-team_posts_custom_column', 'dunkdog_team_custom_column', 10, 2 );





// filter to display templates
function dunkdog_template_filter( $template_path ) { 
	if(is_search()){
		return $template_path;
	}

	$type = get_post_type(); 
    if ( ( $type == 'dd-player'  ) || ( $type == 'dd-team'  ) || ( $type == 'dd-player-ranking'  ) || ($type == 'dd-team-ranking'  ) ){
        if ( is_single() ) {
        	$prefix = 'single';
        }
         if ( is_archive()){
         	$prefix = 'archive';
        }
         if ( is_tax()){
         	$prefix = 'taxonomy';

         	// if(get_query_var('taxonomy')=='dd-conference'){
         	// 	$type = 'dd-team';
         	// }else{
         		$type = 'dd-player'; // forcing tax to be player; no other need for team or ranking taxonomy
         	// }
        }

       $template_path = dunkdog_template_function($prefix . '-' . $type, false);
      
    }
    
    if(DD_DEBUG){global $wp_query; krumo('template_path', $template_path, $prefix, $type, $wp_query);}
	return $template_path;
}

add_filter( 'template_include', 'dunkdog_template_filter', 1 );


// attempting to echo back the mini player box
if(!function_exists('dunkdog_template_function')){
	function dunkdog_template_function( $template = '', $include = true, $vars = array() )
	{
		
		$include = (bool) $include; 
		$template_path = get_query_template( $template );
		if ( ! file_exists( $template_path ) ) {
			$template_path = DD_BASE_DIR . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR .'templates' . DIRECTORY_SEPARATOR . $template . '.php';
		}

		if ( file_exists( $template_path ) ) {
			if ( $include ) {
				if ( ! empty( $vars ) ) {
					extract( $vars );
					
				}
				include $template_path;
			}
		} else {
			$template_path = false;
		}

		return $template_path;
	}
}


// checking to see if in term
function dd_in_tax($tax, $term, $_post = NULL) {
    // if neither tax nor term are specified, return false
    if ( !$tax || !$term ) { return FALSE; }
    // if post parameter is given, get it, otherwise use $GLOBALS to get post
    if ( $_post ) {
        $_post = get_post( $_post );
    } else {
        $_post =& $GLOBALS['post'];
    }
    // if no post return false
    if ( !$_post ) { return FALSE; }
    // check whether post matches term belongin to tax
    $return = is_object_in_term( $_post->ID, $tax, $term );
    // if error returned, then return false
    if ( is_wp_error( $return ) ) { return FALSE; }
    return $return;
}





/**
 * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
 */
add_action( 'wp_enqueue_scripts', 'dunkdog_rankings_stylesheet' );

/**
 * Enqueue plugin style-file
 */
function dunkdog_rankings_stylesheet() {
    wp_register_style( 'dunkdog_rankings', plugins_url(DIRECTORY_SEPARATOR . 'includes ' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'dunkdog_rankings.css', DD_BASE) );
    wp_enqueue_style( 'dunkdog_rankings' );
}



/// attempting acf updating on the fly
add_action('acf_head-input', 'dunkdog_acf_head_input');
function dunkdog_acf_head_input(){
?>

	<script type='text/javascript'>
		$acf = jQuery.noConflict();
		$acf(document).live('acf/setup_fields', function(e, postbox){
 			
 			
		   $acf('.acf_relationship .relationship_right .relationship_list').on( "sortcreate", function( event, ui ) {
				redrawRankings()
			} )
		   $acf('.acf_relationship .relationship_right .relationship_list').on( "sortreceive", function( event, ui ) {
				redrawRankings()
			} )
			$acf('.acf_relationship .relationship_right .relationship_list').on( "sortupdate", function( event, ui ) {
				redrawRankings()
			} );
			$acf('.acf_relationship .relationship_right .relationship_list').on( "sortremove", function( event, ui ) {
				redrawRankings()
			} );
			
			$acf('.acf_relationship .relationship_left .relationship_list a').live('click', function(){
				redrawRankings()
			});
			$acf('.acf_relationship .relationship_right .relationship_list a').live('click', function(){
				redrawRankings();
			 });
		

			// function attempt
			function redrawRankings(){ 
				$acf('.acf_relationship .relationship_right .relationship_list li').each(function(i){
					var pos = '[ ' + i + ' ]. ';
					var str = '<b id="pos" style="color: #ff0000;">' + pos + '</b>  ';
					console.log($acf(this).children('a').children('#pos'));
					if( $acf(this).children('a').children('#pos').length ) { 
						$acf(this).children('a').children('#pos').html(pos);
					}else{
						$acf(this).children('a').prepend(str + ' ');
					}
				});
			}

			redrawRankings();
		 
		});
		</script>

<?php


}

function my_acf_result_result( $html, $post )
{
	// add an image to each result
	$image = get_field('thumbnail', $post->ID);
 
	if( $image )
	{
		$html = '<img src="' . $image['url'] . '" />' . $html;
	}
 
    return $html;
}
 
// acf/fields/relationship/result - filter for every field
add_filter('acf/fields/relationship/result', 'my_acf_result_result');




function dunkdog_image_resize($img, $w, $h, $x, $y){

}

function dunkdog_remove_last_url($url){
	$fpath = explode('/', $url);
   	$npath = '';
   	for($i=0; $i<count($fpath)-1; $i++){
   		$npath .=$fpath[$i] .'/';
   	}
   	return $npath;
}



?>