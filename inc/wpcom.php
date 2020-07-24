<?php
/**
 * WordPress.com-специфичные функции и определения
 *
 * Этот файл централизованно включен из `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package _s
 */

/**
 * Добавлена поддержка функций темы, характерных для wp.com.
 *
 * @global array $themecolors
 */
function _s_wpcom_setup() {
	global $themecolors;

	// Установить цвета темы для сторонних сервисов.
	if ( ! isset( $themecolors ) ) {
		// Белый список, специфичный для переменной wpcom, предназначенный для отмены.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$themecolors = array(
			'bg'     => '',
			'border' => '',
			'text'   => '',
			'link'   => '',
			'url'    => '',
		);
	}
}
add_action( 'after_setup_theme', '_s_wpcom_setup' );
