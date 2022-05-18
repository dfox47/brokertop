
jQuery(document).ready(function($) {
	// get all values
	let valuesBlocks = $('.woof_mselect_pa_obshhaya-ploshhad').find('option')
	let values = []

	$.each(valuesBlocks, function() {
		values.push($(this).val().replace(',','.'))
	})

	filterAddSquareFields();

	// filter by numbers
	$('input[name="pew-range-filter-from"], input[name="pew-range-filter-to"]').on('input paste', function() {
		if (/\D/g.test(this.value)) {
			this.value = this.value.replace(/\D/g, '')
		}
	})

	// min square
	$('body').on('change', 'input[name="pew-range-filter-from"]', function() {
		var value   = $(this).val()
		var maxVal  = $('input[name="pew-range-filter-to"]').val()

		woof_current_values['filter_min_square'] = value
		woof_current_values['filter_max_square'] = maxVal
		$('input[name="pew-filter-current-square-from"]').val(value)

		$.each(valuesBlocks, function(index) {
			let option          = $(this)
			let option_value    = option.val()

			if (+value <= +option_value && (+maxVal == 0 || +maxVal >= +option_value)) {
				if (!option.is(':disabled') && +option_value > 0) {
					option.prop("selected", true)
				}
			}
			else {
				option.prop("selected", false);
			}

			let isLastElement = index === valuesBlocks.length -1;

			if (isLastElement) {
				valuesBlocks.trigger('change')
			}
		})
	})

	// max square
	$('body').on('change', 'input[name="pew-range-filter-to"]', function() {
		let value       = $(this).val();
		let min_value   = $('input[name="pew-range-filter-from"]').val()

		woof_current_values['filter_min_square'] = min_value
		woof_current_values['filter_max_square'] = value

		$('input[name="pew-filter-current-square-to"]').val(value)

		$.each(valuesBlocks, function(index) {
			let option = $(this)
			let option_value = option.val()

			if (+value >= +option_value && +min_value <= +option_value) {
				if(!option.is(':disabled') && +option_value > 0) {
					option.prop("selected", true).attr("data-test", "1")
				}
			}
			else {
				option.prop("selected", false)
			}

			let isLastElement = index === valuesBlocks.length -1

			if (isLastElement) {
				valuesBlocks.trigger('change')
			}
		})
	})

	// switch to the 1st tab if empty
	setTimeout(function() {
		let urlParams       = new URLSearchParams(window.location.search)
		let product_cat     = urlParams.has('product_cat')

		if (product_cat === false) {
			$(".woof_container_product_cat .woof_list.woof_list_radio li:first-child input").prop("ckecked", true).trigger("click")
		}
	}, 100)

	function filterAddSquareFields() {
		valuesBlocks = $('.woof_mselect_pa_obshhaya-ploshhad').find('option')

		// square
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



// show more|less button [START]
let $woof           = document.querySelector('.woof')
let $woofMoreBtn    = document.createElement('div')

$woofMoreBtn.classList.add('js-pew-more', 'woof_more')
$woofMoreBtn.innerHTML = '<span class="woof_more__hide">Свернуть</span><span class="woof_more__show">Больше фильтров</span>'

$woof.appendChild($woofMoreBtn)
// show more|less button [END]
