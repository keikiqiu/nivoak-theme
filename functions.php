<?php
/**
 * Nivoak theme functions.
 *
 * @package Nivoak
 * @since   2.1.0
 */

if ( ! function_exists( 'nivoak_setup' ) ) :
  function nivoak_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'nivoak' ),
      'footer'  => __( 'Footer Menu', 'nivoak' ),
    ) );
  }
endif;
add_action( 'after_setup_theme', 'nivoak_setup' );

function nivoak_scripts() {
  wp_enqueue_style( 'nivoak-style', get_stylesheet_uri(), array(), '2.1.0' );
  wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'nivoak_scripts' );

function nivoak_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'nivoak' ),
    'id'            => 'sidebar-1',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ) );
}
add_action( 'widgets_init', 'nivoak_widgets_init' );

// WooCommerce support
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Set excerpt length
function nivoak_excerpt_length( $length ) {
  return 25;
}
add_filter( 'excerpt_length', 'nivoak_excerpt_length' );

// Set excerpt more
function nivoak_excerpt_more( $more ) {
  return '...';
}
add_filter( 'excerpt_more', 'nivoak_excerpt_more' );

// Define nivoak_breadcrumb() if not already defined by mu-plugin
if ( ! function_exists( 'nivoak_breadcrumb' ) ) {
  function nivoak_breadcrumb() {
    echo '<nav class="nivoak-breadcrumb" style="padding:10px 0;font-size:13px;color:#a89b88;">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '" style="color:#a89b88;">Home</a>';
    if ( is_category() || is_single() ) {
      echo ' &rsaquo; ';
      the_category( ' &rsaquo; ' );
      if ( is_single() ) {
        echo ' &rsaquo; ';
        the_title();
      }
    } elseif ( is_page() ) {
      echo ' &rsaquo; ';
      the_title();
    }
    echo '</nav>';
  }
}

// Page header styles
add_action( 'wp_head', function() {
  echo '<style>
  .page-wrapper { padding-top: 80px; }
  .page-header-section {
    padding: 60px 48px 40px;
    background: linear-gradient(180deg, var(--bg-2) 0%, var(--bg) 100%);
    border-bottom: 1px solid var(--line);
  }
  .page-header-inner { max-width: 1200px; margin: 0 auto; }
  .page-header-inner .page-title {
    font-family: var(--serif);
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 700;
    color: var(--fg);
    margin-top: 10px;
  }
  .page-content-section { padding: 60px 48px; }
  .page-content-inner {
    max-width: 800px;
    margin: 0 auto;
    font-size: 16px;
    line-height: 1.8;
    color: var(--fg-dim);
  }
  .page-content-inner h2 { font-family: var(--serif); color: var(--fg); margin: 1.5em 0 0.5em; }
  .page-content-inner h3 { font-family: var(--serif); color: var(--fg); margin: 1.2em 0 0.4em; }
  .page-content-inner p { margin-bottom: 1.2em; }
  .page-content-inner a { color: var(--accent); }
  .page-content-inner ul, .page-content-inner ol { margin: 1em 0; padding-left: 1.5em; }
  .page-content-inner li { margin-bottom: 0.5em; }
  </style>';
});
