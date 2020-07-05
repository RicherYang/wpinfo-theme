<article <?php post_class(); ?>>
    <header>
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <ul class="post-meta">
            <li>
                網址：<a href="<?=esc_url(get_field('url')) ?>" rel="ugc nofollow" target="_blank"><?php the_field('url'); ?></a>
                <a href="https://richer.tools/query/whois/<?=esc_attr(substr(get_field('url'), 8)) ?>" target="_blank">WHOIS 資訊</a>
            </li>
            <li>
                佈景主題：<?php the_terms(get_the_ID(), 'theme', '', ' , '); ?>
            </li>
            <li>
                外掛：<?php the_terms(get_the_ID(), 'plugin', '', ' , '); ?>
            </li>
            <li>
                支援訪客使用 REST：<?=empty(get_field('rest_url')) ? '否' : '是'; ?>
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
