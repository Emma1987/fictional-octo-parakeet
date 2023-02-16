document.addEventListener("DOMContentLoaded", function(event) {
	// Add min - max values on rating fields
	let ratingFields = document.querySelectorAll('form[name="review"] input[name*="rating"]');

	ratingFields.forEach((ratingField) => {
		ratingField.setAttribute('min', 1);
		ratingField.setAttribute('max', 5);
	});

	// Add confirm modal on delete review button
	let deleteBtn = document.getElementById('delete-review');
	deleteBtn.addEventListener('click', e => {
		e.preventDefault();

		Modal.create(function () {
			location.href = document.getElementById('delete-review').href;
		}, {
			title: window.Translator.trans('website.view.confirm_modal.title'),
			confirmButtonLabel: window.Translator.trans('website.view.confirm_modal.confirmBtn'),
			content: window.Translator.trans('website.view.confirm_modal.text'),
		});
	})
});
