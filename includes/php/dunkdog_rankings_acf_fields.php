<?php  // $options['activation_codes']['repeater'] = 'QJF7-L4IX-UCNP-RF2W';
/**
 * Activate Add-ons
 * Here you can enter your activation codes to unlock Add-ons to use in your theme. 
 * Since all activation codes are multi-site licenses, you are allowed to include your key in premium themes.
 */ 

function my_acf_settings( $options )
{
    // activate add-ons
    $options['activation_codes']['repeater'] = 'QJF7-L4IX-UCNP-RF2W';
    $options['activation_codes']['options_page'] = 'OPN8-FA4J-Y2LW-81LS';
    $options['activation_codes']['flexible_content'] = 'FC9O-H6VN-E4CL-LT33';
    $options['activation_codes']['gallery'] = 'XXXX-XXXX-XXXX-XXXX';
    
    // setup other options (http://www.advancedcustomfields.com/docs/filters/acf_settings/)
    
    return $options;
    
}
add_filter('acf_settings', 'my_acf_settings');


function my_acf_options_page_title( $title )
{
	$title = "DunkDog Options";
 
	return $title;
}
 
add_filter('acf_options_page_title', 'my_acf_options_page_title');



/**
 * Register field groups
 * The register_field_group function accepts 1 array which holds the relevant data to register a field group
 * You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 * This code must run every time the functions.php file is read
 */

