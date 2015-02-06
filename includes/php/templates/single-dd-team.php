<?php get_header(); ?>
<?php roots_content_before();
global $FRONTEND_STRINGS;
global $prime_frontend;
//$prime_frontend->prime_subheader();

$schoolID = $post->ID;
$pad = " - - ";

$address = get_field('team_address', $schoolID,  false);

//  player code to get info
if(has_post_thumbnail( $schoolID )){
    $imgID = get_post_thumbnail_id( $schoolID);
    $imgURL = wp_get_attachment_url($imgID);
    $img = '<img src="'. $imgURL .'"  height="200"/>';
}

global $wpdb;
// player lookup
$sql = "select distinct post_id from $wpdb->postmeta where meta_key in ('college_team', 'travel_team', 'high_school_team') and (meta_value=%d or meta_value LIKE %s)";

$schoolString = '%"'.$schoolID .'"%';
$items = $wpdb->get_results($wpdb->prepare($sql, $schoolID, $schoolString));

if(get_the_terms($schoolID, 'dd-conference')){
    $conf = array_shift(array_values(get_the_terms($schoolID, 'dd-conference')));
}

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

//player contnt -->
//beginning of header  two different displays depending on college or not-->
    if(has_term( 'college', 'dd-team_type' )){ 

?>

    
        <div class="player-profile">
            <div class="team-profile-image player-profile-headshot college-team-single-image"><?php if($img!=null){echo $img;} ?></div>
            <div class="player-profile-info college-team-single-title"><h1><?php echo the_title(); ?></h1>
                <ul class="team-info">
                    <li class="first">City:  <b><?php echo (($address && is_array($address))  ? $address['city'] : $pad); ?></b></li>
                    <li class="last">State:  <b><?php echo (($address && is_array($address))  ? $address['state'] : $pad); ?></b></li>
                </ul>
                <?php if($conf!=null){ ?>
                <div class="team-conference">Conference:  <b><?php echo $conf->name; ?></a></b></div>
                <!-- <div class="team-conference">Conference:  <b><a href="<?php //echo get_term_link($conf, $conf->taxonomy); ?>"><?php //echo $conf->name; ?></a></b></div> -->
                
                <?php } ?>
            <div class='team-attending'>Committed Prospects:</div>
            </div>
        </div>


<?php }else{  ?>
        <div class="player-profile">
            <div class="team-profile-image player-profile-headshot"><?php if($img!=null){echo $img;} ?></div>
            <div class="player-profile-info"><h1><?php echo the_title(); ?></h1>
            <ul class="team-info">
                <li class="first">City:  <b><?php echo (($address && is_array($address))  ? $address['city'] : $pad); ?></b></li>
                <li class="last">State:  <b><?php echo (($address && is_array($address))  ? $address['state'] : $pad); ?></b></li>
            </ul>
            <div class='team-attending'>Players Attending:</div>
            </div>

            
        </div>
<!-- end of header -->

<?php
    } // end if college if


foreach ($items as $db ) {
    $player = $db->post_id;
     dunkdog_template_function('single-player-mini', true, compact('player'));
}

}else{

                echo dunkdog_no_access();   
 } 
?>

<!-- end player content -->
                <?php roots_loop_after(); ?>
            </div>

        </div>
    </div>
</div>
<?php get_footer(); ?>
<?php roots_main_after(); ?>
<?php roots_content_after(); ?>
