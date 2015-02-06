<?php get_header(); ?>
<?php roots_content_before();
global $FRONTEND_STRINGS;
global $prime_frontend;
//$prime_frontend->prime_subheader();
?>

<div class="subheader inset-vertical-shadow">
    <div class="top-shadow-fallback"></div>
        <div class="gridcontainer header-container">
            <div class="row">
                <div class="span12"></div>
            </div>
        </div>
    <div class="bottom-shadow-fallback"></div>
</div>


<?php roots_main_before(); ?>

<div class="gridcontainer pagecontainer">
    <div class="row">
        <div class="span12">
            <div class="page-content page-content-with-sidebar page-content-with-right-sidebar">
                <?php roots_loop_before();




if(S2MEMBER_CURRENT_USER_IS_LOGGED_IN_AS_MEMBER){ 




//  player code to get info
$player = $post;
$playerID = $post->ID;
$class = $height = $weight = $position = null;

//echo dunkdog_current_user_can_access($post->ID);

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
$pad = "   -    -    -   ";
$hs_stub = $travel_stub = $college_stub = $pad;

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
        // college image
        if(has_post_thumbnail( $college_team )){
            $colImgID = get_post_thumbnail_id( $college_team);
            $colImg = wp_get_attachment_url($colImgID);
            $college_stub = '<a href="'.get_permalink( $college_team ).'"><img src="'. $colImg .'" alt="'.get_the_title($college_team).'" /></a>';
        }else{
            $college_stub = '<a href="'.get_permalink( $college_team ).'">'. get_the_title($college_team).'</a>';
        }
    }



if(has_post_thumbnail( $playerID )){
    $imgID = get_post_thumbnail_id( $playerID);
    $imgURL = wp_get_attachment_url($imgID);
    $img = '<img src="'. $imgURL .'" alt="'.$firstname.$lastname.'" height="220"/>';
}else{
    $img = '<img src="'.plugins_url( "/includes/images/default_player.png", DD_BASE ).'" alt="'.$firstname.$lastname.'" height="220"/>';
}

// information
// $info = $player->post_content;

// if($info=='' || $info==null){
//     $info = '<center>There is no additional information regarding this player</center>';
// }




// seeing if this person is in top 100; would prob add options to set the classes available from options page
// get class, find post that has class and field for 'all' rank, then check list
global $post;
global $wpdb;

$args = array(
    'post_type'=>'dd-player-ranking',
    'dd-class' => $class->name,
    'meta_query' => array(
        array(
            'key' => 'ranking_type',
            'value' => 'all',
        )
    )
);

// badge for top dog 100
$badge = '';
$rankingPosts = get_posts( $args ); 

if(count($rankingPosts)){ 
    $rankingID = $rankingPosts[0]->ID;
    $rankings = get_field('player_rankings', $rankingID);
    if(count($rankings)){
        if (in_array($playerID, $rankings)) {
            $badge = '<img src="'.plugins_url( "/includes/images/dunkdog_top100_badge.png", DD_BASE ).'" />';
        }
    }
}
$address = get_field('address', $playerID, false);



// linked articles via linked profile
//select distinct post_id from wp_dd_postmeta where meta_key like '%_linked_player_profile' and meta_value like '%"208095"%';


$playerReq = '%"'.$playerID.'"%';
$sql="SELECT distinct $wpdb->posts.* FROM $wpdb->posts INNER JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) WHERE 1=1 AND (($wpdb->postmeta.meta_key LIKE 'linked_player_items_%_linked_player_profile') or ($wpdb->postmeta.meta_key LIKE 'linked_player_items_%_linked_players')) AND (meta_value LIKE  '". $playerReq."' ) AND  ($wpdb->posts.post_status = 'publish')";



$newsIDs = $wpdb->get_col($sql);
$newsPosts = $wpdb->get_results($sql);

?>

