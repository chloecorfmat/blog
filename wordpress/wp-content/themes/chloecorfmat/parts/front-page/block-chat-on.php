<?php
    require_once(get_template_directory().'/services/ButtonService.php');
    use services\ButtonService;

    $block = get_field('block_chat_on');
    $title = $block['title'];
    $text = $block['text'];

    $buttonService = new ButtonService();
    $buttons = [];
    foreach ($block['buttons'] as $buttonConfig) {
        $buttons[] = $buttonService->buildButton($buttonConfig);
    }
?>

<div class="block-chat-on">
    <div class="block-chat-on__container" id="chat-on">
        <h2><?php echo $title ?></h2>
        <div class="block-chat-on__content">
            <div class="block-chat-on__text">
                <div class="wysiwyg">
                    <?php echo $text ?>
                </div>
                <div class="btns-container btns-container--centered">
                    <?php foreach ($buttons as $button) {
                        get_template_part('parts/components/button', args: ['button' => $button]);
                    } ?>
                </div>
            </div>
            <div  class="block-chat-on__images">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/illustrations/illustration-chat-on_640x320.png" alt=""   class="block-chat-on__images-item"/>
            </div>
        </div>
    </div>

</div>