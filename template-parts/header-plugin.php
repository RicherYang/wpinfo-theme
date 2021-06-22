<?php $basic_url = get_post_type_archive_link(get_post_type()); ?>

<h2>
    <?php post_type_archive_title() ?>
</h2>

<p class="order-list">
    排序：
    <?php the_orderby_list($basic_url, [
        'count' => '使用網站數',
        'name' => '名稱'
    ]); ?>
</p>
