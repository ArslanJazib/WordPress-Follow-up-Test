<?php
/*
 * Template Name: Homepage
 */
get_header(); ?>

<div class="homepage-wrapper">
    <?php
    while (have_posts()) : the_post();
        the_content();
    endwhile;
    ?>
</div>

<?php get_footer(); ?>