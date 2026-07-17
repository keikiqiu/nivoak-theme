<?php
/**
 * Configure Rank Math SEO plugin directly via database options
 * This configures the OFFICIAL Rank Math plugin - no custom SEO code
 */
header('Content-Type: text/plain');

define('WP_USE_THEMES', false);
require('/www/wwwroot/yashitea.com/wp-load.php');

echo "=== Rank Math SEO Configuration ===\n\n";

// Step 1: Check if Rank Math is active
$active_plugins = get_option('active_plugins');
$rankmath_active = false;
foreach ($active_plugins as $p) {
    if (strpos($p, 'seo-by-rank-math') !== false) {
        $rankmath_active = true;
        echo "Rank Math plugin file: $p\n";
        break;
    }
}
if (!$rankmath_active) {
    echo "ERROR: Rank Math is NOT active!\n";
    exit;
}
echo "Rank Math is ACTIVE.\n\n";

// Step 2: Activate Rank Math modules
// These are the official Rank Math module slugs
$modules = array(
    'link-counter',      // Link counter
    'search-console',    // Search Console
    'sitemap',           // XML Sitemap
    'analytics',         // Analytics
    'seo-analysis',      // SEO Analysis
    'rich-snippet',      // Schema (Rich Snippets)
    '404-monitor',       // 404 Monitor
    'redirections',      // Redirections
    'local-seo',         // Local SEO
    'woocommerce',       // WooCommerce (if applicable)
    'acf',              // ACF integration
    'role-manager',      // Role Manager
);

echo "=== Activating Rank Math Modules ===\n";
$existing_modules = get_option('rank_math_modules');
if (!is_array($existing_modules)) {
    $existing_modules = array();
}

foreach ($modules as $module) {
    if (!in_array($module, $existing_modules)) {
        $existing_modules[] = $module;
        echo "  + Added module: $module\n";
    } else {
        echo "  = Already active: $module\n";
    }
}
update_option('rank_math_modules', $existing_modules);
echo "Total active modules: " . count($existing_modules) . "\n\n";

// Step 3: Configure General Settings
echo "=== General Settings ===\n";

$general_settings = get_option('rank-math-options-general');
if (!is_array($general_settings)) {
    $general_settings = array();
}

// SEO meta settings
$general_settings['robots_global'] = array(
    'max-snippet' => -1,
    'max-video-preview' => -1,
    'max-image-preview' => 'large',
);

// Enable breadcrumbs
$general_settings['breadcrumbs'] = 'on';
$general_settings['breadcrumbs_separator'] = '/';
$general_settings['breadcrumbs_home_label'] = 'Home';
$general_settings['breadcrumbs_archive_format'] = '%s';
$general_settings['breadcrumbs_search_format'] = 'Search Results for %s';
$general_settings['breadcrumbs_404_label'] = '404 Error: Page not found';

// Links settings
$general_settings['links_redirect_plain'] = 'on';
$general_settings['links_remove_short_links'] = 'on';

// Images settings
$general_settings['add_img_alt'] = 'on';
$general_settings['add_img_title'] = 'off';

// Webmaster tools (empty - user can add later)
$general_settings['google_verify'] = '';
$general_settings['bing_verify'] = '';
$general_settings['baidu_verify'] = '';

// Open Graph (enable)
$general_settings['open_graph'] = 'on';

// Edit robots.txt
$general_settings['robots_txt_content'] = "User-agent: *\nDisallow: /wp-admin/\nAllow: /wp-admin/admin-ajax.php\nDisallow: /wp-includes/\nAllow: /wp-includes/js/\nAllow: /wp-includes/css/\nSitemap: https://yashitea.com/sitemap_index.xml";

update_option('rank-math-options-general', $general_settings);
echo "General settings configured.\n\n";

// Step 4: Configure Title & Meta Settings
echo "=== Title & Meta Settings ===\n";

$titles_settings = get_option('rank-math-options-titles');
if (!is_array($titles_settings)) {
    $titles_settings = array();
}

// Homepage settings
$titles_settings['homepage_title'] = 'YashiTea - Japanese Tea Culture and Lifestyle Blog';
$titles_settings['homepage_description'] = 'Discover the art of Japanese tea culture, Japandi tea table styling, minimalist tea ceremony guides, and authentic matcha and sencha recommendations at YashiTea.';
$titles_settings['homepage_custom_robots'] = 'on';
$titles_settings['homepage_robots'] = array('index', 'follow');

// Authors
$titles_settings['author_archive_title'] = '%name% %page% %sep% %sitename%';
$titles_settings['author_archive_description'] = 'Articles by %name%';
$titles_settings['author_custom_robots'] = 'on';
$titles_settings['author_robots'] = array('index', 'follow');

// Date archives
$titles_settings['date_archive_title'] = '%date% %page% %sep% %sitename%';
$titles_settings['date_archive_custom_robots'] = 'on';
$titles_settings['date_robots'] = array('noindex', 'follow');

// Search archives
$titles_settings['search_title'] = '%search% %page% %sep% %sitename%';
$titles_settings['search_custom_robots'] = 'on';
$titles_settings['search_robots'] = array('noindex', 'follow');

