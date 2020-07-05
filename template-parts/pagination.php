<?php

$posts_pagination = get_the_posts_pagination();
if ($posts_pagination) { ?>

<div class="pagination">
    <?php echo $posts_pagination; ?>
</div>

<?php
}
