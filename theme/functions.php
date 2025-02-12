<?php
if (!defined('ABSPATH')) exit;

// Theme Setup
function openblog_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'openblog'),
    ));
}
add_action('after_setup_theme', 'openblog_setup');

// Custom Navigation Walker
class OpenBlog_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        
        // Add Tailwind classes
        $class_names .= ' flex items-center gap-1 text-2xl md:text-base hover:text-gray-600 dark:hover:text-gray-300';
        
        $output .= '<li class="' . esc_attr($class_names) . '">';
        
        $atts = array();
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $atts['class'] = 'flex items-center gap-1';
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// Social Links Function
function openblog_social_links() {
    $social_links = array(
        'twitter' => get_theme_mod('twitter_url'),
        'github' => get_theme_mod('github_url'),
        'linkedin' => get_theme_mod('linkedin_url')
    );
    
    foreach ($social_links as $platform => $url) {
        if ($url) {
            echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer" 
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
                    aria-label="' . esc_attr(ucfirst($platform)) . '">';
            // You can add SVG icons here for each platform
            echo ucfirst($platform);
            echo '</a>';
        }
    }
}

// Enqueue Scripts and Styles
function openblog_enqueue_scripts() {
    // 样式表
    wp_enqueue_style('openblog-style', get_stylesheet_uri());
    wp_enqueue_style('openblog-tailwind', get_template_directory_uri() . '/css/tailwind.css');

    // JavaScript 文件
    wp_enqueue_script('openblog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true);
    wp_enqueue_script('openblog-dark-mode', get_template_directory_uri() . '/js/dark-mode.js', array(), '1.0', true);
    wp_enqueue_script('openblog-animations', get_template_directory_uri() . '/js/animations.js', array(), '1.0', true);
    wp_enqueue_script('openblog-search', get_template_directory_uri() . '/js/search.js', array(), '1.0', true);

    // 为搜索功能添加 nonce 和 API URL
    wp_localize_script('openblog-search', 'wpApiSettings', array(
        'root' => esc_url_raw(rest_url()),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}
add_action('wp_enqueue_scripts', 'openblog_enqueue_scripts');

// Reading Time Function
function openblog_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Assuming average reading speed of 200 words per minute
    
    return $reading_time;
}

// Customizer Settings
function openblog_customize_register($wp_customize) {
    // Author Setting
    $wp_customize->add_section('openblog_general', array(
        'title'    => __('General Settings', 'openblog'),
        'priority' => 20,
    ));
    
    $wp_customize->add_setting('openblog_author', array(
        'default'           => get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('openblog_author', array(
        'label'    => __('Author Name', 'openblog'),
        'section'  => 'openblog_general',
        'type'     => 'text',
    ));

    // Social Media Links Section
    $wp_customize->add_section('openblog_social_links', array(
        'title'    => __('Social Links', 'openblog'),
        'priority' => 30,
    ));
    
    // Twitter URL
    $wp_customize->add_setting('twitter_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('twitter_url', array(
        'label'    => __('Twitter URL', 'openblog'),
        'section'  => 'openblog_social_links',
        'type'     => 'url',
    ));
    
    // GitHub URL
    $wp_customize->add_setting('github_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('github_url', array(
        'label'    => __('GitHub URL', 'openblog'),
        'section'  => 'openblog_social_links',
        'type'     => 'url',
    ));
    
    // LinkedIn URL
    $wp_customize->add_setting('linkedin_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('linkedin_url', array(
        'label'    => __('LinkedIn URL', 'openblog'),
        'section'  => 'openblog_social_links',
        'type'     => 'url',
    ));
}
add_action('customize_register', 'openblog_customize_register');
