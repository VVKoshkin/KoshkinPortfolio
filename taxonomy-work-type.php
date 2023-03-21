<?php get_header('default'); ?>
<section class="portfolio">
    <div class="container">
        <div class="portfolio-tags">
            <h4 class="headline">Типы работ:</h4>
            <?php
                // получаем все термины из таксономии work-type
                $terms = get_terms( [
                    'taxonomy'   => 'work-type'
                ] );
                // собираем их и выводим
                if( $terms && ! is_wp_error( $terms ) ){
                    $items = [];
                    foreach( $terms as $term ) {
                        $items[] = sprintf( 
                            '<li class="portfolio-tags__elem"><a href="%s">' . esc_html( $term->name ) . '</a></li>', 
                            esc_url( get_term_link( $term ) )
                        );
                    }
                    echo sprintf( '<ul class="portfolio-tags-list">%s</ul>', implode( '', $items ) );
                }
            ?>
        </div>
            <div class="portfolio-cards">
                    <?php
                    foreach( $posts as $post ){
                        setup_postdata($post); // устанавливаем данные
                        ?>                    
                        <div class="portfolio-card card">
                            <ul class="portfolio-card-tags">
                              <?php
                                  $tags = wp_get_post_terms(get_the_ID(), 'work-type', ['names']);
                                  foreach($tags as $tag) {
                                      echo '<li class="portfolio-card__tag">'.$tag->name.'</li>';
                                  }
                              ?>
                            </ul>
                            <img class="downAndUpAnimClass portfolio-card__img" src="<?php the_post_thumbnail_url(); ?>"/>
                            <h4 class="card-headline"><?php the_title(); ?></h4>
                            <p class="card-typeset"><?php echo get_the_excerpt(); ?></p>
                            <a class="portfolio-card__btn btn" href="<?php echo get_permalink(); ?>" target="_blank">Посмотреть работу</a>
                        </div>
                        <?php
                    }
                    wp_reset_postdata(); // сброс
                    ?>
                  </div>
            </div>

    </div>
  </section>
<?php get_footer(); ?>