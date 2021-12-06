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
        <!-- BEGIN LOGIN -->
        <div class="content" id="loginTampilan" style="display: none">
            <!-- BEGIN LOGIN FORM -->
            <form id="form" class="login-form" autocomplete="off">
                <h3 class="form-title font-green">Sign In</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Username and password harus diisi. </span>
                </div>
				<div id="alerSKS" class="custom-alerts alert alert-success fade in" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					<p id="msgSKS"></p>
				</div>
				<div id="alerERR" class="custom-alerts alert alert-warning fade in" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" >x</button>
					<p id="msgERR"></p>
				</div>
                <div class="form-group">
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username atau Email " name="user_username" /> 
				</div>
                <div class="form-group">
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="user_password" /> 
				</div>
				
                <div class="form-actions">
                    <button id="btnLogin" type="submit" class="btn green uppercase">Login</button>
					<a id="forget-password" class="forget-password" href="#" onclick="showForgot()">Lupa Password?</a>
                </div>
                 <div class="create-account">
                    <p>
                        <a href="<?=base_url();?>backend/daftar" id="register-btn" class="uppercase">Daftar</a>
                    </p>
                </div> 
            </form>
            <!-- END LOGIN FORM -->
        </div>
		
		<div class="content" id="forgotTampilan" style="display: none">
            <!-- BEGIN LOGIN FORM -->
            <form id="formForgot" class="login-form" autocomplete="off">
                <h3 class="form-title font-green">Lupa Password</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Username and password harus diisi. </span>
                </div>
				<div id="alerSKS2" class="custom-alerts alert alert-success fade in" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					<p id="msgSKS2"></p>
				</div>
				<div id="alerERR2" class="custom-alerts alert alert-warning fade in" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" >x</button>
					<p id="msgERR2"></p>
				</div>
				<div class="form-group">
				Jika Anda lupa password, Anda dapat mengatur ulang di sini. 
				Ketika Anda mengisi alamat email terdaftar Anda, 
				Anda akan dikirimkan petunjuk tentang cara untuk reset password Anda.
				</div>
                <div class="form-group">
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email " name="send_email" /> 
				</div>
                <div class="form-actions">
                    <button id="btnKirim" type="button" onclick="sendEmail()" class="btn green uppercase">Kirim</button>
                    <button id="btnCencel" type="button" onclick="showLogin()" class="btn info uppercase">Batal</button>
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
			reset();
			$('[name="user_username"]').focus();		
			$('#loginTampilan').show();				
		});
		
		function reset(){
			$('#loginTampilan').hide();
			$('#forgotTampilan').hide();
			$("#alerERR2").hide();
			$("#alerSKS2").hide();		
			$("#alerERR").hide();
			$("#alerSKS").hide();
			$(".alert-danger").hide();
		}
		
		function showLogin(){
			showLoading();
			reset();	
			$('#loginTampilan').show();		
			hideLoading();
		}
		
		function showForgot(){
			showLoading();
			reset();
			$('#forgotTampilan').show();	
			hideLoading();
		}
		
		function login()
		{
		showLoading();
			$('#btnLogin').text('Login...'); //change button text
			$('#btnLogin').attr('disabled',true); //set button disable 
			var url;

				url = "<?php echo site_url('backend/login/auth')?>";

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
						$("#msgSKS").text(data.msg);
						window.location.href = '<?=base_url()?>backend/beranda';
					}else{
						$("#alerERR").show();
						$("#msgERR").text(data.msg);
					}

					$('#btnLogin').text('Login'); //change button text
					$('#btnLogin').attr('disabled',false); //set button enable 


				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$("#alerERR").show();
					$("#msgERR").text("Error");
					$('#btnLogin').text('Login'); //change button text
					$('#btnLogin').attr('disabled',false); //set button enable 

				}
			});
			hideLoading();
		};
		
		function sendEmail()
		{
		showLoading();
			$('#btnKirim').text('Kirim...'); //change button text
			$('#btnKirim').attr('disabled',true); //set button disable 
			var url;

				url = "<?php echo site_url('backend/login/send')?>";

			// ajax adding data to database
			$.ajax({
				url : url,
				type: "POST",
				data: $('#formForgot').serialize(),
				dataType: "JSON",
				success: function(data)
				{
					if(data.status) //if success close modal and reload ajax table
					{
						$("#alerERR2").hide();
						$("#alerSKS2").show();
						$("#msgSKS2").text(data.msg);
					}else{
						$("#alerERR2").show();
						$("#msgERR2").text(data.msg);
					}
					$('#btnKirim').text('Kirim'); //change button text
					$('#btnKirim').attr('disabled',false); //set button enable 
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$("#alerERR2").show();
					$("#msgERR2").text("Error");
					$('#btnKirim').text('Kirim'); //change button text
					$('#btnKirim').attr('disabled',false); //set button enable 

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
        <script src="<?=base_url();?>asset/pages/js/form-validation-login.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>
</html>