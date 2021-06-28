<?php
global $wp_query;
$post_types = array_column($wp_query->posts, 'post_type');
$post_types = array_count_values($post_types);

get_header();
?>

<main id="site-content">
    <h2>
        標籤【<?php single_tag_title() ?>】
    </h2>

    <div class="row">
        <?php if (isset($post_types['theme'])) { ?>
        <div class="col">
            <h2>佈景主題</h2>
            <?php
            while (have_posts()) {
                the_post();

                if (get_post_type() == 'theme') {
                    get_template_part('template-parts/loop/theme');
                }
            }
            ?>
        </div>
        <?php } ?>

        <?php if (isset($post_types['plugin'])) { ?>
        <div class="col">
            <h2>外掛</h2>
            <?php
            while (have_posts()) {
                the_post();

                if (get_post_type() == 'plugin') {
                    get_template_part('template-parts/loop/plugin');
                }
            }
            ?>
        </div>
        <?php } ?>
    </div>
</main>

<?php
get_footer();
