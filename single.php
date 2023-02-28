<?php get_header('default') ?>
<main class="main">
<div class="container post-content">
    <h4 class="headline has-text-align-center"><?php the_title(); ?></h4>
    <?php the_content(); ?>
</div>
</main>
<?php get_footer(); ?>