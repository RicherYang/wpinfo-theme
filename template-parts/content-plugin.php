<?php
$post_ID = get_the_ID();
$at_org = get_post_meta($post_ID, 'at_org', true);
$url = get_post_meta($post_ID, 'url', true);
?>

<article <?php post_class(); ?>>
    <header>
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <ul class="post-meta">
            <li>
                上架至 WordPress.org：
                <?php
                if ($at_org) {
                    echo '<a href="https://tw.wordpress.org/' . get_post_type() . 's/' . get_post_field('post_name', $post_ID) . '/" rel="external" target="_blank">WordPress.org 網頁</a>';
                } else {
                    echo '否';
                }
                ?>
            </li>
            <li>
                官網：
                <?php
                if ($url) {
                    echo '<a href="' . esc_url($url) . '" rel="external nofollow" target="_blank">' . $url . '</a>';
                }
                ?>
            </li>
            <li>
                最新版本：<?php the_post_meta($post_ID, 'version'); ?>
            </li>
            <li>
                使用網站數：<?php the_post_meta($post_ID, 'used_count'); ?>
            </li>
        </ul>
    </header>

    <footer>
        <p>
            資料更新時間：<?php the_modified_time(get_option('date_format') . ' ' . get_option('time_format')); ?>
        </p>
        <p class="without-manual">
            相關資料為系統自動抓取，並未經過人工處理。
        </p>
    </footer>
</article>

<h2>相關網站</h2>
<div class="over-link-website">
    <?php
    $post_query = new WP_Query();
    $post_query->query([
        'post_type' => 'website',
        'post_status' => 'publish',
        'meta_key' => get_post_type(),
        'meta_value' => $post_ID,
        'orderby' => 'modified',
        'order' => 'DESC',
        'posts_per_page' => '-1'
    ]);
    while ($post_query->have_posts()) {
        $post_query->the_post();

        get_template_part('template-parts/loop', 'website');
    }
    ?>
</div>