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
        <title><?=$judulHalaman;?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES --> 
        <link href="<?=base_url();?>asset/global/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url();?>asset/global/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url();?>asset/global/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
		<link href="<?=base_url();?>asset/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=base_url();?>asset/css/plugins.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?=base_url();?>asset/pages/css/login.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/css/loading.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
	</head>
    <body class="login">
		<div class="preload-spinner" id="loading">
		<div class="sk-folding-cube">
			<div class="sk-cube1 sk-cube"></div>
			<div class="sk-cube2 sk-cube"></div>
			<div class="sk-cube4 sk-cube"></div>
			<div class="sk-cube3 sk-cube"></div>
		</div>
		</div>
        <!-- BEGIN LOGO -->
        <div class="logo">

        </div>
        <!-- END LOGO -->		
		<div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form id="form" class="login-form" autocomplete="off">
                <h3 class="form-title font-green">Reset Password</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Password Baru harus diisi. </span>
                </div>
				<div id="alerSKS" class="custom-alerts alert alert-success fade in" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					<p id="msgSKS">Password Berhasil direset <a href="<?=base_url()?>backend/login">klik disini</a> untuk login</p>
				</div>
				<div id="alerERR" class="custom-alerts alert alert-warning fade in" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" >x</button>
					<p id="msgERR"></p>
				</div>
					<input style="display: none" class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="ID" name="user_id" /> 
				<div class="form-group">
					Masukan Password Baru Untuk Akun Anda.
				</div>
                <div class="form-group">
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password Baru" name="user_password" /> 
				</div>
                <div class="form-actions">
                    <button id="btnSubmit" type="submit" class="btn green uppercase">Submit</button>
                </div>
                <div class="create-account">
                    <p>
                        <a href="<?=base_url();?>backend/daftar" id="register-btn" class="uppercase">Daftar</a>
                    </p>
                </div> 
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <div class="copyright"> 2017 &copy; Developed by <a href="http://inet.co.id/" target="_blank">Inet</a></div>
        <!-- BEGIN CORE PLUGINS -->
		<script src="<?=base_url();?>asset/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/var.js" type="text/javascript"></script>
		<script>
		$(document).ready(function() {
			$('[name="user_password"]').focus();
			$('[name="user_id"]').val(<?=$idUser?>);
		});
		
		function resetPassword()
		{
		showLoading();
			$('#btnSubmit').text('Submit...'); //change button text
			$('#btnSubmit').attr('disabled',true); //set button disable 
			var url;

				url = "<?php echo site_url('backend/login/resetSubmit')?>";

			// ajax adding data to database
			$.ajax({
				url : url,
				type: "POST",
				data: $('#form').serialize(),
				dataType: "JSON",
				success: function(data)
				{

					if(data.status) //if success close modal and reload ajax table
					{
						$("#alerERR").hide();
						$("#alerSKS").show();
					}else{
						$("#alerERR").show();
						$("#msgERR").text(data.msg);
					}

					$('#btnSubmit').text('Submit'); //change button text


				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$("#alerERR").show();
					$("#msgERR").text("Error");
					$('#btnSubmit').text('Submit'); //change button text
					$('#btnSubmit').attr('disabled',false); //set button enable 

				}
			});
			hideLoading();
		};
		</script>
		<script src="<?=base_url();?>asset/global/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>asset/js/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=base_url();?>asset/global/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
		<!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?=base_url();?>asset/js/app.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?=base_url();?>asset/pages/js/form-validation-forgot.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>
</html>