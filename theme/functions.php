<?php
if (!defined('ABSPATH')) {
    exit;
}

// 主题设置
function openblog_setup() {
    // 添加主题支持
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // 注册菜单
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'openblog'),
    ));
}
add_action('after_setup_theme', 'openblog_setup');

// 加载样式和脚本
function openblog_scripts() {
    wp_enqueue_style('openblog-style', get_stylesheet_uri());
    wp_enqueue_style('openblog-tailwind', get_template_directory_uri() . '/dist/style.css');
    wp_enqueue_script('openblog-theme', get_template_directory_uri() . '/js/theme.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'openblog_scripts');
