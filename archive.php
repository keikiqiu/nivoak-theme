<?php
/**
 * Archive template (category, tag, author, date).
 *
 * @package Nivoak
 */

get_header();
?>

<div class="page-wrapper">
  <div class="page-header-section">
    <div class="page-header-inner">
      <?php if (function_exists('nivoak_breadcrumb')) nivoak_breadcrumb(); ?>
      <?php
      $archive_title = '';
      $archive_desc = '';
      if (is_category()) {
        $archive_title = single_cat_title('', false);
        $archive_desc = category_description();
      } elseif (is_tag()) {
        $archive_title = single_tag_title('', false);
      } elseif (is_author()) {
        $archive_title = get_the_author();
      } elseif (is_date()) {
        $archive_title = get_the_date('F Y');
      } else {
        $archive_title = 'Archive';
      }
      ?>
      <div class="section-label" style="margin-bottom:12px;"><?php echo esc_html(ucfirst(get_query_var('taxonomy') ? get_taxonomy(get_query_var('taxonomy'))->labels->singular_name : 'Collection')); ?></div>
      <h1 class="page-title"><?php echo esc_html($archive_title); ?></h1>
      <?php if ($archive_desc) echo '<p style="color:var(--fg-dim);max-width:600px;margin-top:16px;font-size:15px;line-height:1.7;">' . $archive_desc . '</p>'; ?>
    </div>
  </div>

  <div class="archive-content-section">
    <div class="archive-content-inner">
      <?php if (have_posts()) : ?>
      <div class="article-grid">
        <?php while (have_posts()) : the_post();
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
      $pagination = paginate_links(array(
        'prev_text' => '&lsaquo; Prev',
        'next_text' => 'Next &rsaquo;',
        'type' => 'array',
        'mid_size' => 1,
      ));
      if ($pagination) :
      ?>
      <nav class="archive-pagination">
        <?php foreach ($pagination as $link) : ?>
          <?php echo $link; ?>
        <?php endforeach; ?>
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
