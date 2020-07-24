<?php
/**
 * Шаблон для отображения архивных страниц
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Начало цикла */
			while ( have_posts() ) :
				the_post();

				/*
				 * Включите Post-Type-specific шаблон для контента.
				 * Если вы хотите переопределить это в дочерней теме, включите файл с именем content-___.php (где ___ является Post Type именем) и он будет использоваться вместо этого..
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
