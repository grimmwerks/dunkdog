<?php
//  post type for the new news articles to keep separate from the old basketball news

function setup_dunkdog_news_posttypes(){
	
 // 	register_post_type( 'dunkdog_news', 
 // 		array(
 // 		'labels' => array('name'=> __("News"),
 // 							'singular_name'=>__('News'),
 // 							'add_new'=>__('Add News'),
 // 							'add_new_item'=>__('Add News Article'),
 // 							'edit'=>__('Edit'),
 // 							'edit_item'=>__('Edit News'),
 // 							'new_item'=>__("New News"),
 // 							'view'=>__('View News'),
 // 							'view_item' => __('View News'),
 // 							'not_found' => __('No News Articles found.'),
 // 							'not_found_in_trash'=>__('No News Articles found in Trash')
 // 							),
 // 		'public'=>true,
 // 		'has_archive'=>true,
 // 		'rewrite'   => array( 'slug' => 'news' ),
 // 		'can_export'=>true,
 // 		'publicly_querable'=>true,
 // 		'exclude_from_search' => false,
 // 		'supports' => array( 'title', 'editor', 'author',  'excerpt', 'revisions', 'thumbnail' ),
 // 		'hierarchical' => false
 // 		)
 // 	);

 // 	register_taxonomy('column', array('dunkdog_news'), array(
	// 	'hierarchical' => true,
	// 	'show_admin_column' => true,
	// 	'show_ui' => true, 
	// 	'sort' => true,
	// 	'show_tagcloud'=> false,
	// 	'label' => "Columns",
	// 	'query_var' => true,
	// 	'rewrite' => array('slug' => 'column' )
	// ));
}

//add_action('init', 'setup_dunkdog_news_posttypes');

?>