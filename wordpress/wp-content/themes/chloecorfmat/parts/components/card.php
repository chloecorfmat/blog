<?php

use dto\CardDto;

/** @var CardDto $card */
$card = $args['card'];

?>

<li class="cards-item cards-item--foldable">
    <img src="<?php echo $card->image ?>" alt="" class="cards-item__image"/>
    <div class="cards-item__content cards-item__content--fold">
        <h3 class="cards-item__title"><?php echo $card->title ?></h3>
        <div class="wysiwyg">
            <?php echo $card->text ?>
        </div>
    </div>
    <?php if (isset($card->details)) { ?>
    <div class="cards-item__content cards-item__content--unfold" aria-hidden="true">
        <div class="wysiwyg">
            <?php echo $card->details ?>
        </div>
    </div>
    <?php } ?>
</li>