<?php
    require_once(get_template_directory().'/services/CardService.php');
    use services\CardService;

    $block = get_field('block_steps');
    $title = $block['title'];
    $text = $block['text'];

    $cardService = new CardService();
    $cards = [];
    foreach ($block['cards'] as $cardConfig) {
        $cards[] = $cardService->buildCard($cardConfig);
    }
?>

<div class="block">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/09_sales.png" alt="" class="block-steps__asset--1" />

    <div class="block-steps" id="etapes">
        <h2><?php echo $title ?></h2>
        <ol class="cards-list">
            <?php
            foreach ($cards as $card) {
                get_template_part('parts/components/card', args: ['card' => $card]);
            }
            ?>
        </ol>

        <div class="block-steps__infos wysiwyg">
            <?php echo $text ?>
        </div>
    </div>

    <img src="<?php echo get_template_directory_uri(); ?>/assets/10_sales.png" alt="" class="block-steps__asset--2" />
</div>