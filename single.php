<?php
/**
 * Single post template.
 *
 * @package Nivoak
 */

get_header();
?>

<div class="page-wrapper">
  <?php while (have_posts()) : the_post();
    $categories = get_the_category();
    $cat_name = !empty($categories) ? esc_html($categories[0]->name) : 'Guide';
    $cat_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';
  ?>
  <div class="page-header-section">
    <div class="page-header-inner">
      <?php if (function_exists('nivoak_breadcrumb')) nivoak_breadcrumb(); ?>
      <div class="section-label" style="margin-bottom:12px;"><?php echo $cat_name; ?></div>
      <h1 class="page-title"><?php the_title(); ?></h1>
      <div class="single-meta">
        <span><?php echo esc_html(get_the_date('F j, Y')); ?></span>
        <span class="single-meta-dot">&middot;</span>
        <span>by <?php the_author(); ?></span>
        <span class="single-meta-dot">&middot;</span>
        <span><?php echo esc_html(get_the_category_list(', ')); ?></span>
      </div>
    </div>
  </div>

  <div class="page-content-section">
    <div class="single-content-inner">
      <?php the_content(); ?>

      <?php
      $tags = get_the_tags();
      if ($tags) :
      ?>
      <div class="single-tags">
        <?php foreach ($tags as $tag) : ?>
          <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="single-tag"><?php echo esc_html($tag->name); ?></a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <div class="single-nav">
        <?php
        $prev = get_previous_post();
        $next = get_next_post();
        if ($prev) : ?>
        <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="single-nav-link single-nav-prev">
          <span class="single-nav-label">&lsaquo; Previous</span>
          <span class="single-nav-title"><?php echo esc_html(get_the_title($prev)); ?></span>
        </a>
        <?php endif; ?>
        <?php if ($next) : ?>
        <a href="<?php echo esc_url(get_permalink($next)); ?>" class="single-nav-link single-nav-next">
          <span class="single-nav-label">Next &rsaquo;</span>
          <span class="single-nav-title"><?php echo esc_html(get_the_title($next)); ?></span>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php endwhile; ?>
</div>

<?php get_footer(); ?>
