<?php
/**
 * Template Name: Blog Page
 * Template for displaying blog post listings.
 *
 * @package Nivoak
 */

get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$blog_query = new WP_Query(array(
  'post_type' => 'post',
  'posts_per_page' => 12,
  'post_status' => 'publish',
  'paged' => $paged,
));
?>

<div class="page-wrapper">
  <div class="page-header-section">
    <div class="page-header-inner">
      <?php if (function_exists('nivoak_breadcrumb')) nivoak_breadcrumb(); ?>
      <div class="section-label" style="margin-bottom:12px;">Expert Guides</div>
      <h1 class="page-title">Buying Guides &amp; Reviews</h1>
      <p style="color:var(--fg-dim);max-width:600px;margin-top:16px;font-size:15px;line-height:1.7;">In-depth reviews and curated buying guides from barware experts. Find the right tool for your home bar.</p>
    </div>
  </div>

  <div class="archive-content-section">
    <div class="archive-content-inner">
      <?php if ($blog_query->have_posts()) : ?>
      <!-- Category filter -->
      <div class="blog-filter-bar">
        <?php
        $cats = get_categories(array('hide_empty' => 1, 'orderby' => 'name'));
        foreach ($cats as $cat) :
          $active = (is_category($cat->term_id)) ? ' active' : '';
        ?>
        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="blog-filter-btn<?php echo $active; ?>">
          <?php echo esc_html($cat->name); ?> <span class="blog-filter-count"><?php echo $cat->count; ?></span>
        </a>
        <?php endforeach; ?>
      </div>

      <div class="article-grid">
        <?php while ($blog_query->have_posts()) : $blog_query->the_post();
          $categories = get_the_category();
          $cat_name = !empty($categories) ? esc_html($categories[0]->name) : 'Guide';
        ?>
        <a href="<?php the_permalink(); ?>" class="article-card reveal">
          <div class="article-image">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('medium', array('style' => 'width:100%;height:100%;object-fit:cover;')); ?>
            <?php else : ?>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="8" y1="13" x2="16" y2="13"/>
                <line x1="8" y1="17" x2="13" y2="17"/>
              </svg>
            <?php endif; ?>
          </div>
          <div class="article-meta">
            <span class="article-category"><?php echo $cat_name; ?></span>
            <span class="article-date"><?php echo esc_html(get_the_date('M j, Y')); ?></span>
          </div>
          <h3 class="article-title"><?php the_title(); ?></h3>
          <p class="article-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
          <span class="article-read-more">Read More &rarr;</span>
        </a>
        <?php endwhile; ?>
      </div>

      <?php
      wp_reset_postdata();
      $total_pages = $blog_query->max_num_pages;
      if ($total_pages > 1) :
        $current_page = max(1, $paged);
      ?>
      <nav class="archive-pagination">
        <?php
        echo paginate_links(array(
          'total' => $total_pages,
          'current' => $current_page,
          'prev_text' => '&lsaquo; Prev',
          'next_text' => 'Next &rsaquo;',
          'mid_size' => 1,
        ));
        ?>
      </nav>
      <?php endif; ?>

      <?php else : ?>
      <div style="text-align:center;padding:80px 20px;">
        <h2 style="font-family:var(--serif);font-size:2rem;color:var(--fg);margin-bottom:16px;">No Articles Found</h2>
        <p style="color:var(--fg-dim);">Check back soon for new guides and reviews.</p>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
