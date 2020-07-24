<?php
/**
 * Функции, которые улучшают тему, подключаясь к WordPress
 *
 * @package _s
 */

/**
 * Добавляет пользовательские классы в массив классов тела.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _s_body_classes( $classes ) {
	// Добавляет класс hfeed к несингулярным страницам.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Добавляет класс без боковой панели, когда боковой панели нет.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', '_s_body_classes' );

/**
 * Добавьте заголовок автообнаружения URL-адреса pingback для отдельных сообщений, страниц или вложений.
 */
function _s_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', '_s_pingback_header' );
