<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header id="site-header">
        <?php
        if (has_nav_menu('primary')) {
            wp_nav_menu([
                'container_id' => 'header-menu',
                'theme_location' => 'primary'
            ]);
        }
        get_search_form();
        ?>
    </header>
