<?php $basic_url = get_post_type_archive_link(get_post_type()); ?>

<h2>
    <?php post_type_archive_title() ?>
</h2>

<p class="order-list">
    排序：
    <a href="<?=esc_url(add_query_arg(['order' => 'create'], $basic_url)) ?>">建立時間</a>
    <a href="<?=esc_url(add_query_arg(['order' => 'update'], $basic_url)) ?>">更新時間</a>
    <a href="<?=esc_url(add_query_arg(['order' => 'name'], $basic_url)) ?>">名稱</a>
</p>
