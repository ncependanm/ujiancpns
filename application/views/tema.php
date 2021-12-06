<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?=$title;?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
		
		<!-- Bootstrap Core CSS -->
		<link href="<?=base_url();?>asset/global/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

		<!-- Custom Fonts -->
		<link href="<?=base_url();?>asset/global/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/css/loading.css" rel="stylesheet" type="text/css" />
		
		<!-- Theme CSS -->
		<link href="<?=base_url();?>asset/landing/css/agency.css" rel="stylesheet">
		<!-- jQuery -->
		<script src="<?=base_url();?>asset/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/var.js" type="text/javascript"></script>

</head>
<body id="page-top" class="index">
		<div class="preload-spinner" id="loading">
		<div class="sk-folding-cube">
			<div class="sk-cube1 sk-cube"></div>
			<div class="sk-cube2 sk-cube"></div>
			<div class="sk-cube4 sk-cube"></div>
			<div class="sk-cube3 sk-cube"></div>
		</div>
		</div>

    <!-- Header -->
    <div id="contents">
		<?= $contents;?>
	</div>


    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url();?>asset/global/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Theme JavaScript -->
    <script src="<?=base_url();?>asset/landing/js/agency.min.js"></script>
	
	        <script src="<?=base_url();?>asset/global/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/app.js" type="text/javascript"></script>
    </body>

</html>