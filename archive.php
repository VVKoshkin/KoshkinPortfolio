<?php get_header('default'); ?>
<main class="main">
    <div class="container">
            <ul class="post-cards">
            <?php
            foreach( $posts as $post ){
                setup_postdata($post); // устанавливаем данные
                ?>
                <li class="post-card">
                    <div class="date-and-headline">
                        <p class="typeset post-card__date"><?php the_date(); ?></p>
                        <h4 class="headline post-card__headline"><?php the_title(); ?></h4>
                    </div>
                    <hr>
                    <p class="typeset post-card__short"><?php echo get_the_excerpt(); ?></p>
                    <?php the_post_thumbnail(); ?>
                    <a class="post-card__link" target="_blank" href="<?php the_permalink(); ?>"><button class="btn">Смотреть</button></a>
                </li>
                <?php
            }
            wp_reset_postdata(); // сброс
            ?>

        </ul>
    </div>
</main>


<?php get_footer(); ?>