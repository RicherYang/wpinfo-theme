<?php
$post_query = new WP_Query();
$term = get_queried_object();
get_header();
?>

<main id="site-content">
    <h2>
        標籤【<?php single_tag_title() ?>】
    </h2>

    <div class="row">
        <div class="col">
            <h2>佈景主題</h2>
            <?php
            $post_query->query([
                'post_type' => 'theme',
                'post_status' => 'publish',
                'tag_id' => $term->term_id,
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'meta_key' => 'used_count',
                'posts_per_page' => -1
            ]);
            while ($post_query->have_posts()) {
                $post_query->the_post();

                get_template_part('template-parts/loop', 'theme');
            }
            ?>
        </div>
        <div class="col">
            <h2>外掛</h2>
            <?php
            $post_query->query([
                'post_type' => 'plugin',
                'post_status' => 'publish',
                'tag_id' => $term->term_id,
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'meta_key' => 'used_count',
                'posts_per_page' => -1
            ]);
            while ($post_query->have_posts()) {
                $post_query->the_post();

                get_template_part('template-parts/loop', 'theme');
            }
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
