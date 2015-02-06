<?php

global $wp_query;


?>

<?php get_header(); ?>
<?php roots_content_before();
global $FRONTEND_STRINGS;
global $prime_frontend;
//$prime_frontend->prime_subheader();
$left = 20;


$n = array('post_type'=>'dd-player', 'showposts'=>200,  'meta_key' => 'last_name', 'orderby' => 'meta_value',  'order' => 'ASC');
$args = array_merge( $wp_query->query_vars, $n);
query_posts( $args );


$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
$title =  $the_tax->labels->name . ' : ' . $term->name;


?>

   <div class="subheader inset-vertical-shadow">
            <div class="top-shadow-fallback"></div>
            <div class="gridcontainer header-container">
                <div class="row">
                    <div class="span12">
                         <h1 class="page-title">Players Listed by <?php echo $title; ?></h1>
                    </div>
                </div>
            </div>
            <div class="bottom-shadow-fallback"></div>
        </div>


<?php roots_main_before(); ?>
<div class="gridcontainer pagecontainer">
    <div class="row">
        <div class="span12">
            <div class="page-content page-content-with-sidebar page-content-with-right-sidebar">
              <?php
                if(S2MEMBER_CURRENT_USER_IS_LOGGED_IN_AS_MEMBER){
                   $left = 20;
                    while ( have_posts() ) : the_post();
                        $player = $post->ID;    
                        dunkdog_template_function('single-player-mini', true, compact( 'player', 'left'));
                    endwhile; 
                }else{
                    echo dunkdog_no_access();
                }
                ?>
            </div>
        </div>
 
    </div>
</div>






<?php get_footer(); ?>
<?php roots_main_after(); ?>
<?php roots_content_after(); ?>