<?php
/**
 * Nivoak Theme Fix v2 - Mu-Plugin
 * Fixes: undefined nivoak_breadcrumb(), broken taxonomy, .reveal visibility, nav URL 404s
 * Place at: wp-content/mu-plugins/nivoak-fix.php
 */

// 1. Register bar_product_category taxonomy
add_action('init', function() {
    if (!taxonomy_exists('bar_product_category')) {
        register_taxonomy('bar_product_category', 'product', array(
            'labels' => array('name' => 'Bar Product Categories', 'singular_name' => 'Bar Product Category'),
            'public' => true, 'hierarchical' => true, 'show_in_rest' => true,
        ));
    }
    foreach (array('whiskey' => 'Whiskey', 'wine' => 'Wine', 'cocktail' => 'Cocktail') as $s => $n) {
        if (!term_exists($s, 'bar_product_category')) {
            wp_insert_term($n, 'bar_product_category', array('slug' => $s));
        }
    }
});

// 2. Fix term links
add_filter('term_link', function($url, $term, $taxonomy) {
    if ($taxonomy === 'bar_product_category') {
        $m = array('whiskey' => 'whiskey-accessories', 'wine' => 'wine-accessories', 'cocktail' => 'cocktail-accessories');
        if (isset($m[$term->slug])) return home_url('/category/' . $m[$term->slug] . '/');
    }
    return $url;
}, 10, 3);

// 3. Define nivoak_breadcrumb()
if (!function_exists('nivoak_breadcrumb')) {
    function nivoak_breadcrumb() {
        echo '<nav class="nivoak-breadcrumb" style="padding:10px 0;font-size:13px;color:#a89b88;">';
        echo '<a href="' . esc_url(home_url('/')) . '" style="color:#a89b88;">Home</a>';
        if (is_category() || is_single()) {
            echo ' &rsaquo; '; the_category(' &rsaquo; ');
            if (is_single()) { echo ' &rsaquo; '; the_title(); }
        } elseif (is_page()) { echo ' &rsaquo; '; the_title(); }
        echo '</nav>';
    }
}

// 4. Inject CSS + JS fixes via wp_head
add_action('wp_head', function() {
    echo '<script>document.documentElement.className += " js";</script>' . "\n";
    echo '<style>
.reveal { opacity: 1 !important; transform: none !important; }
.js .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.9s cubic-bezier(0.22,1,0.36,1), transform 0.9s cubic-bezier(0.22,1,0.36,1); }
.js .reveal.visible { opacity: 1; transform: translateY(0); }
.hero-eyebrow,.hero-title,.hero-sub,.hero-actions,.hero-scroll { opacity: 1 !important; animation: none !important; }
.js .hero-eyebrow { opacity: 0; animation: fadeUp 1s 0.3s forwards; }
.js .hero-title { opacity: 0; animation: fadeUp 1.2s 0.5s forwards; }
.js .hero-sub { opacity: 0; animation: fadeUp 1s 0.8s forwards; }
.js .hero-actions { opacity: 0; animation: fadeUp 1s 1s forwards; }
.js .hero-scroll { opacity: 0; animation: fadeIn 1s 1.5s forwards; }
.page-wrapper { padding-top: 80px; }
.page-header-section { padding: 60px 48px 40px; background: linear-gradient(180deg,#14100d 0%,#0a0807 100%); border-bottom: 1px solid rgba(200,147,47,0.15); }
.page-header-inner { max-width: 1200px; margin: 0 auto; }
.page-header-inner .page-title { font-family: "Playfair Display",Georgia,serif; font-size: clamp(2rem,5vw,3.5rem); font-weight: 700; color: #f5ede0; margin-top: 10px; }
.page-content-section { padding: 60px 48px; }
.page-content-inner { max-width: 800px; margin: 0 auto; font-size: 16px; line-height: 1.8; color: #a89b88; }
.page-content-inner h2 { font-family: "Playfair Display",Georgia,serif; color: #f5ede0; margin: 1.5em 0 0.5em; }
.page-content-inner h3 { font-family: "Playfair Display",Georgia,serif; color: #f5ede0; margin: 1.2em 0 0.4em; }
.page-content-inner p { margin-bottom: 1.2em; }
.page-content-inner a { color: #c8932f; }
</style>' . "\n";
    echo '<script>
window.addEventListener("DOMContentLoaded",function(){
    var h=document.querySelector(".site-header");
    if(h){window.addEventListener("scroll",function(){if(window.scrollY>40){h.classList.add("scrolled")}else{h.classList.remove("scrolled")}});}
    var io=new IntersectionObserver(function(e){e.forEach(function(en){if(en.isIntersecting){en.target.classList.add("visible");io.unobserve(en.target)}})},{threshold:0.1,rootMargin:"0px 0px -60px 0px"});
    document.querySelectorAll(".reveal").forEach(function(el){io.observe(el)});
    setTimeout(function(){document.querySelectorAll(".reveal:not(.visible)").forEach(function(el){el.classList.add("visible")})},3000);
});
</script>' . "\n";
}, 1);

// 5. Fix navigation URLs via output buffering
add_action('template_redirect', function() {
    ob_start(function($html) {
        $html = str_replace(
            array('nivoak.com/whiskey-accessories/', 'nivoak.com/wine-accessories/', 'nivoak.com/cocktail-accessories/', 'nivoak.com/contact-us/', 'nivoak.com/best-sellers/'),
            array('nivoak.com/category/whiskey-accessories/', 'nivoak.com/category/wine-accessories/', 'nivoak.com/category/cocktail-accessories/', 'nivoak.com/contact/', 'nivoak.com/shop/'),
            $html
        );
        return $html;
    });
});
