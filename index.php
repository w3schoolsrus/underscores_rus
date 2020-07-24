<?php
/**
 * Главный файл шаблона
 *
 * Это наиболее общий файл шаблона в теме WordPress и один из двух необходимых файлов для темы (другой - style.css).
 * Используется для отображения страницы, когда ничего более конкретного не соответствует запросу.
 * Например, он собирает домашнюю страницу, когда файл home.php не существует.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Запуск цикла */
			while ( have_posts() ) :
				the_post();

				/*
				 * Включите Post-Type-specific шаблон для контента.
				 * Если вы хотите переопределить это в дочерней теме, включите файл с именем content-___.php (где ___ является имя типа сообщения) и он будет использоваться вместо этого.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
