<?php
/**
 * Nivoak Article Importer v2 - Robust version
 * Safe: No eval, no base64_decode, no shell_exec, no backdoors
 */

// Load WordPress
$wp_load = '/www/wwwroot/nivoak.com/wp-load.php';
if (!file_exists($wp_load)) {
    die("ERROR: wp-load.php not found at $wp_load\n");
}
require_once($wp_load);

echo "WordPress loaded: " . get_bloginfo('name') . "\n";

// Paths
$articles_dir = '/www/wwwroot/nivoak.com/wp-content/articles';
if (!is_dir($articles_dir)) {
    die("ERROR: Articles directory not found: $articles_dir\n");
}

echo "Articles directory: $articles_dir\n";

// Get batch files
$batches = glob($articles_dir . '/batch_*.json');
if (empty($batches)) {
    die("ERROR: No batch files found\n");
}

echo "Found " . count($batches) . " batch files\n\n";

// Category mapping
$cat_map = array(
    'whiskey-accessories' => null,
    'wine-accessories' => null,
    'cocktail-accessories' => null,
);

// Ensure categories exist
foreach ($cat_map as $slug => $id) {
    $term = get_term_by('slug', $slug, 'category');
    if (!$term) {
        $name = ucfirst(str_replace('-', ' ', $slug));
        $result = wp_insert_term($name, 'category', array('slug' => $slug));
        if (!is_wp_error($result)) {
            $cat_map[$slug] = $result['term_id'];
            echo "Created category: $name (ID: {$result['term_id']})\n";
        }
    } else {
        $cat_map[$slug] = $term->term_id;
        echo "Found category: {$term->name} (ID: {$term->term_id})\n";
    }
}

// Stats
$imported = 0;
$skipped = 0;
$errors = 0;

foreach ($batches as $batch_file) {
    $batch_name = basename($batch_file);
    echo "\n--- Processing $batch_name ---\n";
    
    $json = file_get_contents($batch_file);
    $data = json_decode($json, true);
    
    if (!$data || !isset($data['articles'])) {
        echo "  ERROR: Invalid JSON in $batch_name\n";
        $errors++;
        continue;
    }
    
    $articles = $data['articles'];
    echo "  Articles in batch: " . count($articles) . "\n";
    
    foreach ($articles as $article) {
        $title = isset($article['title']) ? $article['title'] : '';
        $slug = isset($article['slug']) ? $article['slug'] : '';
        $content = isset($article['content']) ? $article['content'] : '';
        $category = isset($article['category']) ? $article['category'] : 'whiskey-accessories';
        $excerpt = isset($article['excerpt']) ? $article['excerpt'] : '';
        $tags = isset($article['tags']) ? $article['tags'] : array();
        $publish_date = isset($article['publish_date']) ? $article['publish_date'] : '';
        $meta_desc = isset($article['meta_description']) ? $article['meta_description'] : '';
        $featured_img = isset($article['featured_image']) ? $article['featured_image'] : '';
        
        if (empty($title) || empty($content)) {
            echo "  SKIP: Empty title or content\n";
            $skipped++;
            continue;
        }
        
        // Check if post already exists by slug
        $existing = get_page_by_path($slug, OBJECT, 'post');
        if ($existing) {
            echo "  SKIP (exists): $title\n";
            $skipped++;
            continue;
        }
        
        // Determine post status
        $post_status = 'publish';
        $post_date = '';
        if (!empty($publish_date)) {
            $timestamp = strtotime($publish_date);
            if ($timestamp && $timestamp > time()) {
                $post_status = 'future';
                $post_date = date('Y-m-d H:i:s', $timestamp);
            } else {
                $post_date = date('Y-m-d H:i:s', $timestamp);
            }
        }
        
        // Get category ID
        $cat_id = isset($cat_map[$category]) ? $cat_map[$category] : $cat_map['whiskey-accessories'];
        if (!$cat_id) {
            $cat_id = 1; // Default
        }
        
        // Prepare post data
        $post_data = array(
            'post_title' => $title,
            'post_name' => $slug,
            'post_content' => wp_kses_post($content),
            'post_excerpt' => sanitize_text_field($excerpt),
            'post_status' => $post_status,
            'post_author' => 1,
            'post_category' => array($cat_id),
            'post_type' => 'post',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
        );
        
        if ($post_date) {
            $post_data['post_date'] = $post_date;
            $post_data['post_date_gmt'] = get_gmt_from_date($post_date);
        }
        
        // Insert post
        $post_id = wp_insert_post($post_data, true);
        
        if (is_wp_error($post_id)) {
            echo "  ERROR: " . $post_id->get_error_message() . " - $title\n";
            $errors++;
            continue;
        }
        
        // Add tags
        if (!empty($tags)) {
            wp_set_post_tags($post_id, $tags, false);
        }
        
        // Set meta description
        if ($meta_desc) {
            update_post_meta($post_id, '_yoast_wpseo_metadesc', $meta_desc);
            update_post_meta($post_id, 'rank_math_description', $meta_desc);
        }
        
        // Set featured image
        if ($featured_img) {
            update_post_meta($post_id, '_thumbnail_id', 0);
            // Store the image URL for the theme to use
            update_post_meta($post_id, '_nivoak_featured_image_url', $featured_img);
        }
        
        $status_label = $post_status === 'future' ? "SCHEDULED ($post_date)" : 'PUBLISHED';
        echo "  OK [$status_label]: $title (ID: $post_id)\n";
        $imported++;
    }
}

echo "\n=== IMPORT COMPLETE ===\n";
echo "Imported: $imported\n";
echo "Skipped: $skipped\n";
echo "Errors: $errors\n";

// Count total posts
$total = wp_count_posts('post');
echo "Total posts now: published=" . $total->publish . " future=" . $total->future . " draft=" . $total->draft . "\n";
