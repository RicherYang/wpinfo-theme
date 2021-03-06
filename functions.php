<?php
include_once __DIR__ . '/includes/template.php';

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
    wp_register_style('fortawesome', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.min.css', [], null);
    wp_enqueue_style('wpi-style', get_stylesheet_directory_uri() . '/assets/css/main.css', ['fortawesome'], $version);

    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js', [], null, true);
    wp_register_script('wpi-add', get_stylesheet_directory_uri() . '/assets/js/create.js', ['jquery'], $version, true);

    wp_localize_script('wpi-add', 'ajaxInfo', [
        'url' => rest_url('wpi/v1/site')
    ]);
}

add_action('init', 'wpi_menus');
function wpi_menus()
{
    register_nav_menus([
        'primary'  => '頁首選單',
    ]);
}

add_filter('navigation_markup_template', 'wpi_navigation_markup_template');
function wpi_navigation_markup_template($template)
{
    $template = '
	<nav class="navigation" role="navigation" aria-label="%4$s">
		<div class="nav-links">%3$s</div>
    </nav>';

    return $template;
}

add_action('pre_get_posts', 'wpi_custom_query');
function wpi_custom_query($query)
{
    if (is_admin()) {
        return;
    }

    if (!$query->is_main_query()) {
        return;
    }

    if ($query->is_tag()) {
        $query->set('post_type', ['plugin', 'theme']);
        $query->set('posts_per_page', -1);
    } elseif ($query->is_search()) {
        $query->set('posts_per_page', 1);
    } else {
        if ($query->is_post_type_archive(['website', 'plugin', 'theme'])) {
            $_GET['orderby'] = strtolower(wp_unslash($_GET['orderby'] ?? ''));
            if (strpos($_GET['orderby'], '_') === false) {
                $_GET['orderby'] = 'update_d';
            }

            list($orderby, $order) = explode('_', $_GET['orderby']);

            switch ($orderby) {
                case 'update':
                    $query->set('orderby', 'modified');
                    break;
                case 'name':
                    $query->set('orderby', 'title');
                    break;
                case 'create':
                    $query->set('orderby', 'ID');
                    break;
                case 'count':
                    $query->set('meta_key', 'used_count');
                    $query->set('orderby', 'meta_value_num');
                    break;
            }
            switch ($order) {
                case 'a':
                    $query->set('order', 'ASC');
                    break;
                case 'd':
                    $query->set('order', 'DESC');
                    break;
            }
        }
    }

    if ($query->get('orderby') == '') {
        $query->set('orderby', 'modified');
    }
}
