<?php get_header('home'); ?>
<main class="main">
  <section class="what-order" id="what-order">
    <div class="container">
      <h4 class="headline">Что можно заказать</h4>
      <div class="cards what-order-cards">
        <?php
          // выводятся все карточки с таксономией "Тип карточки" = "Виды сайтов"
          $query = new WP_Query( [ 'post_type'=>'cards',
              'tax_query' => array(
                array(
                  'taxonomy' => 'card_type',
                  'field'    => 'slug',
                  'terms'    => 'виды-сайтов'
                )
                ),
              'orderby'     => 'date',
              'order'       => 'ASC' ] );
          while ( $query->have_posts() ) {
            $query->the_post();
        ?>         
        <div class="card what-order-card">
            <img src="<?php the_post_thumbnail_url(); ?>"/>
            <?php the_title('<h4 class="card-headline">', '</h4>');  ?>
            <p class="card-price">
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
      <h4 class="headline">А что ещё</h4>
      <div class="list-and-photo">
        <ul class="what-else-list">
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



          <!-- <li data-img-file="design.gif">Дизайн-проекты и мокапы</li>
          <li data-img-file="animated.gif">Анимации любой сложности</li>
          <li data-img-file="responsive.gif">Адаптивная вёрстка</li>
          <li data-img-file="wordpress.png">Посадка вёрстки на CMS WordPress</li>
          <li data-img-file="java.png">Создание собственного движка для сайта: Python Flask или Java Spring Boot</li>
          <li data-img-file="api.png">Взаимодействие с API: прикручивание к VK, Telegram или другим необходимым интерфейсам</li> -->
        </ul>
        <div class="list-and-photo__img">
          <img src="<?php echo get_template_directory_uri().'/assets/img/for-lists/animated.gif' ?>" alt="" />
        </div>
      </div>
    </div>
  </section>
  <section class="my-portfolio" id="my-portfolio">
    <div class="container">
      <h4 class="headline">мои работы</h4>

      <div class="cards my-portfolio-cards">
        <?php
          $paged  = get_query_var( 'paged' ) ?: 1;
          // выводятся все карточки с таксономией "Тип карточки" = "Карточка в портфолио"
          $query = new WP_Query( [ 'post_type'=>'cards',
              'tax_query' => array(
                array(
                  'taxonomy' => 'card_type',
                  'field'    => 'slug',
                  'terms'    => 'карточка-в-портфолио'
                )
                ),
                'posts_per_page' => 2,
                'paged' => $paged,
              'orderby'     => 'date',
              'order'       => 'ASC' ] );
          while ( $query->have_posts() ) {
            $query->the_post();
        ?>
        
          
        <div class="card my-portfolio-card">
            <img src="<?php the_post_thumbnail_url(); ?>"/>
            <?php the_title('<h4 class="card-headline">', '</h4>');  ?>
            <input type="hidden" name="content" value="<?php echo get_the_content(); ?>">
            <input type="hidden" name="link" value="<?php echo get_permalink(); ?>">       
        </div>              
        <?php
        }
        wp_reset_postdata(); // сброс
        ?>
      </div>
      <?php if($query->max_num_pages > 1) {?>
      <div class="slider my-portfolio-slider" data-cur-page-num="<?php echo $paged; ?>" data-total-pages="<?php echo $query->max_num_pages; ?>">
        <p class="slider-arrow" data-navigation-type="prev" id="portfolioSliderPrev">&lt;</p>
        <div class="slider-controller">
          <?php for($i=1; $i<=$query->max_num_pages; $i++) { ?>
            <div data-page-num="<?php echo $i; ?>" class="slider-controller-circle <?php echo ($i==$paged) ? 'active':'';?>"></div>
          <?php
          }
          ?>
        </div>
        <p class="slider-arrow" data-navigation-type="next" id="portfolioSliderNext">&gt;</p>
      </div>
      <?php } ?>
      <p class="grey-text">
        Кстати, этот сайт-портфолио тоже создан мной и сидит на WordPress :)
      </p>
    </div>
  </section>
  <section class="about" id="about">
    <div class="container">
      <h4 class="headline">Обо мне</h4>
      <div class="list-and-photo">
        <ul class="about-list">
          
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
<!-- 
          <li>Я Вася Пупкин</li>
          <li>Учился и окончил шарагу</li>
          <li>Работал нагрузочным тестировщиком и сеньор помидор жаба разрабом 3 года</li>
          <li>Мой стек дохуильон языков</li>
          <li>У меня статус самозанятого так что всё легально, нологи плочу, отдельный счёт итд</li>
           -->
        </ul>
        <div class="list-and-photo__img">
          <img src="<?php echo get_template_directory_uri().'/assets/img/for-lists/animated.gif' ?>" alt="" />
        </div>
      </div>
    </div>
  </section>
  <section class="contact-me screen-width-bgi" id="contact-me">
    <div class="container">
      <h4 class="headline">Готовы заказать сайт?</h4>
      <p class="typeset">Тогда нажмите на кнопку:</p>
      <button class="contact-me-btn btn" data-action="openOrderForm">Оставить заявку</button>
      <p class="typeset">Или напишите мне на почту/в соцсеть/мессенджер:</p>
      <div class="socnets">
        <a target="_blank" href="mailto:vlad_zdor_94@mail.ru"><img src="<?php echo get_template_directory_uri().'/assets/img/socnets/email.png' ?>" alt="email" /></a>
        <a target="_blank" href="https://vk.com/id734769187"><img src="<?php echo get_template_directory_uri().'/assets/img/socnets/vk.png' ?>" alt="VK" /></a>
        <a target="_blank" href="https://t.me/dsdest"><img src="<?php echo get_template_directory_uri().'/assets/img/socnets/tg.png' ?>" alt="Telegram" /></a>
      </div>
    </div>
  </section>
  <section class="about-work" id="about-work">
    <div class="container">
      <h4 class="headline">рабочий процесс</h4>
      <div class="list-and-photo">
        <ul class="about-list">
          
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
