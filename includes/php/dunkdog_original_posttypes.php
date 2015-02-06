<?php 

add_action( 'init', 'dunkdog_register_custom_blogs',  -1 ); // must -1 to ensure this runs before Ajax functions that rely on this post type

function dunkdog_register_custom_blogs() { 

	// Celebrity Interviews

	// register_post_type('celebrity_interviews', 
	// 	array(	'label' => 'Celebrity Interviews',
	// 		'description' => '',
	// 		'public' => true,
	// 		'show_ui' => true,
	// 		'show_in_menu' => true,
	// 		'capability_type' => 'post',
	// 		'hierarchical' => false,
	// 		'rewrite' => array('slug' => 'celebrity-interviews'),
	// 		'query_var' => true,
	// 		'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),
	// 		'labels' => array (
	// 			'name' => 'Celebrity Interviews',
	// 			'singular_name' => 'Celebrity Interview',
	// 			'menu_name' => 'Celebrity Interviews',
	// 			'add_new' => 'Add Interview',
	// 			'add_new_item' => 'Add New Interview',
	// 			'edit' => 'Edit Interviews',
	// 			'edit_item' => 'Edit Interview',
	// 			'new_item' => 'New Interview',
	// 			'view' => 'View Interview',
	// 			'view_item' => 'View Interview',
	// 			'search_items' => 'Search Interview',
	// 			'not_found' => 'No Interviews Found',
	// 			'not_found_in_trash' => 'No Interviews Found in Trash',
	// 			'parent' => 'Parent Interview',
	// 		),
	// 	) 
	// );

	// register_taxonomy('celebrity_interview_categories',
	// 	array (
	// 	    0 => 'celebrity_interviews',
	// 	),
	// 	array( 'hierarchical' => true, 
	// 		'label' => 'Interview Categories',
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 		'rewrite' => array('slug' => 'celebrity-interview-cat' ),
	// 	'singular_label' => 'Interview Category') 
	// );


	// register_taxonomy('celebrity_interview_tags',
	// 	array (
	// 	    0 => 'celebrity_interviews',
	// 	),
	// 	array( 'hierarchical' => false, 
	// 		'label' => 'Interview Tags',
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 		'rewrite' => array('slug' => 'celebrity-interviews-tags' ),
	// 	'singular_label' => 'Interview Tag') 
	// );


	// Radio Show Podcast

	register_post_type('radio_show_podcasts', 
		array(	'label' => 'Radio Show Podcasts',
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive'=>true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array('slug' => 'radio-shows'),
			'query_var' => true,
			'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),
			'labels' => array (
				'name' => 'Radio Show Podcasts',
				'singular_name' => 'Radio Show Podcast',
				'menu_name' => 'Radio Show Podcasts',
				'add_new' => 'Add Podcast',
				'add_new_item' => 'Add New Podcast',
				'edit' => 'Edit Podcasts',
				'edit_item' => 'Edit Podcast',
				'new_item' => 'New Podcast',
				'view' => 'View Podcast',
				'view_item' => 'View Podcast',
				'search_items' => 'Search Podcast',
				'not_found' => 'No Podcasts Found',
				'not_found_in_trash' => 'No Podcasts Found in Trash',
				'parent' => 'Parent Podcast',
			),
		) 
	);

	register_taxonomy('radio_show_podcast_categories',
		array (
		    0 => 'radio_show_podcasts',
		),
		array( 'hierarchical' => true, 
			'label' => 'Podcast Categories',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'radio-show-cat' ),
		'singular_label' => 'Podcast Category') 
	);

	register_taxonomy('radio_show_podcast_tags',
		array (
		    0 => 'radio_show_podcasts',
		),
		array( 'hierarchical' => false, 
			'label' => 'Podcast Tags',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'radio-show-tags' ),
		'singular_label' => 'Podcast Tag') 
	);

	// Basketball News

	// register_post_type('basketball_news', 
	// 	array(	'label' => 'Basketball News',
	// 		'description' => '',
	// 		'public' => true,
	// 		'show_ui' => true,
	// 		'show_in_menu' => true,
	// 		'capability_type' => 'post',
	// 		'hierarchical' => false,
	// 		'rewrite' => array('slug' => 'basketball-news'),
	// 		'query_var' => true,
	// 		'has_archive'=>true,
	// 		'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),
	// 		'labels' => array (
	// 			'name' => 'Basketball News',
	// 			'singular_name' => 'Basketball News',
	// 			'menu_name' => 'Basketball News',
	// 			'add_new' => 'Add News',
	// 			'add_new_item' => 'Add New News',
	// 			'edit' => 'Edit News',
	// 			'edit_item' => 'Edit News',
	// 			'new_item' => 'New News',
	// 			'view' => 'View News',
	// 			'view_item' => 'View News',
	// 			'search_items' => 'Search News',
	// 			'not_found' => 'No News Found',
	// 			'not_found_in_trash' => 'No News Found in Trash',
	// 			'parent' => 'Parent News',
	// 		),
	// 	) 
	// );

	// register_taxonomy('basketball_news_categories',
	// 	array (
	// 	    0 => 'basketball_news',
	// 	),
	// 	array( 'hierarchical' => true, 
	// 		'label' => 'News Categories',
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 		'rewrite' => array('slug' => 'basketball-news-cat' ),
	// 	'singular_label' => 'News Category') 
	// );

	// register_taxonomy('basketball_news_tags',
	// 	array (
	// 	    0 => 'basketball_news',
	// 	),
	// 	array( 'hierarchical' => false, 
	// 		'label' => 'News Tags',
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 		'rewrite' => array('slug' => 'basketball-news-tag' ),
	// 	'singular_label' => 'News Tags') 
	// );

}
?>