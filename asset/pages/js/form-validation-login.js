var Login = function() {

    var handleLogin = function() {

        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                user_username: {
                    required: true
                },
                user_password: {
                    required: true
                }
            },

            messages: {
                username: {
                    required: "Username harus diisi"
                },
                password: {
                    required: "Password harus diisi"
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.login-form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
						$('#alerERR').hide();
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
                $('.alert-danger', $('.login-form')).hide();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
				login();
            }
        });

        $('.login-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
					login();
                }
                return false;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function() {
            handleLogin();
        }
    };
}();

jQuery(document).ready(function() {
    Login.init();
});