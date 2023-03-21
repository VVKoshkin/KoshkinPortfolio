<!DOCTYPE html>
<html lang="ru" class="theme-light">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- этот вариант хедера используется только на главной -->
    <title><?php echo get_bloginfo('name'),' - Главная страница'; ?></title>
    <!-- Roboto Font (mostly popular) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <?php wp_head(); ?>
  </head>

<body data-theme="theme-light">
<header class="header" id="header">
      <div class="header-bgi screen-width-bgi">
        <div class="header-blur"></div>
      </div>
      <div class="navbar">
        <div class="container">
          <nav class="navbar-content">
            <div class="navbar-hamburger">
              <!-- will be shown when screen width less then container width -->
              <div class="navbar-hamburger__line"></div>
              <div class="navbar-hamburger__line"></div>
              <div class="navbar-hamburger__line"></div>
            </div>
            <?php
            wp_nav_menu([
                'theme_location'  => 'headerNav',
                'container'       => 'div',
                'container_class' => 'navbar-elements',
                'items_wrap' => '<div id="nav-menu-close"><img src="'.get_template_directory_uri().'/assets/img/cross.png'.'"></div>%3$s',
                'add_li_class'  => 'navbar-element',
                'add_a_class' => 'navbar-element__link'  
            ]);
            ?>
            <div class="color-mode-switcher" id="color-mode-switcher">
              <div class="color-mode-switcher-line"></div>
              <div class="color-mode-switcher-circle"></div>
            </div>
          </nav>
        </div>
      </div>
      <div class="container">
        <div class="header-content">
          <h1 class="headline-big"><?php bloginfo('name'); ?></h1>
          <p class="typeset-big"><?php bloginfo('description'); ?></p>
          <div class="header-btns">
            <button class="btn header-btn" data-action="openOrderForm">Оставить заявку</button>
          </div>
        </div>
      </div>
    </header>