 <?php
// if(function_exists("register_field_group"))
// {
// 	register_field_group(array (
// 		'id' => '512235f3ca8f1',
// 		'title' => 'Article Information',
// 		'fields' => 
// 		array (
// 			0 => 
// 			array (
// 				'key' => 'field_38',
// 				'label' => 'Linked Players',
// 				'name' => 'linked_players',
// 				'type' => 'tab',
// 				'order_no' => 0,
// 				'instructions' => '',
// 				'required' => 0,
// 				'conditional_logic' => 
// 				array (
// 					'status' => 0,
// 					'rules' => 
// 					array (
// 						0 => 
// 						array (
// 							'field' => 'null',
// 							'operator' => '==',
// 						),
// 					),
// 					'allorany' => 'all',
// 				),
// 			),
// 			1 => 
// 			array (
// 				'key' => 'field_33',
// 				'label' => 'Linked Players',
// 				'name' => 'linked_players',
// 				'type' => 'relationship',
// 				'order_no' => 1,
// 				'instructions' => '',
// 				'required' => 0,
// 				'conditional_logic' => 
// 				array (
// 					'status' => 0,
// 					'rules' => 
// 					array (
// 						0 => 
// 						array (
// 							'field' => 'null',
// 							'operator' => '==',
// 							'value' => '',
// 						),
// 					),
// 					'allorany' => 'all',
// 				),
// 				'post_type' => 
// 				array (
// 					0 => 'player',
// 				),
// 				'taxonomy' => 
// 				array (
// 					0 => 'all',
// 				),
// 				'max' => '',
// 			),
// 			2 => 
// 			array (
// 				'key' => 'field_39',
// 				'label' => 'Linked Teams',
// 				'name' => '',
// 				'type' => 'tab',
// 				'order_no' => 2,
// 				'instructions' => '',
// 				'required' => 0,
// 				'conditional_logic' => 
// 				array (
// 					'status' => 0,
// 					'rules' => 
// 					array (
// 						0 => 
// 						array (
// 							'field' => 'null',
// 							'operator' => '==',
// 						),
// 					),
// 					'allorany' => 'all',
// 				),
// 			),
// 			3 => 
// 			array (
// 				'key' => 'field_34',
// 				'label' => 'Linked Teams',
// 				'name' => 'linked_teams',
// 				'type' => 'relationship',
// 				'order_no' => 3,
// 				'instructions' => '',
// 				'required' => 0,
// 				'conditional_logic' => 
// 				array (
// 					'status' => 0,
// 					'rules' => 
// 					array (
// 						0 => 
// 						array (
// 							'field' => 'null',
// 							'operator' => '==',
// 							'value' => '',
// 						),
// 					),
// 					'allorany' => 'all',
// 				),
// 				'post_type' => 
// 				array (
// 					0 => 'team',
// 				),
// 				'taxonomy' => 
// 				array (
// 					0 => 'all',
// 				),
// 				'max' => '',
// 			),
// 			4 => 
// 			array (
// 				'key' => 'field_40',
// 				'label' => 'Author Comments',
// 				'name' => 'author_comments',
// 				'type' => 'tab',
// 				'order_no' => 4,
// 				'instructions' => '',
// 				'required' => 0,
// 				'conditional_logic' => 
// 				array (
// 					'rules' => 
// 					array (
// 						0 => 
// 						array (
// 							'field' => 'null',
// 							'operator' => '==',
// 						),
// 					),
// 					'allorany' => 'all',
// 				),
// 			),
// 			5 => 
// 			array (
// 				'key' => 'field_35',
// 				'label' => 'Author Comments',
// 				'name' => 'author_comments',
// 				'type' => 'repeater',
// 				'order_no' => 5,
// 				'instructions' => '',
// 				'required' => 0,
// 				'conditional_logic' => 
// 				array (
// 					'status' => 0,
// 					'rules' => 
// 					array (
// 						0 => 
// 						array (
// 							'field' => 'null',
// 							'operator' => '==',
// 							'value' => '',
// 						),
// 					),
// 					'allorany' => 'all',
// 				),
// 				'sub_fields' => 
// 				array (
// 					'field_37' => 
// 					array (
// 						'label' => 'Comments',
// 						'name' => 'comments',
// 						'type' => 'wysiwyg',
// 						'instructions' => '',
// 						'column_width' => '',
// 						'default_value' => '',
// 						'toolbar' => 'full',
// 						'media_upload' => 'yes',
// 						'the_content' => 'yes',
// 						'order_no' => 0,
// 						'key' => 'field_37',
// 					),
// 				),
// 				'row_min' => 0,
// 				'row_limit' => '',
// 				'layout' => 'table',
// 				'button_label' => 'Add Author Comments',
// 			),
// 		),
// 		'location' => 
// 		array (
// 			'rules' => 
// 			array (
// 				0 => 
// 				array (
// 					'param' => 'post_type',
// 					'operator' => '==',
// 					'value' => 'post',
// 					'order_no' => 0,
// 				),
// 			),
// 			'allorany' => 'all',
// 		),
// 		'options' => 
// 		array (
// 			'position' => 'normal',
// 			'layout' => 'default',
// 			'hide_on_screen' => 
// 			array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// 	register_field_group(array (
// 		'id' => '512235f3cc552',
// 		'title' => 'User Information',
// 		'fields' => 
// 		array (
// 			0 => 
// 			array (
// 				'key' => 'field_30',
// 				'label' => 'Headshot',
// 				'name' => 'headshot',
// 				'type' => 'image',
// 				'order_no' => 0,
// 				'instructions' => '',
// 				'required' => 0,
// 				'conditional_logic' => 
// 				array (
// 					'status' => 0,
// 					'rules' => 
// 					array (
// 						0 => 
// 						array (
// 							'field' => 'null',
// 							'operator' => '==',
// 						),
// 					),
// 					'allorany' => 'all',
// 				),
// 				'save_format' => 'object',
// 				'preview_size' => 'thumbnail',
// 			),
// 		),
// 		'location' => 
// 		array (
// 			'rules' => 
// 			array (
// 				0 => 
// 				array (
// 					'param' => 'ef_user',
// 					'operator' => '==',
// 					'value' => 'all',
// 					'order_no' => 0,
// 				),
// 			),
// 			'allorany' => 'all',
// 		),
// 		'options' => 
// 		array (
// 			'position' => 'normal',
// 			'layout' => 'no_box',
// 			'hide_on_screen' => 
// 			array (
// 			),
// 		),
// 		'menu_order' => 0,
// 	));
// }

 ?>