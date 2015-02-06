<?php

$linkText = get_field('forum_link_button_text', 'options');
$linkButtonColor = get_field('forum_link_button_background_color', 'options');
$linkTextColor = get_field('forum_link_button_text_color', 'options');
$topicLink = get_field('topic_link');
if($topicLink){
	$forumLink = get_permalink($topicLink[0]->ID);
}



$playerMainDisplay = get_field('linked_players_display');

$linkedPlayers = get_field('linked_player_items');

$playerCount = 0;


if($linkedPlayers){
	echo '<div class="article-linked-players">';

	while(the_flexible_field("linked_player_items")){
		$tid = get_row_layout();

		if('player_sub_section'==$tid){
			$playerCount = 0; /// zeroing it out in case there's multiples
			echo '<div class="clear"></div>';
			echo '<h4>'. get_sub_field('player_sub_heading') . '</h4>';
			echo  get_sub_field('player_sub_heading_text');
		}
		if('linked_player'==$tid){
			// added by john
			$playerPost = array_shift(array_values(get_sub_field('linked_player_profile')));
			// end added by john
			
			$playerCount++; 
			if (is_array($player_post)) {
				$playerPost = array_shift(array_values(get_sub_field('linked_player_profile')));
			} 
			$playerText = get_sub_field('linked_player_text');
			$hideHeadshot = get_sub_field('hide_player_headshot');

			$playerDisplay = $playerMainDisplay;

			dunkdog_template_function('post-footer-linked-players', true, compact('playerCount', 'playerPost', 'playerText', 'playerDisplay', 'hideHeadshot'));
		}

		if('linked_player_group'==$tid){
			$playerDisplay = get_sub_field('group_display');
			$playerCount = 0;
			$players = get_sub_field('linked_players');
			foreach ($players as $playerPost) {
				dunkdog_template_function('post-footer-linked-players', true, compact('playerCount', 'playerPost', 'playerDisplay'));
			}
		}

	}
	echo '</div>';
}

?><p></p><div class="clear"></div>
<!-- end linked players and teams -->    

<!-- POST FOOTER TEXT / SIGNOUT -->
<?php
$pft = get_field('post_footer_text', 'option'); 

 if($pft){
	echo '<div class="post_footer_call"><h4><b>'.$pft.'</b></h4></div>';
 } 
?>
	
<!--FORUM BUTTON TEXT PULLED IN FROM DUNKDOG OPTIONS PAGE -->	
	
<?php

	if($topicLink){
		echo '<p>&nbsp;</p><center>';
		echo do_shortcode('[button size="medium" text_color="'. $linkTextColor . '" text="'.$linkText.'"  color="'. $linkButtonColor .'"  class="forum_link_button " link="'.$forumLink.'" window="false"][/button]');	
		echo '</center>';
	}
?>