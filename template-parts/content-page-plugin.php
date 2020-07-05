<?php
$url_query = [];
$query_arg = [
    'taxonomy' => get_post_field('post_name'),
    'hide_empty' => true,
    'meta_query' => [
        [
            'key' => 'at_org',
            'value' => '1'
        ],
    ],
    'orderby' => 'count',
    'order' => 'DESC'
];

if (isset($_GET['order'])) {
    if ($_GET['order'] == 'count') {
        $url_query['order'] = 'count';
        $query_arg['orderby'] = 'count';
        $query_arg['order'] = 'DESC';
    }

    if ($_GET['order'] == 'name') {
        $url_query['order'] = 'name';
        $query_arg['orderby'] = 'name';
        $query_arg['order'] = 'ASC';
    }
}


if (isset($_GET['at_org']) && $_GET['at_org']=='all') {
    $url_query['at_org'] = 'all';
    unset($query_arg['meta_query']);
}
$term_query = new WP_Term_Query();
$terms = $term_query->query($query_arg);
?>

<p>
    <?php
    if (isset($url_query['at_org'])) {
        unset($url_query['at_org']);
        echo '<a href="' . esc_url(get_permalink()) . '?' . http_build_query($url_query) .'">隱藏非官網' . get_the_title() . '</a>';
        $url_query['at_org'] = 'all';
    } else {
        $url_query['at_org'] = 'all';
        echo '<a href="' . esc_url(get_permalink()) . '?' . http_build_query($url_query) .'">顯示非官網' . get_the_title() . '</a>';
        unset($url_query['at_org']);
    }
    ?>
</p>
<p>
    <?php
    $url_query['order'] = 'count';
    echo '<a href="' . esc_url(get_permalink()) . '?' . http_build_query($url_query) .'">熱門' . get_the_title() . '先顯示</a>';
    $url_query['order'] = 'name';
    echo ' <a href="' . esc_url(get_permalink()) . '?' . http_build_query($url_query) .'">照名稱順序顯示</a>';
    ?>
</p>

<?php
global $term;
foreach ($terms as $term) {
    get_template_part('template-parts/loop', $term->taxonomy);
}
