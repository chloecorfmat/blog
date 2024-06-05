<?php get_header(); ?>
    <main role="main" id="main" tabindex="0">
        <div class="list-alternatives">
            <div class="list-alternatives__banner"></div>
            <div class="list-alternatives__content">
                <header>
                    <nav aria-label="Fil d'ariane" class="breadcrumb">
                        <ol class="breadcrumb-list">
                            <li class="breadcrumb-list__item">
                                Ressources
                            </li>
                            <li class="breadcrumb-list__item" aria-current="page">
                                Les alternatives accessibles
                            </li>
                        </ol>
                    </nav>

                    <h1 class="list-alternatives__title"><?php echo post_type_archive_title() ?></h1>
                    <?php $term = get_queried_object(); ?>
                    <div class="list-alternatives__text"><?php echo get_field('config_alternatives_description', 'option'); ?></div>
                </header>

                <div class="list-alternatives__body">
                    <div class="list-alternatives__before">
                        <div class="portrait">
                            <?php $picture = get_field('portrait_picture', 'option')[0]; ?>
                            <img src="<?php echo esc_url( $picture['sizes']['medium'] ); ?>" alt="" class="portrait__picture" />
                            <h2 class="portrait__title"><?php the_field('portrait_title', 'option') ?></h2>
                            <div class="portrait__text"><?php the_field( 'portrait_pitch', 'option' ); ?></div>
                            <?php $link = get_field('portrait_link', 'option'); ?>
                            <a
                                href="<?php echo $link['url'] ?>"
                                class="btn btn--primary portrait__btn"
                            >
                                <?php echo $link['text'] ?>
                            </a>
                        </div>
                    </div>
                    <div class="list-alternatives__list">
                        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
                            <article class="list-alternatives__item" data-expand-target>
                                <?php
                                    $image = get_field('alternative_carousel')['alternative_carousel_slides'][0]['alternative_slide_image'][0];
                                    $date = get_field('alternative_date');
                                ?>

                                <img src="<?php echo esc_url($image['sizes']['medium_large']) ?>" alt="<?php $image['alt'] ?>" class="list-alternatives__item-image"/>
                                <div class="list-alternatives__item-content">
                                    <div class="list-alternatives__item-text">
                                        <span class="tag">Alternatives accessibles</span>
                                        <h2 class="list-alternatives__item-title"><?php the_title(); ?></h2>
                                        <p class="list-alternatives__item-date">
                                            <time datetime=""><?php echo $date ?></time>
                                        </p>
                                    </div>
                                    <a href="<?php echo get_permalink() ?>" class="list-alternatives__item-link" data-expand-link>Découvrir le contenu <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
                                </div>
                            </article>
                        <?php endwhile; endif; ?>

                        <?php
                        $previous = get_previous_posts_link( 'Page précédente' );
                        $next = get_next_posts_link( 'Page suivante' );
                        $classes = '';

                        if (empty($previous) && !empty($next)) {
                            $classes = 'btns-container pagination pagination--end';
                        }

                        if (!empty($previous)) {
                            $classes = 'btns-container pagination';
                        }
                        ?>

                        <?php
                        if (!empty($classes)) {
                            ?>
                            <div class="<?php echo $classes ?>">
                                <?php previous_posts_link( 'Page précédente' ) ?>
                                <?php next_posts_link( 'Page suivante' ) ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="list-articles__after">

                    </div>
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/02_sales.png" alt="" class="article--full__asset--1"/>
            </div>
        </div>
    </main>

<?php get_footer(); ?>