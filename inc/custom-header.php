<?php
/**
 * Пример реализации функции пользовательского заголовка
 *
 * Вы можете добавить необязательный пользовательский заголовок изображения в header.php примерно так ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package _s
 */

/**
 * Настройте основной пользовательский заголовок WordPress.
 *
 * @uses _s_header_style()
 */
function _s_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'_s_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => '_s_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', '_s_custom_header_setup' );

if ( ! function_exists( '_s_header_style' ) ) :
	/**
	 * Стили изображения заголовка и текста, отображаемого в блоге.
	 *
	 * @see _s_custom_header_setup().
	 */
	function _s_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * Если не настроены пользовательские параметры для текста, давайте внесем залог.
		 * get_header_textcolor() options: Любое шестнадцатеричное значение, пустое, чтобы скрыть текст. По умолчанию: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// Если мы зайдем так далеко, у нас будут собственные стили. Давай сделаем это.
		?>
		<style type="text/css">
		<?php
		// Был ли текст скрыт?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// Если пользователь установил пользовательский цвет для текста, используйте его.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
