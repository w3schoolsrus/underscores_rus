<?php
/**
 * _s Настройка темы
 *
 * @package _s
 */

/**
 * Добавьте поддержку postMessage для заголовка сайта и описания для Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Объект настройки темы.
 */
function _s_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => '_s_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => '_s_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', '_s_customize_register' );

/**
 * Визуализируйте заголовок сайта для выборочного частичного обновления.
 *
 * @return void
 */
function _s_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Визуализировать слоган сайта для выборочного частичного обновления.
 *
 * @return void
 */
function _s_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Связывает обработчики JS для асинхронного предварительного просмотра настроек кастомизатора тем.
 */
function _s_customize_preview_js() {
	wp_enqueue_script( '_s-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', '_s_customize_preview_js' );
