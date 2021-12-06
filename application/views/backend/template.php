<?php
if($this->session->userdata('user_id')=='')
{
    redirect('backend/login');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?=$judulHalaman?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?=base_url();?>asset/global/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url();?>asset/global/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url();?>asset/global/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/css/loading.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
		<link href="<?=base_url();?>asset/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=base_url();?>asset/css/plugins.css" rel="stylesheet" type="text/css" />
		<!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN DATA TABLE -->
        <link href="<?=base_url();?>asset/global/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END DATA TABLE -->
        <!-- BEGIN FORM INPUTAN -->
		<link href="<?=base_url();?>asset/global/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <!-- END FORM INPUTAN -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?=base_url();?>asset/css/error.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/css/layout.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?=base_url();?>asset/css/custom.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/global/sweetalert/sweetalert.css">
        <!-- END THEME LAYOUT STYLES -->
        <script src="<?=base_url();?>asset/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/var.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?=base_url();?>asset/global/sweetalert/sweetalert.min.js"></script>
		<script src="<?=base_url();?>asset/js/highcharts.js"></script>
        <link rel="shortcut icon" href="favicon.ico" /> 
	</head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">		
		<!-- <div class="preload-spinner" id="loading">
		<div class="spinner">
			<div class="dot1"></div>
			<div class="dot2"></div>
		</div>
		</div> -->
		<div class="preload-spinner" id="loading">
		<div class="sk-folding-cube">
			<div class="sk-cube1 sk-cube"></div>
			<div class="sk-cube2 sk-cube"></div>
			<div class="sk-cube4 sk-cube"></div>
			<div class="sk-cube3 sk-cube"></div>
		</div>
		</div>
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <div class="page-logo">
                    <a href="index.html">
						<h3 class="logo-default">OO</h3>
					</a>
                    <div class="menu-toggler sidebar-toggler">
                    </div>
                </div>
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <div class="page-top">
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile"><?=$this->session->userdata('user_nama');?></span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?=base_url();?>backend/login/logout">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
         </div>
        <div class="clearfix"> </div>
        <div class="page-container">
			<?php 
			include "menu/menu.php";
			?>
			<div class="page-content-wrapper">
                <div class="page-content">
					<?= $contents;?>
                </div>
            </div>
        </div>
        <div class="page-footer">
            <div class="page-footer-inner"> 2017 &copy; Developed by <a href="http://inet.co.id/" target="_blank">Inet</a> 
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
        </div>
		<!-- BEGIN CORE PLUGINS -->
        <script src="<?=base_url();?>asset/global/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>asset/js/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
		<!-- END CORE PLUGINS -->
        <!-- BEGIN INPUTAN -->
		<script src="<?=base_url();?>asset/global/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
		<script src="<?=base_url();?>asset/global/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
        <!-- END INPUTAN -->
        <!-- BEGIN DATA TABLE -->
        <script src="<?=base_url();?>asset/js/datatable.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <!-- END DATA TABLE -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?=base_url();?>asset/js/app.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?=base_url();?>asset/js/table-datatables-responsive.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?=base_url();?>asset/js/layout.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/demo.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/quick-sidebar.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
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