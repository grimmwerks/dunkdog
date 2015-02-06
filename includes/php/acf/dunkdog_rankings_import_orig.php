<?php

class Silk_Import{
	var $log=array();
	var $lines = array();
	var $props = array();
	var $products = array();
	
//	var $w = wp_upload_dir();
//	var $wooimg = $w['baseurl'] . '/woocommerce_uploads/';
	
	
	var $cats = array();
		
	function __construct(){
		add_action('admin_menu', array(&$this, 'silk_import_menu'));
		
		if(!class_exists("SimpleXLSX")){
			require_once(dirname(__FILE__) . "/simple-xlsx-0.4/simplexlsx.class.php");
		}

		
	}
		
		
	function silk_import_menu(){
		require_once ABSPATH . '/wp-admin/admin.php';
		add_submenu_page ('edit.php?post_type=player-ranking', 'Rankings Import', 'Rankings Import', 0, 'rankings-import', array(&$this, 'dunkdog_rankings_import'));
	}
	
	
	function dunkdog_rankings_import(){
		if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $this->loadExcel();
        }

		?>			
		<div class="wrap">
		<h2>Dunkdog Rankings Import</h2>
		<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
			  Choose your file: <br /> 
			  <input name="csv" type="file" id="csv" /> 
			  <input type="submit" name="Submit" value="Submit" /> 
		</form> 
		</div>			
					
		<?php 				
	}

	// printing messages
	 function print_messages() {
        if (!empty($this->log)) {

        // messages HTML {{{
?>

<div class="wrap">
    <?php if (!empty($this->log['error'])): ?>

    <div class="error">

        <?php foreach ($this->log['error'] as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>

    </div>

    <?php endif; ?>

    <?php if (!empty($this->log['notice'])): ?>

    <div class="updated fade">

        <?php foreach ($this->log['notice'] as $notice): ?>
            <p><?php echo $notice; ?></p>
        <?php endforeach; ?>

    </div>

    <?php endif; ?>
    
    <?php if (!empty($this->log['message'])): ?>

    <div>

        <?php foreach ($this->log['message'] as $message): ?>
            <p><?php echo $message; ?></p>
        <?php endforeach; ?>

    </div>

    <?php endif; ?>

    
    
</div><!-- end wrap -->

<?php
        // end messages HTML }}}

            $this->log = array();
        }
    }
	
	
	
	
	
		


		
	function loadExcel(){
		global $wpdb;
				
		if(empty( $_FILES[csv][tmp_name])){
			$this->log['error']  = "No File uploaded, aborting.";
			return;
		}
	
		$time_start = microtime(true);
		
		$xlsx = new SimpleXLSX($_FILES[csv][tmp_name]);

		$data = $xlsx->rows();
		$this->props = $data[0];
	
	
		// for($i=5; $i<count($data); $i++){
		// 	$this->importItem($data[$i]);
		// }
		
		$this->print_messages();
		echo "Finished importing " . count($data) . ' items.';			
	}
		

	function importItem($item){
		set_time_limit(0);
		global $wpdb;
		$this->log['message'][] = "Importing " . $item[0];
		// need to find or create product with basic info
		$query = get_posts(array('posts_per_page'=>1, 'post_type'=>'product', 'meta_key'=>'_sku', 'meta_value'=> $item[0]));
		if(empty($query)){
			$productID= $this->setupDefaultProduct($item);
		}else{
			$product = $query[0];
			$productID = $product->ID;
			$this->log['message'][] = "Found  " . $item[0] . ' at ' . $productID;
		}
		
		// $productID is the productID now -- take care of the ones we know
		// if($item[17]!=null){
		// 			update_post_meta($productID, '_price', $item[17]); // price
		// 			update_post_meta($productID, '_regular_price', $item[17]);
		// 			$this->log['message'][] = "Price " . $productID. ' to '. $item[17];
		// 
		// 		}
		// 		// sale price
		// 		if($item[18]!=null && $item[18]!=0 && $item[18]!='0'){
		// 			update_post_meta($productID, '_sale_price', $item[18]); 
		// 
		// 		}
		// width / depth / height are in inches; need to be cm via * 2.54
		// item-width:  13
		if($item[13]!=null){
			update_post_meta($productID, '_width', ($item[13]));
		}
		// depth
	
		

		// CATEGORIES
		if($item[3]!=null){
			//$terms = array_map('intval', explode(',', $item[3])); // real site
			$terms = explode(',', $item[4]); // this is my site
			wp_set_object_terms($productID, $terms, 'product_cat');
			$this->log['message'][] = "Linking product_cat: ". $item[3];

		}	

		if($item[4]!=null){
			$terms = explode(',', $item[4]);
			wp_set_object_terms($productID, $terms, 'room');
			$this->log['message'][] = "Linking CATEGORY: ". $item[4];

		}	
		
		if($item[9]!=null){
			$terms = explode(',', $item[9]);
			wp_set_object_terms($productID, $terms, 'age');
			$this->log['message'][] = "Linking age: ". $item[45];

		}		

	}
	
	
	



		
}


?>