<?php

    use dto\ButtonDto;

    /** @var ButtonDto $button */
    $button = $args['button'];
?>

<div class="btn-container">
    <a
        href="<?php echo $button->url ?>"
        class="<?php echo $button->classes ?>"
        target="<?php echo $button->target ?>"
        <?php if (!empty($button->title)) { ?> title="<?php echo $button->title ?>" <?php } ?>
    >
        <?php echo $button->text ?>
        <span class="icon-internal-link fa-xs <?php echo $button->icon ?>" aria-hidden="true"></span>
    </a>
    <?php if (!is_null($button->data)) { ?>
        <p class="btn-data"><?php echo $button->data ?></p>
    <?php } ?>
</div>