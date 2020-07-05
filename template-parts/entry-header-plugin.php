<?php
$term = get_queried_object();
$at_org = get_field('at_org', $term);
$url = get_field('url', $term);
?>

<header class="archive-header">
    <h1 class="archive-title">
        <?=get_the_archive_title(); ?>
    </h1>
    <ul class="post-meta">
        <li>
            上架至 WordPress.org：
            <?php
        if ($at_org) {
            echo '<a href="https://tw.wordpress.org/' . $term->taxonomy . 's/' . $term->slug . '/" rel="external" target="_blank">WordPress.org 網頁</a>';
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
            最新版本：<?php the_field('version', $term); ?>
        </li>
        <li>
            目前使用的網站數：<?=$term->count ?>
        </li>
        <li>
            資料更新時間：<?php the_field('update', $term); ?>
        </li>
    </ul>
</header>

<h2>相關網站</h2>
