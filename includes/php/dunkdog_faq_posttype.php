<?php


add_action( 'init', 'dunkdog_register_faq_posttype',  -1 ); // must -1 to ensure this runs before Ajax functions that rely on this post type

function dunkdog_register_faq_posttype() { 
	register_post_type('dunkdog_faq', 
		array(	'label' => 'DunkDog FAQ',
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive'=>false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array('slug' => 'faq'),
			'query_var' => true,
			'supports' => array('title','editor','revisions','thumbnail','author'),
			'menu_icon' => plugins_url( '/includes/images/balloons-box.png', DD_BASE ),
			'labels' => array (
				'name' => 'DunkDog FAQs',
				'singular_name' => 'DunkDog FAQ',
				'menu_name' => 'DunkDog FAQs',
				'add_new' => 'Add FAQ',
				'add_new_item' => 'Add New FAQ',
				'edit' => 'Edit FAQs',
				'edit_item' => 'Edit FAQ',
				'new_item' => 'New FAQ',
				'view' => 'View FAQ',
				'view_item' => 'View FAQ',
				'search_items' => 'Search FAQs',
				'not_found' => 'No FAQs Found',
				'not_found_in_trash' => 'No FA Found in Trash',
			),
		) 
	);

	register_taxonomy('dunkdog_faq_types',
		array (
		    0 => 'dunkdog_faq',
		),
		array( 'hierarchical' => true, 
			'label' => 'FAQ Types',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'faq-type' ),
		'singular_label' => 'FAQ Type') 
	);

}




if(!function_exists('dunkdog_faq_draw')){
	function dunkdog_faq_draw($args){
		global $wpdb;
		$sql = "select distinct ID from $wpdb->posts where post_type='dunkdog_faq' and post_status='publish'";

		$postids = $wpdb->get_col($wpdb->prepare($sql));
		foreach ($postids as $ID) {
			$faq = get_post($ID);
?>
			<div class="accordion faq" id="accordion_<?php echo $ID; ?>">
				<div class="accordion-group">
					<div class="accordion-heading faqHeader " >
						<a class="accordion-toggle closed" data-toggle="collapse" data-parent="#accordion_<?php echo $ID; ?>" data-target="#collapseOne<?php echo $ID; ?>">
							<div class="faqDiv">
								<div class="faqIconOpen"><?php echo do_shortcode( '[icon icon="arrow-down" color="#ffffff"][/icon]' ); ?></div>
								<div class="faqName">
									<?php echo $faq->post_title; ?>
								</div>
							</div>
						</a>
					</div>
					<div id="collapseOne<?php echo $ID; ?>" class="accordion-body collapse" style="height: 0px; overflow: hidden;">
						<div class="accordion-inner">
							<p>
								<?php echo $faq->post_content; ?>
							</p>
						</div>
					</div>
				</div>
			</div>

<?php

		}

	}
}
add_shortcode( 'dunkdog_faqs', 'dunkdog_faq_draw' );



?>