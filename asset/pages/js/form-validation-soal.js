var FormValidation = function () {

    // advance validation
    var handleValidation = function() {
        // for more info visit the official plugin documentation: 
        // http://docs.jquery.com/Plugins/Validation

            var form3 = $('#form');
            var error3 = $('.alert-danger', form3);
            var success3 = $('.alert-success', form3);

            form3.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                rules: {
					soal_sesi: {
						required: true
					},
                    soal_pertanyaan: {
                        minlength: 2,
                        required: true
                    },
                    soal_jawaban_a: {
                        required: true
                    },
                    soal_jawaban_b: {
                        required: true
                    },
                    soal_jawaban_c: {
                        required: true
                    },
                    soal_jawaban_d: {
                        required: true
                    },
                    soal_jawaban_e: {
                        required: true
                    },
                    soal_kunci_jawaban: {
                        required: true
                    },
					soal_penyelesaian: {
						required: true
					}
                },
                messages: {
					soal_sesi: {
						required: "Sesi Soal Harus Diisi"
					},
                    soal_pertanyaan: {
                        required: "Soal Harus Diisi"
                    },
                    soal_jawaban_a: {
                        required: "Opsi A Harus Diisi"
                    },
                    soal_jawaban_b: {
                        required: "Opsi B Harus Diisi"
                    },
                    soal_jawaban_c: {
                        required: "Opsi C Harus Diisi"
                    },
                    soal_jawaban_d: {
                        required: "Opsi D Harus Diisi"
                    },
                    soal_jawaban_e: {
                        required: "Opsi E Harus Diisi"
                    },
                    soal_kunci_jawaban: {
                        required: "Kunci Jawaban Harus Dipilih"
                    },
					soal_penyelesaian: {
						required: "Penyelesaian Soal Harus Diisi"
					}
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success3.hide();
                    error3.show();
                    App.scrollTo(error3, -200);
                },

                highlight: function (element) { // hightlight error inputs
                   $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label.closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function () {
                    success3.show();
                    error3.hide();
					save();
                    success3.hide();
                }

            });
            //initialize datepicker
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                autoclose: true
            });
            $('.date-picker .form-control').change(function() {
                form3.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input 
            })
    }

    return {
        //main function to initiate the module
        init: function () {
            handleValidation();
        }

    };

}();

jQuery(document).ready(function() {
    FormValidation.init();
});