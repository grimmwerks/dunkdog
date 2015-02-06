<?php

if(isset($team)){ 
	if(is_int($team) || is_string($team)){
		$teamID = $team;
		$team = get_post($teamID);
	}else{
		$teamID = $team->ID;
	}


	
	
	$address = get_field('team_address', $teamID, false);

	$pad = "  -  -  ";


	// college image
	$image = '';
	if(has_post_thumbnail( $teamID )){
		$colImgID = get_post_thumbnail_id( $teamID );
    	$image = wp_get_attachment_url($colImgID);
	}

	// just seeing if I can get class data;
	$teamText = '';
	if(isset($ranking_class)){
		$tct = get_field('team_class_text', $teamID);
		if($tct){
			foreach($tct as $txt){
				if($txt['team_class'] == $ranking_class->name){
					$teamText = $txt['team_text'];
				}
			}
		}
	}
   
?>

<div class="accordion team-ranking" id="accordion_<?php echo $teamID; ?>">
	<div class="accordion-group">
		<div class="accordion-heading teamHeader " <?php if(($teamText=='')||(!(count($teamText)))){echo 'style="cursor: default;"'; }; ?> >
			<a class="accordion-toggle closed" data-toggle="collapse" data-parent="#accordion_<?php echo $teamID; ?>" data-target="#collapseOne<?php echo $teamID; ?>">
				<div class="teamDiv">
					<?php if(isset($pos)){echo '<div class="rank">' . $pos . '</div>';} ?>
					<div class="info">
						<div class="bio"><span class="label">CITY: </span><b><?php echo (($address && is_array($address) && $address['city']!='')  ? $address['city'] : $pad); ?></b></div> 
						<div class="bio"><span class="label">STATE: </span><b><?php echo (($address && is_array($address) && $address['state']!='')  ? $address['state'] : $pad); ?></b></div>

						<?php  if(get_the_terms($schoolID, 'dd-conference')){
						      $conf = array_shift(array_values(get_the_terms($schoolID, 'dd-conference'))); ?>
						      <div class="team-conference">Conference:  <b><a href="<?php echo get_term_link($conf, $conf->taxonomy); ?>"><?php echo $conf->name; ?></a></b></div>
						<?php  } ?>
					</div> 
					<div class="teamName">
						<?php echo $team->post_title; ?>
					</div>
					<div class="teamRankImage"><img src="<?php echo $image; ?>"></div>
					<?php if($teamText!=''){ ?>
					<div class="teamRankIconOpen"><?php echo do_shortcode( '[icon icon="arrow-down" color="#ffffff"][/icon]' ); ?></div>
					<?php }; ?>
				</div>
			</a>
		</div>
		<?php if($teamText!=''){ ?>
		<div id="collapseOne<?php echo $teamID; ?>" class="accordion-body collapse" style="height: 0px; overflow: hidden;">
			<div class="accordion-inner">
				<p>
					<?php echo $teamText; ?>
				</p>
			</div>
		</div>
		<?php }; ?>
	</div>
</div>

<?php }; ?>