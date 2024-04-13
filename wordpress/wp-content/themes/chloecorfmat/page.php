<?php
    $description = get_field('description');
?>

<?php get_header(); ?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
    <main role="main" class="page">
        <div class="page__content">
            <h1><?php the_title(); ?></h1>
            <p class="page__description"><?php echo $description ?></p>
            <?php the_content(); ?>
        </div>
    </main>
<?php endwhile; endif; ?>

<?php get_footer(); ?>