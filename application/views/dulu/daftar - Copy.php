<?php
if($this->session->userdata('user_id')!='')
{
    redirect('profile');
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
        <link href="<?=base_url();?>asset/global/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

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
		var url;

			url = "<?php echo site_url('daftar/save')?>";
			$("#msgSKS").text("Pendaftaran Berhasil Dilakukan !!");
			$("#msgERR").text("Pendaftaran Gagal Dilakukan !!");

		// ajax adding data to database
		$.ajax({
			url : url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status){
					$("#alerSKS").show();
					$('#btnSave').text('Daftar'); //change button text
					$('#btnSave').attr('disabled',false); //set button enable 
					$("#msgSKS").text(data.msg);
					$('[name="user_nama"]').val("");
					$('[name="user_no_hp"]').val("");
					$('[name="user_email"]').val("");
					$('[name="user_password"]').val("");
				}else{
					$("#alerERR").show();
					$('#btnSave').text('Daftar'); //change button text
					$('#btnSave').attr('disabled',false); //set button enable 	
					$("#msgERR").text(data.msg);
					$('[name="user_password"]').val("");
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				$("#alerERR").show();
				$('#btnSave').text('Daftar'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable 
			}
		});
		hideLoading();
	};
	</script>
	
<section class="bg-light-gray">

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
                        <button class="close" data-close="alert"></button> Verifikasi User Berhasil, Silahkan klik <a href="<?=base_url();?>login">disini</a> untuk login ! 
					</div>
				</div>
			<?php } ?>
                <div class="col-md-12 coming-soon-content">
                   
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase"><?=$judulForm;?></span>
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
                                                    <input type="text" name="user_nama" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-2">No Hp
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_no_hp" data-required="1" class="form-control" /> 
												</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Username
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_username" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-2">Email
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_email" data-required="1" class="form-control" /> 
												</div>
                                            </div>
											<div class="form-group">
                                                <label class="control-label col-md-3">Datepicker</label>
                                                <div class="col-md-4">
                                                    <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                                                        <input type="text" class="form-control" readonly name="datepicker">
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    <!-- /input-group -->
                                                    <span class="help-block"> select a date </span>
                                                </div>
                                                <label class="control-label col-md-2">Password
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="password" name="user_password" data-required="1" class="form-control form-control-inline input-medium date-picker" /> 
												</div>
                                            </div>
                                        </div>
                                        <div class="form-actions" style="margin-bottom:15px">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
													<button type="submit" id="btnSave" class="btn btn-primary">Daftar</button>
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
													<label class="control-label">Jika sudah mendaftar, silahkan klik <a href="<?=base_url();?>login">disini</a> untuk login</label>
                                                </div>
                                            </div>
                                        </div>
								</div>
							</div>
                </div>
            </div>
        </div>
		</section>
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
            <script src="<?=base_url();?>asset/global/moment.min.js" type="text/javascript"></script>
            <script src="<?=base_url();?>asset/global/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
            <script src="<?=base_url();?>asset/global/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="<?=base_url();?>asset/global/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
            <script src="<?=base_url();?>asset/global/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?=base_url();?>asset/js/app.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>