<?php
if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>

<?php get_template_part( 'map', 'polyline' ); ?>
<h1 class="entry-title"><?php the_title(); ?></h1>
<?php the_content(); ?>