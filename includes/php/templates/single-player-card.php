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
    if($high_school_team){
    	if(!is_string($high_school_team)){$high_school_team = $high_school_team[0]->ID;}
    	$hs_stub = '<a href="'.get_permalink( $high_school_team ).'">'. get_the_title($high_school_team).'</a>';
    }
    if($travel_team){
    	if(!is_string($travel_team)){$travel_team = $travel_team[0]->ID;}
    	$travel_stub = '<a href="'.get_permalink( $travel_team ).'">'. get_the_title($travel_team).'</a>';
    }
    if($college_team){
    	if(!is_string($college_team)){$college_team = $college_team[0]->ID;}
    	$college_stub = '<a href="'.get_permalink( $college_team ).'">'. get_the_title($college_team).'</a>';
    }



	if(has_post_thumbnail( $player->ID )){
		$imgID = get_post_thumbnail_id( $player->ID);
    	$imgURL = wp_get_attachment_url($imgID);
    	$fpath = dunkdog_remove_last_url($imgURL);



    	$nImg = wp_get_image_editor( $imgURL ); 

		if ( ! is_wp_error( $nImg ) ) {
		    //$nImg->resize( 100, 130, true );
		    $nImg->crop(160,0,280,320,60,69);

		   	$image =  $nImg->save( $player->ID.'.png' , 'image/png');
		   	$imgURL = '/'.($image['file']);
		  
		}

    $img = '<a href="'. get_permalink($player->ID). '"><img src="'. $imgURL .'" alt="'.$firstname.$lastname.'" style="max-width: 100%;"" /></a>';
	}else{
      $img = '<a href="'. get_permalink($player->ID). '"><img src="'.plugins_url( "/includes/images/default_player_sm.png", DD_BASE ).'" alt="'.$firstname.$lastname.'" style="max-width: 100%;" /></a>';
    }
    

?>	

<div class="playerCard span4 cardview">
		<div class="playerCardImage span1"><?php echo $img; ?></div>
		<div class="playerCardName span"><?php echo $firstname; ?>  <?php echo $lastname; ?></div>

		<div class="mask">  
		     <h2><?php echo $firstname; ?>  <?php echo $lastname; ?></h2>  
		     <p><?php if(isset($playerText)){ echo $playerText; } ?></p>  
		         <a href="#" class="info">Read More</a>  
		     </div> 

	
</div>



<!-- 
<div class="playerCard"> 
	<div class="playerPhoto"><?php //echo $img; ?></div>
	<div class="playerCardDiv">
		<div class="playerHeader"><
        <?php //if(isset($pos)){echo '<div class="rank">' . $pos . '</div>';} ?>
			<div class="headerTop"<?php //if(isset($left)){echo ' style="left:'.$left.'px;"';} ?>>
				<div class="playerName"><a href="<?php //echo get_permalink($player->ID); ?>"><?php //echo $firstname . ' ' . $lastname; ?></a></div>
			</div>
			<div class="info"<?php //if(isset($left)){echo ' style="left:'.$left.'px;"';} ?>>
				<div class="bio"><span class="label">HT: </span><a href="<?php //echo get_term_link($height->name, 'height'); ?>"><?php echo $height->name; ?></a></div>
				<div class="bio"><span class="label">WT: </span><a href="<?php //echo get_term_link($weight->name, 'weight'); ?>"><?php echo $weight->name; ?></a></div>
				<div class="bio pos"><span class="label">POS: </span><a href="<?php //echo get_term_link($position->name, 'position'); ?>"><?php echo strtoupper($position->name); ?></a></div>
                <div class="bio"><span class="label">SCHOOL: </span><?php //echo $hs_stub; ?></div>
                <div class="bio"><span class="label">TRAVEL: </span><?php //echo $travel_stub; ?></div>
			</div>
			<div class="teamImage"><img src="http://assets.espn.go.com/i/teamlogos/mlb/mobile/sml/laa.png"></div>
			<div class="photoShadow"></div>
		</div>
		<div class="headerShadow"></div>
	</div>
</div> -->


<?php	
	
	
	
}

 ?>