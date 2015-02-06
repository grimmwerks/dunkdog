<?php




function dunkdog_lookup_player_rankings($class, $position){
	//SELECT wp_dd_posts.* FROM wp_dd_posts WHERE 1=1 AND wp_dd_posts.post_name = '2013-02-28-class-2016-dunkdog-top-100-2' AND wp_dd_posts.post_type = 'dd-player-ranking' ORDER BY wp_dd_posts.post_date DESC

	$args = array(
		'post_type' => 'dd-player-ranking',
		'dd-class' => $class,
		'posts_per_page' => '1',
		'meta_query' => array(
			array(
				'key' => 'ranking_type',
				'value' => $position,
				'compare' => '='
			)
		)
	);

	$query = new WP_Query( $args );
	return($query);
}






//  shortcode for page display of dunkdog db


if(!function_exists('dunkdog_rankings_controls_draw')){
	function dunkdog_rankings_controls_draw($args){
		$posList = array('PG', 'WG', 'WF', 'PF', 'C');

		$thisClass = $args['class'];
		$thisPosition = $args['position'];
		$rankID= $args['rankid'];
		$positions = get_terms('dd-position', array('hide_empty'=>false));
		// now have to look up 

		$activeCSS = ' style="color: #ffffff; background-color: #b30027; border: 1px solid white;"';
		$inactiveCSS = ' style="cursor: default;"';

$ret = '
<article class=" widget_categories" style="background: #191919; padding: 10px;">
	<div class="widget-4 container sidebar-widget">
		<ul style="margin-left:20px; padding:10px;">';

	$allpage = dunkdog_lookup_player_rankings($thisClass, 'all');
	

	$ret .='<li class="cat-item player-db-list "><a href="';
	 if($allpage->post_count){
	 	$ret.= get_permalink( $allpage->posts[0]->ID);
	 }else{
	 	$ret.='#';
	 }
	
	$ret.= '"';
	if($allpage->posts[0]->ID==$rankID){
		$ret .= $activeCSS;
	} 
	if(!$allpage->post_count){
		$ret.= $inactiveCSS;
	}
	$ret.='>Top Dog 100</a></li>';
	$ret .='<li class="cat-item player-db-list-title">By Positions:</li>';

	foreach($posList as $p){
		$tmpQ = dunkdog_lookup_player_rankings($thisClass, $p);
		$ret .= '<li class="cat-item player-db-list activeDBItem"><a href="';
		if($tmpQ->post_count){
		 	$ret.= get_permalink( $tmpQ->posts[0]->ID);
		}else{
			$ret.='#';
		}
		$ret.= '"';
		if($tmpQ->posts[0]->ID==$rankID){
			$ret .= $activeCSS;
		} 
		if(!$tmpQ->post_count){
			$ret.= $inactiveCSS;
		}
			$ret.='>'.$p.'</a></li>';
	}

	// foreach ($positions as $pos){
	// 	$tmpQ = dunkdog_lookup_player_rankings($thisClass, $pos->name); 
	// 	$ret .= '<li class="cat-item player-db-list activeDBItem"><a href="';
	// 	if($tmpQ->post_count){
	// 	 	$ret.= get_permalink( $tmpQ->posts[0]->ID);
	// 	}else{
	// 		$ret.='#';
	// 	}
	// 	$ret.= '"';
	// 	if($tmpQ->posts[0]->ID==$rankID){
	// 		$ret .= $activeCSS;
	// 	} 
	// 	if(!$tmpQ->post_count){
	// 		$ret.= $inactiveCSS;
	// 	}
	// 		$ret.='>'.$pos->name.'</a></li>';
	// }
	$ret.='	</ul>
	</div>
</article>';

return $ret;

	}
}

add_shortcode('dunkdog_rankings_controls', 'dunkdog_rankings_controls_draw');

/// getting list of team rankings and player rankings based upon dunkdog options
function dunkdog_player_ranking_list_menu_draw(){
	$activePlayerClasses = get_field('active_player_classes', 'options');
	$ret = '';
	if($activePlayerClasses){
		$ret .= '<div class="container">';
		//$ret .=  '<h3 class="widget-title sidebar-widget-title">Player Rankings</h3>';
		$ret .= '<ul>';

		foreach($activePlayerClasses as $aClass){
			$tmpQ = dunkdog_lookup_player_rankings($aClass->name, 'all'); 
			//$ret .= '<li class=""><a href="';
			//$ret.= '<a href="'. get_permalink( $tmpQ->posts[0]->ID) . 'TEST</a><br />';
			$ret .= '<li class="cat-item"><a href="'. get_permalink( $tmpQ->posts[0]->ID) .'">'.$aClass->name.'</a></li>';
		}
		$ret .='</ul></div>';
	}

	return $ret;
}

add_shortcode( 'dunkdog_player_ranking_list_menu', 'dunkdog_player_ranking_list_menu_draw' );




function dunkdog_team_ranking_list_menu_draw(){
	$activeTeamClasses = get_field('active_team_classes', 'options');
	$ret = '';
	if($activeTeamClasses){
		$ret .= '<div class="container">';
		//$ret .=  '<h3 class="widget-title sidebar-widget-title">Player Rankings</h3>';
		$ret .= '<ul>';

		foreach($activeTeamClasses as $aClass){
			$args = array(
				'post_type' => 'dd-team-ranking',
				'dd-class' => $aClass->name,
				'posts_per_page' => '1',
			);

			$query = new WP_Query( $args );
			$ret .= '<li class="cat-item"><a href="'. get_permalink( $query->posts[0]->ID) .'">'.$aClass->name.'</a></li>';
		}
		$ret .='</ul></div>';
	}
	return $ret;
}

add_shortcode( 'dunkdog_team_ranking_list_menu', 'dunkdog_team_ranking_list_menu_draw' );






?>