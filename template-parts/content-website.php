<?php
$url = get_field('url', false);
$whois_url = parse_url($url, PHP_URL_HOST);
if (strpos($whois_url, 'www.') === 0) {
    $whois_url = substr($whois_url, 4);
}
?>

<article <?php post_easy_class(); ?>>
    <header>
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header>

    <div class="entry-content">
        <?php the_excerpt() ?>

        <div class="row">
            <div class="col-4em">網址</div>
            <div class="col">
                <a href="<?=esc_url($url) ?>" rel="external nofollow ugc noopener" target="_blank"><?=$url ?></a>
                <a href="https://richer.tools/query/whois/<?=esc_attr($whois_url) ?>" rel="external noopener" target="_blank">WHOIS 資訊</a>
            </div>
        </div>
        <div class="row">
            <div class="col-4em btn-link-label">外掛</div>
            <div class="col">
                <?php the_post_list(get_field('plugins')); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-4em btn-link-label">佈景主題</div>
            <div class="col">
                <?php the_post_list(get_field('themes')); ?>
            </div>
        </div>
    </div>

    <footer>
        <ul class="post-meta">
            <li>
                資料更新時間 <?php the_modified_time(get_option('date_format') . ' ' . get_option('time_format')); ?>
            </li>
        </ul>
        <p class="without-manual">
            相關資料為系統自動抓取，並未經過人工處理。
        </p>
    </footer>
</article>
