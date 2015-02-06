<?php

 class Dunkdog_Rankings_Team_Image_Import{

 	var $log=array();
 	

	function __construct(){
		if(!class_exists("SimpleXLSX")){
			require_once(dirname(__FILE__) . "/simple-xlsx-0.6/simplexlsx.class.php");
		}
		add_action('admin_menu', array(&$this, 'dunkdog_team_image_import_menu'));
	}

	function dunkdog_team_image_import_menu(){
		require_once ABSPATH . '/wp-admin/admin.php';
		add_submenu_page ('edit.php?post_type=dd-team-ranking', 'Team Image Import', 'Team Image Import', 0, 'team-image-import', array(&$this, 'dunkdog_rankings_import_excel'));
	}

	function dunkdog_rankings_import(){
		if ('POST' == $_SERVER['REQUEST_METHOD']) {
	       // $this->loadExcel();
	    }
	}
// import functions
	function dunkdog_rankings_import_excel(){
		if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $this->loadExcel();
        }
		?>			
		<div class="wrap">
		<h2>Team Image Import</h2>
		<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
			  Choose your file: <br /> 
			  <input name="csv" type="file" id="csv" /> 
			  <input type="submit" name="Submit" value="Submit" /> 
		</form> 
		</div>
		<div class="clear"></div>
		<div class="output"></div>			
					
		<?php 				
	}


	// printing messages
	 function print_messages() {
        if (!empty($this->log)) {
			?>
			<div class="output">
		    	<?php 
		    	if (!empty($this->log['error'])): ?>
					 <div class="error">
						<?php foreach ($this->log['error'] as $error): ?>
				            <p><?php echo $error; ?></p>
				        <?php endforeach; ?>
					</div>
				<?php endif; ?>

			    <?php 
			    if (!empty($this->log['notice'])): ?>
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
	       	$this->log = array();
        }
    }


    function loadExcel(){
    	if(empty( $_FILES[csv][tmp_name])){
			$this->log['error']  = "No File uploaded, aborting.";
			return;
		}
		$excel = new SimpleXLSX($_FILES[csv][tmp_name]);
		if($excel->success()){
			$data = $excel->rows();
			$props = $data[0];
		 	for($i=1; $i<count($data); $i++){
			 	$team = array_combine($props, $data[$i]);
			 	$id = $this->createOrLinkTeam($team);
			}
			$id = $this->createOrLinkTeam(array_combine($props, $data[1]));
		}
    	

    	$this->print_messages();
    }


  

    function createOrLinkTeam($team){
    	global $wpdb;
    	$teamName = ($team["SCHOOL NAME"]);
    	if($teamName=='' || $teamName==null){return null;}
    	$this->log['message'][] = "Looking for team: " . $teamName;

    	$college = get_term_by( 'name', 'College', 'dd-team_type'); 
    	$confName = $team["CONFERENCE"];

     	//$sql = "SELECT $wpdb->posts.ID FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) WHERE 1=1 AND ( $wpdb->term_relationships.term_taxonomy_id IN ($college->term_id) ) AND $wpdb->posts.post_type = 'dd-team' AND ($wpdb->posts.post_status = 'publish') and ($wpdb->posts.post_title=%s)";

    	$sql = "SELECT $wpdb->posts.ID FROM $wpdb->posts WHERE $wpdb->posts.post_type = 'dd-team' AND ($wpdb->posts.post_status = 'publish') and ($wpdb->posts.post_title=%s)";

     	$tid = $wpdb->get_var($wpdb->prepare($sql, $teamName));

    	if($tid!=null){
     		$this->log['message'][] = "<b>Team Found: ". $teamName . ' ID:' . $tid . '</b>';
     	}else{
    		$tmp = array(
				'post_title'=>$teamName,
				'post_type'=>'dd-team',
				'post_status'=>'publish',
				);

     		$tid = wp_insert_post($tmp); 
     		wp_set_object_terms($tid, 'College',  'dd-team_type');
     		$this->log['error'][] = "Creating Team: " . $teamName . ' ID: '. $tid ;
     	}

      	wp_set_object_terms( $tid, $confName, 'dd-conference' );
      	$imageName = substr($team["ASSOCIATED IMAGE"], 0, -4);
      	$imgSQL = "SELECT ID FROM $wpdb->posts WHERE post_title =%s AND post_type = 'attachment' AND post_status != 'trash' AND (post_mime_type = 'image/jpeg' OR post_mime_type = 'image/gif' OR post_mime_type = 'image/png')";
      	$imgID  = $wpdb->get_var( $wpdb->prepare( $imgSQL, $imageName));

     	
      	$this->log['message'][] = "Image: " . $imageName. ' ' . $imgID;

     	if(($imgID!=null)&& !(has_post_thumbnail( $tid ))){
     		add_post_meta($tid, '_thumbnail_id', $imgID, true);
     		$this->log['messages'][] = "Image " . $imageName . " attached to post " . $tid;
     	}else{
     		$this->log['error'][] = "Image: " . $imageName . " not attached to any team.";
     	}

     	return $tid;
    }



  



 }

 $ddtii= new Dunkdog_Rankings_Team_Image_Import();
?>