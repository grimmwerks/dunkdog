<?php

global $wp_query;


?>

<?php get_header(); ?>
<?php roots_content_before();
global $FRONTEND_STRINGS;
global $prime_frontend;
$prime_frontend->prime_subheader();
$left = 20;




?>



<!-- echo '<div class="teamRankings">';
    if($team_rankings){
        $pos = 0;
        foreach ($team_rankings as $team) {
            $pos++;
            dunkdog_template_function('single-team-mini', true, compact('pos', 'team', 'ranking_class'));
        }
    }
    echo '</div>'; -->



<?php roots_main_before(); ?>
<div class="gridcontainer pagecontainer">
    <div class="row">
        <div class="span12">
            <div class="page-content page-content-with-sidebar page-content-with-right-sidebar">
                
<!-- rankings header -->
                 <!-- <div class="rankings-header">
                     <div class="rankings-header-info">
                        <h1><?php// echo 'Class of '. $ranking_class->name; ?></h1>
                        <h3><?// echo 'Team Rankings' ?></h3>
                    </div>
                </div> -->




<?php roots_loop_before(); ?>

              <?php
                if(S2MEMBER_CURRENT_USER_IS_LOGGED_IN_AS_MEMBER){
                    echo '<div class="teamRankings">';
                   $left = 20;
                    while ( have_posts() ) : the_post();
                        $team = $post; 
                        dunkdog_template_function('single-team-mini', true, compact( 'team', 'left'));
                    endwhile; 
                    echo '</div>';
                }else{
                    echo dunkdog_no_access();
                }
                roots_loop_after(); 
                ?>
                </div>
            </div>
        </div>
 



<?php

$ns = "SELECT SQL_CALC_FOUND_ROWS wp_dd_posts.ID FROM wp_dd_posts INNER JOIN wp_dd_term_relationships ON (wp_dd_posts.ID = wp_dd_term_relationships.object_id) WHERE 1=1 AND ( wp_dd_term_relationships.term_taxonomy_id IN (673) ) AND wp_dd_posts.post_type IN ('dd-player-ranking', 'dd-team-ranking', 'dd-player') AND (wp_dd_posts.post_status = 'publish' OR wp_dd_posts.post_status = 'closed' OR wp_dd_posts.post_author = 1 AND wp_dd_posts.post_status = 'private' OR wp_dd_posts.post_author = 1 AND wp_dd_posts.post_status = 'hidden') GROUP BY wp_dd_posts.ID ORDER BY wp_dd_posts.post_date DESC LIMIT 0, 10";

$newsIDs = $wpdb->get_results($ns);

//krumo($newsIDs);
?>



<?php get_footer(); ?>
<?php roots_main_after(); ?>
<?php roots_content_after(); ?>