<?php get_header(); ?>
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
    <main role="main" id="main" tabindex="0">
        <article class="article--full">
            <?php
                $packshot = get_field('packshot')[0];
            ?>
            <img src="<?php echo esc_url( $packshot['sizes']['2048x2048'] ) ?>" alt="" class="article--full__banner"/>

            <div class="article--full__content">
                <header class="article--full__content-header">
                    <?php $terms = get_the_terms(get_the_ID(), 'post-main-thematic');
                    foreach ($terms as $term) { ?>
                        <span class="tag"><?php echo $term->to_array()['name'] ?></span>
                    <?php } ?>

                    <h1 class="article--full__title"><?php echo get_the_title() ?></h1>
                    <div class="article--full__infos">
                        <ul class="article--full__infos-list">
                            <li  class="article--full__infos-item">
                                <?php
                                $author_id = get_the_author_meta('ID');
                                $author_avatar = get_field('avatar', 'user_'. $author_id );
                                ?>
                                <img src="<?php echo esc_url( $author_avatar['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $author_avatar['alt'] ) ?>" class="article--full__infos-picture" />
                                <p class="article--full__infos-text">Écrit par <span class="article--full__infos-link--disabled"><?php the_author(); ?></span></p>
                            </li>
                            <li  class="article--full__infos-item">
                                <i class="fa-regular fa-clock fa-lg article--full__infos-icon" aria-hidden="true"></i>
                                <p class="article--full__infos-text">Écrit le <time datetime="<?php get_the_date('c'); ?>"><?php the_date(); ?></time></p>
                            </li>
                            <li  class="article--full__infos-item">
                                <i class="fa-solid fa-stopwatch fa-lg article--full__infos-icon" aria-hidden="true"></i>
                                <p class="article--full__infos-text">Lecture <?php echo esc_html(get_field('reading_time')); ?> min.</p>
                            </li>
                        </ul>
                    </div>
                </header>

                <div class="article--full__body">
                    <div class="article--full__before">
                    </div>
                    <div class="article--full__wysiwyg">
                        <?php the_content(); ?>
                    </div>
                    <div class="article--full__after">
                        <?php get_template_part( 'parts/block-references' ); ?>
                    </div>
                </div>

                <footer>
                    <p class="article--full__signature">Chloé Corfmat</p>
                </footer>

                <img src="<?php echo(get_template_directory_uri() . '/assets/02_sales.png') ?>" alt="" class="article--full__asset--1"/>
            </div>

            <!--<div class="site__navigation">
                <?php /** if (isset(get_previous_post()->ID)) { ?>
                    <div class="site__navigation__prev">
                        <p>Article précédent</p>
                        <?php previous_post_link( '%link' ); ?>
                    </div>
                <?php }
                if (isset(get_next_post()->ID)) { ?>
                    <div class="site__navigation__next">
                        <p>Article Suivant</p>
                        <?php next_post_link( '%link' ); ?>
                    </div>
                <?php } */ ?>
            </div>-->

            <?php //comments_template(); ?>
        </article>

        <?php get_template_part( 'parts/block-cta' ); ?>
        <?php get_template_part( 'parts/block-related-articles' ); ?>

    </main>

    <?php endwhile; endif; ?>

<?php get_footer(); ?>