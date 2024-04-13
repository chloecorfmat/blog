<?php get_header(); ?>
<main role="main" id="main" tabindex="0">
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

        <?php get_template_part('parts/front-page/block-hero'); ?>
        <?php get_template_part('parts/front-page/block-why'); ?>
        <?php get_template_part('parts/front-page/block-presentation'); ?>
        <?php get_template_part('parts/front-page/block-offers'); ?>
        <?php get_template_part('parts/front-page/block-chat-on'); ?>
        <?php get_template_part('parts/front-page/block-steps'); ?>
        <?php get_template_part('parts/front-page/block-testimonials'); ?>
        <?php get_template_part('parts/front-page/block-contact'); ?>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>