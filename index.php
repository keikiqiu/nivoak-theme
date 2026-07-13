<?php
/**
 * The main template file (Homepage).
 *
 * @package Nivoak
 * @since   2.1.0
 */

get_header();
?>

<!-- HERO -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-content">
    <div class="hero-eyebrow" style="animation: fadeUp 1s 0.3s forwards; opacity:0;">Premium Bar Accessories</div>
    <h1 class="hero-title" style="animation: fadeUp 1.2s 0.5s forwards; opacity:0;">Nivoak<span class="accent">&middot;</span><br>Every Glass<br>Is a <span class="accent">Ritual</span></h1>
    <p class="hero-sub" style="animation: fadeUp 1s 0.8s forwards; opacity:0;">From whiskey to wine, from classics to cocktails &mdash; match every drink with the vessel it deserves. Expert-curated barware for the discerning connoisseur.</p>
    <div class="hero-actions" style="animation: fadeUp 1s 1s forwards; opacity:0;">
      <a href="#categories" class="btn-primary">Explore Collections</a>
      <a href="#craft" class="btn-ghost">Our Craft</a>
    </div>
  </div>
  <div class="hero-scroll" style="animation: fadeIn 1s 1.5s forwards; opacity:0;">
    <span>Scroll</span>
    <div class="hero-scroll-line"></div>
  </div>
</section>

<!-- CATEGORIES -->
<section class="categories" id="categories">
  <div class="section-head reveal">
    <div>
      <div class="section-label">Three Collections</div>
      <h2 class="section-title">For Every Spirit,<br>Its Perfect Vessel</h2>
    </div>
    <p class="section-desc">Different spirits, different rituals, different tools. We curate by category to give every enthusiast professional-grade accessories.</p>
  </div>

  <div class="cat-grid">
    <a href="<?php echo esc_url( home_url( '/category/whiskey-accessories/' ) ); ?>" class="cat-card reveal">
      <div class="cat-card-visual">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M8 2h8l-1 6h-6L8 2z"/>
          <path d="M7 8h10v3a5 5 0 0 1-5 5 5 5 0 0 1-5-5V8z"/>
          <line x1="12" y1="16" x2="12" y2="19"/>
          <line x1="9" y1="22" x2="15" y2="22"/>
          <line x1="10" y1="19" x2="14" y2="19"/>
        </svg>
      </div>
      <div class="cat-card-overlay"></div>
      <div class="cat-card-body">
        <span class="cat-card-num">01 / Whiskey</span>
        <h3 class="cat-card-name">Whiskey Accessories</h3>
        <p class="cat-card-desc">Crystal decanters, whiskey stones, Glencairn glasses, leather coasters &mdash; crafted for neat pours and slow sips.</p>
        <span class="cat-card-link">Browse All &rarr;</span>
      </div>
    </a>

    <a href="<?php echo esc_url( home_url( '/category/wine-accessories/' ) ); ?>" class="cat-card reveal reveal-delay-1">
      <div class="cat-card-visual">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M8 2h8v6a4 4 0 0 1-8 0V2z"/>
          <path d="M12 12v8"/>
          <path d="M8 22h8"/>
          <path d="M9 22v-2h6v2"/>
        </svg>
      </div>
      <div class="cat-card-overlay"></div>
      <div class="cat-card-body">
        <span class="cat-card-num">02 / Wine</span>
        <h3 class="cat-card-name">Wine Accessories</h3>
        <p class="cat-card-desc">Sommelier corkscrews, aerators, crystal stemware, preservation systems &mdash; the complete ritual from uncork to pour.</p>
        <span class="cat-card-link">Browse All &rarr;</span>
      </div>
    </a>

    <a href="<?php echo esc_url( home_url( '/category/cocktail-accessories/' ) ); ?>" class="cat-card reveal reveal-delay-2">
      <div class="cat-card-visual">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 2h16l-8 10L4 2z"/>
          <path d="M12 12v8"/>
          <path d="M8 22h8"/>
          <line x1="6" y1="6" x2="18" y2="6"/>
        </svg>
      </div>
      <div class="cat-card-overlay"></div>
      <div class="cat-card-body">
        <span class="cat-card-num">03 / Cocktail</span>
        <h3 class="cat-card-name">Cocktail Accessories</h3>
        <p class="cat-card-desc">Boston shakers, jiggers, muddlers, strainers, bar spoons &mdash; bartender-grade tools for the home mixologist.</p>
        <span class="cat-card-link">Browse All &rarr;</span>
      </div>
    </a>
  </div>
</section>

<!-- CRAFT -->
<section class="craft" id="craft">
  <div class="craft-inner">
    <div class="craft-visual reveal">
      <div class="craft-visual-pattern"></div>
      <div class="craft-visual-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <path d="M12 2v20"/>
          <path d="M2 12h20"/>
          <circle cx="12" cy="12" r="4"/>
        </svg>
      </div>
    </div>
    <div class="craft-content reveal reveal-delay-1">
      <div class="section-label">Craftsmanship</div>
      <h2 class="section-title">Beauty in<br>Every Detail</h2>
      <p class="craft-text">Every piece is selected for material quality and craftsmanship. From lead-free crystal clarity to surgical-grade steel polish to hand-stitched leather grain &mdash; we believe the best barware is the kind you barely notice, yet it transforms the entire experience.</p>
      <div class="craft-stats">
        <div>
          <div class="craft-stat-num">200+</div>
          <div class="craft-stat-label">Curated Items</div>
        </div>
        <div>
          <div class="craft-stat-num">48h</div>
          <div class="craft-stat-label">Fast Shipping</div>
        </div>
        <div>
          <div class="craft-stat-num">30-Day</div>
          <div class="craft-stat-label">Easy Returns</div>
        </div>
        <div>
          <div class="craft-stat-num">100%</div>
          <div class="craft-stat-label">Authentic</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- BLOG / GUIDES -->
<section class="blog-section" id="blog">
  <div class="section-head reveal">
    <div>
      <div class="section-label">Expert Guides</div>
      <h2 class="section-title">Buying Guides<br>&amp; Reviews</h2>
    </div>
    <p class="section-desc">In-depth reviews and curated buying guides from barware experts. Find the right tool for your home bar.</p>
  </div>

  <div class="article-grid">
    <?php
    $args = array(
      'post_type'      => 'post',
      'posts_per_page' => 6,
      'post_status'    => 'publish',
    );
    $query = new WP_Query( $args );
    while ( $query->have_posts() ) : $query->the_post();
      $categories = get_the_category();
      $cat_name = ! empty( $categories ) ? esc_html( $categories[0]->name ) : 'Guide';
    ?>
    <a href="<?php the_permalink(); ?>" class="article-card reveal">
      <div class="article-image">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14 2 14 8 20 8"/>
          <line x1="8" y1="13" x2="16" y2="13"/>
          <line x1="8" y1="17" x2="13" y2="17"/>
        </svg>
      </div>
      <div class="article-meta">
        <span class="article-category"><?php echo $cat_name; ?></span>
        <span class="article-date"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
      </div>
      <h3 class="article-title"><?php the_title(); ?></h3>
      <p class="article-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
    </a>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>

<!-- FINAL CTA -->
<section class="cta">
  <div class="cta-bg"></div>
  <div class="cta-content reveal">
    <h2 class="cta-title">Make Every Pour<br>Worth <span class="accent">Savoring</span></h2>
    <p class="cta-sub">Join our community of connoisseurs. Get expert guides, new arrivals, and exclusive offers delivered to your inbox.</p>
    <a href="#categories" class="btn-primary">Start Exploring</a>
  </div>
</section>

<?php get_footer(); ?>