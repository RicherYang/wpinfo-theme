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
        list($key_orderby, $key_order) = explode('_', $key);
        $active = $get_orderby == $key_orderby;

        $url_order = $active ? ($get_order == 'd' ? '_a' : '_d') : '_' . $key_order;
        $name_orderby = $active ? $get_order : $key_order;
        printf(
            '<a href="%1$s" class="%2$s">%3$s</a>',
            esc_url(add_query_arg(['orderby' => $key_orderby . $url_order], $basic_url)),
            $active ? 'active' : '',
            $name . ' ' . ($name_orderby == 'd' ? '↑' : '↓')
        );
    }
}
