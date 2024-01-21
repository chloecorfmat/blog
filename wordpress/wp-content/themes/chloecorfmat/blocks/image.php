<div class="gutenberg__block block-image">
    <?php if (!empty(get_field('title'))) { ?>
        <h2 class="gutenberg__title"><?php echo get_field('title'); ?></h2>
    <?php } ?>

    <?php $image = get_field('image')[0]; // list-articles__item-image?>
    <img src="<?php echo esc_url( $image['sizes']['medium_large'] ) ?>" alt="" class="gutenberg__image"/>
</div>