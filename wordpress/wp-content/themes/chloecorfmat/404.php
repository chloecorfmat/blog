<?php get_header(); ?>
    <main role="main" tabindex="0" class="error">
        <div class="error__content">
            <h1 class="error__title">La page que vous cherchez <span class="highlighted">n'existe pas</span></h1>
            <p class="error__subtitle">Erreur technique 404</p>

            <div class="error__navigation">
                <p>Pour poursuivre votre navigation, vous pouvez retourner sur l'accueil.</p>
                <a href="/" target="_self" class="btn btn--primary">Retourner à l'accueil <span class="icon-internal-link fa-solid fa-chevron-right fa-xs" aria-hidden="true"></span></a>
                <img class="error__navigation-img" src="<?php echo (get_template_directory_uri() . '/assets/shine-woman-in-violet-jumper-and-man-in-green-jumper-with-khaki-backpack-hiking_500x375.png' ); ?>" alt="" />
            </div>
        </div>
    </main>

<?php get_footer(); ?>