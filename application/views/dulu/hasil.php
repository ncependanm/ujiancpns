<?php
if($this->session->userdata('user_id')=='')
{
    redirect('login');
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

		<link href="<?=base_url();?>asset/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=base_url();?>asset/css/plugins.css" rel="stylesheet" type="text/css" />

        <link rel="shortcut icon" href="favicon.ico" /> </head>

        <script src="<?=base_url();?>asset/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/var.js" type="text/javascript"></script>
		<script src="<?=base_url();?>asset/pages/js/form-validation-masuk.js" type="text/javascript"></script>

    <body class="">
	
	<script>
	var dana = "E";
	$(document).ready(function () {
		
	});
	</script>
	
	</script>
	
<section class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">&nbsp;</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 coming-soon-content">
                   
                            <div class="portlet light ">
								
                                 <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase"><?=$judulForm?></span>
                                    </div>                                
								</div>
                                <div class="portlet-title">
								
                                    <!-- BEGIN FORM-->
                                    <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>Nilai Total</td>
                                                    <td class="text-center">
														<label class="btn btn-transparent blue btn-outline btn-circle btn-sm active" id="nilaiTotal"><?=$nilaiTotal?></label>
													</td>
                                                </tr>
                                                <tr class="success">
                                                    <td>Nilai TWK</td>
                                                    <td class="text-center">
														<label class="btn btn-transparent blue btn-outline btn-circle btn-sm active" id="nilaiTWK"><?=$nilaiTWK?></label>
													</td>
                                                </tr>
                                                <tr class="success">
                                                    <td>Nilai TIU</td>
                                                    <td class="text-center">
														<label class="btn btn-transparent blue btn-outline btn-circle btn-sm active" id="nilaiTIU"><?=$nilaiTIU?></label>
													</td>
                                                </tr>
                                                <tr class="success">
                                                    <td>Nilai TKP</td>
                                                    <td class="text-center">
														<label class="btn btn-transparent blue btn-outline btn-circle btn-sm active" id="nilaiTKP"><?=$nilaiTKP?></label>
													</td>
                                                </tr>
												</tbody>
                                        </table>
                                    <!-- END FORM-->
								</div>
                                <div class="portlet-title">
                                    <div class="caption font-dark col-md-12">													
												<div id="timer" class="control-label"></div>
                                    </div>
                                    <div class="tools"> </div>
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
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?=base_url();?>asset/js/app.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>