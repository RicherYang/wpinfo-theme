<?php

function the_post_meta($post_id, $key)
{
    echo get_post_meta($post_id, $key, true);
}

function the_post_list($list, $glue = ', ')
{
    $show_list = [];
    $list = array_filter(array_unique($list));
    foreach ($list as $post_id) {
        $post = get_post($post_id);
        $show_list[strtolower(get_the_title($post))] = sprintf('<a href="%s">%s</a>', esc_url(get_permalink($post)), get_the_title($post));
    }
    ksort($show_list, SORT_STRING);

    echo implode($glue, $show_list);
}

function the_orderby_list($basic_url, $order_list)
{
    list($get_orderby, $get_order) = explode('_', $_GET['orderby']);

    foreach ($order_list as $key => $name) {
        $active = $get_orderby == $key;

        $url_order = $active ? ($get_order == 'd' ? '_a' : '_d') : '_d';
        printf(
            '<a href="%1$s" class="%2$s">%3$s</a>',
            esc_url(add_query_arg(['orderby' => $key . $url_order], $basic_url)),
            $active ? 'active ' . ($get_order == 'd' ? 'order-desc' : 'order-asc') : '',
            $name
        );
    }
}
