<div class="block-references">
    <h2 class="block-references__title"><?php echo get_field('references_title') ?></h2>
    <ul class="block-references__list">
        <?php foreach (get_field('references_list') as $item) { ?>
            <li class="block-references__list-item">
                <p class="block-references__list-title"><strong><?php echo $item['title'] ?></strong></p>
                <p class="block-references__list-description"><?php echo $item['description'] ?></p>
                <a
                    href="<?php echo $item['link']['url'] ?>"
                    class="block-references__list-link"
                    <?php if ($item['link']['new_window']) { ?>
                        target="_blank"
                        title="<?php echo $item['link']['url'] ?> - Nouvelle fenêtre"
                    <?php } ?>
                >
                    <?php echo $item['link']['url'] ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>