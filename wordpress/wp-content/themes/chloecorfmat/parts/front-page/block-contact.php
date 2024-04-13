<?php
    $block = get_field('block_contact');
    $title = $block['title'];
    $text = $block['text'];

    $block_links_data = $block['block_links'];
    $links = [];

    foreach ($block_links_data['links'] as $link) {
        $links[] = [
            'text' => $link['text'],
            'url' => $link['url'],
            'clickable_text' => $link['clickable_text'],
            'helped_text' => $link['helped_text']
        ];
    }

    $block_links = [
        'title' => $block_links_data['title'],
        'links' => $links
    ];
?>

<div class="block">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/11_sales.png" alt=""  class="block-meet__asset--1" />
    <div class="block-meet" id="contact">
        <h2><?php echo $title ?></h2>
        <div class="block-meet__content">
            <div class="block-meet__column">
                <?php echo $text ?>

                <form class="form">
                    <p class="form__required-message">Les champs précédés d’une astérisque rouge (<span class="required">*</span>) sont obligatoires.</p>

                    <div class="form__field">
                        <label for="name">Votre nom <span class="required">*</span></label>
                        <input type="text" id="name" name="name" required autocomplete="name" class="form__input"/>
                    </div>
                    <div class="form__field">
                        <label for="email">Votre adresse e-mail <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required autocomplete="email" class="form__input" aria-describedby="email-description"/>
                        <p id="email-description" class="form__input-description">Le format attendu de l'email est moi@example.com.</p>
                    </div>
                    <div class="form__field">
                        <label for="object">Votre objet <span class="required">*</span></label>
                        <select name="object" id="object" required class="form__select">
                            <option value="">--Choisir une option--</option>
                            <option value="meet">Demander un rendez-vous pour un appel découverte</option>
                            <option value="ask">Me poser une question</option>
                            <option value="react">Réagir à une publication sur Internet</option>
                        </select>
                    </div>
                    <div class="form__field">
                        <label for="message">Votre message <span class="required">*</span></label>
                        <textarea name="message" id="message" cols="30" rows="10" required class="form__textarea"></textarea>
                    </div>
                    <button type="submit" class="btn btn--submit btn--primary">
                        Envoyer votre message
                        <span class="icon-send-link fa-solid fa-paper-plane fa-xs" aria-hidden="true"></span>
                    </button>
                </form>
            </div>
            <div class="block-meet__column">
                <h3 class="block-meet__contact-title"><?php echo $block_links['title'] ?></h3>
                <ul class="block-meet__contact-list">
                    <?php foreach ($block_links['links'] as $link) { ?>
                        <li class="block-meet__contact-list-item">
                            <strong><?php echo $link['text'] ?> : </strong>
                            <a href="<?php echo $link['url'] ?>" class="block-meet__contact-list-link"><?php echo $link['clickable_text'] ?></a>
                            <?php if (!empty($link['helped_text'])) { ?>
                                <p class="block-meet__contact-list-info"><?php echo $link['helped_text'] ?></p>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>

                <?php $block_social_media = $block['social_media']; ?>
                <h3 class="block-meet__contact-title"><?php echo $block_social_media['title'] ?></h3>

                <?php
                require_once(get_template_directory().'/walkers/Walker_Home_Social_Menu.php');
                wp_nav_menu( array(
                    'theme_location' => 'social',
                    'container' => 'ul',
                    'menu_class' => 'block-meet__social-list',
                    'walker' => new Walker_Home_Social_Menu()
                ) ); ?>
            </div>
        </div>
    </div>

    <img src="<?php echo get_template_directory_uri(); ?>/assets/12_sales.png" alt=""  class="block-meet__asset--2" />
</div>