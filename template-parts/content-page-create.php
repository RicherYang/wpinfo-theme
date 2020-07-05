<?php wp_enqueue_script('wpi-create-script'); ?>

<article <?php post_class(); ?>>
    <fieldset id="create_form">
        <label for="url">WordPress 網址</label>
        <div class="input-box">
            <div class="input-box-prev">https://</div>
            <input type="text" class="input" name="url" id="url">
        </div>
        <button type="button" id="add_url">提交網站</button>

        <p class="confirming url-info d-none">系統抓取資訊中，請耐心等待！</p>
        <p class="error_url url-info d-none">錯誤的網址！</p>
    </fieldset>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>
</article>