if(function_exists("register_field_group"))
{
// 	register_field_group(array (
// 		'id' => '5111f462485f1',
// 		'title' => 'Player Information',
// 		'fields' => 
// 		array (
// 			0 => 
// 			array (
// 				'key' => 'field_17',
// 				'label' => 'First Name',
// 				'name' => 'first_name',
// 				'type' => 'text',
// 				'order_no' => 0,
// 				'instructions' => '',
// 				'required' => 1,
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
// 				'default_value' => '',
// 				'formatting' => 'none',
// 			),
// 			1 => 
// 			array (
// 				'key' => 'field_18',
// 				'label' => 'Last Name',
// 				'name' => 'last_name',
// 				'type' => 'text',
// 				'order_no' => 1,
// 				'instructions' => '',
// 				'required' => 1,
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
// 				'default_value' => '',
// 				'formatting' => 'none',
// 			),
// 			2 => 
// 			array (
// 				'key' => 'field_29',
// 				'label' => 'Address',
// 				'name' => 'address',
// 				'type' => 'address-field',
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
// 							'value' => '',
// 						),
// 					),
// 					'allorany' => 'all',
// 				),
// 				'address_components' => 
// 				array (
// 					'address1' => 
// 					array (
// 						'enabled' => 0,
// 						'label' => 'Address 1',
// 						'default_value' => '',
// 						'class' => 'address1',
// 						'separator' => '',
// 					),
// 					'address2' => 
// 					array (
// 						'enabled' => 0,
// 						'label' => 'Address 2',
// 						'default_value' => '',
// 						'class' => 'address2',
// 						'separator' => '',
// 					),
// 					'address3' => 
// 					array (
// 						'enabled' => 0,
// 						'label' => 'Address 3',
// 						'default_value' => '',
// 						'class' => 'address3',
// 						'separator' => '',
// 					),
// 					'city' => 
// 					array (
// 						'enabled' => 1,
// 						'label' => 'City',
// 						'default_value' => '',
// 						'class' => 'city',
// 						'separator' => ',',
// 					),
// 					'state' => 
// 					array (
// 						'enabled' => 1,
// 						'label' => 'State',
// 						'default_value' => '',
// 						'class' => 'state',
// 						'separator' => '',
// 					),
// 					'postal_code' => 
// 					array (
// 						'enabled' => 1,
// 						'label' => 'Postal Code',
// 						'default_value' => '',
// 						'class' => 'postal_code',
// 						'separator' => '',
// 					),
// 					'country' => 
// 					array (
// 						'enabled' => 0,
// 						'label' => 'Country',
// 						'default_value' => '',
// 						'class' => 'country',
// 						'separator' => '',
// 					),
// 				),
// 				'address_layout' => 
// 				array (
// 					0 => 
// 					array (
// 						0 => 'city',
// 						1 => 'state',
// 						2 => 'postal_code',
// 					),
// 				),
// 			),
// 			3 => 
// 			array (
// 				'key' => 'field_20',
// 				'label' => 'High School Team',
// 				'name' => 'high_school_team',
// 				'type' => 'post_object',
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
// 					0 => 'team_type:7',
// 				),
// 				'allow_null' => 1,
// 				'multiple' => 0,
// 			),
// 			4 => 
// 			array (
// 				'key' => 'field_21',
// 				'label' => 'Travel Team',
// 				'name' => 'travel_team',
// 				'type' => 'post_object',
// 				'order_no' => 4,
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
// 				'post_type' => 
// 				array (
// 					0 => 'team',
// 				),
// 				'taxonomy' => 
// 				array (
// 					0 => 'team_type:8',
// 				),
// 				'allow_null' => 1,
// 				'multiple' => 0,
// 			),
// 			5 => 
// 			array (
// 				'key' => 'field_22',
// 				'label' => 'College Team',
// 				'name' => 'college_team',
// 				'type' => 'post_object',
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
// 					0 => 'team_type:9',
// 				),
// 				'allow_null' => 1,
// 				'multiple' => 0,
// 			),
// 			6 => 
// 			array (
// 				'key' => 'field_19',
// 				'label' => 'Scouting Report',
// 				'name' => 'scouting_report',
// 				'type' => 'wysiwyg',
// 				'order_no' => 6,
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
// 				'default_value' => '',
// 				'toolbar' => 'basic',
// 				'media_upload' => 'yes',
// 				'the_content' => 'yes',
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
// 					'value' => 'player',
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
	
// 		register_field_group(array (
// 		'id' => '510b4669b4823',
// 		'title' => 'Player Rankings',
// 		'fields' => 
// 		array (
// 			0 => 
// 			array (
// 				'key' => 'field_46',
// 				'label' => 'Ranking Type',
// 				'name' => 'ranking_type',
// 				'type' => 'categories',
// 				'order_no' => 0,
// 				'instructions' => 'To create a <b>Dunkdog Top 100 Ranking</b> select <b>Show All</b>; otherwise to create a <b>Positional Ranking</b> select the position you want to rank.	<br /><b>Remember:</b> positional rankings are only 50 players.',
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
// 				'post_type' => 'post',
// 				'child_of' => 0,
// 				'parent' => '',
// 				'orderby' => 'id',
// 				'order' => 'ASC',
// 				'hide_empty' => 1,
// 				'hierarchical' => 1,
// 				'taxonomy' => 'position',
// 				'include' => '',
// 				'exclude' => '',
// 				'display_type' => 'drop_down',
// 				'show_all' => 1,
// 				'show_none' => 0,
// 				'show_parent' => 0,
// 				'ret_val' => 'category_slug',
// 			),
// 			1 => 
// 			array (
// 				'key' => 'field_42',
// 				'label' => 'Player Rankings',
// 				'name' => 'player_rankings',
// 				'type' => 'repeater',
// 				'order_no' => 1,
// 				'instructions' => 'Add new players by clicking <b>Add Player</b> and linking to the correct player profile.	Ranking order can be changed by dragging and dropping players, and hitting <b>Update</b> on the post.',
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
// 				'sub_fields' => 
// 				array (
// 					'field_43' => 
// 					array (
// 						'label' => 'Player',
// 						'name' => 'player',
// 						'type' => 'relationship',
// 						'instructions' => '',
// 						'column_width' => '',
// 						'post_type' => 
// 						array (
// 							0 => 'player',
// 						),
// 						'taxonomy' => 
// 						array (
// 							0 => 'all',
// 						),
// 						'max' => 1,
// 						'order_no' => 0,
// 						'key' => 'field_43',
// 					),
// 				),
// 				'row_min' => 0,
// 				'row_limit' => '',
// 				'layout' => 'table',
// 				'button_label' => 'Add Player',
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
// 					'value' => 'player-ranking',
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
// 		'id' => '5106e1c348d8a',
// 		'title' => 'Team Information',
// 		'fields' => 
// 		array (
// 			0 => 
// 			array (
// 				'key' => 'field_28',
// 				'label' => 'Address',
// 				'name' => 'address',
// 				'type' => 'address-field',
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
// 				'address_components' => 
// 				array (
// 					'address1' => 
// 					array (
// 						'enabled' => 0,
// 						'label' => 'Address 1',
// 						'default_value' => '',
// 						'class' => 'address1',
// 						'separator' => '',
// 					),
// 					'address2' => 
// 					array (
// 						'enabled' => 0,
// 						'label' => 'Address 2',
// 						'default_value' => '',
// 						'class' => 'address2',
// 						'separator' => '',
// 					),
// 					'address3' => 
// 					array (
// 						'enabled' => 0,
// 						'label' => 'Address 3',
// 						'default_value' => '',
// 						'class' => 'address3',
// 						'separator' => '',
// 					),
// 					'city' => 
// 					array (
// 						'enabled' => 1,
// 						'label' => 'City',
// 						'default_value' => '',
// 						'class' => 'city',
// 						'separator' => ',',
// 					),
// 					'state' => 
// 					array (
// 						'enabled' => 1,
// 						'label' => 'State',
// 						'default_value' => '',
// 						'class' => 'state',
// 						'separator' => '',
// 					),
// 					'postal_code' => 
// 					array (
// 						'enabled' => 1,
// 						'label' => 'Postal Code',
// 						'default_value' => '',
// 						'class' => 'postal_code',
// 						'separator' => '',
// 					),
// 					'country' => 
// 					array (
// 						'enabled' => 1,
// 						'label' => 'Country',
// 						'default_value' => '',
// 						'class' => 'country',
// 						'separator' => '',
// 					),
// 				),
// 				'address_layout' => 
// 				array (
// 					0 => 
// 					array (
// 						0 => 'city',
// 						1 => 'state',
// 						2 => 'postal_code',
// 						3 => 'country',
// 					),
// 				),
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
// 					'value' => 'team',
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

// // TEAM RANKINGS
// 		register_field_group(array (
// 		'id' => '5125cf4816d7a',
// 		'title' => 'Team Rankings',
// 		'fields' => 
// 		array (
// 			0 => 
// 			array (
// 				'key' => 'field_8',
// 				'label' => 'Team Rankings',
// 				'name' => 'team_rankings',
// 				'type' => 'relationship',
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
// 				'post_type' => 
// 				array (
// 					0 => 'team',
// 				),
// 				'taxonomy' => 
// 				array (
// 					0 => 'team_type:8',
// 				),
// 				'max' => 25,
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
// 					'value' => 'team-ranking',
// 					'order_no' => 0,
// 				),
// 			),
// 			'allorany' => 'any',
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

}

?>