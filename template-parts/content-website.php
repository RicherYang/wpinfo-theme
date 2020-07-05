<?php
$post_ID = get_the_ID();
$url = get_post_meta($post_ID, 'url', true);
?>

<article <?php post_class(); ?>>
    <header>
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <ul class="post-meta">
            <li>
                網址：<a href="<?=esc_url($url) ?>" rel="ugc nofollow" target="_blank"><?=$url ?></a>
                <a href="https://richer.tools/query/whois/<?=esc_attr(substr($url, 8)) ?>" rel="external" target="_blank">WHOIS 資訊</a>
            </li>
            <li>
                佈景主題：<?php the_post_list(get_post_meta($post_ID, 'theme')); ?>
            </li>
            <li>
                外掛：<?php the_post_list(get_post_meta($post_ID, 'plugin')); ?>
            </li>
            <li>
                支援訪客使用 REST：<?=empty(get_post_meta($post_ID, 'rest_url', true)) ? '否' : '是'; ?>
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
