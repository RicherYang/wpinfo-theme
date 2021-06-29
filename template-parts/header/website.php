<?php $basic_url = get_post_type_archive_link(get_post_type()); ?>

<h2>
    <?php post_type_archive_title() ?>
</h2>

<p class="order-list">
    排序：
    <?php the_orderby_list($basic_url, [
        'name' => '名稱',
        'update' => '更新時間',
        'create' => '建立時間'
    ]); ?>
</p>
