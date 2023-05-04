// custom.js [START]
$(document).ready(function () {
	// accept [START]
	let $acceptInput = $('.js-accept')

	$acceptInput.on('change', () => {
		$('.js-accept-desc').toggleClass('active', !$acceptInput.is(':checked'))
	})
	// accept [END]

	$(document).on('click touchstart focus', '.chosen-single', function () {
		$('.chosen-container').removeClass('filter-mobile-hack')
		$(this).parent().addClass('filter-mobile-hack')
	})

	// news
	$('.js-news-list').find('li').click(function () {
		window.location.href = $(this).find('a').attr('href')
	})

	// delete [START]
	// $('.js-popup[data-popup="feedback-6847"]').addClass('active')
	// delete [END]


	// send to amo [START]
	let feedbackForm = $('.hero_block_slide__content').find('form')

	feedbackForm.attr('action', '/send_amo.php');

	feedbackForm.find('.js-crm-submit').click(function (event) {
		event.preventDefault()

		let fieldsArray = feedbackForm.serializeArray()

		let fieldName = feedbackForm.find('input[name="user-name"]').eq(1)

		let fieldPhone = feedbackForm.find('input[name="user-phone"]').eq(1)

		fieldName.val() === '' ? fieldName.closest('.js-crm-name').addClass('error') : fieldName.closest('.js-crm-name').removeClass('error')

		fieldPhone.val() === '' ? fieldPhone.closest('.js-crm-phone').addClass('error') : fieldPhone.closest('.js-crm-phone').removeClass('error')


		// check to compleated fields
		if (fieldName.val() !== '' && fieldPhone.val() !== '') {
			let objData = []

			fieldsArray.forEach(item => {
				if ((item.name === 'user-name' || item.name === 'user-phone') && item.value !== '') objData.push(item)
			})

			$.ajax({
				url: feedbackForm.attr('action'),
				type: feedbackForm.attr('method'),
				data: objData,
				success: function (response) {
					$('.popup--success').addClass('active')

					feedbackForm.find('input[type="text"]').val('');
				},
				error: function (xhr, status, error) {
					console.log('error');
				}
			});
		}
	})
	// send to amo [END]
})

// insert after | hack
let insertAfter = (newNode, existingNode) => {
	existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling)
}

// set page URL to hidden input
document.querySelectorAll('.js-page-url').forEach((e) => {
	e.value = window.location.href
})
// custom.js [END]