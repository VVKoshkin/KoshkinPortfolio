<?php get_header('home'); ?>
<main class="main">
  <section class="what-order" id="what-order">
    <div class="container">
      <h4 class="headline has-text-align-center">Что можно заказать</h4>
      <div class="cards what-order-cards">
        <?php
          // выводятся все карточки с таксономией "Тип карточки" = "Виды сайтов"
          $query = new WP_Query( [ 'post_type'=>'sites'] );
          while ( $query->have_posts() ) {
            $query->the_post();
        ?>         
        <div class="card what-order-card">
            <img src="<?php the_post_thumbnail_url(); ?>"/>
            <?php the_title('<h4 class="card-headline">', '</h4>');  ?>
            <p class="card-typeset">
              <?php echo get_the_excerpt(); ?>
            </p>          
        </div>            
        <?php
        }
        wp_reset_postdata(); // сброс
        ?>
      </div>
    </div>
  </section>
  <section class="what-else" id="what-else">
    <div class="container">
      <h4 class="headline has-text-align-center">А что ещё</h4>
      <div class="list-and-photo">
        <ul class="list what-else-list">
          <?php
              // выводятся все элементы списка с таксономией "Вид списка" = "Что я умею"
              $query = new WP_Query( [ 'post_type'=>'listElems',
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'list_type',
                      'field'    => 'slug',
                      'terms'    => 'что-я-умею'
                    )
                    ),
                  'orderby'     => 'date',
                  'order'       => 'ASC' ] );
              while ( $query->have_posts() ) {
                $query->the_post(); ?>
                <li data-img-file="<?php echo get_the_post_thumbnail_url(); ?>"><?php the_title(); ?></li>

            <?php }
            wp_reset_postdata(); // сброс
            ?>
            </ul>

        <div class="list-and-photo__img">
          <img src="<?php echo get_template_directory_uri().'/assets/img/for-lists/animated.gif' ?>" alt="" />
        </div>
      </div>
    </div>
  </section>
  <section class="my-portfolio" id="my-portfolio">
    <div class="container">
      <h4 class="headline has-text-align-center">Примеры работ</h4>
      <div class="cards my-portfolio-cards">
        <?php
          // выводятся все карточки с таксономией "Тип карточки" = "Карточка в портфолио"
          $query = new WP_Query( [ 'post_type'=>'works',
              'meta_query' => array(
                array(
                  'key' => 'is_on_main', // сумма с НДС по которой ищем
                  'value' => true // значение в промежутке от-до
                )
                ),
                'paged' => $paged,
              'orderby'     => 'date',
              'order'       => 'ASC' ] );
          while ( $query->have_posts() ) {
            $query->the_post();
        ?>
        <div class="card my-portfolio-card">
          <img class="downAndUpAnimClass" src="<?php the_post_thumbnail_url(); ?>"/>
          <h4 class="card-headline"><?php the_title(); ?></h4>
          <p class="card-typeset"><?php echo get_the_excerpt(); ?></p>
          <div class="buttons">
            <a href="<?php echo get_permalink(); ?>" target="_blank">
            <button class="btn">Посмотреть работу</button>
            </a>
            <button class="btn" data-action="openOrderForm">Хочу такой же</button>
          </div>
      </div>           
        <?php
        }
        wp_reset_postdata(); // сброс
        ?>
      </div>
      <p class="grey-text">
        Кстати, этот сайт-портфолио тоже создан мной и сидит на WordPress :)
      </p>
    </div>
  </section>
  <section class="about" id="about">
    <div class="container">
      <h4 class="headline has-text-align-center">Обо мне</h4>
      <div class="list-and-photo">
        <ul class="list about-list">
          
          <?php
              // выводятся все элементы списка с таксономией "Вид списка" = "Обо мне"
              $query = new WP_Query( [ 'post_type'=>'listElems',
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'list_type',
                      'field'    => 'slug',
                      'terms'    => 'обо-мне'
                    )
                    ),
                  'orderby'     => 'date',
                  'order'       => 'ASC' ] );
              while ( $query->have_posts() ) {
                $query->the_post(); ?>
                <li data-img-file="<?php echo get_the_post_thumbnail_url(); ?>"><?php the_title(); ?></li>

            <?php }
            wp_reset_postdata(); // сброс
            ?>
        </ul>
        <div class="list-and-photo__img">
          <img src="<?php echo get_template_directory_uri().'/assets/img/for-lists/animated.gif' ?>" alt="" />
        </div>
      </div>
    </div>
  </section>
  <section class="contact-me screen-width-bgi" id="contact-me">
    <div class="container">
      <div class="contact-me-content">
        <h4 class="headline has-text-align-center">Готовы заказать сайт?</h4>
        <p class="typeset">Тогда нажмите на кнопку:</p>
        <button class="contact-me-btn btn" data-action="openOrderForm">Оставить заявку</button>
        <p class="typeset">Или напишите мне на почту/в соцсеть/мессенджер:</p>
        <div class="socnets">
          <a target="_blank" href="mailto:vlad_zdor_94@mail.ru"><img src="<?php echo get_template_directory_uri().'/assets/img/socnets/email.png' ?>" alt="email" /></a>
          <a target="_blank" href="https://vk.com/id734769187"><img src="<?php echo get_template_directory_uri().'/assets/img/socnets/vk.png' ?>" alt="VK" /></a>
          <a target="_blank" href="https://t.me/dsdest"><img src="<?php echo get_template_directory_uri().'/assets/img/socnets/tg.png' ?>" alt="Telegram" /></a>
        </div>
      </div>
    </div>
  </section>
  <section class="about-work" id="about-work">
    <div class="container">
      <h4 class="headline has-text-align-center">рабочий процесс</h4>
      <div class="list-and-photo">
        <ul class="list about-list">
          
          <?php
              // выводятся все элементы списка с таксономией "Вид списка" = "Рабочий процесс"
              $query = new WP_Query( [ 'post_type'=>'listElems',
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'list_type',
                      'field'    => 'slug',
                      'terms'    => 'рабочий-процесс'
                    )
                    ),
                  'orderby'     => 'date',
                  'order'       => 'ASC' ] );
              while ( $query->have_posts() ) {
                $query->the_post(); ?>
                <li data-img-file="<?php echo get_the_post_thumbnail_url(); ?>"><?php the_title(); ?></li>

            <?php }
            wp_reset_postdata(); // сброс
            ?>
        </ul>
        <div class="list-and-photo__img">
          <img src="<?php echo get_template_directory_uri().'/assets/img/for-lists/gears.gif' ?>" alt="" />
        </div>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
