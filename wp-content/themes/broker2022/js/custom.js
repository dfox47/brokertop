
// some special code here
let x = () => {
	let pageNavCurrent = document.querySelectorAll('.page-numbers.current')

	if (!pageNavCurrent) return

	pageNavCurrent.forEach((e) => {
		e.classList.add('new')
	})
}

x()

$(document).ready(function() {
	// owl carousel at product page
	$('.js-owl-carousel').owlCarousel({
		dots:       false,
		items:      1,
		loop:       true,
		nav:        true,
		navText: ['', '']
	})

	$('.js-owl-carousel-auto').owlCarousel({
		autoplay:           true,
		autoplayHoverPause: true,
		autoplayTimeout:    4000,
		dots:               false,
		items:              1,
		loop:               true,
		nav:                true,
		navText:            ['', '']
	})

	// go to selected slide
	$('.js-go-to-slide').click(function () {
		let slideId = $(this).attr('data-slide')

		$('.js-owl-carousel').trigger('to.owl.carousel', slideId)
	})
})

jQuery(document).ready(function($) {
	var custom_uploader;

	$('#upload_image_button').click(function(e) {
		e.preventDefault();
		//If the uploader object has already been created, reopen the dialog
		if (custom_uploader) {
			custom_uploader.open();
			return;
		}

		//Extend the wp.media object
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});

		//When a file is selected, grab the URL and set it as the text field's value
		custom_uploader.on('select', function() {
			attachment = custom_uploader.state().get('selection').first().toJSON();
			$('#upload_image').val(attachment.url);
		});

		//Open the uploader dialog
		custom_uploader.open();
	});
});
