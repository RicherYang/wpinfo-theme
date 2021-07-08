<?php
function the_post_meta($post_id, $key)
{
    echo get_post_meta($post_id, $key, true);
}

function the_post_list($list)
{
    if (!is_array($list)) {
        return ;
    }

    echo '<div class="row">';
    $show_list = [];
    foreach ($list as $post) {
        echo '<div class="col-auto">'
            . sprintf('<a class="btn-link" href="%s">%s</a>', esc_url(get_permalink($post)), get_the_title($post))
            . '</div>';
    }
    ksort($show_list, SORT_STRING);

    echo '</div>';
}

function the_orderby_list($basic_url, $order_list)
{
    list($get_orderby, $get_order) = explode('_', $_GET['orderby']);

    foreach ($order_list as $key => $name) {
        $active = $get_orderby == $key;

        if ($active) {
            $url_order = $get_order == 'd' ? '_a' : '_d';
            $name .= ($get_order == 'd' ? '<i class="fas fa-sort-down"></i>' : '<i class="fas fa-sort-up"></i>');
        } else {
            $url_order = '_d';
            $name .= '<i class="fas fa-sort"></i>';
        }
        printf(
            '<a href="%1$s" class="%2$s">%3$s</a>',
            esc_url(add_query_arg(['orderby' => $key . $url_order], $basic_url)),
            $active ? 'active ' : '',
            $name
        );
    }
}

function post_easy_class($class = '', $post_id = null)
{
    echo 'class="' . esc_attr(implode(' ', get_post_easy_class($class, $post_id))) . '"';
}


function get_post_easy_class($class = '', $post_id = null)
{
    $post = get_post($post_id);

    $classes = array();

    if ($class) {
        if (! is_array($class)) {
            $class = preg_split('#\s+#', $class);
        }
        $classes = array_map('esc_attr', $class);
    } else {
        $class = array();
    }

    if (! $post) {
        return $classes;
    }

    $classes[] = 'post-' . $post->ID;
    if (! is_admin()) {
        $classes[] = $post->post_type;
    }
    $classes[] = 'type-' . $post->post_type;
    $classes[] = 'status-' . $post->post_status;

    // Post Format.
    if (post_type_supports($post->post_type, 'post-formats')) {
        $post_format = get_post_format($post->ID);
        if ($post_format && ! is_wp_error($post_format)) {
            $classes[] = 'format-' . sanitize_html_class($post_format);
        } else {
            $classes[] = 'format-standard';
        }
    }

    // Post thumbnails.
    if (current_theme_supports('post-thumbnails') && has_post_thumbnail($post->ID) && ! is_attachment($post) && ! $post_password_required) {
        $classes[] = 'has-post-thumbnail';
    }

    // Sticky for Sticky Posts.
    if (is_sticky($post->ID)) {
        if (is_home() && ! is_paged()) {
            $classes[] = 'sticky';
        } elseif (is_admin()) {
            $classes[] = 'status-sticky';
        }
    }

    $classes[] = 'hentry';

    $classes = array_map('esc_attr', $classes);
    $classes = apply_filters('post_class', $classes, $class, $post->ID);

    return array_unique($classes);
}
