<?php
 /*Template Name: Dunkdog Single Team Ranking

 */


get_header(); 
roots_content_before();
global $FRONTEND_STRINGS;
global $prime_frontend;
//$prime_frontend->prime_subheader();


$team_rankings = get_field('team_rankings', $post->ID);
$ranking_class =  array_shift(array_values(get_the_terms( $post->ID, 'dd-class')));


roots_main_before(); ?>


<div class="gridcontainer pagecontainer">
    <div class="row">
        <div class="span12">
            <div class="page-content page-content-with-sidebar page-content-with-right-sidebar">
               
<!-- rankings header -->
       			 <div class="rankings-header">
					 <div class="rankings-header-info">
                		<h1><?php echo 'Class of '. $ranking_class->name; ?></h1>
                		<h3><?php echo 'Team Rankings' ?></h3>
                	</div>
                </div>

 
<?php roots_loop_before();

// page text if wanted
	if (have_posts()) : while (have_posts()) : the_post();
		the_content(); 
	endwhile; endif; 


if(S2MEMBER_CURRENT_USER_IS_LOGGED_IN_AS_MEMBER){ 
	echo '<div class="teamRankings">';
	if($team_rankings){
		$pos = 0;
		foreach ($team_rankings as $team) {
			if(!is_int($team)){
				$team = $team->ID;
			}
			$pos++;
			dunkdog_template_function('single-team-mini', true, compact('pos', 'team', 'ranking_class'));
		}
	}
	echo '</div>';
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