<?php
/**
 * Файл совместимости jetpack
 *
 * @link https://jetpack.com/
 *
 * @package _s
 */

/**
 * Функция настройки Jetpack.
 *
 * Смотрите: https://jetpack.com/support/infinite-scroll/
 * Смотрите: https://jetpack.com/support/responsive-videos/
 * Смотрите: https://jetpack.com/support/content-options/
 */
function _s_jetpack_setup() {
	// Добавить поддержку тем для Infinite Scroll.
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'main',
			'render'    => '_s_infinite_scroll_render',
			'footer'    => 'page',
		)
	);

	// Добавить поддержку тем для адаптивных видео.
	add_theme_support( 'jetpack-responsive-videos' );

	// Добавить поддержку тем для параметров контента.
	add_theme_support(
		'jetpack-content-options',
		array(
			'post-details' => array(
				'stylesheet' => '_s-style',
				'date'       => '.posted-on',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline',
				'comment'    => '.comments-link',
			),
			'featured-images' => array(
				'archive' => true,
				'post'    => true,
				'page'    => true,
			),
		)
	);
}
add_action( 'after_setup_theme', '_s_jetpack_setup' );

/**
 * Пользовательская функция рендеринга для Infinite Scroll.
 */
function _s_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_type() );
		endif;
	}
}
