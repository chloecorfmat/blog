<?php get_header(); ?>
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
    <main role="main" id="main" tabindex="0" class="without-cover">
        <article class="article--full">

            <div class="article--full__content">
                <header class="article--full__content-header">
                    <nav aria-label="Fil d'ariane" class="breadcrumb">
                        <ol class="breadcrumb-list">
                            <li class="breadcrumb-list__item">
                               Ressources
                            </li>
                            <li class="breadcrumb-list__item">
                                <a href="/alternatives" class="breadcrumb-list__link">Alternatives accessibles</a>
                            </li>
                            <li class="breadcrumb-list__item" aria-current="page">
                                <?php echo get_the_title() ?>
                            </li>
                        </ol>
                    </nav>
                    <a href="#" class="tag">Alternatives accessibles</a>

                    <h1 class="article--full__title"><?php echo get_the_title() ?></h1>
                    <div class="article--full__infos">
                        <ul class="article--full__infos-list">
                            <li  class="article--full__infos-item">
                                <?php
                                $author_id = get_the_author_meta('ID');
                                $author_avatar = get_field('user_avatar', 'user_'. $author_id );
                                ?>
                                <img src="<?php echo esc_url( $author_avatar['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $author_avatar['alt'] ) ?>" class="article--full__infos-picture" />
                                <p class="article--full__infos-text">Écrit par <span class="article--full__infos-link--disabled"><?php the_author(); ?></span></p>
                            </li>
                            <li  class="article--full__infos-item">
                                <i class="fa-regular fa-clock fa-lg article--full__infos-icon" aria-hidden="true"></i>
                                <p class="article--full__infos-text">Publié le <time><?php echo get_field('alternative_date') ?></time></p>
                            </li>
                            <li  class="article--full__infos-item">
                                <i class="fa-solid fa-stopwatch fa-lg article--full__infos-icon" aria-hidden="true"></i>
                                <p class="article--full__infos-text">Lecture <?php echo esc_html(get_field('alternative_reading_time')); ?> min.</p>
                            </li>
                        </ul>
                    </div>
                </header>

                <div class="article--full__body">
                    <div class="article--full__before">
                        <div class="block-references">
                            <h2 class="block-references__title">Fichier</h2>
                            <?php
                                $file = get_field('alternative_file');
                            ?>
                            <ul class="block-references__list">
                                <li class="block-references__list-item">
                                    <p class="block-references__list-title"><strong>Document <?php echo strtoupper($file['subtype']) ?></strong></p>
                                    <?php
                                    $bytes = $file['filesize'];
                                    if ($bytes == 0)
                                        return "0.00 B";

                                    $s = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
                                    $e = floor(log($bytes, 1024));

                                    $result =  round($bytes/pow(1024, $e), 2).' '.$s[$e];
                                    ?>
                                    <a href="<?php echo $file['url'] ?>" class="block-references__list-link"><?php the_title() ?> (<?php echo strtoupper($file['subtype']) ?>, <?php echo $result ?>)</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block-references">
                            <h2 class="block-references__title">Réseaux sociaux</h2>
                            <ul class="block-references__list">
                                <?php
                                    foreach (get_field('alternative_links') as $link) {
                                ?>
                                    <li class="block-references__list-item">
                                        <p class="block-references__list-title"><strong><?php echo $link['alternative_link_plateform'] ?></strong></p>
                                        <p class="block-references__list-description">Lien vers la publication :</p>
                                        <a href="<?php echo $link['alternative_link_url'] ?>" class="block-references__list-link">
                                            <?php echo $link['alternative_link_url'] ?>
                                        </a>
                                    </li>
                                <?php
                                    }
                                ?>

                            </ul>
                        </div>
                    </div>
                    <div class="article--full__wysiwyg">
                        <div class="gutenberg__block block-text">
                            <div class="gutenberg__wysiwyg wysiwyg">
                                <?php echo get_field('alternative_content') ?>
                            </div>
                        </div>

                        <?php
                        $slides = get_field('alternative_carousel')['alternative_carousel_slides'];
                        $first = true;
                        foreach ($slides as $slide) {

                            ?>
                            <div class="gutenberg__block block-image">
                                <?php
                                if ($first) {

                                    ?>
                                    <h2 class="gutenberg__title">Transcription textuelle du carrousel</h2>
                                    <?php
                                }
                                ?>
                                <?php $image = $slide['alternative_slide_image'][0]; ?>
                                <img src="<?php echo esc_url( $image['sizes']['medium_large'] ) ?>" alt="<?php echo $image['alt'] ?>" class="gutenberg__image"/>
                                <div class="gutenberg__wysiwyg wysiwyg">
                                    <?php echo $slide['alternative_slide_content'] ?>
                                </div>
                            </div>
                            <?php
                            $first = false;
                        }
                        ?>
                    </div>
                    <div class="article--full__after"></div>
                </div>

                <footer>
                    <p class="article--full__signature">Chloé Corfmat</p>
                </footer>

                <img src="<?php echo(get_template_directory_uri() . '/assets/02_sales.png') ?>" alt="" class="article--full__asset--1"/>
            </div>
        </article>

        <?php get_template_part( 'parts/block-cta' ); ?>

        <?php
            $block = get_field('related_alternatives_list');
            $list = $block['alternative_related_list'];
            $alternatives_slug = get_option('chloecorfmat_alternatives_slug') . '/';
        ?>

        <div class="block">
            <div class="block-related-articles" id="block-related-articles">
                <p class="block__subtitle"><?php echo $block['alternative_related_surtitle'] ?></p>
                <h2><?php echo $block['alternative_related_title'] ?></h2>
                <ul class="related-articles">
                    <?php foreach ($list as $list_item) { ?>
                        <?php
                            $item = $list_item['alternative']->to_array();

                            $carousel = get_field( "alternative_carousel", $item['ID'] );
                            $slide = $carousel['alternative_carousel_slides'][0];
                            $image = $slide['alternative_slide_image'][0];
                        ?>
                        <li class="article-item" data-expand-target="">
                            <a href="<?php echo $alternatives_slug . $item['post_name'] ?>" class="article-item__link" data-expand-link>
                                <img src="<?php echo esc_url($image['sizes']['medium_large']) ?>" alt="" class="article-item__image" />
                                <div class="article-item__infos">
                                    <span class="tag">Alternatives accessibles</span>
                                    <h3 class="article-item__title"><?php echo $item['post_title'] ?></h3>
                                    <p class="article-item__published_at"><time><?php echo get_field('alternative_date', $item['ID']) ?></time></p>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </main>

    <?php endwhile; endif; ?>
<?php get_footer(); ?>