<?php
$post_query = new WP_Query();
$term_query = new WP_Term_Query();
get_header();
?>

<main id="site-content">
    <div class="over-home">
        <div class="new-site">
            <h2>新網站</h2>
            <?php
            $post_query->query([
                'post_type' => 'site',
                'post_status' => 'publish',
                'posts_per_page' => get_option('posts_per_page')
            ]);
            while ($post_query->have_posts()) {
                $post_query->the_post();

                get_template_part('template-parts/loop', 'site');
            }
            ?>
        </div>
        <div class="popular-theme">
            <h2>熱門佈景主題</h2>
            <?php
            $terms = $term_query->query([
                'taxonomy' => 'theme',
                'hide_empty' => true,
                'meta_query' => [
                    [
                        'key' => 'at_org',
                        'value' => '1'
                    ],
                ],
                'orderby' => 'count',
                'order' => 'DESC',
                'number' => get_option('posts_per_page')
            ]);
            foreach ($terms as $term) {
                get_template_part('template-parts/loop', 'theme');
            }
            ?>
        </div>
        <div class="popular-plugin">
            <h2>熱門外掛</h2>
            <?php
            $terms = $term_query->query([
                'taxonomy' => 'plugin',
                'hide_empty' => true,
                'meta_query' => [
                    [
                        'key' => 'at_org',
                        'value' => '1'
                    ],
                ],
                'orderby' => 'count',
                'order' => 'DESC',
                'number' => get_option('posts_per_page')
            ]);
            foreach ($terms as $term) {
                get_template_part('template-parts/loop', 'plugin');
            }
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
