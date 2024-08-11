<div class="gutenberg__block block-callout block-callout--<?php echo(get_field('gut_callout_type')) ?>">
    <span class="block-callout__icon" aria-hidden="true"><?php echo(get_field('gut_callout_emoji')) ?></span>
    <div class="block-callout__wysiwyg wysiwyg">
        <?php the_field( 'gut_callout_content' ); ?>
    </div>

</div>