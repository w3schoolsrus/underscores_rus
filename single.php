<?php
/**
 * Шаблон для отображения всех отдельных сообщений
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _s
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', '_s' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', '_s' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// Если комментарии открыты или у нас есть хотя бы один комментарий, загрузите шаблон комментария.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // Конец цикла.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
