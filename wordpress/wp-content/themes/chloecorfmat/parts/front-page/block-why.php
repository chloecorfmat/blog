<?php
    require_once(get_template_directory().'/services/CardService.php');
    use services\CardService;

    $block = get_field('block_why');
    $title = $block['title'];

    $cardService = new CardService();
    $cards = [];
    foreach ($block['cards'] as $cardConfig) {
        $cards[] = $cardService->buildCard($cardConfig);
    }
?>

<div class="block">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/03_sales.png" alt="" class="block-why__asset--1" />

    <div class="block-why" id="pourquoi">
        <?php $block = get_field('block_why'); ?>
        <!--<h2>Pourquoi un <span class="highlighted">site web</span> ?</h2>-->
        <h2><?php echo $title ?></h2>
        <ul class="cards-list">
            <?php
                foreach ($cards as $card) {
                    get_template_part('parts/components/card', args: ['card' => $card]);
                }
            ?>
        </ul>
    </div>

    <img src="<?php echo get_template_directory_uri(); ?>/assets/04_sales.png" alt="" class="block-why__asset--2"/>
</div>