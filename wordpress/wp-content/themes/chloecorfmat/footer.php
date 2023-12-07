    <?php wp_nav_menu( array(
        'theme_location' => 'social',
        'container' => 'ul',
        'menu_class' => 'header__menu-social--footer'
    ) ); ?>

    <footer role="contentinfo" class="footer">
        <div class="footer__container">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/logo_cream.png" alt="Logo" class="footer__logo">

            <?php
            require_once('classes/Walker_Footer_List.php');
            wp_nav_menu( array(
                'theme_location' => 'legal',
                'container' => 'ul',
                'menu_class' => 'footer__list',
                'walker' => new Walker_Footer_List()
            ) ); ?>

            <?php
            require_once('classes/Walker_Footer_List.php');
            wp_nav_menu( array(
                'theme_location' => 'references',
                'container' => 'ul',
                'menu_class' => 'footer__list',
                'walker' => new Walker_Footer_List()
            ) ); ?>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>