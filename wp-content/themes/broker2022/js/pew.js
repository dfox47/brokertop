
/* pew-pew filters */
jQuery(document).ready(function($) {
	// получение всех значений
	var values_blocks = $(".woof_mselect_pa_obshhaya-ploshhad").find("option");
	var values = [];

	$.each(values_blocks, function(){
		values.push($(this).val().replace(',','.'));
	});

	var min_value = $(".woof_mselect_pa_obshhaya-ploshhad").find('option:nth-child(2)').val();
	var max_value = $(".woof_mselect_pa_obshhaya-ploshhad").find('option:last-child').val();

	filter_add_square_fields();

	/* фильтр полей по цифрам */
	$('input[name="pew-range-filter-from"], input[name="pew-range-filter-to"]').on("input paste", function(){
		if (/\D/g.test(this.value))
		{
			this.value = this.value.replace(/\D/g, '');
		}
	});

	//минимальная площадь
	$('body').on("change", 'input[name="pew-range-filter-from"]', function(){
		var value = $(this).val();
		var max_value = $('input[name="pew-range-filter-to"]').val();

		woof_current_values['filter_min_square'] = value;
		woof_current_values['filter_max_square'] = max_value;
		$('input[name="pew-filter-current-square-from"]').val(value);

		$.each(values_blocks, function(index, cur_value){
			var option = $(this);
			var option_value = option.val();

			if(+value <= +option_value && (+max_value == 0 || +max_value >= +option_value))
			{
				if(!option.is(':disabled') && +option_value > 0)
				{
					option.prop("selected", true);
				}
			}
			else
			{
				option.prop("selected", false);
			}

			var isLastElement = index == values_blocks.length -1;
			if (isLastElement) {
				$(".woof_mselect_pa_obshhaya-ploshhad").trigger("change");
			}
		});
	});

	//максимальная площадь
	$('body').on("change", 'input[name="pew-range-filter-to"]', function(){
		var value = $(this).val();
		var min_value = $('input[name="pew-range-filter-from"]').val();

		woof_current_values['filter_min_square'] = min_value;
		woof_current_values['filter_max_square'] = value;
		$('input[name="pew-filter-current-square-to"]').val(value);

		$.each(values_blocks, function(index, cur_value){
			var option = $(this);
			var option_value = option.val();

			if(+value >= +option_value && +min_value <= +option_value)
			{
				if(!option.is(':disabled') && +option_value > 0)
				{
					option.prop("selected", true).attr("data-test", "1");
				}
			}
			else
			{
				option.prop("selected", false);
			}

			var isLastElement = index == values_blocks.length -1;
			if (isLastElement) {
				$(".woof_mselect_pa_obshhaya-ploshhad").trigger("change");
			}
		});
	});

	//переключение на 1 вкладку если пусто
	setTimeout(function(){
		var urlParams = new URLSearchParams(window.location.search);
		var product_cat = urlParams.has('product_cat');

		if (product_cat === false) {
			$(".woof_container_product_cat .woof_list.woof_list_radio li:first-child input").prop("ckecked", true).trigger("click");
		}
	}, 100);

	function filter_add_square_fields(){
		values_blocks = $(".woof_mselect_pa_obshhaya-ploshhad").find("option");

		/* площадь */
		var urlParams = new URLSearchParams(window.location.search);
		var filter_min_square = urlParams.has('filter_min_square') === true ? urlParams.get('filter_min_square') : '';
		var filter_max_square = urlParams.has('filter_max_square') === true ? urlParams.get('filter_max_square') : '';

		$('input[name="pew-filter-current-square-from"]').val(filter_min_square);
		$('input[name="pew-filter-current-square-to"]').val(filter_max_square);

		$('input[name="woof_t_pa_obshhaya-ploshhad"]').after('<div class="pew-range-fields"><div class="pew-range-from"><input type="text" name="pew-range-filter-from" value="'+filter_min_square+'" placeholder="От" autocomplete="off"></div><div class="pew-range-from"><input type="text" name="pew-range-filter-to" value="'+filter_max_square+'" placeholder="До" autocomplete="off"></div></div>');
	}

	jQuery(document).on('woof_ajax_done', function(){
		filter_add_square_fields();
	})
})
