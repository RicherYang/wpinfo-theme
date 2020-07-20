<?php
wp_enqueue_script('amp-form');
wp_enqueue_script('amp-mustache');
?>

<article <?php post_class(); ?>>
    <form method="post" action-xhr="<?=esc_url(rest_url('wpi/v1/site/check_url')) ?>" target="_top">
        <label for="url">WordPress 網址</label>
        <div class="input-box">
            <div class="input-box-prev">https://</div>
            <input type="text" class="input" name="url" id="url" required>
        </div>
        <button type="submit">提交網站</button>
        <div submitting>
            系統抓取資訊中，請耐心等待！
        </div>
        <div submit-success>
            <template type="amp-mustache">
                {{#info}}
                系統無法自動辨識是否為 WordPress 架設的網站，需等待管理人員人工判定！
                {{/info}}
            </template>
        </div>
        <div submit-error>
            錯誤的網址！
        </div>
        <?php wp_nonce_field('wp_rest', '_wpnonce', false) ?>
    </form>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>
</article>
