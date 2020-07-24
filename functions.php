<?php
/**
 * _s функции и определения
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Замените номер версии темы в каждом выпуске.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( '_s_setup' ) ) :
	/**
	 * Устанавливает настройки по умолчанию темы и регистрирует поддержку различных функций WordPress.
	 *
	 * Обратите внимание, что эта функция подключена к хуку after_setup_theme, который запускается до хука init. Хук инициализации слишком поздно для некоторых функций, таких как указание поддержки миниатюр сообщений.
	 */
	function _s_setup() {
		/*
		 * Сделать тему доступной для перевода.
		 * Переводы можно сохранить в каталоге / languages /.
		 * Если вы создаете тему на основе _s, используйте поиск и замену, чтобы заменить '_s' на имя вашей темы во всех файлах шаблона.
		 */
		load_theme_textdomain( '_s', get_template_directory() . '/languages' );

		// Добавить по умолчанию сообщения и комментарии RSS-канал ссылки в head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Позвольте WordPress управлять заголовком документа.
		 * Добавляя поддержку тем, мы заявляем, что эта тема не использует жестко заданный тег <title> в заголовке документа, и ожидаем, что WordPress предоставит его нам.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Включить поддержку миниатюр сообщений в постах и страницах.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Эта тема использует wp_nav_menu () в одном месте.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', '_s' ),
			)
		);

		/*
		 * Переключите разметку ядра по умолчанию для формы поиска, формы комментариев и комментариев для вывода правильного HTML5.
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

		// Настройка основной фоновой функции WordPress.
		add_theme_support(
			'custom-background',
			apply_filters(
				'_s_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Добавить поддержку тем для выборочного обновления для виджетов.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Добавить поддержку основного логотипа.
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
endif;
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Установите ширину содержимого в пикселях, основываясь на дизайне темы и таблице стилей.
 *
 * Приоритет 0, чтобы сделать его доступным для обратных вызовов с более низким приоритетом.
 *
 * @global int $content_width
 */
function _s_content_width() {
	// Эта переменная предназначена для отмены из тем.
	// Открытая проблема WPCS: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( '_s_content_width', 640 );
}
add_action( 'after_setup_theme', '_s_content_width', 0 );

/**
 * Зарегистрировать область виджетов.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _s_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', '_s' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', '_s' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', '_s_widgets_init' );

/**
 * Ставить скрипты и стили.
 */
function _s_scripts() {
	wp_enqueue_style( '_s-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( '_s-style', 'rtl', 'replace' );

	wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );

/**
 * Реализуйте функцию пользовательского заголовка.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Пользовательские теги шаблонов для этой темы.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Функции, которые улучшают тему, подключаясь к WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Дополнения настройщика.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Загрузить файл совместимости с Jetpack.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Загрузить файл совместимости WooCommerce.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
