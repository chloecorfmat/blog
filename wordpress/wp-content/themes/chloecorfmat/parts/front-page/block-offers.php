<?php
    require_once(get_template_directory().'/services/CardService.php');
    use services\CardService;

    $block = get_field('block_offers');
    $title = $block['title'];
    $text = $block['text'];

    $cardService = new CardService();
    $cards = [];
    foreach ($block['cards'] as $cardConfig) {
        $cards[] = $cardService->buildCard($cardConfig);
    }
?>

<div class="block">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/07_sales.png" alt="" class="block-offers__asset--1" />

    <div class="block-offers" id="offres">
        <h2><?php echo $title ?></h2>
        <div class="block-offers__infos wysiwyg">
            <p><?php echo $text ?></p>
        </div>
        <div class="switcher">
            <button class="switcher__item switcher__item--active" data-foldable="true">Je ne maîtrise pas trop</button>
            <button class="switcher__item" data-foldable="false">Je veux des détails</button>
        </div>
        <ul class="cards-list" id="cards-list--offers">
            <?php
                foreach ($cards as $card) {
                    get_template_part('parts/components/card', args: ['card' => $card]);
                }
            ?>
        </ul>
    </div>

    <img src="<?php echo get_template_directory_uri(); ?>/assets/08_sales.png" alt="" class="block-offers__asset--2" />
</div>