var FormWizard = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

            $("#country_list").select2({
                placeholder: "Select",
                allowClear: true,
                formatResult: format,
                width: 'auto', 
                formatSelection: format,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    //data diri
					reg_akun_nisn: {
						required: true,
						minlength: 11,
						number: true
					},
                    reg_data_diri_nama: {
                        minlength: 2,
                        required: true
                    },
					reg_data_diri_panggilan: {
						required: true
					},
					reg_data_diri_jenis_kelamin: {
                        required: true
                    },
					reg_data_diri_agama_id: {
						required: true
					},
					reg_data_diri_tempat_lahir: {
						required: true
					},
					reg_data_diri_tgl_lahir: {
						required: true
					},
					reg_data_diri_no_telp: {
						required: true
					},
					reg_data_diri_lulusan: {
						required: true
					},
					reg_data_diri_alamat_propinsi_id: {
						required: true
					},
					reg_data_diri_alamat_kota_id: {
						required: true
					},
					reg_data_diri_alamat: {
						required: true
					},
					// data orang tua
					reg_data_ortu_nama_a: {
						required: true
					},
					reg_data_ortu_tempat_lahir_a: {
						required: true
					},
					reg_data_ortu_tgl_lahir_a: {
						required: true
					},
					reg_data_ortu_alamat_a: {
						required: true
					},
					reg_data_ortu_alamat_propinsi_id_a: {
						required: true
					},
					reg_data_ortu_alamat_kota_id_a: {
						required: true
					},
					reg_data_ortu_no_telepon_a: {
						required: true,
                        number: true
					},
					reg_data_ortu_agama_id_a: {
						required: true
					},
					reg_data_ortu_pendidikan_id_a: {
						required: true
					},
					reg_data_ortu_pekerjaan_id_a: {
						required: true
					},
					reg_data_ortu_penghasilan_a: {
						required: true,
                        number: true
					},
					reg_data_ortu_nama_i: {
						required: true
					},
					reg_data_ortu_tempat_lahir_i: {
						required: true
					},
					reg_data_ortu_tgl_lahir_i: {
						required: true
					},
					reg_data_ortu_alamat_i: {
						required: true
					},
					reg_data_ortu_alamat_propinsi_id_i: {
						required: true
					},
					reg_data_ortu_alamat_kota_id_i: {
						required: true
					},
					reg_data_ortu_no_telepon_i: {
						required: true,
                        number: true
					},
					reg_data_ortu_agama_id_i: {
						required: true
					},
					reg_data_ortu_pendidikan_id_i: {
						required: true
					},
					reg_data_ortu_pekerjaan_id_i: {
						required: true
					},
					reg_data_ortu_penghasilan_i: {
						required: true,
                        number: true
					},
					// Data Nilai
					reg_data_nilai_ind_satu: {
						required: true,
                        number: true
					},
					reg_data_nilai_ind_dua: {
						required: true,
                        number: true
					},
					reg_data_nilai_ind_tiga: {
						required: true,
                        number: true
					},
					reg_data_nilai_ind_empat: {
						required: true,
                        number: true
					},
					reg_data_nilai_ind_lima: {
						required: true,
                        number: true
					},
					reg_data_nilai_ing_satu: {
						required: true,
                        number: true
					},
					reg_data_nilai_ing_dua: {
						required: true,
                        number: true
					},
					reg_data_nilai_ing_tiga: {
						required: true,
                        number: true
					},
					reg_data_nilai_ing_empat: {
						required: true,
                        number: true
					},
					reg_data_nilai_ing_lima: {
						required: true,
                        number: true
					},
					reg_data_nilai_ipa_satu: {
						required: true,
                        number: true
					},
					reg_data_nilai_ipa_dua: {
						required: true,
                        number: true
					},
					reg_data_nilai_ipa_tiga: {
						required: true,
                        number: true
					},
					reg_data_nilai_ipa_empat: {
						required: true,
                        number: true
					},
					reg_data_nilai_ipa_lima: {
						required: true,
                        number: true
					},
					reg_data_nilai_mtk_satu: {
						required: true,
                        number: true
					},
					reg_data_nilai_mtk_dua: {
						required: true,
                        number: true
					},
					reg_data_nilai_mtk_tiga: {
						required: true,
                        number: true
					},
					reg_data_nilai_mtk_empat: {
						required: true,
                        number: true
					},
					reg_data_nilai_mtk_lima: {
						required: true,
                        number: true
					}
                },

                messages: { // custom messages for radio buttons and checkboxes
                    //data diri
					reg_akun_nisn: {
						required: "NISN Harus Diisi"
					},
                    reg_data_diri_nama: {
                        required: "Nama Harus Diisi"
                    },
					reg_data_diri_panggilan: {
						required: "Nama Panggilan Harus Diisi"
					},
					reg_data_diri_jenis_kelamin: {
                        required: "Jenis Kelamin Harus Dipilih"
                    },
					reg_data_diri_agama_id: {
						required: "Agama Harus Dipilih"
					},
					reg_data_diri_tempat_lahir: {
						required: "Tempat Lahir Harus Diisi"
					},
					reg_data_diri_tgl_lahir: {
						required: "Tanggal Lahir Harus Diisi"
					},
					reg_data_diri_no_telp: {
						required: "No Telpon / No Hp Harus Diisi"
					},
					reg_data_diri_lulusan: {
						required: "Lulusan Harus Diisi"
					},
					reg_data_diri_alamat_propinsi_id: {
						required: "Propinsi Harus Dipilih"
					},
					reg_data_diri_alamat_kota_id: {
						required: "Kota Harus Dipilih"
					},
					reg_data_diri_alamat: {
						required: "Alamat Harus Diisi"
					},
					// data orang tua
					reg_data_ortu_nama_a: {
						required: "Nama Ayah Harus Diisi"
					},
					reg_data_ortu_tempat_lahir_a: {
						required: "Tempat Lahir Ayah Harus Diisi"
					},
					reg_data_ortu_tgl_lahir_a: {
						required: "Tanggal Lahir Ayah Harus Diisi"
					},
					reg_data_ortu_alamat_a: {
						required: "Alamat Ayah Harus Diisi"
					},
					reg_data_ortu_alamat_propinsi_id_a: {
						required: "Propinsi Ayah Harus Dipilih"
					},
					reg_data_ortu_alamat_kota_id_a: {
						required: "Kota Ayah Harus Dipilih"
					},
					reg_data_ortu_no_telepon_a: {
						required: "No Telepon Ayah Harus Diisi"
					},
					reg_data_ortu_agama_id_a: {
						required: "Agama Ayah Harus Dipilih"
					},
					reg_data_ortu_pendidikan_id_a: {
						required: "Pendidikan Ayah Harus Dipilih"
					},
					reg_data_ortu_pekerjaan_id_a: {
						required: "Pekerjaan Ayah Harus Dipilih"
					},
					reg_data_ortu_penghasilan_a: {
						required: "Penghasilan Ayah Harus Diisi"
					},
					reg_data_ortu_nama_i: {
						required: "Nama Ibu Harus Diisi"
					},
					reg_data_ortu_tempat_lahir_i: {
						required: "Tempat Lahir Ibu Harus Diisi"
					},
					reg_data_ortu_tgl_lahir_i: {
						required: "Tanggal Lahir Ibu Harus Diisi"
					},
					reg_data_ortu_alamat_i: {
						required: "Alamat Ibu Harus Diisi"
					},
					reg_data_ortu_alamat_propinsi_id_i: {
						required: "Propinsi Ibu Harus Dipilih"
					},
					reg_data_ortu_alamat_kota_id_i: {
						required: "Kota Ibu Harus Dipilih"
					},
					reg_data_ortu_no_telepon_i: {
						required: "No Telepon Ibu Harus Diisi"
					},
					reg_data_ortu_agama_id_i: {
						required: "Agama Ibu Harus Dipilih"
					},
					reg_data_ortu_pendidikan_id_i: {
						required: "Pendidikan Ibu Harus Dipilih"
					},
					reg_data_ortu_pekerjaan_id_i: {
						required: "Pekerjaan Ibu Harus Dipilih"
					},
					reg_data_ortu_penghasilan_i: {
						required: "Penghasilan Ibu Harus Diisi"
					},
					// Data Nilai
					reg_data_nilai_ind_satu: {
						required: "Nilai Indonesia Semester Satu Harus Diisi"
					},
					reg_data_nilai_ind_dua: {
						required: "Nilai Indonesia Semester Dua Harus Diisi"
					},
					reg_data_nilai_ind_tiga: {
						required: "Nilai Indonesia Semester Tiga Harus Diisi"
					},
					reg_data_nilai_ind_empat: {
						required: "Nilai Indonesia Semester Empat Harus Diisi"
					},
					reg_data_nilai_ind_lima: {
						required: "Nilai Indonesia Semester Lima Harus Diisi"
					},
					reg_data_nilai_ing_satu: {
						required: "Nilai Inggris Semester Satu Harus Diisi"
					},
					reg_data_nilai_ing_dua: {
						required: "Nilai Inggris Semester Dua Harus Diisi"
					},
					reg_data_nilai_ing_tiga: {
						required: "Nilai Inggris Semester Tiga Harus Diisi"
					},
					reg_data_nilai_ing_empat: {
						required: "Nilai Inggris Semester Empat Harus Diisi"
					},
					reg_data_nilai_ing_lima: {
						required: "Nilai Inggris Semester Lima Harus Diisi"
					},
					reg_data_nilai_ipa_satu: {
						required: "Nilai IPA Semester Satu Harus Diisi"
					},
					reg_data_nilai_ipa_dua: {
						required: "Nilai IPA Semester Dua Harus Diisi"
					},
					reg_data_nilai_ipa_tiga: {
						required: "Nilai IPA Semester Tiga Harus Diisi"
					},
					reg_data_nilai_ipa_empat: {
						required: "Nilai IPA Semester Empat Harus Diisi"
					},
					reg_data_nilai_ipa_lima: {
						required: "Nilai IPA Semester Lima Harus Diisi"
					},
					reg_data_nilai_mtk_satu: {
						required: "Nilai Matematika Semester Satu Harus Diisi"
					},
					reg_data_nilai_mtk_dua: {
						required: "Nilai Matematika Semester Dua Harus Diisi"
					},
					reg_data_nilai_mtk_tiga: {
						required: "Nilai Matematika Semester Tiga Harus Diisi"
					},
					reg_data_nilai_mtk_empat: {
						required: "Nilai Matematika Semester Empat Harus Diisi"
					},
					reg_data_nilai_mtk_lima: {
						required: "Nilai Matematika Semester Lima Harus Diisi"
					}
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    success.show();
                    error.hide();
					save();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            var displayConfirm = function() {
                $('#tab4 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment[]') {
                        var payment = [];
                        $('[name="payment[]"]:checked', form).each(function(){ 
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                    
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            $('#form_wizard_1').find('.button-submit').hide();
           // $('#form_wizard_1 .button-submit').click(function () {
           //     alert('Finished! Hope you like it :)');
           // }).hide();

            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            $('#country_list', form).change(function () {
                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
             //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            $('.select2me', form).change(function () {
                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
			
            //initialize datepicker
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                autoclose: true
            });
            $('.date-picker .form-control').change(function() {
                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input 
            })
        }

    };

}();

jQuery(document).ready(function() {
    FormWizard.init();
});