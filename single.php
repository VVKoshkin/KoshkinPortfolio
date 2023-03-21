<?php get_header('default') ?>
<main class="main">
<div class="container post-content">
    <h4 class="headline has-text-align-center"><?php the_title(); ?></h4>
    <?php the_content();
    if (get_post_type() == 'works') {
        echo '<a href="'.get_field('link').'" class="btn" target="_blank">Смотреть результат</a>';
    }
    ?>
    
    
</div>
</main>
<?php get_footer(); ?>