<!-- player contnt -->
 <!-- beginning of header -->
        <div class="player-profile">

            <div class="player-profile-headshot"><?php echo $img; ?></div>
            <div class="player-profile-rank"><?php echo $badge; ?></div>
            <div class="team-logo"><?php echo $college_stub; ?></div>
            <div class="player-profile-info">
                <h1><?php echo get_field('first_name') . ' ' . get_field('last_name'); ?></h1>
            
                <div class="player-bio">
                    <div class="line-divider"></div>
                    <ul class="general-info">
                        <li class="first">Height:  <b><?php if($height!=null){ ?><a href="<?php echo get_term_link($height, $height->taxonomy); ?>"><?php echo $height->name; ?></a><?php }else{ echo $pad; } ?></b></li>
                        <li>Weight:  <b> <?php if($weight!=null){ ?><a href="<?php echo get_term_link($weight, $weight->taxonomy); ?>"><?php echo $weight->name; ?></a><?php }else{ echo $pad; }; ?></b> lbs.</li>
                        <li class="last">Position:  <b> <?php if($position!=null){ ?> <a href="<?php echo get_term_link($position, $position->taxonomy);  ?>"><?php echo strtoupper($position->name); ?></a><?php }else{ echo $pad;} ?></b></li>
                    </ul>
                    <ul class="school-info">
                        <li><span>City:</span><b><?php echo (($address && is_array($address))  ? $address['city'] : $pad); ?></b> <span>State:</span><b><?php echo (($address && is_array($address))  ? $address['state'] : $pad);  ?></b></li>
                        <li class="class"><span>Class of</span><b>
                            <?php if($class!=null){ ?>
                            <a href="<?php echo get_term_link($class->name,$class->taxonomy); ?>"><?php echo $class->name; ?></a>
                            <?php }else{ echo $pad; }; ?>
                        </b></li>
                        <li><span>High School:</span><b><?php echo $hs_stub; ?></b></li>
                        <li><span>Travel Team:</span><b><?php echo $travel_stub; ?></b></li>
                    </ul>
                </div>
            </div>
        </div>
<!-- end of header -->

<!-- tabbed content area -->
      <ul id="tabs_<?php echo $player->ID; ?>" class="tabs nav nav-tabs" data-tabs="tabs" style="margin-top: -10px;">
            <li class="nav-tab "><a href="#first_<?php echo $player->ID; ?>" data-toggle="tab">Article Mentions</a></li>
            <?php if(current_user_can("access_s2member_level2")){ ?>
            <li class="nav-tab last-tab"><a  href="#second_<?php echo $player->ID; ?>" data-toggle="tab">Contact</a></li>
            <?php }; ?>
        </ul>
        <div class="tab-content">
             <div id="first_<?php echo $player->ID; ?>" class="tab-pane ">
                <div class="gridcontainer pagecontainer profile-news">
                    <div class="row">
                        <div class="span10">
                            <div class="page-content  blog-medium-image">
                                <h4><?php echo get_field('first_name')  ?> was mentioned on the site...</h4>
                    <?php 
                 
                    if(count($newsIDs)){
                        
                       global $wp_the_query;
                       $wp_the_query->posts = $newsPosts;  $wp_the_query->post_count = count($newsPosts);
                       $wp_the_query->request = $sql; $wp_the_query ->is_posts_page = true;
//krumo($wp_the_query);
                        get_template_part('loop', 'medium'); 
                    }else{
                        echo '<p><center><b>No additional information found.</b></center></p>';
                    }
                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php //if(current_user_can("access_s2member_level2")){ ?>
            <div id="second_<?php echo $player->ID; ?>" class="tab-pane ">
                <p><?php
                
                    $scouting = get_field('scouting_report',  $playerID);
                    $contact = get_field('contact_info',  $playerID);
                    $map = get_field('google_map_shortcode',  $playerID);

                    echo do_shortcode( '[spacer height="10px"]');

                    $firstHalf = '<h4>'.$firstname . "'s scouting report:</h4><br />";
                    if($scouting){
                        $firstHalf.= $scouting . '<div class="clear"></div>';
                    }else{
                        $firstHalf.='No additional information found.';
                    }
                    echo do_shortcode( '[one_half]'.$firstHalf.'[/one_half]' );

                    $secondHalf = '<h4>'.$firstname . "'s contact information:</h4><br />";
                     if($contact){
                        $secondHalf.=$contact . '<div class="clear"></div>';
                    }
                     if($map){
                        $secondHalf.= do_shortcode( '[gmap address="'.$map.'" zoom="15" height="300px" ]' ).'<div class="clear"></div>';
                    }
                    if(!$map && !$contact){$secondHalf.='No additional information found.';}
                     echo do_shortcode( '[one_half_last]'.$secondHalf.'[/one_half_last]' );
                    ?>
                </p>
            </div>
        <?php// }; ?>
        </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>




<!-- tabbed content area end -->
<?php 
}else{

                echo dunkdog_no_access();   
 } ?>





<!-- end player content -->
                <?php roots_loop_after(); ?>
            </div>
        </div>
    </div>
</div>
<? 

?>

<?php get_footer(); ?>
<?php roots_main_after(); ?>
<?php roots_content_after(); ?>
