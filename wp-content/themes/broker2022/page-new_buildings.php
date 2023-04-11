<?php
/*
* Template Name: Новостройки
* Template Post Type: post, page, product
*/
?>

<?php get_header(); ?>

	<h1>Жилые комплексы</h1>

	<div class="wrap">
		<ul class="new_building_list">
			<?php // subcategories of new buildings
			$categories = get_terms(array(
				'hide_empty'    => false,
				'parent'        => 2291,
				'taxonomy'      => 'product_cat'
			));

			foreach ($categories as $category) {
				$desc       = $category->description;
				$id         = $category->term_id;
				$image      = wp_get_attachment_url(get_term_meta($id, 'thumbnail_id', true));
				$link       = get_category_link($id);
				$name       = $category->name;

				if ($image) {
					echo '<img src="' . $image . '" alt="">';
				} ?>

				<li class="new_building_list__item"></li>

				<?php echo '<p><a href="' . $link . '" title="' . $name . '" ' . '>' . $name . '</a></p>';
				echo '<p>' . $category->description . '</p><br><br><br><br><br>';
			} ?>
		</ul>
	</div>

<?php // content
the_content(); ?>

<?php get_footer(); ?>