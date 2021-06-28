<?php
$query = new WP_Query;
$content_args = [
    's' => get_search_query(),
    'post_status' => 'publish',
    'orderby' => 'none',
    'posts_per_page' => -1,
    'fields' => 'ids'
];
$url_args = [
    'meta_query' => [
        [
            'key' => 'url',
            'value' => get_search_query(),
            'compare' => 'LIKE'
        ]
    ],
    'post_status' => 'publish',
    'orderby' => 'none',
    'posts_per_page' => -1,
    'fields' => 'ids'
];
$real_args = [
    'post_status' => 'publish',
    'orderby' => 'rand',
    'posts_per_page' => -1
];
$show_list = [
    'website' => '網站',
    'plugin' => '外掛',
    'theme' => '佈景主題'
];

get_header();
?>

<main id="site-content">
    <h2>搜尋【<?=get_search_query() ?>】</h2>

    <div class="row">
        <?php
        foreach ($show_list as $type => $name) {
            $content_args['post_type'] = $type;
            $url_args['post_type'] = $type;
            $real_args['post_type'] = $type;

            $ids = array_merge($query->query($content_args), $query->query($url_args));
            $real_args['post__in'] = array_unique($ids);
            if (count($real_args['post__in']) == 0) {
                continue;
            }
            $query->query($real_args);
            if ($query->have_posts()) {
                ?>
        <div class="col">
            <h2>
                <?=$name ?>
            </h2>
            <?php
            while ($query->have_posts()) {
                $query->the_post();

                get_template_part('template-parts/loop/' . $type);
            } ?>
        </div>
        <?php
            }
        }
        ?>
    </div>
</main>

<?php
get_footer();
