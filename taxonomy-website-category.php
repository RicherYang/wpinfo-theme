<?php

get_header();
?>

<main id="site-content">
    <h2>
        網站分類【<?php single_tag_title() ?>】
    </h2>

    <h2>網站</h2>
    <?php
    while (have_posts()) {
        the_post();

        get_template_part('template-parts/loop', get_post_type());
    }
    ?>
</main>

<?php
get_footer();
