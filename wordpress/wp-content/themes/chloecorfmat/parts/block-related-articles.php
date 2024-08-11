<?php
    $articles = get_field('related_articles_list');
?>

<?php if (sizeof($articles) > 0) { ?>
    <div class="block">
        <div class="block-related-articles" id="block-related-articles">
            <p class="block__subtitle"><?php echo the_field('related_articles_surtitle') ?></p>
            <h2><?php echo the_field('related_articles_title') ?></h2>
            <ul class="related-articles">
                <?php foreach ($articles as $article_object) {
                    $article = $article_object['article'];
                    $articleArray = $article->to_array();
                    $packshot = get_field( "article_packshot", $articleArray['ID'] )[0];
                ?>
                    <li class="article-item" data-expand-target>
                        <a href="<?php echo esc_url(get_permalink($article)) ?>" class="article-item__link" data-expand-link>
                            <img src="<?php echo esc_url( $packshot['sizes']['medium_large'] ) ?>" alt="" class="article-item__image" />
                            <div class="article-item__infos">
                                <?php $terms = get_the_terms($articleArray['ID'], 'post-main-thematic');
                                foreach ($terms as $term) { ?>
                                    <span class="tag"><?php echo $term->to_array()['name'] ?></span>
                                <?php } ?>

                                <h3 class="article-item__title"><?php echo $articleArray['post_title'] ?></h3>
                                <p class="article-item__published_at">Écrit le <time datetime="<?php echo get_the_date('c', $article) ?>"><?php echo get_the_date('j F o', $article) ?></time></p>
                            </div>
                        </a>
                    </li>
               <?php } ?>
            </ul>
        </div>
    </div>
<?php } ?>