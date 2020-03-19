"use strict";

// Class definition
var KTWizard1 = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new KTWizard('kt_wizard_v1', {
			startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
		});

		// Validation before going to next page
		wizard.on('beforeNext', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
		});

		wizard.on('beforePrev', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
		});

		// Change event
		wizard.on('change', function(wizard) {
			setTimeout(function() {
				KTUtil.scrollTop();
			}, 500);
		});
	}

	var initValidation = function() {
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
			rules: {
				//= Step 1
				name: {
					required: true
				},
				from: {
					required: true
				},
				subject: {
					required: true
				},

				//= Step 2
				template: {
				    required: true
                },

				//= Step 3
				title: {
					required: true
				},
				text: {
					required: true
				},
				button_text: {
                    required: true
                },
                button_color: {
                    required: true
                },

				//= Step 4

			},

			// Display error
			invalidHandler: function(event, validator) {
				KTUtil.scrollTop();

				swal.fire({
					"title": "",
					"text": "Има някои грешки във формата. Моля проверете ги.",
					"type": "error",
					"confirmButtonClass": "btn btn-secondary"
				});
			},

			// Submit valid form
			submitHandler: function (form) {

			}
		});
	}

	var initSubmit = function() {
		var btn = formEl.find('[data-ktwizard-type="action-submit"]');

		btn.on('click', function(e) {
			e.preventDefault();

			if (validator.form()) {
				// See: src\js\framework\base\app.js
				KTApp.progress(btn);
				//KTApp.block(formEl);

				// See: http://malsup.com/jquery/form/#ajaxSubmit
				formEl.ajaxSubmit({
					success: function(response) {
						KTApp.unprogress(btn);
						//KTApp.unblock(formEl);

                        if (response.success) {
                            swal.fire({
                                "title": "",
                                "text": response.message,
                                "type": "success",
                                "confirmButtonClass": "btn btn-secondary"
                            }).then(() => {
                                window.location.replace(response.redirect);
                            });
                        } else {
                            swal.fire({
                                "title": "",
                                "text": "Възникнаха грешки!",
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary"
                            })
                        }
					}
				});
			}
		});
	}

	return {
		// public functions
		init: function() {
			wizardEl = KTUtil.get('kt_wizard_v1');
			formEl = $('#kt_form');

			initWizard();
			initValidation();
			initSubmit();
		}
	};
}();

jQuery(document).ready(function() {
	KTWizard1.init();
});
