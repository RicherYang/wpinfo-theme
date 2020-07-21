<form role="search" method="get" class="search-form" action="<?=esc_url(home_url('/')) ?>">
    <div class="input-box">
        <input type="search" class="search-field input" placeholder="搜尋..." value="<?=get_search_query() ?>" name="s" />
        <button type="submit" class="search-submit input-box">搜尋</button>
    </div>
</form>
