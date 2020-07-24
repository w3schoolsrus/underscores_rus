<?php
/**
 * Шаблон для отображения комментариев
 *
 * Это шаблон, который отображает область страницы, которая содержит как текущие комментарии, так и форму комментария..
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

/*
 * Если текущее сообщение защищено паролем, а посетитель еще не ввел пароль, мы вернемся рано без загрузки комментариев.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// Вы можете начать редактирование здесь - включая этот комментарий!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$_s_comment_count = get_comments_number();
			if ( '1' === $_s_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', '_s' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: количество комментариев, 2: заголовок. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $_s_comment_count, 'comments title', '_s' ) ),
					number_format_i18n( $_s_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// Если комментарии закрыты и есть комментарии, давайте оставим небольшую заметку, не так ли?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'комментарии закрыты.', '_s' ); ?></p>
			<?php
		endif;

	endif; // Проверить have_comments().

	comment_form();
	?>

</div><!-- #comments -->
