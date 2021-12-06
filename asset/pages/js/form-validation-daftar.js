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
                    user_email: {
                        required: true,
                        email: true
                    },
					user_username: {
						required: true
					},
                    user_nama: {
                        required: true
                    },
                    user_no_hp: {
                        required: true,
                        number: true
                    },
                    user_password: {
                        required: true
                    },
                    user_asal_sekolah: {
                        required: true
                    },
                    user_kelas: {
                        required: true
                    },
                    user_alamat: {
                        required: true
                    }
                },
                messages: {
                    user_email: {
                        required: "Email Harus Diisi"
                    },
					user_username: {
						required: "Username Harus Diisi"
					},
                    user_nama: {
                        required: "Nama Harus Diisi"
                    },
                    user_no_hp: {
                        required: "No Hp Harus Diisi"
                    },
                    user_password: {
                        required: "Password Harus Diisi"
                    },
                    user_asal_sekolah: {
                        required: "Asal Sekolah Harus Diisi"
                    },
                    user_kelas: {
                        required: "Kelas Harus Diisi"
                    },
                    user_alamat: {
                        required: "Alamat Harus Diisi"
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success3.hide();
                    error3.show();
                    App.scrollTo(error3, -200);
                },

                highlight: function (element) { // hightlight error inputs
                   $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function () {
                    success3.show();
                    error3.hide();
					save();
                    success3.hide();
                }

            });
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