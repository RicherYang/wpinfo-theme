<?php
$post_query = new WP_Query();
get_header();
?>

<main id="site-content">
    <div class="row">
        <div class="col">
            <h2>新網站</h2>
            <?php
            $post_query->query([
                'post_type' => 'website',
                'post_status' => 'publish',
                'posts_per_page' => get_option('posts_per_page')
            ]);
            while ($post_query->have_posts()) {
                $post_query->the_post();

                get_template_part('template-parts/loop/website');
            }
            ?>
        </div>

        <div class="col">
            <h2>熱門佈景主題</h2>
            <?php
            $post_query->query([
                'post_type' => 'theme',
                'post_status' => 'publish',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'meta_key' => 'used_count',
                'posts_per_page' => get_option('posts_per_page')
            ]);
            while ($post_query->have_posts()) {
                $post_query->the_post();

                get_template_part('template-parts/loop/theme');
            }
            ?>
        </div>

        <div class="col">
            <h2>熱門外掛</h2>
            <?php
            $post_query->query([
                'post_type' => 'plugin',
                'post_status' => 'publish',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'meta_key' => 'used_count',
                'posts_per_page' => get_option('posts_per_page')
            ]);
            while ($post_query->have_posts()) {
                $post_query->the_post();

                get_template_part('template-parts/loop/plugin');
            }
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
