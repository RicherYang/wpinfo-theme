<?php
$url = get_field('url', false);
$post_type = get_post_type();
$total_count = wp_count_posts($post_type);
?>

<article <?php post_class(); ?>>
    <header>
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header>

    <div class="entry-content">
        <div class="row">
            <div class="col-9em">上架 WordPress.org</div>
            <div class="col">
                <?php
                if (get_field('at_org')) {
                    echo '<a href="https://tw.wordpress.org/' . $post_type . 's/' . get_post_field('post_name', get_the_ID()) . '/" rel="external nofollow noopener" target="_blank">WordPress.org 網頁</a>';
                } else {
                    echo '否';
                }
                ?>
            </div>
        </div>

        <?php if ($url) { ?>
        <div class="row">
            <div class="col-2em">官網</div>
            <div class="col">
                <a href="<?=esc_url($url) ?>" rel="external nofollow ugc noopener" target="_blank"><?=$url ?></a>
            </div>
        </div>
        <?php } ?>

        <?php if (has_tag()) { ?>
        <div class="row">
            <div class="col-2em">標籤</div>
            <div class="col">
                <?php the_tags('', ' , '); ?>
            </div>
        </div>
        <?php } ?>
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
