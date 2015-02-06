<?php

	/*
*	Advanced Custom Fields - New field template
*
*	Create your field's functionality below and use the function:
*	register_field($class_name, $file_path) to include the field
*	in the acf plugin.
*
*	Documentation:
*
*/

	class Unique_key_field extends acf_Field {

		/*--------------------------------------------------------------------------------------
*
*	Constructor
*	- This function is called when the field class is initalized on each page.
*	- Here you can add filters / actions and setup any other functionality for your field
*
*	@author Elliot Condon
*	@since 2.2.0
*
*-------------------------------------------------------------------------------------*/

		function __construct($parent) {
			// do not delete!
			parent::__construct($parent);

			// set name / title
			$this->name = 'unique_key';
			// variable name (no spaces / special characters / etc)
			$this->title = __("Unique Key", 'acf');
			// field label (Displayed in edit screens)

		}

		/*--------------------------------------------------------------------------------------
*
*	create_options
*	- this function is called from core/field_meta_box.php to create extra options
*	for your field
*
*	@params
*	- $key (int) - the $_POST obejct key required to save the options to the field
*	- $field (array) - the field object
*
*	@author Nontas Ravazoulas
*	@since 1.0.0
*
*-------------------------------------------------------------------------------------*/

		function create_options($key, $field) {
			// defaults
			$field['read_only']   = isset($field['read_only']) ? $field['read_only'] : '';
			$field['is_password'] = isset($field['is_password']) ? $field['is_password'] : ''; ?>

		<tr class="field_option field_option_<?php echo $this->name;?>">
			<td class="label">
				<label><?php _e("Read Only", 'acf');?></label>
			</td>
			<td>
				<?php
				$this->parent->create_field(array(
					'type'    => 'radio',
					'name'    => 'fields[' . $key . '][read_only]',
					'value'   => $field['read_only'],
					'choices' => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'layout'  => 'horizontal',
				));
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php echo $this->name;?>">
			<td class="label">
				<label><?php _e("Hide Characters", 'acf');?></label>
			</td>
			<td>
				<?php
				$this->parent->create_field(array(
					'type'    => 'radio',
					'name'    => 'fields[' . $key . '][is_password]',
					'value'   => $field['is_password'],
					'choices' => array(
						'1' => 'Yes',
						'0' => 'No',
					),
					'layout'  => 'horizontal',
				));
				?>
			</td>
		</tr>
		<?php
		}

		/*--------------------------------------------------------------------------------------
*
*	pre_save_field
*	- this function is called when saving your acf object. Here you can manipulate the
*	field object and it's options before it gets saved to the database.
*
*	@author Elliot Condon
*	@since 2.2.0
*
*-------------------------------------------------------------------------------------*/

		function pre_save_field($field) {
			// do stuff with field (mostly format options data)

			return parent::pre_save_field($field);
		}

		/*--------------------------------------------------------------------------------------
*
*	create_field
*	- this function is called on edit screens to produce the html for this field
*
*  @author Nontas Ravazoulas
*  @since 1.0.0
*
*-------------------------------------------------------------------------------------*/

		function create_field($field) {
			global $wpdb;
			$unique_key  = '';
			$ret_val     = '';
			$read_only   = '';
			$is_password = '';

			$unique_key_row = $wpdb->get_row("SELECT MD5(RAND()) AS unique_key");
			$unique_key     = $unique_key_row->unique_key;

			$field['read_only']   = isset($field['read_only']) ? $field['read_only'] : '';
			$field['is_password'] = isset($field['is_password']) ? $field['is_password'] : '';

			if (isset($field['value'])) {
				if ($field['value'] == '' || $field['value'] == NULL) {
					$ret_val = $unique_key;
				} else {
					$ret_val = $field['value'];
				}
			}

			if ($field['read_only'] == 1) {
				$read_only = 'readonly="readonly"';
			} else {
				$read_only = '';
			}

			if ($field['is_password'] == 1) {
				$is_password = 'password';
			} else {
				$is_password = 'text';
			}

			echo '<input type="' . $is_password . '" value="' . $ret_val . '" id="' . $field['name'] . '" class="' . $field['class'] . '" name="' . $field['name'] . '"' . $read_only . ' />';
		}

		/*--------------------------------------------------------------------------------------
*
*	admin_head
*	- this function is called in the admin_head of the edit screen where your field
*	is created. Use this function to create css and javascript to assist your
*	create_field() function.
*
*	@author Elliot Condon
*	@since 2.2.0
*
*-------------------------------------------------------------------------------------*/

		function admin_head() {

		}

		/*--------------------------------------------------------------------------------------
*
*	admin_print_scripts / admin_print_styles
*	- this function is called in the admin_print_scripts / admin_print_styles where
*	your field is created. Use this function to register css and javascript to assist
*	your create_field() function.
*
*	@author Elliot Condon
*	@since 3.0.0
*
*-------------------------------------------------------------------------------------*/

		function admin_print_scripts() {

		}

		function admin_print_styles() {

		}

		/*--------------------------------------------------------------------------------------
*
*	update_value
*	- this function is called when saving a post object that your field is assigned to.
*	the function will pass through the 3 parameters for you to use.
*
*	@params
*	- $post_id (int) - usefull if you need to save extra data or manipulate the current
*	post object
*	- $field (array) - usefull if you need to manipulate the $value based on a field option
*	- $value (mixed) - the new value of your field.
*
*	@author Elliot Condon
*	@since 2.2.0
*
*-------------------------------------------------------------------------------------*/

		function update_value($post_id, $field, $value) {
			// do stuff with value

			// save value
			parent::update_value($post_id, $field, $value);
		}

		/*--------------------------------------------------------------------------------------
*
*	get_value
*	- called from the edit page to get the value of your field. This function is useful
*	if your field needs to collect extra data for your create_field() function.
*
*	@params
*	- $post_id (int) - the post ID which your value is attached to
*	- $field (array) - the field object.
*
*	@author Elliot Condon
*	@since 2.2.0
*
*-------------------------------------------------------------------------------------*/

		function get_value($post_id, $field) {
			// get value
			$value = parent::get_value($post_id, $field);

			// format value

			// return value
			return $value;
		}

		/*--------------------------------------------------------------------------------------
*
*	get_value_for_api
*	- called from your template file when using the API functions (get_field, etc).
*	This function is useful if your field needs to format the returned value
*
*	@params
*	- $post_id (int) - the post ID which your value is attached to
*	- $field (array) - the field object.
*
*	@author Elliot Condon
*	@since 3.0.0
*
*-------------------------------------------------------------------------------------*/

		function get_value_for_api($post_id, $field) {
			// get value
			$value = $this->get_value($post_id, $field);

			// format value

			// return value
			return $value;

		}

	}

?>