<?php 
/*
File : loop/orderby.php
Replace the default form by "btn-group"
*/
?>

<div class="btn-group">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php echo (isset($_GET['orderby'])) ? $catalog_orderby_options[$orderby] : $catalog_orderby_options[get_option( 'woocommerce_default_catalog_orderby' )]; ?> <span class="caret"></span></button>
	<ul class="order_filtr">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<li style="padding: 6px 14px;"<?php echo (isset($_GET['orderby']) && $_GET['orderby'] == $id ) ? ' class="active"' : ($id == get_option( 'woocommerce_default_catalog_orderby') && !isset($_GET['orderby'])) ? ' class="active"' : ''; ?>>
				<a class="order_link" href="<?php echo get_current_url() . '/shop/?orderby=' . $id ; ?>"><?php echo esc_html( $name ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>


<style>
	.order_filtr {
		display: flex;
	}
	
	.order_link {
		text-decoration: none; 
		color: #515151;	
	}
	
	.order_link:hover {
		color: #d0be7b;
	}
</style>
