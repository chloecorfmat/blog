<?php
$subtitle = get_field('block_cta_surtitle', 'option');
$title = get_field('block_cta_title', 'option');
$content = get_field('block_cta_content', 'option');
$btn = get_field('block_cta_btn', 'option');

if (is_single()) {
    $subtitle = get_field('block_cta_surtitle');
    $title = get_field('block_cta_title');
    $content = get_field('block_cta_content');
    $btn = get_field('block_cta_btn');
}

if (is_archive()) {
    $term = get_queried_object();
    $subtitle = get_field('block_cta_surtitle', $term);
    $title = get_field('block_cta_title', $term);
    $content = get_field('block_cta_content', $term);
    $btn = get_field('block_cta_btn', $term);
}

$btn_url = $btn['text'];
$btn_new_window = $btn['new_window'];
$btn_text = $btn['text'];
$btn_icon = $btn['icon'];


?>

<div class="block-sales__container">
    <div class="block-sales" id="block-sales">
        <?php if (!empty($subtitle)) { ?>
            <p class="block__subtitle"><?php echo $subtitle ?></p>
        <?php } ?>
        <h2><?php echo $title ?></h2>
        <div>
            <?php echo $content ?>
        </div>
        <div class="btns-container--centered">
            <a
                href="<?php echo $btn_url ?>"
                class="btn btn--primary"
                <?php if ($btn_new_window) { ?>
                    target="_blank"
                    title="<?php echo $btn_text  ?> - Nouvelle fenêtre"
                <?php } ?>
            >
                <?php if (!empty($btn_icon)) { ?>
                    <span class="<?php echo $btn_icon ?>" aria-hidden="true"></span>
                <?php } ?>
                <?php echo $btn_text ?>
            </a>
        </div>
    </div>
</div>