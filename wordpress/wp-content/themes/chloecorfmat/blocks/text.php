<div class="gutenberg__block block-text">
    <?php if (!empty(get_field('title'))) { ?>
        <h2 class="gutenberg__title"><?php echo get_field('title'); ?></h2>
    <?php } ?>

    <div class="gutenberg__wysiwyg wysiwyg">
        <?php the_field( 'content' ); ?>
    </div>
</div>