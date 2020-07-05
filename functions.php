<?php

add_action('after_setup_theme', 'wpi_theme_support');
function wpi_theme_support()
{
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1920, 1080);

    add_theme_support('title-tag');

    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'script', 'style']);
}

add_action('wp_enqueue_scripts', 'wpi_register_styles');
function wpi_register_styles()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('wpi-style', get_stylesheet_directory_uri() . '/assets/css/main.css', [], $version);

    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js', [], null, true);
    wp_register_script('wpi-script', get_stylesheet_directory_uri() . '/assets/js/main.js', ['jquery'], $version, true);
    wp_register_script('wpi-create-script', get_stylesheet_directory_uri() . '/assets/js/create.js', ['wpi-script'], $version, true);

    wp_localize_script('wpi-create-script', 'ajaxInfo', [
        'url' => rest_url('wei/v1/site')
    ]);
}

add_action('enqueue_block_editor_assets', 'wpi_block_editor_styles');
function wpi_block_editor_styles()
{
    $version = wp_get_theme()->get('Version');

    wp_enqueue_style('wpi-block-editor-style', get_stylesheet_directory_uri() . '/assets/css/block-editor.css', [], $version);
}

add_action('init', 'wpi_menus');
function wpi_menus()
{
    register_nav_menus([
        'primary'  => '頁首選單',
    ]);
}

add_filter('navigation_markup_template', 'wei_navigation_markup_template');
function wei_navigation_markup_template($template)
{
    $template = '
	<nav class="navigation" role="navigation" aria-label="%4$s">
		<div class="nav-links">%3$s</div>
    </nav>';

    return $template;
}
