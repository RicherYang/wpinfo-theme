<?php
$post_ID = get_the_ID();
$url = get_post_meta($post_ID, 'url', true);
$guest_rest = get_post_meta($post_ID, 'rest_url', true);
if (empty($guest_rest)) {
    $guest_rest = false;
} elseif ($guest_rest == 'not_use') {
    $guest_rest = false;
} else {
    $guest_rest = true;
}
?>

<article <?php post_class(); ?>>
    <header>
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <?php the_excerpt() ?>
    </header>

    <footer>
        <ul class="post-meta">
            <li>
                網址：<a href="<?=esc_url($url) ?>" rel="ugc nofollow" target="_blank"><?=$url ?></a>
                <a href="https://richer.tools/query/whois/<?=esc_attr(parse_url($url, PHP_URL_HOST)) ?>" rel="external" target="_blank">網域 WHOIS 資訊</a>
            </li>
            <li>
                佈景主題：<span class="btn-link"><?php the_post_list(get_post_meta($post_ID, 'theme'), ''); ?></span>
            </li>
            <li>
                外掛：<span class="btn-link"><?php the_post_list(get_post_meta($post_ID, 'plugin'), ''); ?></span>
            </li>
            <li>
                支援訪客使用 REST：<?=$guest_rest ? '是': '否' ?>
            </li>
            <li>
                資料更新時間：<?php the_modified_time(get_option('date_format') . ' ' . get_option('time_format')); ?>
            </li>
        </ul>
        <p class="without-manual">
            相關資料為系統自動抓取，並未經過人工處理。
        </p>
    </footer>
</article>
