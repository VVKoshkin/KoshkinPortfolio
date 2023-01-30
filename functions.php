<?php
add_theme_support( 'post-thumbnails' );
add_action( 'init', 'register_custom_post_types' );

add_action('wp_enqueue_scripts','add_css_and_scripts');
add_action('after_setup_theme', 'register_navbars');
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 10, 4);

// действия
function register_custom_post_types(){

    register_taxonomy( 'card_type', [ 'cards' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Типы карточек',
			'singular_name'     => 'Тип карточки',
			'search_items'      => 'Искать тип карточке',
			'all_items'         => 'Все типы карточкек',
			'view_item '        => 'Смотреть тип карточки',
			'parent_item'       => 'Parent Genre',
			'parent_item_colon' => 'Parent Genre:',
			'edit_item'         => 'Редактировать тип карточки',
			'update_item'       => 'Обновить тип карточки',
			'add_new_item'      => 'Новый тип карточки',
			'new_item_name'     => 'Новое название типа карточки',
			'menu_name'         => 'Тип карточки',
			'back_to_items'     => '← Назад к типу карточки',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => false,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );    

    register_taxonomy( 'list_type', [ 'listElems' ], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Виды списков',
			'singular_name'     => 'Вид списка',
			'search_items'      => 'Искать вид списка',
			'all_items'         => 'Все виды списков',
			'view_item '        => 'Смотреть вид списка',
			'parent_item'       => 'Parent Genre',
			'parent_item_colon' => 'Parent Genre:',
			'edit_item'         => 'Редактировать вид списка',
			'update_item'       => 'Обновить вид списка',
			'add_new_item'      => 'Новый вид списка',
			'new_item_name'     => 'Новое название вида списка',
			'menu_name'         => 'Виды списков',
			'back_to_items'     => '← Назад к типу карточки',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => false,

		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
	] );  

	register_post_type( 'cards', [
		'label'  => null,
		'labels' => [
			'name'               => 'Карточки', // основное название для типа записи
			'singular_name'      => 'Карточка', // название для одной записи этого типа
			'add_new'            => 'Добавить карточку', // для добавления новой записи
			'add_new_item'       => 'Добавление карточки', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование карточки', // для редактирования типа записи
			'new_item'           => 'Новая карточка', // текст новой записи
			'view_item'          => 'Смотреть карточку', // для просмотра записи этого типа.
			'search_items'       => 'Искать карточку', // для поиска по этим типам записи
			'not_found'          => 'Не найдена', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдена в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Карточки', // название меню
		],
		'description'            => 'Карточки на сайте, по смыслу поделены таксономией',
		'public'                 => true,
		'show_in_menu'           => true, // показывать ли в меню админки
		'show_in_admin_bar'   => true, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 5,
		'menu_icon'           => null,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'excerpt', 'thumbnail', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['card_type'],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );

	register_post_type( 'listElems', [
		'label'  => null,
		'labels' => [
			'name'               => 'Элементы списка', // основное название для типа записи
			'singular_name'      => 'Элемент списка', // название для одной записи этого типа
			'add_new'            => 'Добавить элемент списка', // для добавления новой записи
			'add_new_item'       => 'Добавление элемента списка', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование элемента списка', // для редактирования типа записи
			'new_item'           => 'Новый элемент списка', // текст новой записи
			'view_item'          => 'Смотреть элемент списка', // для просмотра записи этого типа.
			'search_items'       => 'Искать элемент списка', // для поиска по этим типам записи
			'not_found'          => 'Не найден', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найден в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Элементы списка', // название меню
		],
		'description'            => 'Элементы списка на сайте, по смыслу поделены таксономией',
		'public'                 => true,
		// 'publicly_queryable'  => true, // зависит от public
		// 'exclude_from_search' => true, // зависит от public
		// 'show_ui'             => true, // зависит от public
		// 'show_in_nav_menus'   => true, // зависит от public
		'show_in_menu'           => true, // показывать ли в меню админки
		'show_in_admin_bar'   => true, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 6,
		'menu_icon'           => null,
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'thumbnail' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['list_type'],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

function add_css_and_scripts() {
    // стили css
    wp_enqueue_style( 'reset', get_template_directory_uri() . '/assets/css/reset.css' );
    wp_enqueue_style( 'default', get_template_directory_uri() . '/assets/css/default.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css' );
    wp_enqueue_style( 'my-forms', get_template_directory_uri() . '/assets/css/forms.css' );
    wp_enqueue_style( 'popups', get_template_directory_uri() . '/assets/css/popups.css' );
    // подцепляется jQuery из CDN вместо стандартного
	wp_deregister_script( 'jquery-core');
	wp_register_script('jquery-core', 'https://code.jquery.com/jquery-3.6.0.js', in_footer:true);
	wp_enqueue_script('jquery', in_footer:true);

    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', in_footer:true); 
    // template_directory_uri передаётся как переменная в скрипт, т.к. там для форм и всплывашек
    // используются файлы из popups и modals шаблоны соответственно
    // обращение к переменной: additional_vars.template_uri
    wp_localize_script( 'main', 'additional_vars', array( 'template_uri' => get_template_directory_uri() ) );
}

function register_navbars() {
    register_nav_menus([
                        'headerNav' => 'Header Navbar',
                        'footerNav' => 'Footer Navbar'
                    ]);

}

// фильтры
function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}

function add_additional_class_on_a( $atts, $item, $args ) {
  if (property_exists($args, 'add_a_class')) {
    $atts['class'] = $args->add_a_class;
  }
  return $atts;
}

?>