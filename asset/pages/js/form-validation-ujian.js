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
                    ujian_paket_parent_id: {
                        required: true
                    },
                    ujian_nama: {
                        required: true
                    },
                    ujian_tgl_mulai: {
                        required: true
                    },
                    ujian_tgl_akhir: {
                        required: true
                    },
                    ujian_durasi: {
                        required: true,
                        number: true
                    },
                    ujian_ind: {
                        required: true
                    },
                    ujian_keterangan: {
                        required: true
                    }
                },
                messages: {
                    ujian_paket_parent_id: {
                        required: "Paket Harus Dipilih"
                    },
                    ujian_nama: {
                        required: "Nama Ujian Harus Diisi"
                    },
                    ujian_tgl_mulai: {
                        required: "Tanggal Mulai Harus Diisi"
                    },
                    ujian_tgl_akhir: {
                        required: "Tanggal Akhir Harus Diisi"
                    },
                    ujian_durasi: {
                        required: "Durasi Harus Diisi"
                    },
                    ujian_ind: {
                        required: "Jenis Ujian Harus Dipilih"
                    },
                    ujian_keterangan: {
                        required: "Keterangan Ujian Harus Diisi"
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