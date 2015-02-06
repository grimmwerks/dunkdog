<?php

if(!function_exists('dunkdog_list_players_by_alph')){
	function dunkdog_list_players_by_alph(){
		global $wpdb;

		


		//$exp = explode(' - ', $_POST['aleph']);
		//$start = $exp[0]; $end = $exp[1];
		$reg = '^['. $_POST['aleph'] . '-'. $_POST['aleph'] . ']';
		
		//$sql = " SELECT DISTINCT post_id FROM  $wpdb->postmeta WHERE  (meta_key = 'last_name') AND (UPPER(meta_value) >= %s AND UPPER(meta_value) < %s)";
		//$sql = " SELECT DISTINCT post_id FROM  $wpdb->postmeta WHERE  (meta_key = 'last_name') AND (meta_value REGEXP '%s')";
		$sql = "SELECT DISTINCT post_id FROM  $wpdb->postmeta WHERE  (meta_key = 'last_name') AND (meta_value LIKE '%s')";

		$postids = $wpdb->get_col($wpdb->prepare($sql,  $_POST['aleph'] . '%'));	
		
		
		if ($postids) {
		 	$args=array(
				'order'=> 'ASC',
				'meta_key' => 'last_name',
				'orderby' => 'meta_value',
			   	'post__in' => $postids,
			   	'post_type' => 'dd-player',
			   	'post_status' => 'publish',
			   	'posts_per_page' => -1,
			   	'caller_get_posts'=> 1
			 );

			$my_query = null;
		 	$my_query = new WP_Query($args);

			foreach ($my_query->posts as $post) {
				$player = $post->ID;
				include 'templates/single-player-mini.php';
			}
			
			die();
		}else{
			echo '<center><div style="margin-top: 50px;"><h3>No players found.</h3></div></center>';
			die();
		}

		
	}
}



add_action('wp_ajax_dunkdog_list_players_by_alph', 'dunkdog_list_players_by_alph');
add_action('wp_ajax_nopriv_dunkdog_list_players_by_alph', 'dunkdog_list_players_by_alph');

//  shortcode for page display of dunkdog db



//if(!function_exists('dunkdog_player_database_draw')){
	function dunkdog_player_database_draw(){
		global $wp_query;
		$dbPage = $wp_query->posts[0];
/// first header image etc
		$head = '<div class="rankings-header">
					<div class="rankings-header-info">
					<h1>'.$dbPage->post_title.'</h1>
					</div>
				</div>
				<div class="clear"></div>';
	

$ret = $head;

if(S2MEMBER_CURRENT_USER_IS_LOGGED_IN_AS_MEMBER){
$ret .= '
<script type="text/javascript">
	var ajax_admin_url = "' . admin_url('admin-ajax.php') . '"
	var $jm = jQuery.noConflict();
	$jm(document).ready(function() {
		$jm(".player-db-list").click(function() {
			var alphs = $jm("a", this).html();
			$jm("#loading").fadeIn();
			displayPlayers(alphs);
        });
		
		function displayPlayers(str){
			var data = {
				action: "dunkdog_list_players_by_alph",
				aleph: str	
			};
			$jm.post(ajax_admin_url, data, function(response){
				$jm("#loading").fadeOut();
				$jm("#player-list").html(response);
				//$jm("#player-list").show();
				var count = 0;
				$jm(".playerContainer").each(function(i) {
					count++;
					var dis = $jm(this);
					$jm(this).hide();
				   	//$jm(this).delay(800*i).fadeIn();
				   	setTimeout(function() {
				   		dis.fadeIn();
				   		$jm("#db-found").text("Found: "+count);
					}, 50*i);

				});
			})
		}

		displayPlayers("A");
		$jm("#player-list").html().hide();

	});
</script>

<article class=" widget_categories" style="background: #191919; padding: 10px;">
	<div class="container player-db-head">
		<h3 class="widget-title sidebar-widget-title">Player by Last Name</h3>
		<div id="db-found"></div>	 
		<ul style="margin-left:20px; padding:10px;">';

$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';	
//$arr = str_split($str);
foreach (str_split($str) as $char){
	$ret .= '<li class="cat-item player-db-list"><a href="#">'.$char.'</a></li>';
}
$ret.='	</ul>
	</div>
</article><div class="clear"></div>';


}else{
	ob_start();

	echo $ret;
	dunkdog_no_access();
	$ret =  ob_get_clean();
}

	return $ret;

	}
//}

add_shortcode('dunkdog_player_database_controls', 'dunkdog_player_database_draw');


//if(!function_exists('dunkdog_player_database_list_draw')){
	function dunkdog_player_database_list_draw(){
		if(S2MEMBER_CURRENT_USER_IS_LOGGED_IN_AS_MEMBER){
		return '<div class="playerdb"><div id="player-list" style="min-height: 200px;"></div><div id="loading" class="loading"><div class="bar"> <i class="sphere"></i></div></div></div>';
		}
	}
//}
add_shortcode( 'dunkdog_player_database_list', 'dunkdog_player_database_list_draw' );





?>