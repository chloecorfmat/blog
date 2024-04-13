<?php
    require_once(get_template_directory().'/services/ButtonService.php');
    use services\ButtonService;

    $block = get_field('block_presentation');
    $title = $block['title'];
    $lines = [];

    $buttonService = new ButtonService();

    foreach($block['lines'] as $line) {
        $buttons = [];
        if ($line['buttons']) {
            foreach ($line['buttons'] as $buttonConfig) {
                $buttons[] = $buttonService->buildButton($buttonConfig);
            }
        }


        $lines[] = [
            'image' => [
                'position' => $line['image_position'],
                'url' => $line['image'][0]['sizes']['2048x2048']
            ],
            'text' => $line['text'],
            'buttons' => $buttons
        ];
    }
?>

<div class="block">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/05_sales.png" alt="" class="block-presentation__asset--1" />

    <div class="block-presentation">
        <h2 class="sr-only"><?php echo $title ?></h2>

        <?php foreach($lines as $line) { ?>
            <div class="block-presentation__row">
                <?php if ($line['image']['position'] == 'left') { ?>
                    <img src="<?php echo $line['image']['url'] ?>" alt=""  class="block-presentation__image"/>
                <?php } ?>

                <div class="block-presentation__content">
                    <div class="wysiwyg">
                        <?php echo $line['text'] ?>
                    </div>
                    <?php if ($line['buttons']) { ?>
                        <div class="btns-container">
                            <?php foreach ($line['buttons'] as $button) {
                                get_template_part('parts/components/button', args: ['button' => $button]);
                            } ?>
                        </div>
                    <?php } ?>
                </div>
                <?php if ($line['image']['position'] == 'right') { ?>
                    <img src="<?php echo $line['image']['url'] ?>" alt=""  class="block-presentation__image"/>
                <?php } ?>
            </div>
        <?php } ?>

    </div>
</div>