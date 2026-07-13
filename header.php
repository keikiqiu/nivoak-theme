<?php
/**
 * Header template.
 *
 * @package Nivoak
 * @since   2.1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <script>document.documentElement.className += ' js';</script>
  <?php wp_head(); ?>
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      var header = document.querySelector('.site-header');
      window.addEventListener('scroll', function() {
        if (window.scrollY > 40) {
          header.classList.add('scrolled');
        } else {
          header.classList.remove('scrolled');
        }
      });

      var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

      document.querySelectorAll('.reveal').forEach(function(el) {
        observer.observe(el);
      });

      // Fallback: make everything visible after 3 seconds
      setTimeout(function() {
        document.querySelectorAll('.reveal:not(.visible)').forEach(function(el) {
          el.classList.add('visible');
        });
      }, 3000);
    });
  </script>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-brand">Nivoak<span>.</span></a>
  <nav>
    <ul class="nav-links">
      <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
      <li><a href="<?php echo esc_url( home_url( '/category/whiskey-accessories/' ) ); ?>">Whiskey</a></li>
      <li><a href="<?php echo esc_url( home_url( '/category/wine-accessories/' ) ); ?>">Wine</a></li>
      <li><a href="<?php echo esc_url( home_url( '/category/cocktail-accessories/' ) ); ?>">Cocktail</a></li>
      <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Guides</a></li>
      <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
    </ul>
  </nav>
  <a href="<?php echo esc_url( home_url( '/cart/' ) ); ?>" class="nav-cart">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="9" cy="21" r="1"/>
      <circle cx="20" cy="21" r="1"/>
      <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
    </svg>
    <span>Cart</span>
  </a>
</header>