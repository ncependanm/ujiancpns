<?php
if($this->session->userdata('user_id')!='')
{
    redirect('backend/beranda');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Pendaftaran</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

		<link href="<?=base_url();?>asset/css/loading.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

		<link href="<?=base_url();?>asset/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=base_url();?>asset/css/plugins.css" rel="stylesheet" type="text/css" />

        <link rel="shortcut icon" href="favicon.ico" /> </head>

        <script src="<?=base_url();?>asset/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/var.js" type="text/javascript"></script>
		<script src="<?=base_url();?>asset/pages/js/form-validation-daftar.js" type="text/javascript"></script>

    <body class="">
	
	<script>
	$(document).ready(function () {
		$('[name="user_nama"]').focus();
	});
	function save()
	{
		showLoading();
		$('#btnSave').text('Daftar...'); //change button text
		$('#btnSave').attr('disabled',true); //set button disable 
                    var file_data = "";
                    var file_nama = $('[name="user_nama"]').val();
                    var file_no_hp = $('[name="user_no_hp"]').val();
                    var file_username = $('[name="user_username"]').val();
                    var file_email = $('[name="user_email"]').val();
                    var file_tgl_lahir = "";
                    var file_password = $('[name="user_password"]').val();
                    var file_asal_sekolah = $('[name="user_asal_sekolah"]').val();
                    var file_kelas = $('[name="user_kelas"]').val();
                    var file_alamat = $('[name="user_alamat"]').val();
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    form_data.append('user_nama', file_nama);
                    form_data.append('user_no_hp', file_no_hp);
                    form_data.append('user_username', file_username);
                    form_data.append('user_email', file_email);
                    form_data.append('user_tgl_lahir', file_tgl_lahir);
                    form_data.append('user_password', file_password);
                    form_data.append('user_asal_sekolah', file_asal_sekolah);
                    form_data.append('user_kelas', file_kelas);
                    form_data.append('user_alamat', file_alamat);
                    $.ajax({
                        url: "<?php echo site_url('backend/daftar/upload_file')?>", // point to server-side controller method
                        dataType: 'JSON', // what to expect back from the server
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (data) {
                            if(data.status){
								$("#alerERR").hide();
								$("#alerSKS").show();
								$('#btnSave').text('Daftar'); //change button text
								$('#btnSave').attr('disabled',false); //set button enable 
								$("#msgSKS").text(data.msg);
								$('[name="user_nama"]').val("");
								$('[name="user_no_hp"]').val("");
								$('[name="user_email"]').val("");
								$('[name="user_password"]').val("");
								$('[name="user_username"]').val("");
								$('[name="user_asal_sekolah"]').val("");
								$('[name="user_kelas"]').val("");
								$('[name="user_alamat"]').val("");
								hideLoading();
							} else {
								$("#alerERR").show();
								$('#btnSave').text('Daftar'); //change button text
								$('#btnSave').attr('disabled',false); //set button enable 	
								$("#msgERR").text(data.msg);
								$('[name="user_password"]').val("");
								hideLoading();
							}
                        },
                        error: function (data) {
								$("#alerERR").show();
								$('#btnSave').text('Daftar'); //change button text
								$('#btnSave').attr('disabled',false); //set button enable 	
								$("#msgERR").text(data.msg);
								$('[name="user_password"]').val("");
								hideLoading();
                        }
                    });
                };
	</script>
	

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">&nbsp;</h2>
                </div>
            </div>
            <div class="row">
			<?php if($indVerifikasi == 'Y'){?>
				<div class="col-lg-12 coming-soon-content">
					<div class="alert alert-success ">
                        <button class="close" data-close="alert"></button> Verifikasi User Berhasil, Silahkan klik <a href="<?=base_url();?>backend/login">disini</a> untuk login ! 
					</div>
				</div>
			<?php } ?>
                <div class="col-md-12 coming-soon-content">
                   
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
										<h3 class="form-title font-green"><?=$judulForm;?></h3>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-title">
								
                                    <!-- BEGIN FORM-->
									<form id="form" class="form-horizontal" autocomplete="off">
									    <input type="text" name="id" hidden /> 
                                        <div class="form-body">
											<div id="alerSKS" class="custom-alerts alert alert-success fade in" style="display:none">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
												<p id="msgSKS"></p>
											</div>
											<div id="alerERR" class="custom-alerts alert alert-warning fade in" style="display:none">
												<button type="button" class="close" data-dismiss="alert" >x</button>
												<p id="msgERR"></p>
											</div>
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> Inputan masih belum sesuai. Mohon periksa kembali ! </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Sukses ! </div>
											<div class="form-group">
                                                <label class="control-label col-md-2">Nama Lengkap
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_nama" maxlength="50" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-2">No Hp
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_no_hp" maxlength="15" data-required="1" class="form-control" /> 
												</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Username
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_username" maxlength="20" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-2">Email
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_email" data-required="1" maxlength="30" class="form-control" /> 
												</div>
                                            </div>
											<div class="form-group">
                                                <label class="control-label col-md-2">Password
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="password" name="user_password" maxlength="20" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-2">Asal Sekolah
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_asal_sekolah" maxlength="150" data-required="1" class="form-control" /> 
												</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Kelas
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_kelas" maxlength="5" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-2">Alamat
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <textarea name="user_alamat" maxlength="250" class="form-control"></textarea> 
												</div>
                                            </div>
                                        </div>
                                        <div class="form-actions" style="margin-bottom:15px">
                                            <div class="row">
                                                <div class="col-md-12 text-center" >
													<button type="submit" id="btnSave" class="btn green uppercase">Daftar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
								</div>
                                <div class="portlet-body">
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-9">
													<label class="control-label">Jika sudah mendaftar, silahkan klik <a href="<?=base_url();?>backend/login">disini</a> untuk login</label>
                                                </div>
                                            </div>
                                        </div>
								</div>
							</div>
                </div>
            </div>
        </div>
        <script src="<?=base_url();?>asset/global/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>asset/js/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=base_url();?>asset/global/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/countdown/jquery.countdown.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
            <script src="<?=base_url();?>asset/global/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?=base_url();?>asset/js/app.js" type="text/javascript"></script>
		<script type="text/javascript">
            $(document).ready(function () {
                $('.tanggal').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });
            });
        </script>
    </body>

</html>