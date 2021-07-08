<?php
$url = get_field('url', false);
$total_count = wp_count_posts('theme');
?>

<article <?php post_easy_class(); ?>>
    <header>
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header>

    <div class="entry-content">
        <div class="row">
            <div class="col-9em">上架 WordPress.org</div>
            <div class="col">
                <?php
                if (get_field('at_org')) {
                    echo '<a href="https://tw.wordpress.org/themes/' . get_post_field('post_name', get_the_ID()) . '/" rel="external nofollow noopener" target="_blank">WordPress.org 網頁</a>';
                } else {
                    echo '否';
                }
                ?>
            </div>
        </div>

        <?php if ($url) { ?>
        <div class="row">
            <div class="col-4em">官網</div>
            <div class="col">
                <a href="<?=esc_url($url) ?>" rel="external nofollow ugc noopener" target="_blank"><?=$url ?></a>
            </div>
        </div>
        <?php } ?>

        <?php if (has_tag()) { ?>
        <div class="row">
            <div class="col-4em">標籤</div>
            <div class="col">
                <?php the_tags('', ' , '); ?>
            </div>
        </div>
        <?php } ?>

        <div class="row">
            <div class="col-4em">使用數</div>
            <div class="col">
                <?php echo get_field('used_count'); ?>
                ( <?php echo round(get_field('used_count') / $total_count->publish * 100, 1); ?>% )
            </div>
        </div>

        <div class="row">
            <div class="col-4em">使用網站</div>
            <div class="col">

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
