<?php
 /*Template Name: Dunkdog Single Player Template

 */




$ranking_type = get_field('ranking_type');  // used to figure out controls selection too

$rankings = get_field('player_rankings');

//get_terms('dd-position', array('hide_empty'=>false));
$term = get_term_by( 'name', $ranking_type, 'dd-position');



//$ranking_class = array_shift(array_values(get_terms('dd-class')));
$ranking_class =  array_shift(array_values(get_the_terms( $post->ID, 'dd-class')));

$badge = '';
if($ranking_type=='all'){
	$rt_stub = 'DunkDog Top 100';
	$badge = '<img src="'.plugins_url( "/includes/images/dunkdog_top100_badge.png", DD_BASE ).'" />';   
}else{
	$rt_stub = 'Position Rankings: ' . $term->description ;
}

if(DD_DEBUG){krumo($ranking_type, $rankings, $ranking_class, $rt_stub);}

get_header(); 
roots_content_before();
global $FRONTEND_STRINGS;
global $prime_frontend;
//$prime_frontend->prime_subheader();


roots_main_before(); ?>


<div class="gridcontainer pagecontainer">
    <div class="row">
        <div class="span12">
            <div class="page-content page-content-with-sidebar page-content-with-right-sidebar">
               
<!-- rankings header -->
       			 <div class="rankings-header">
       			 	<div class="ranking-topdog"><?php echo $badge; ?></div>
					<div class="rankings-header-info">
                		<h1><?php echo 'Class of '. $ranking_class->name; ?></h1>
                		<h3><?php echo $rt_stub; ?></h3>
                	</div>
                </div>

                <?php 
if(S2MEMBER_CURRENT_USER_IS_LOGGED_IN_AS_MEMBER){ 
                echo do_shortcode( '[dunkdog_rankings_controls  rankID="'. $post->ID.'" position="'.$ranking_type.'" class="'. $ranking_class->name. '"]' ); 
}
                ?>

			<?php
				roots_loop_before();
if(S2MEMBER_CURRENT_USER_IS_LOGGED_IN_AS_MEMBER){ 
				if( $rankings ): 
					$pos = 0;
					foreach( $rankings as $player): 

						if(!is_int($player) ){
							$player = $player->ID;
						}
						$pos++;
						 dunkdog_template_function('single-player-mini', true, compact('pos', 'player'));
					  endforeach; 
				endif; 
}else{
	echo dunkdog_no_access();
}
				roots_loop_after(); 
			?>

		</div>
  	</div>
</div>

<?php get_footer(); ?>
<?php roots_main_after(); ?>
<?php roots_content_after(); ?>