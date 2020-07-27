<article <?php post_class(); ?>>
    <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>
    <?php the_excerpt() ?>
</article>
