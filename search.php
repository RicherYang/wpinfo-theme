<?php
$query = new WP_Query;
$item_list = [];
$item_list = array_merge($item_list, $query->query([
    's' => get_search_query(),
    'post_type' => ['website', 'plugin', 'theme'],
    'post_status' => 'publish',
    'orderby' => 'none',
    'posts_per_page' => -1,
    'fields' => 'ids'
]));
$item_list = array_merge($item_list, $query->query([
    'meta_query' => [
        [
            'key' => 'url',
            'value' => get_search_query(),
            'compare' => 'LIKE'
        ]
    ],
    'post_type' => ['website', 'plugin', 'theme'],
    'post_status' => 'publish',
    'orderby' => 'none',
    'posts_per_page' => -1,
    'fields' => 'ids'
]));
$item_list = array_unique($item_list);

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
            $query->query([
                'post_type' => $type,
                'post__in' => $item_list,
                'post_status' => 'publish',
                'orderby' => 'rand',
                'posts_per_page' => -1,
            ]);
            if ($query->have_posts()) { ?>
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
