<?php get_header(); ?>

<main id="site-content">
    <?php
    if (is_post_type_archive()) {
        get_template_part('template-parts/header', get_post_type());
    }
    ?>

    <div class="masonry">
        <?php
        while (have_posts()) {
            the_post();

            get_template_part('template-parts/loop', get_post_type());
        }
        ?>
    </div>

    <?php get_template_part('template-parts/pagination'); ?>
</main>

<?php
get_footer();
