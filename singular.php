<?php get_header(); ?>

<main id="site-content">
    <?php
    if (have_posts()) {
        the_post();

        get_template_part('template-parts/content', get_post_type());
    }
    ?>
</main>

<?php
get_footer();
