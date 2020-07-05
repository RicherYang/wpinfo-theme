<?php
global $term;
?>

<article>
    <h2 class="entry-title"><a href="<?=esc_url(get_term_link($term)) ?>"><?=$term->name ?></a></h2>
    <p>
        目前使用的網站數：<?=$term->count ?>
    </p>
</article>
