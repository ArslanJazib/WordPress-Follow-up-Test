<?php
/*
 * Template Name: Homepage
 * Description: A custom homepage template with theme option integrations.
 */

get_header();
?>

<div class="homepage-wrapper">

  <!-- Content Section -->
  <section class="intro-section">
    <div class="container">
      <?php
      if (have_posts()) :
        while (have_posts()) : the_post(); ?>

          <!-- Title -->
          <h1 class="mb-4 fw-bold text-orange"><?php the_title(); ?></h1>

          <!-- Content -->
          <div class="page-content">
            <?php the_content(); ?>
          </div>

        <?php endwhile;
      endif;
      ?>
    </div>
  </section>

</div><!-- .homepage-wrapper -->

<?php get_footer(); ?>