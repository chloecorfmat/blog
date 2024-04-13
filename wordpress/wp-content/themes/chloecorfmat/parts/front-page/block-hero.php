<?php
    require_once(get_template_directory().'/services/ButtonService.php');
    use services\ButtonService;

    $block = get_field('block_hero');
    $title = $block['title'];
    $text = $block['text'];
    $portrait = $block['portrait'][0]['url'];

    $buttonService = new ButtonService();
    $buttons = [];
    foreach ($block['buttons'] as $buttonConfig) {
        $buttons[] = $buttonService->buildButton($buttonConfig);
    }
?>

<div class="block-hero">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/01_sales.png" alt="" class="block-hero__asset--1" />

    <div class="block-hero__content">
        <div class="block-hero__text">
            <h1 class="block-hero__title"><?php echo $title ?></h1>
            <div class="wysiwyg">
                <?php echo $text ?>
            </div>
            <div class="btns-container btns-container--flex">
                <?php foreach ($buttons as $button) {
                    get_template_part('parts/components/button', args: ['button' => $button]);
                } ?>
            </div>
        </div>

        <img src="<?php echo $portrait; ?>" alt="" class="block-hero__image"/>
    </div>

    <img src="<?php echo get_template_directory_uri(); ?>/assets/02_sales.png" alt="" class="block-hero__asset--2"/>
</div>