// 404 page
$titles_settings['404_title'] = 'Page Not Found %sep% %sitename%';

// Category
$titles_settings['tax_category_title'] = '%term% %page% %sep% %sitename%';
$titles_settings['tax_category_description'] = '%term% articles and guides from YashiTea.';
$titles_settings['tax_category_custom_robots'] = 'on';
$titles_settings['tax_category_robots'] = array('index', 'follow');

// Post
$titles_settings['pt_post_title'] = '%title% %page% %sep% %sitename%';
$titles_settings['pt_post_description'] = '%excerpt%';
$titles_settings['pt_post_custom_robots'] = 'on';
$titles_settings['pt_post_robots'] = array('index', 'follow');

// Page
$titles_settings['pt_page_title'] = '%title% %page% %sep% %sitename%';
$titles_settings['pt_page_description'] = '%excerpt%';
$titles_settings['pt_page_custom_robots'] = 'on';
$titles_settings['pt_page_robots'] = array('index', 'follow');

// Attachment
$titles_settings['pt_attachment_custom_robots'] = 'on';
$titles_settings['pt_attachment_robots'] = array('noindex', 'follow');

// Add Schema to posts
$titles_settings['pt_post_rich_snippet'] = 'article';

// Social settings
$titles_settings['og_facebook'] = '';
$titles_settings['twitter_author_names'] = '';
$titles_settings['twitter_card_type'] = 'summary_large_image';

// Knowledge Graph schema
$titles_settings['knowledgegraph_type'] = 'organization';
$titles_settings['knowledgegraph_name'] = 'YashiTea';
$titles_settings['knowledgegraph_logo'] = '';
$titles_settings['local_business_type'] = '';
$titles_settings['local_address'] = '';
$titles_settings['local_phone'] = '';
$titles_settings['local_email'] = '';

update_option('rank-math-options-titles', $titles_settings);
echo "Title & Meta settings configured.\n\n";

// Step 5: Configure Sitemap Settings
echo "=== Sitemap Settings ===\n";

$sitemap_settings = get_option('rank-math-options-sitemap');
if (!is_array($sitemap_settings)) {
    $sitemap_settings = array();
}

$sitemap_settings['items_per_page'] = 200;
$sitemap_settings['include_images'] = 'on';
$sitemap_settings['include_featured_image'] = 'on';
$sitemap_settings['exclude_post_types'] = array('attachment');
$sitemap_settings['exclude_taxonomies'] = array('post_format');

// Post types in sitemap
$sitemap_settings['pt_post'] = 'on';
$sitemap_settings['pt_page'] = 'on';

// Taxonomies in sitemap
$sitemap_settings['tax_category'] = 'on';
$sitemap_settings['tax_post_tag'] = 'on';

update_option('rank-math-options-sitemap', $sitemap_settings);
echo "Sitemap settings configured.\n\n";

// Step 6: Mark setup as complete
echo "=== Marking Setup Complete ===\n";

// Rank Math uses this option to track if setup wizard is complete
update_option('rank_math_setup_completed', true);
update_option('rank_math_registration_skipped', true);
update_option('rank_math_skip_registration', true);

// Also set the version marker (Rank Math uses this to detect first run)
update_option('rank_math_version', '1.0.274');

echo "Setup marked as complete.\n\n";

// Step 7: Flush rewrite rules (needed for sitemap and REST API)
echo "=== Flushing Rewrite Rules ===\n";
flush_rewrite_rules(true);
echo "Rewrite rules flushed.\n\n";

// Step 8: Verify settings
echo "=== Verification ===\n";
echo "Active modules: " . implode(', ', get_option('rank_math_modules', array())) . "\n";

$verify_general = get_option('rank-math-options-general');
echo "Open Graph enabled: " . (isset($verify_general['open_graph']) ? 'YES' : 'NO') . "\n";
echo "Breadcrumbs enabled: " . (isset($verify_general['breadcrumbs']) ? 'YES' : 'NO') . "\n";

$verify_titles = get_option('rank-math-options-titles');
echo "Homepage title: " . ($verify_titles['homepage_title'] ?? 'NOT SET') . "\n";
echo "Homepage description: " . ($verify_titles['homepage_description'] ?? 'NOT SET') . "\n";

$verify_sitemap = get_option('rank-math-options-sitemap');
echo "Sitemap items per page: " . ($verify_sitemap['items_per_page'] ?? 'NOT SET') . "\n";

echo "Setup completed: " . (get_option('rank_math_setup_completed') ? 'YES' : 'NO') . "\n";
echo "Registration skipped: " . (get_option('rank_math_registration_skipped') ? 'YES' : 'NO') . "\n";

echo "\n=== DONE! ===\n";
echo "Rank Math SEO has been configured. Please verify by checking:\n";
echo "1. https://yashitea.com/ (should have meta description, OG tags, Schema)\n";
echo "2. https://yashitea.com/sitemap_index.xml (should show sitemap)\n";
echo "DELETE THIS FILE after verification!\n";
