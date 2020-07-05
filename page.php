<?php get_header(); ?>

<main id="site-content">
    <?php
    if (have_posts()) {
        the_post();

        get_template_part('template-parts/content-page', get_post_field('post_name'));
    }
    ?>
</main>

<?php
get_footer();
