<?php

 class Dunkdog_Rankings_Import{

 	var $log=array();
 	

	function __construct(){
		if(!class_exists("SimpleXLSX")){
			require_once(dirname(__FILE__) . "/simple-xlsx-0.6/simplexlsx.class.php");
		}
		add_action('admin_menu', array(&$this, 'dunkdog_rankings_import_menu'));
	}

	function dunkdog_rankings_import_menu(){
		require_once ABSPATH . '/wp-admin/admin.php';
		add_submenu_page ('edit.php?post_type=dd-player-ranking', 'Rankings Import', 'Rankings Import', 0, 'rankings-import', array(&$this, 'dunkdog_rankings_import_excel'));
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
			//$this->fixTeamStates();
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
			?>
			<div class="wrap">
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
    	global $wpdb;

    	if(empty( $_FILES[csv][tmp_name])){
			$this->log['error']  = "No File uploaded, aborting.";
			return;
		}
		$excel = new SimpleXLSX($_FILES[csv][tmp_name]);

		if($excel->success()){
			$now = new DateTime("now");
			$classyear =  $excel->sheetName(1); // main sheet name

			$pre =  $now->format('Y-m-d :');


			// dunkdog top 100;   count($data)
			$rid = $this->createOrLinkRankingPage($pre, 'all', $classyear);
			$data = $excel->rows();
			$props = $data[0];
			//$cnt = 0;
			$pl_rankings = array();
			for($i=1; $i<count($data); $i++){
				// need to create ranking page with date and type of top100
				// create linking
				$pid = $this->createOrLinkPlayer(array_combine($props, $data[$i]), $classyear);
				//update_post_meta($rid, 'player_rankings', 1);
				if($pid!=null){
					//$cnt++;
					$rankpos = ($data[$i][0] - 1);
					$this->log['message'][] = "Player ID:  ". $pid . ' rank: ' . $rankpos;
					$pl_rankings[$rankpos] = $pid;
					//$f = 'player_rankings_'. $rankpos . '_player';
					//update_post_meta( $rid, $f, array($pid));
				}
			}

			update_post_meta( $rid, 'player_rankings', $pl_rankings );
			//update_post_meta( $rid, 'player_rankings', $cnt);
			//update_post_meta( $rid, '_player_rankings', 'field_42');

			//this is position rankings
			for($i=2; $i<=$excel->sheetsCount(); $i++){
				$position = strtolower($excel->sheetName($i));
				$rid = $this->createOrLinkRankingPage($pre, $position, $classyear);
				$data = $excel->rows($i);
				//$cnt = 0;
				$pl_rankings = array();
				for($j=1; $j<count($data); $j++){
					$pid = $this->createOrLinkPlayer(array_combine($props, $data[$j]), $classyear);
					if($pid!=null){
						//$cnt++;
						$rankpos = ($data[$j][0] - 1);
						$this->log['message'][] = "Player ID:  ". $pid . ' rank: ' . $data[$j][0];
						$pl_rankings[$rankpos] = $pid;
						//$f = 'player_rankings_'. $rankpos . '_player';
						//update_post_meta( $rid, $f, array($pid));
					}
				}
				update_post_meta( $rid, 'player_rankings', $pl_rankings );
				//update_post_meta( $rid, 'player_rankings', $cnt);
				//update_post_meta( $rid, '_player_rankings', 'field_42');
			}
		}

		$this->print_messages();

    }

    function createOrLinkRankingPage($pre, $type, $class){
    	global $wpdb;
    	if($type=='all'){
    		$suf = "DunkDog Top 100";
    	}else{
    		$suf = "Positional Ranking ". strtoupper($type);
    	}

    	$title = $pre . ' Class '. $class . ' '. $suf;

     	$term = get_term_by( 'name', $class, 'class');
     	$sql = "SELECT $wpdb->posts.ID FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) WHERE 1=1 AND ( $wpdb->term_relationships.term_taxonomy_id IN ($term->term_id) ) AND $wpdb->posts.post_type = 'dd-player-ranking' AND ($wpdb->posts.post_status = 'publish') and ($wpdb->posts.post_title='$title')";

     	$rid = $wpdb->get_var($wpdb->prepare($sql));
	 	$this->log['message'][] = '<h3>' . $title . '</h3>  ....';

     	if($rid!=null){
    		$this->log['message'][] = "<b>Ranking found: ". $title . ' ID:' . $rid . '</b>';
    	}else{
    		$props = array(
				'post_title'=>$title,
				'post_type'=>'dd-player-ranking',
				'post_status'=>'publish',
				);

     		$rid = wp_insert_post($props);
     		wp_set_object_terms($rid, $class, 'dd-class');
     		$this->log['message'][] = "Saving: " . $title . ' ID: '. $rid . ' Type: '. $type;
     		update_post_meta( $rid, 'ranking_type', $type);
     	}

     	return $rid;
    }

    function createOrLinkPlayer($player, $classyear){
    	global $wpdb;

    	$firstname = $player['FIRST NAME'];
    	$lastname = $player['LAST NAME'];
    	$city = $player['CITY'];
    	$state = $player['STATE'];
    	$address = array('city'=>$player['CITY'], 'state'=>$player['STATE'], 'postal_code'=>'');

    	if(($firstname=='' || $firstname==null) && ($lastname=='' || $lastname==null)){
    		return null;
    	}
    	$this->log['message'][]='Loading '. $firstname . ' ' . $lastname;
    	$args = array('post_type'=>'dd-player', 
    		'post_status' => 'publish', 
    			'meta_query'=>array(
    				'relation'=>'AND',
    				array('key'=>'first_name', 'value'=>$firstname,'compare'=>'='),
    				array('key'=>'last_name', 'value'=>$lastname,'compare'=>'='),
    				array('key'=>'address', 'value'=>$player['CITY'],'compare'=>'LIKE'),
    				array('key'=>'address', 'value'=>$player['STATE'],'compare'=>'LIKE')
    			)
    	);

		$query = new WP_Query( $args );
		if($query->found_posts){
			// update info?
			$pid = $query->posts[0]->ID;
		}else{
			$props = array(
				'post_title'=>$firstname . ' ' . $lastname,
				'post_type'=>'dd-player',
				'post_status'=>'publish',
				);
			$pid = wp_insert_post($props);
			update_post_meta($pid, 'first_name', $firstname);
			update_post_meta($pid, 'last_name', $lastname);
			update_post_meta($pid, 'address', $address);
		}
		wp_set_object_terms($pid, sanitize_key( $classyear ), 'dd-class');
		wp_set_object_terms($pid, $player['HEIGHT'], 'dd-height');
		wp_set_object_terms($pid, sanitize_key( $player['WEIGHT']), 'dd-weight');
		wp_set_object_terms($pid, sanitize_key( $player['POSITION']), 'dd-position');
$this->log['error'][]= $pid . ' CLASS ' . sanitize_key( $classyear ) . '  HEIGHT ' . $player['HEIGHT'] . '   WEIGHT ' . sanitize_key( $player['WEIGHT']) . '  POS ' . sanitize_key( $player['POSITION']);


		// schools
		//echo $player['SCHOOL'];
		$h = $this->createOrLinkTeam('High School', $player['SCHOOL']);
		if($h!=null){
			//update_field('high_school_team',  $h, $pid);
			update_post_meta($pid, 'high_school_team', $h);
			$this->log['message'][]=' -- High School: '.$h;
		}
		$travel = $this->createOrLinkTeam('AAU', $player['TRAVEL TEAM']);
		if($travel!=null){
			//update_field('travel_team',  $travel, $pid);
			update_post_meta($pid, 'travel_team', $travel);
			$this->log['message'][]=' -- AAU: '.$travel;
		}
		$college = $this->createOrLinkTeam('College', $player['COLLEGE']);
		if($college!=null){
			//update_field('college_team',  $college, $pid);
			update_post_meta($pid, 'college_team', $college);
			$this->log['message'][]=' -- College: '.$college;
		}

		// img uploaded
		$name = $firstname . $lastname;
    	$imgID  = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title ='$name' AND post_type = 'attachment' AND post_status != 'trash' AND (post_mime_type = 'image/jpeg' OR post_mime_type = 'image/gif' OR post_mime_type = 'image/png')"));

    	$this->log['message'][] = "Image: " . $name. ' ' . $imgID;
    	if(($imgID!=null)&& !(has_post_thumbnail( $pid ))){add_post_meta($pid, '_thumbnail_id', $imgID, true);}

		return $pid;
    }

    function createOrLinkTeam($type, $teamName){
    	global $wpdb;
    	if($teamName=='' || $teamName==null){return null;}
    	$address = null;
    	preg_match('#\((.*?)\)#', $teamName, $match);
		if(strlen($match[1])==2){$address = array('city'=>'', 'state'=>$match[1], 'postal_code'=>'');}

    	$this->log['message'][] = "School Type: " . $type . "   School: " . $teamName;
    	$term = get_term_by( 'name', $type, 'dd-team_type');
    	$sql = "SELECT $wpdb->posts.ID FROM $wpdb->posts INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) WHERE 1=1 AND ( $wpdb->term_relationships.term_taxonomy_id IN ($term->term_taxonomy_id) ) AND $wpdb->posts.post_type = 'dd-team' AND ($wpdb->posts.post_status = 'publish') and ($wpdb->posts.post_title=%s)";


    	$tid = $wpdb->get_var($wpdb->prepare($sql, $teamName));
    	
    	if($tid!=null){
     		$this->log['message'][] = "<b>Team Found: ". $teamName . ' ID:' . $tid . '</b>';
     	}else{
    		$props = array(
				'post_title'=>$teamName,
				'post_type'=>'dd-team',
				'post_status'=>'publish',
				);

     		$tid = wp_insert_post($props);
     		wp_set_object_terms($tid, $type, 'dd-team_type');
     		$this->log['message'][] = "Saving: " . $teamName . ' ID: '. $tid . ' Type: '. $type;
     	}
     	
     	if($address!=null){update_post_meta($tid, 'team_address', $address);}

     	return $tid;
    }

    function fixTeamStates(){
    	global $wpdb;

    	$sql = "SELECT $wpdb->posts.ID, $wpdb->posts.post_title FROM $wpdb->posts WHERE  $wpdb->posts.post_type = 'dd-team' AND ($wpdb->posts.post_status = 'publish')";
    	$teams = $wpdb->get_results($sql);
    	foreach ($teams as $team) {
    		preg_match('#\((.*?)\)#', $team->post_title, $match);
    		if(strlen($match[1])==2){
    			$address = array('city'=>'', 'state'=>$match[1], 'postal_code'=>'');
    			update_post_meta($team->ID, 'team_address', $address);
    			echo $team->post_title . ' :  ' . $address['state'].'<br />';
    		}
    	}
    	
    }

 }

 $ddri= new Dunkdog_Rankings_Import();
?>