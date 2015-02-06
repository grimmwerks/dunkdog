<?php

// passing in: playerCount, playerPost, playerText, playerDisplay, hidePicture

$playerLink = get_permalink( $playerPost->ID );
$playerID = $playerPost->ID;


// defaults/blank
$className = $heightName = $weightName = $positionName  = ' - - ';
$high_school_teamName = $travel_teamName = $college_teamName = '';

//krumo(get_the_terms($playerID, 'dd-class'), get_the_terms($playerID, 'dd-height'));
if(get_the_terms($playerID, 'dd-class')){
	$class = array_shift(array_values(get_the_terms($playerID, 'dd-class')));
	$className = $class->name;
}
if(get_the_terms($playerID, 'dd-height')){
	$height = array_shift(array_values(get_the_terms($playerID, 'dd-height')));
	$heightName = $height->name;
}
if(get_the_terms($playerID, 'dd-weight')){
	$weight = array_shift(array_values(get_the_terms($playerID, 'dd-weight')));
	$weightName = $weight->name;
}
if(get_the_terms($playerID, 'dd-position')){
	$position = array_shift(array_values(get_the_terms($playerID, 'dd-position')));
	$positionName = $position->name;
}

if(get_field('high_school_team', $playerID)){
	$high_school_team = get_field('high_school_team', $playerID);
	if(!is_string($high_school_team)){$high_school_team = $high_school_team[0]->ID;}
	$high_school_teamName = get_the_title($high_school_team);
}
if(get_field('travel_team', $playerID)){
	$travel_team = get_field('travel_team', $playerID);
	if(!is_string($travel_team)){$travel_team = $travel_team[0]->ID;}
	$travel_team_teamName = get_the_title($travel_team);
}
if(get_field('college_team', $playerID)){
	$college_team = get_field('college_team', $playerID);
	 if(!is_string($college_team)){$college_team = $college_team[0]->ID;}
	$college_team_teamName = get_the_title($college_team);
}






switch($playerDisplay){
	case 'orange_strip':
		$player = $playerPost->ID;
		dunkdog_template_function('single-player-mini', true, compact('player', 'playerText'));
		break;
	case 'pop_up':
		dunkdog_template_function('single-player-card', true, compact('player', 'playerText'));
		break;
	case 'white_box_full': $size = 'span9'; $full=true; $perc = '20%';
	case 'white_box_half': if(is_null($full)){$size = 'one_half'; $perc='30%';}
		$img = '';
		if(!$hideHeadshot){
			if(has_post_thumbnail( $playerPost->ID )){
			    $imgID = get_post_thumbnail_id( $playerPost->ID);
			    $imgURL = wp_get_attachment_url($imgID);
			    $img = '<a href="'.$playerLink.'"><img class="alignleft" src="'. $imgURL .'" alt="'.$playerPost->post_title.'"  /></a>';
			}else{
			    $img = '<img  class="alignleft" src="'.plugins_url( "/includes/images/default_player.png", DD_BASE ).'" alt="'.$firstname.$lastname.'"  alt="'.$playerPost->post_title.'"/>';
			}
		}
		$stub = '';
		if($size=='one_half'){
			if ($playerCount % 2 == 0){$stub = 'last';}
		}
		
		echo '<div class="player_card_white_box '.$playerDisplay .' '.$size .' '.$stub .' text-align-left">';
		if(!$hideHeadshot){echo '<a href="'.$playerLink.'">'. $img . '</a>';}
		//echo '<h5>'. $playerPost->post_title . '</h5>';
		echo '<span class="categories">';
		if($playerPost->post_status='publish'){
			echo '<a href="'.$playerLink.'">'.$playerPost->post_title.'</a>';
		}else{
			echo $playerPost->post_title;
		}
		echo '</span><br />';
		echo '<b>Class: </b> '.$className.' | <b>HT: </b>'. $heightName .'   <b>WT: </b>'.$weightName .'  <b>POS: </b>'.$positionName . '<br />';
		echo $travel_teamName;
		if($travel_teamName!='' && $high_school_teamName!='' ){echo ' - ';} 
		echo $high_school_teamName . '<br />';
		echo $playerText;
		echo '</div>';

		break;
	case 'picture':
		if(has_post_thumbnail( $playerPost->ID )){
		    $imgID = get_post_thumbnail_id( $playerPost->ID);
		    $imgURL = wp_get_attachment_url($imgID);
		    $img = '<img src="'. $imgURL .'" alt="'.$playerPost->post_title.'" style="max-width:100%; max-height:100%;" width="100%" height="100%" />';
		}else{
		    $img = '<img src="'.plugins_url( "/includes/images/default_player.png", DD_BASE ).'" alt="'.$firstname.$lastname.'" style="max-width:100%; max-height:100%;" width="100%" height="100%" alt="'.$playerPost->post_title.'"/>';
		}

		echo '<div class="one_sixth"><a title="'.$playerPost->post_title.'" href="'. $playerLink . '">'.$img.'</a>'.$playerPost->post_title.'</div>';
		break;
	case 'link';
		echo '<span class="categories"><a href="'.$playerLink.'">'.$playerPost->post_title.'</a></span>';
		break;

	case 'none':
		// none will display; only linked in db
		break;
}
?>