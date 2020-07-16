<h2>
    <?php post_type_archive_title() ?>
</h2>

<p>
    排序：
    <select id="order" data-url="<?=esc_url(get_post_type_archive_link(get_post_type())) ?>">
        <option value="create" <?php selected($_GET['order'], 'create'); ?>>建立時間</option>
        <option value="update" <?php selected($_GET['order'], 'update'); ?>>更新時間</option>
        <option value="name" <?php selected($_GET['order'], 'name'); ?>>名稱</option>
    </select>
</p>
