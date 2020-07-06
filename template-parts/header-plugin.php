<p>
    排序：
    <select id="order" data-url="<?=esc_url(get_post_type_archive_link(get_post_type())) ?>">
        <option value="count" <?php selected($_GET['order'], 'count'); ?>>使用網站數</option>
        <option value="name" <?php selected($_GET['order'], 'name'); ?>>名稱</option>
    </select>
</p>
