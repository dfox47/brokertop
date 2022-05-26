
<ul class="social_list">
	<li class="social_list__item">
		<a class="social_list__icon social_list__icon--whatsapp" href="" target="_blank"></a>
	</li>

	<li class="social_list__item">
		<a class="social_list__icon social_list__icon--telegram" href="" target="_blank"></a>
	</li>

	<?php // all options https://brokertop.ru/wp-admin/admin.php?page=theme-custom-options
	$instagram = esc_attr(get_option('broker_inst'));

	if ( isset($instagram) ) { ?>
		<li class="social_list__item">
			<a class="social_list__icon social_list__icon--instagram" href="//www.instagram.com/<?php echo $instagram; ?>" target="_blank"></a>
		</li>
	<?php } ?>
</ul>
