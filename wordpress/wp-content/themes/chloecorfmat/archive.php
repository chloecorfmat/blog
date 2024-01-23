<?php get_header(); ?>
    <main role="main" id="main" tabindex="0">
        <div class="list-articles">
            <div class="list-articles__banner"></div>
            <div class="list-articles__content">
                <header>
                    <h1 class="list-articles__title"><?php echo single_term_title() ?></h1>
                    <?php $term = get_queried_object(); ?>
                    <div class="list-articles__text"><?php echo get_field('description', $term) ?></div>
                </header>

                <div class="list-articles__body">
                    <div class="list-articles__before">
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
                    <div class="list-articles__list">

                        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
                            <article class="list-articles__item" data-expand-target>
                                <?php
                                $packshot = get_field('article_packshot')[0];
                                ?>

                                <img src="<?php echo esc_url( $packshot['sizes']['medium_large'] ) ?>" alt="" class="list-articles__item-image"/>
                                <?php $terms = get_the_terms(get_the_ID(), 'post-main-thematic');
                                foreach ($terms as $term) { ?>
                                    <span class="tag"><?php echo $term->to_array()['name'] ?></span>
                                <?php } ?>
                                <h2 class="list-articles__item-title"><?php the_title(); ?></h2>
                                <p class="list-articles__item-date">
                                    <time datetime="<?php echo get_the_date('c'); ?>"><?php the_date(); ?></time>
                                </p>
                                <p class="list-articles__item-text"><?php echo get_field('excerpt'); ?></p>
                                <a href="<?php echo get_permalink() ?>" class="list-articles__item-link" data-expand-link>Lire l'article <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
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

        <?php get_template_part( 'parts/block-cta' ); ?>
    </main>

<?php get_footer(); ?>