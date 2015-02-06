<?php
 /*Template Name: DunkDog Player Mini Box (ie in rankings or archive)
 */ 

if(isset($player)){ 
	


	$class = array_shift(array_values(get_the_terms($player->ID, 'class')));
	$height = array_shift(array_values(get_the_terms($player->ID, 'height')));
	$weight = array_shift(array_values(get_the_terms($player->ID, 'weight')));
	$position = array_shift(array_values(get_the_terms($player->ID, 'position')));
	$high_school_team = get_field('high_school_team', $player->ID);
	$travel_team = get_field('travel_team', $player->ID);
	$college_team = get_field('college_team', $player->ID);

	$firstname = get_post_meta( $player->ID, 'first_name', true);
 	$lastname = get_post_meta( $player->ID, 'last_name', true);

    $hs_stub = '';  $travel_stub = '';  $college_stub = '';
    if($high_school_team){$hs_stub = '<a href="'.get_permalink( $high_school_team ).'">'. get_the_title($high_school_team).'</a>';
    }
    if($travel_team){
    	$travel_stub = '<a href="'.get_permalink( $travel_team ).'">'. get_the_title($travel_team).'</a>';
    }
    if($college_team){
    	$college_stub = '<a href="'.get_permalink( $college_team ).'">'. get_the_title($college_team).'</a>';
    }



	if(has_post_thumbnail( $player->ID )){
		$imgID = get_post_thumbnail_id( $player->ID);
    $imgURL = wp_get_attachment_url($imgID);
    echo "IMG: " . $imgID;
    $img = '<a href="'. get_permalink($player->ID). '"><img src="'. $imgURL .'" alt="'.$firstname.$lastname.'" /></a>';
	}else{
      $img = '<a href="'. get_permalink($player->ID). '"><img src="'.plugins_url( "/includes/images/default_player.png", DD_BASE ).'" alt="'.$firstname.$lastname.'" /></a>';
    }
       

    echo '<div class="player-mini-box">';
    echo '<div class="player-mini-box-thumbnail" >'. $img . ' ' . $college . '</div>';
    if(isset($pos)){echo '<div class"player-mini-rank">'.$pos.'</div>';}
    echo '<div class="player-mini-name">'. $firstname . ' ' . $lastname . '</div>';
    echo '<div class="player-mini-stats">';  
    echo '<span class="player-mini-stats-height">HT: <a href="'. get_term_link($height->name, 'height') .'/">'. $height->name .'</a></span>';
    echo '<span class="player-mini-stats-weight">WT: <a href="'.get_term_link($weight->slug, 'weight'). '/">'.$weight->name. '</a></span>';
    echo '<span class="player-mini-stats-position">POS: <a href="'.get_term_link($position->name, 'position') .'">'. strtoupper($position->name) .'</a></span>';
    echo '<span class="player-mini-stats-hightschool">SCHOOL: '.$hs_stub. '</span>';
    echo '<span class="player-mini-stats-travel">TRAVEL: '. $travel_stub. '</span>';
    echo '</div></div>';
	
}

 ?>