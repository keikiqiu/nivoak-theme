<?php
/**
 * The template for displaying all single pages.
 *
 * @package Nivoak
 * @since   2.1.0
 */

get_header();
?>

<div class="page-wrapper">
  <?php
  while ( have_posts() ) : the_post();
  ?>
  <div class="page-header-section">
    <div class="page-header-inner">
      <?php if (function_exists('nivoak_breadcrumb')) nivoak_breadcrumb(); ?>
      <h1 class="page-title"><?php the_title(); ?></h1>
    </div>
  </div>

  <div class="page-content-section">
    <div class="page-content-inner">
      <?php the_content(); ?>
    </div>
  </div>
  <?php
  endwhile;
  ?>
</div>

<?php get_footer(); ?>