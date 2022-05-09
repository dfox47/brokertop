
/* pew-pew filters */
jQuery(document).ready(function($) {
	// получение всех значений
	let valuesBlocks = $(".woof_mselect_pa_obshhaya-ploshhad").find("option")
	let values = []

	$.each(valuesBlocks, function() {
		values.push($(this).val().replace(',','.'))
	})

	filterAddSquareFields();

	// фильтр полей по цифрам
	$('input[name="pew-range-filter-from"], input[name="pew-range-filter-to"]').on("input paste", function() {
		if (/\D/g.test(this.value)) {
			this.value = this.value.replace(/\D/g, '')
		}
	})

	// минимальная площадь
	$('body').on('change', 'input[name="pew-range-filter-from"]', function() {
		var value       = $(this).val()
		var max_value   = $('input[name="pew-range-filter-to"]').val()

		woof_current_values['filter_min_square'] = value
		woof_current_values['filter_max_square'] = max_value
		$('input[name="pew-filter-current-square-from"]').val(value)

		$.each(valuesBlocks, function(index, cur_value){
			let option          = $(this)
			let option_value    = option.val()

			if (+value <= +option_value && (+max_value == 0 || +max_value >= +option_value)) {
				if(!option.is(':disabled') && +option_value > 0) {
					option.prop("selected", true)
				}
			}
			else {
				option.prop("selected", false);
			}

			let isLastElement = index == valuesBlocks.length -1;

			if (isLastElement) {
				$(".woof_mselect_pa_obshhaya-ploshhad").trigger("change")
			}
		})
	})

	// максимальная площадь
	$('body').on('change', 'input[name="pew-range-filter-to"]', function() {
		let value       = $(this).val();
		let min_value   = $('input[name="pew-range-filter-from"]').val()

		woof_current_values['filter_min_square'] = min_value
		woof_current_values['filter_max_square'] = value

		$('input[name="pew-filter-current-square-to"]').val(value)

		$.each(valuesBlocks, function(index, cur_value) {
			let option = $(this)
			let option_value = option.val()

			if (+value >= +option_value && +min_value <= +option_value) {
				if(!option.is(':disabled') && +option_value > 0)
				{
					option.prop("selected", true).attr("data-test", "1")
				}
			}
			else {
				option.prop("selected", false)
			}

			let isLastElement = index == valuesBlocks.length -1

			if (isLastElement) {
				$(".woof_mselect_pa_obshhaya-ploshhad").trigger("change")
			}
		})
	})

	// переключение на 1 вкладку если пусто
	setTimeout(function() {
		let urlParams       = new URLSearchParams(window.location.search)
		let product_cat     = urlParams.has('product_cat')

		if (product_cat === false) {
			$(".woof_container_product_cat .woof_list.woof_list_radio li:first-child input").prop("ckecked", true).trigger("click")
		}
	}, 100)

	function filterAddSquareFields() {
		valuesBlocks = $('.woof_mselect_pa_obshhaya-ploshhad').find('option')

		/* площадь */
		let urlParams           = new URLSearchParams(window.location.search);
		let filter_min_square   = urlParams.has('filter_min_square') === true ? urlParams.get('filter_min_square') : ''
		let filter_max_square   = urlParams.has('filter_max_square') === true ? urlParams.get('filter_max_square') : ''

		$('input[name="pew-filter-current-square-from"]').val(filter_min_square)
		$('input[name="pew-filter-current-square-to"]').val(filter_max_square)

		$('input[name="woof_t_pa_obshhaya-ploshhad"]').after('<div class="pew-range-fields"><div class="pew-range-from"><input type="text" name="pew-range-filter-from" value="'+filter_min_square+'" placeholder="От" autocomplete="off"></div><div class="pew-range-from"><input type="text" name="pew-range-filter-to" value="'+filter_max_square+'" placeholder="До" autocomplete="off"></div></div>')
	}

	$(document).on('woof_ajax_done', function() {
		filterAddSquareFields()
	})
})
