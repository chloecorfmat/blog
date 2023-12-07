<!DOCTYPE html>
<html <?php

language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="header">
    <div class="header-banner">
        <a href="<?php echo home_url( '/' ); ?>" class="header-banner__home">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/logo_text.png" alt="Logo">
        </a>

        <button class="header-banner__burger" id="js--header-burger__button">
            <i class="fa-solid fa-bars fa-2xl header-banner__burger--open-selected" id="js--header-burger__button--open" title="Ouvrir le menu"></i>
            <i class="fa-solid fa-xmark fa-2xl header-banner__burger--close" id="js--header-burger__button--close" title="Fermer le menu"></i>
        </button>

        <nav role="navigation" class="header-nav" id="js--header-nav">
            <?php
            require_once('classes/Walker_Main_Menu.php');
            wp_nav_menu( array(
                'theme_location' => 'main',
                'container' => 'ul',
                'menu_class' => 'header-nav__list',
                'walker' => new Walker_Main_Menu()
            ) ); ?>
        </nav>

        <?php
        require_once('classes/Walker_Social_Menu.php');
        wp_nav_menu( array(
            'theme_location' => 'social',
            'container' => 'ul',
            'menu_class' => 'header-social',
            'menu_id' => 'js--header-social',
            'walker' => new Walker_Social_Menu()
        ) ); ?>
    </div>
</header>

<?php wp_body_open(); ?>