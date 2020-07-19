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

    wp_enqueue_script('wpi-script');

    wp_localize_script('wpi-create-script', 'ajaxInfo', [
        'url' => rest_url('wpi/v1/site')
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

add_action('pre_get_posts', 'wei_custom_query');
function wei_custom_query($query)
{
    if (!is_admin()) {
        if ($query->is_main_query()) {
            if ($query->is_post_type_archive(['website'])) {
                if (!isset($_GET['order'])) {
                    $_GET['order'] = 'create';
                }
                $_GET['order'] = wp_unslash($_GET['order']);
                switch ($_GET['order']) {
                    case 'create':
                        $query->set('orderby', 'ID');
                        $query->set('order', 'DESC');
                        break;
                    case 'update':
                        $query->set('orderby', 'modified');
                        $query->set('order', 'DESC');
                        break;
                    case 'name':
                        $query->set('orderby', 'title');
                        $query->set('order', 'ASC');
                        break;
                }
            }

            if ($query->is_post_type_archive(['plugin', 'theme'])) {
                if (!isset($_GET['order'])) {
                    $_GET['order'] = 'count';
                }
                $_GET['order'] = wp_unslash($_GET['order']);
                switch ($_GET['order']) {
                    case 'count':
                        $query->set('meta_key', 'used_count');
                        $query->set('orderby', 'meta_value_num');
                        $query->set('order', 'DESC');
                        break;
                    case 'name':
                        $query->set('orderby', 'title');
                        $query->set('order', 'ASC');
                        break;
                }
            }
        }
    }
}

function the_post_meta($post_id, $key)
{
    echo get_post_meta($post_id, $key, true);
}

function the_post_list($list)
{
    $list = array_filter(array_unique($list));
    sort($list);
    foreach ($list as &$theme) {
        $theme = get_post($theme);
        $theme = sprintf('<a href="%s">%s</a>', esc_url(get_permalink($theme)), get_the_title($theme));
    }
    echo implode(' , ', $list);
}
