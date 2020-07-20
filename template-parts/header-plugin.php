<?php $basic_url = get_post_type_archive_link(get_post_type()); ?>

<h2>
    <?php post_type_archive_title() ?>
</h2>

<p>
    排序：
    <a href="<?=esc_url(add_query_arg(['order' => 'count'], $basic_url)) ?>">使用網站數</a>
    <a href="<?=esc_url(add_query_arg(['order' => 'name'], $basic_url)) ?>">名稱</a>
</p>
