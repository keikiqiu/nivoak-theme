<?php
/**
 * Single post template.
 *
 * @package Nivoak
 */

get_header();
?>

<div class="page-header">
  <?php
  while ( have_posts() ) : the_post();
    $categories = get_the_category();
    $cat_name = ! empty( $categories ) ? esc_html( $categories[0]->name ) : 'Guide';
  ?>
  <div class="section-label"><?php echo $cat_name; ?></div>
  <h1 class="page-title"><?php the_title(); ?></h1>
  <p class="page-desc"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></p>
</div>

<div class="single-post-content">
  <?php the_content(); ?>
</div>

<?php
  endwhile;
get_footer();
