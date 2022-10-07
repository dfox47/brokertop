<?php /*
File : loop/orderby.php
Replace the default form by "btn-group"
*/ ?>

<div class="btn-group">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php echo (isset($_GET['orderby'])) ? $catalog_orderby_options[$orderby] : $catalog_orderby_options[get_option( 'woocommerce_default_catalog_orderby' )]; ?> <span class="caret"></span></button>
	<ul class="order_filter">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<li class="order_filter__item<?php echo ((isset($_GET['orderby']) && $_GET['orderby'] == $id) ? ' active' : ($id == get_option('woocommerce_default_catalog_orderby') && !isset($_GET['orderby']))) ? ' active' : ''; ?>">
				<a class="order_filter__link" href="<?php echo get_current_url() . '/shop/?orderby=' . $id ; ?>"><?php echo esc_html( $name ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
