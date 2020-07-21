<?php
wp_enqueue_script('wpi-add');
?>

<article <?php post_class(); ?>>
    <fieldset id="add_form">
        <label for="url">WordPress 網址</label>
        <div class="input-box">
            <div class="input-box">https://</div>
            <input type="text" class="input" name="url" id="url" required>
        </div>
        <button type="button" id="add_url">提交網站</button>
        <p class="getting url-info d-none">系統抓取資訊中，請耐心等待！</p>
        <p class="confirming url-info d-none">系系統無法自動辨識是否為 WordPress 架設的網站，需等待管理人員人工判定！</p>
        <p class="error_url url-info d-none">錯誤的網址！</p>
        <?php wp_nonce_field('wp_rest', '_wpnonce', false) ?>
    </fieldset>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>
</article>
