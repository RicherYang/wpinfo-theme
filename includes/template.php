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
