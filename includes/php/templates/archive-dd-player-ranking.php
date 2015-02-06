<?php get_header(); ?>
<?php roots_content_before();
global $FRONTEND_STRINGS;
global $prime_frontend;
$prime_frontend->prime_subheader();
?>

<?php roots_main_before(); ?>
<div class="gridcontainer pagecontainer">
    <div class="row">
        <div class="span9">
            <div class="page-content page-content-with-sidebar page-content-with-right-sidebar">
                <?php get_template_part('loop', 'index'); ?>
            </div>
        </div>
        <div class="span3">
            <div class="sidebar widget-area right-sidebar">
                <?php roots_sidebar_inside_before(); ?>

                <?php get_sidebar(); ?>

                <?php roots_sidebar_inside_after(); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
<?php roots_main_after(); ?>
<?php roots_content_after(); ?>

