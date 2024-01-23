<div class="gutenberg__block block-text">
    <?php if (!empty(get_field('gut_text_title'))) { ?>
        <h2 class="gutenberg__title"><?php echo get_field('gut_text_title'); ?></h2>
    <?php } ?>

    <div class="gutenberg__wysiwyg wysiwyg">
        <?php the_field( 'gut_text_content' ); ?>
    </div>
</div>