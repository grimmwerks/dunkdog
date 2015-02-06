<?php
/*
Plugin Name: DunkDog Customization
Plugin URI: www.igrimmwerks.com
Description: Customization of DunkDog.com.
Version: 2.0
Author: Garry Schafer
Author URI: http://www.grimmwerks.com
Site Wide Only: true
*/

define('DD_BASE', __FILE__);
define('DD_BASE_DIR', dirname(__FILE__));

define('DD_DEBUG', false);


require_once(DD_BASE_DIR . '/includes/php/krumo/class.krumo.php');

class DD_Custom{
	public function __construct(){
		$this->install_acf_plugin();
		$this->install_acf_addons();
		require_once(DD_BASE_DIR . '/includes/php/dunkdog_rankings.php');
		require_once(DD_BASE_DIR . '/includes/php/dunkdog_faq_posttype.php');
		//require_once(DD_BASE_DIR . '/includes/php/dunkdog_schools_import.php');
		//require_once(DD_BASE_DIR . '/includes/php/dunkdog_article_user_acf.php');
		require_once(DD_BASE_DIR . '/includes/php/dunkdog_rankings_page_display.php');
		require_once(DD_BASE_DIR . '/includes/php/dunkdog_usermeta.php');
		require_once(DD_BASE_DIR . '/includes/php/dunkdog_rankings_import.php');
	 	require_once(DD_BASE_DIR . '/includes/php/dunkdog_team_image_import.php');
		require_once(DD_BASE_DIR . '/includes/php/dunkdog_rankings_acf_fields.php');
		require_once(DD_BASE_DIR . '/includes/php/dunkdog_original_posttypes.php');
	 	require_once(DD_BASE_DIR . '/includes/php/dunkdog_players_db.php');
	 	require_once(DD_BASE_DIR . '/includes/php/dunkdog-added-shortcodes.php');
	}

	// just adding helper functions for using ACF plugin
	function install_acf_plugin(){
		require_once(DD_BASE_DIR . '/includes/php/class-tgm-plugin-activation.php');
		add_action( 'tgmpa_register', array(&$this,  'action_install_acf_plugin' ));
	}

	function install_acf_addons(){
		include( DD_BASE_DIR . '/includes/php/acf/acf-address-field/address-field.php' );
		include( DD_BASE_DIR . '/includes/php/acf/acf-taxonomy-field/taxonomy-field.php' );
		if (function_exists('register_field')) { 
		  register_field('Categories_field', DD_BASE_DIR. '/includes/php/acf/acf-addons-master/categories.php'); 
		  register_field('Unique_key_field', DD_BASE_DIR . '/includes/php/acf/acf-addons-master/unique_key.php'); 
		  register_field('Tax_field', DD_BASE_DIR . '/includes/php/acf/acf-tax-master/acf-tax.php');
		}
	}

	function action_install_acf_plugin(){
		$plugins = array(
			array(
				'name' 		=> 'Advanced Custom Fields',
				'slug' 		=> 'advanced-custom-fields',
				'required' 	=> true,
				'has_notices' => true,
				'force_activation' => true
			)
		);
		$theme_text_domain = 'tgmpa';
		
		$config = array(
			'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
				'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
				'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
				'notice_can_install_required'     			=> _n_noop( 'DunkDog requires the following plugin: %1$s.', 'Simple Events plugin requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'DunkDog recommends the following plugin: %1$s.', 'Simple Events plugin recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);

		tgmpa( $plugins, $config );
	}
	// end of ACF helper functions

}

$dd = new DD_Custom();



?>