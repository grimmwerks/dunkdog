<?php
 /*Template Name: DunkDog Player Mini Box (ie in rankings or archive)
 */ 

if(isset($player)){ 
	
	// just keeping this in case something changes again
	$playerID = $player;
	$class = $height = $weight = $position = null;

	if(get_the_terms($playerID, 'dd-class')){
	    $class = array_shift(array_values(get_the_terms($playerID, 'dd-class')));
	}
	if(get_the_terms($playerID, 'dd-height')){
	    $height = array_shift(array_values(get_the_terms($playerID, 'dd-height')));
	}
	if(get_the_terms($playerID, 'dd-weight')){
	    $weight = array_shift(array_values(get_the_terms($playerID, 'dd-weight')));
	}
	if(get_the_terms($playerID, 'dd-position')){
	    $position = array_shift(array_values(get_the_terms($playerID, 'dd-position')));
	}
	$high_school_team = get_field('high_school_team', $playerID);
	$travel_team = get_field('travel_team', $playerID);
	$college_team = get_field('college_team', $playerID);

	$firstname = get_post_meta( $playerID, 'first_name', true);
 	$lastname = get_post_meta( $playerID, 'last_name', true);

    $hs_stub =  $travel_stub = $pad = "   -    -   ";; 
    $college_stub='';


    // if($high_school_team){$hs_stub = '<a href="'.get_permalink( $high_school_team ).'">'. get_the_title($high_school_team).'</a>';
    // }
    $high_school_team = get_field('high_school_team', $playerID); 
	if($high_school_team){
		if(!is_string($high_school_team)){$high_school_team = $high_school_team[0]->ID;}
		$hs_stub =  '<a href="'.get_permalink($high_school_team).'">'. get_the_title($high_school_team).'</a>';
	}



    // if($travel_team){
    // 	$travel_stub = '<a href="'.get_permalink( $travel_team ).'">'. get_the_title($travel_team).'</a>';
    // }
    $travel_team = get_field('travel_team', $playerID); 
		if($travel_team){
			if(!is_string($travel_team)){$travel_team = $travel_team[0]->ID;}
	    	$travel_stub = '<a href="'.get_permalink($travel_team).'">'. get_the_title($travel_team).'</a>';
    }


    if($college_team){
    	// college image
    	if(!is_string($college_team)){$college_team = $college_team[0]->ID;}
		if(has_post_thumbnail( $college_team )){
			$colImgID = get_post_thumbnail_id( $college_team);
	    	$colImg = wp_get_attachment_url($colImgID);
    		$college_stub = '<a href="'.get_permalink( $college_team ).'"><img src="'. $colImg .'" alt="'.get_the_title($college_team).'" height="50" width="auto" /></a>';
    	}else{
	    	$college_stub = '<a href="'.get_permalink( $college_team ).'">'. get_the_title($college_team).'</a>';
	    }
    }





//krumo($college_team,has_post_thumbnail( $college_team ) , $college_stub);

    $address = get_field('address', $playerID, false);
    

if(DD_DEBUG){
	krumo($playerID, $class, $height, $weight, $position, $high_school_team, $travel_team, $college_team, $address);
}


	if(has_post_thumbnail( $playerID )){
		$imgID = get_post_thumbnail_id( $playerID);
    	$imgURL = wp_get_attachment_url($imgID);
    	$img = '<a href="'.get_permalink($playerID) . '"><img src="'. $imgURL.'" alt="'.$firstname.$lastname.'" height="90"/></a>';
	}else{
     	 $img = '<a href="'. get_permalink($playerID). '"><img src="'.plugins_url( "/includes/images/default_player.png", DD_BASE ).'" alt="'.$firstname.$lastname.'" height="90"/></a>';
    }
?>	


<div class="playerContainer">
    <div class="headerBar"></div> 
	<div class="playerPhoto"><?php echo $img; ?></div>
	<div class="playerDiv">
		<div class="playerHeader"><!-- PLAYER RANK -->
        <?php if(isset($pos)){echo '<div class="rank">' . $pos . '</div>';}else{$left = 20;} ?>
		<div class="headerTop"<?php if(isset($left)){echo ' style="left:'.$left.'px;"';} ?>>
<!-- PLAYER NAME -->
			<div class="playerName"><a href="<?php echo get_permalink($playerID); ?>"><?php echo $firstname . ' ' . $lastname; ?></a></div>
			<!-- <div class="headerDivider"></div> -->
<!-- SCOUTS GRADE -->
		</div>
<!-- BEGIN BIO INFO -->
		<div class="data">
			<div class="contact"  <?php if(isset($left)){echo ' style="left:'.$left.'px;"';} ?>>
				<div class="bio biolast"><span class="label">CLASS: </span><?php echo $class->name ?></div>
				<div class="bio biolast"><span class="label">CITY: </span><?php echo (($address && is_array($address))  ? $address['city'] : $pad); ?></div>
				<div class="bio biolast"><span class="label">STATE: </span><?php echo (($address && is_array($address))  ? $address['state'] : $pad);  ?></div>
			</div>
			<div class="info"  <?php if(isset($left)){echo ' style="left:'.$left.'px;"';} ?>>
				<div class="bio"><span class="label">HT: </span>
					<?php if($height!=null){ ?>
						<a href="<?php echo get_term_link($height, $height->taxonomy); ?>"><?php echo $height->name; ?></a>
					<?php }else{ echo $pad; } ?>
				</div>
				<div class="bio"><span class="label">WT: </span>
					<?php if($weight!=null){ ?>
						<a href="<?php echo get_term_link($weight, $weight->taxonomy); ?>"><?php echo $weight->name; ?></a>
					<?php }else{ echo $pad; } ?>
				</div>
				<div class="bio"><span class="label">POS: </span>
					<?php if($position!=null){ ?>
						<a href="<?php echo get_term_link($position, $position->taxonomy); ?>"><?php echo strtoupper($position->name); ?></a>
					<?php }else{ echo $pad; } ?>
				</div>
	            <div class="bio"><span class="label">SCHOOL: </span><?php echo $hs_stub; ?></div>
	            <div class="bio biolast"><span class="label">TRAVEL: </span><?php echo $travel_stub; ?></div>
			</div>
		</div>
		<div class="teamImage"><?php echo $college_stub; ?></div>
		<div class="photoShadow"></div>
		</div>
		<div class="headerShadow"></div>
<!-- END HEADER -->
	</div>
</div>
<!-- END PLAYER -->

<?php	
	
}

 ?>