<?php
/**
 * test7 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package test7
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function test7_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on test7, use a find and replace
		* to change 'test7' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'test7', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'test7' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'test7_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'test7_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function test7_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'test7_content_width', 640 );
}
add_action( 'after_setup_theme', 'test7_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function test7_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'test7' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'test7' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'test7_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function test7_scripts() {
	wp_enqueue_style( 'test7-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'test7-style', 'rtl', 'replace' );

	wp_enqueue_script( 'test7-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'test7_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Подключаем плагин carbon-fields
 */
add_action('after_setup_theme', 'crb_load');
function crb_load()
{
    require_once(get_template_directory() . '/inc/carbon-fields/vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}

/**
 * Подключаем настройки произвольных полей. Все произвольные поля находятся в inc/carbon-fields-options
 */

add_action('carbon_fields_register_fields', 'register_carbon_fields');
function register_carbon_fields()
{
    /** Новости */
    require_once(get_template_directory() . '/inc/carbon-fields-options/news-options.php');
    /** Продукция */
    require_once(get_template_directory() . '/inc/carbon-fields-options/products-options.php');


}

/** Добавляем новый тип поста   */

add_action('init', 'register_post_types');
function register_post_types()
{
    register_taxonomy('news-categories', 'news', [
        'label' => 'Категория новости',
        'labels' => [
            'name' => 'Категория новости',
            'singular_name' => 'Категория новости',
            'search_items' => 'Искать новости',
            'popular_items' => 'Популярные новости',
            'all_items' => 'Все новости',
            'edit_item' => 'Изменить новости',
            'update_item' => 'Обновить новости',
            'add_new_item' => 'Добавить новую новости',
            'new_item_name' => 'Новое название новости',
            'separate_items_with_commas' => 'Отделить категории запятыми',
            'add_or_remove_items' => 'Добавить или удалить новости',
            'choose_from_most_used' => 'Выбрать самую популярную новости',
            'menu_name' => 'Новости',
        ],
        'public' => true,
        'description' => 'Категории для новости', // описание таксономии
        'hierarchical' => true,
        'publicly_queryable' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => false, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => false, // равен аргументу show_ui
        'hierarchical' => true,
        'rewrite' => true,
    ]);
    register_post_type('news', [
        'labels' => [
            'name' => 'Новости', // основное название для типа записи
            'singular_name' => 'Новость', // название для одной записи этого типа
            'add_new' => 'Добавить Новость', // для добавления новой записи
            'add_new_item' => 'Добавление Новость', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item' => 'Редактирование Новость', // для редактирования типа записи
            'new_item' => 'Новая Новость', // текст новой записи
            'view_item' => 'Смотреть Новость', // для просмотра записи этого типа.
            'search_items' => 'Искать Новость', // для поиска по этим типам записи
            'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'menu_name' => 'Новости', // название меню
        ],
        'menu_icon' => 'dashicons-welcome-learn-more',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => false,
        'rest_base' => '',
        'show_in_menu' => true,
        'menu_position' => 2,
        'map_meta_cap' => true,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => ['title'],
        'has_archive' => true,
        'rewrite' => ['slug' => 'news'],
        'taxonomies' => array('news-categories'),
    ]);

    register_taxonomy('products-categories', 'products', [
        'label' => 'Категория продукта',
        'labels' => [
            'name' => 'Категория продукции',
            'singular_name' => 'Категория продукта',
            'search_items' => 'Искать продукт',
            'popular_items' => 'Популярные продукты',
            'all_items' => 'Все продукты',
            'edit_item' => 'Изменить продукты',
            'update_item' => 'Обновить продукты',
            'add_new_item' => 'Добавить новую продукты',
            'new_item_name' => 'Новое название продукты',
            'separate_items_with_commas' => 'Отделить категории запятыми',
            'add_or_remove_items' => 'Добавить или удалить продукты',
            'choose_from_most_used' => 'Выбрать самую популярную продукты',
            'menu_name' => 'Категория продукции',
        ],
        'public' => true,
        'description' => 'Категории для продукции', // описание таксономии
        'hierarchical' => true,
        'publicly_queryable' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => false, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => false, // равен аргументу show_ui
        'hierarchical' => true,
        'rewrite' => true,
    ]);
    register_post_type('products', [
        'labels' => [
            'name' => 'Продукт', // основное название для типа записи
            'singular_name' => 'Продукт', // название для одной записи этого типа
            'add_new' => 'Добавить Продукт', // для добавления новой записи
            'add_new_item' => 'Добавление Продукт', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item' => 'Редактирование Продукт', // для редактирования типа записи
            'new_item' => 'Новая Продукт', // текст новой записи
            'view_item' => 'Смотреть Продукт', // для просмотра записи этого типа.
            'search_items' => 'Искать Продукт', // для поиска по этим типам записи
            'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'menu_name' => 'Продукты', // название меню
        ],
        'menu_icon' => 'dashicons-welcome-learn-more',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => false,
        'rest_base' => '',
        'show_in_menu' => true,
        'menu_position' => 2,
        'map_meta_cap' => true,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => ['title'],
        'has_archive' => true,
        'rewrite' => ['slug' => 'products'],
        'taxonomies' => array('products-categories'),
    ]);

}