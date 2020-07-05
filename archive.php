<?php
$term = get_queried_object();

get_header();
?>

<main id="site-content">
    <?php
    if (is_tax()) {
        get_template_part('template-parts/entry-header', $term->taxonomy);
    }

    if (have_posts()) {
        while (have_posts()) {
            the_post();

            get_template_part('template-parts/loop', get_post_type());
        }
    }
    ?>

    <?php get_template_part('template-parts/pagination'); ?>
</main>

<?php
get_footer();
