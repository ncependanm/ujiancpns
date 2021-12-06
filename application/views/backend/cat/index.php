<?php
if($this->session->userdata('user_id')=='')
{
    redirect('backend/login');
}
$idTerjawabTmp = $idTerjawabTmp;
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
		<script src="<?=base_url();?>asset/pages/js/form-validation-cat.js" type="text/javascript"></script>

    <body class="">
	
	<script>
	var dana = "E";
	function showModal(){
		$("#viewDetail").fadeIn(600);
	}

	function hideModal(){
		$("#viewDetail").fadeOut(300);
	}
	$(document).ready(function () {
		$('[name="user_email"]').focus();
		$('#jmlTerjawabTmp').text(<?=$jmlTerjawab?>);
		$('#jmlSisaSoalTmp').text(<?=$jmlSoal - $jmlTerjawab?>);
		$('#jmlSoalTmp').text(<?=$jmlSoal?>);
		$('<?=$idBackTmp?>').hide();
		$('<?=$idNextTmp?>').show();
		var today = new Date();
		var tglAwal = new Date();
		
		var batasWaktu = '<?=$batasWaktu?>';
        var batasWaktuSplit = batasWaktu.split(" ");
		var waktu = batasWaktuSplit[1];
        var waktuSplit = waktu.split(":");
		
		var waktuSekarang = '<?=$waktuSekarang?>';
        var waktuSekarangSplit = waktuSekarang.split(" ");
		var waktuSekarang = waktuSekarangSplit[1];
        var waktuSekarangSplit = waktuSekarang.split(":");
		
		var detik = waktuSplit[2] - waktuSekarangSplit[2];
        var menit = waktuSplit[1] - waktuSekarangSplit[1];
        var jam   = waktuSplit[0] - waktuSekarangSplit[0];
        
        // Set the date we're counting down to
		var countDownDate = new Date(batasWaktu).getTime();

		// Update the count down every 1 second
		var x = setInterval(function() {

			// Get todays date and time
			var now = new Date().getTime();
			
			// Find the distance between now an the count down date
			var distance = countDownDate - now;
			
			// Time calculations for days, hours, minutes and seconds
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
			// Output the result in an element with id="demo"
			document.getElementById("timer").innerHTML = hours + " jam : " + minutes + " menit : " + seconds + " detik";
			
			// If the count down is over, write some text 
			if (distance < 0) {
				selesaiKerja();
			}
		}, 1000);
			
	$("input[name=optionPG1]").click(function () {
        dana = $("input[name='optionPG1']:checked").val();
	});
    $("input[name=optionPG2]").click(function () {
        dana = $("input[name='optionPG2']:checked").val();
	});
    $("input[name=optionPG3]").click(function () {
        dana = $("input[name='optionPG3']:checked").val();
	});
    $("input[name=optionPG4]").click(function () {
        dana = $("input[name='optionPG4']:checked").val();
	});
    $("input[name=optionPG5]").click(function () {
        dana = $("input[name='optionPG5']:checked").val();
	});
    $("input[name=optionPG6]").click(function () {
        dana = $("input[name='optionPG6']:checked").val();
	});
    $("input[name=optionPG7]").click(function () {
        dana = $("input[name='optionPG7']:checked").val();
	});
    $("input[name=optionPG8]").click(function () {
        dana = $("input[name='optionPG8']:checked").val();
	});
    $("input[name=optionPG9]").click(function () {
        dana = $("input[name='optionPG9']:checked").val();
	});
    $("input[name=optionPG10]").click(function () {
        dana = $("input[name='optionPG10']:checked").val();
	});
	
    $("input[name=optionPG11]").click(function () {
        dana = $("input[name='optionPG11']:checked").val();
	});
    $("input[name=optionPG12]").click(function () {
        dana = $("input[name='optionPG12']:checked").val();
	});
    $("input[name=optionPG13]").click(function () {
        dana = $("input[name='optionPG13']:checked").val();
	});
    $("input[name=optionPG14]").click(function () {
        dana = $("input[name='optionPG14']:checked").val();
	});
    $("input[name=optionPG15]").click(function () {
        dana = $("input[name='optionPG15']:checked").val();
	});
    $("input[name=optionPG16]").click(function () {
        dana = $("input[name='optionPG16']:checked").val();
	});
    $("input[name=optionPG17]").click(function () {
        dana = $("input[name='optionPG17']:checked").val();
	});
    $("input[name=optionPG18]").click(function () {
        dana = $("input[name='optionPG18']:checked").val();
	});
    $("input[name=optionPG19]").click(function () {
        dana = $("input[name='optionPG19']:checked").val();
	});
    $("input[name=optionPG20]").click(function () {
        dana = $("input[name='optionPG20']:checked").val();
	});
	
    $("input[name=optionPG21]").click(function () {
        dana = $("input[name='optionPG21']:checked").val();
	});
    $("input[name=optionPG22]").click(function () {
        dana = $("input[name='optionPG22']:checked").val();
	});
    $("input[name=optionPG23]").click(function () {
        dana = $("input[name='optionPG23']:checked").val();
	});
    $("input[name=optionPG24]").click(function () {
        dana = $("input[name='optionPG24']:checked").val();
	});
    $("input[name=optionPG25]").click(function () {
        dana = $("input[name='optionPG25']:checked").val();
	});
    $("input[name=optionPG26]").click(function () {
        dana = $("input[name='optionPG26']:checked").val();
	});
    $("input[name=optionPG27]").click(function () {
        dana = $("input[name='optionPG27']:checked").val();
	});
    $("input[name=optionPG28]").click(function () {
        dana = $("input[name='optionPG28']:checked").val();
	});
    $("input[name=optionPG29]").click(function () {
        dana = $("input[name='optionPG29']:checked").val();
	});
    $("input[name=optionPG30]").click(function () {
        dana = $("input[name='optionPG30']:checked").val();
	});
	
    $("input[name=optionPG31]").click(function () {
        dana = $("input[name='optionPG31']:checked").val();
	});
    $("input[name=optionPG32]").click(function () {
        dana = $("input[name='optionPG32']:checked").val();
	});
    $("input[name=optionPG33]").click(function () {
        dana = $("input[name='optionPG33']:checked").val();
	});
    $("input[name=optionPG34]").click(function () {
        dana = $("input[name='optionPG34']:checked").val();
	});
    $("input[name=optionPG35]").click(function () {
        dana = $("input[name='optionPG35']:checked").val();
	});
    $("input[name=optionPG36]").click(function () {
        dana = $("input[name='optionPG36']:checked").val();
	});
    $("input[name=optionPG37]").click(function () {
        dana = $("input[name='optionPG37']:checked").val();
	});
    $("input[name=optionPG38]").click(function () {
        dana = $("input[name='optionPG38']:checked").val();
	});
    $("input[name=optionPG39]").click(function () {
        dana = $("input[name='optionPG39']:checked").val();
	});
    $("input[name=optionPG40]").click(function () {
        dana = $("input[name='optionPG40']:checked").val();
	});
	
    $("input[name=optionPG41]").click(function () {
        dana = $("input[name='optionPG41']:checked").val();
	});
    $("input[name=optionPG42]").click(function () {
        dana = $("input[name='optionPG42']:checked").val();
	});
    $("input[name=optionPG43]").click(function () {
        dana = $("input[name='optionPG43']:checked").val();
	});
    $("input[name=optionPG44]").click(function () {
        dana = $("input[name='optionPG44']:checked").val();
	});
    $("input[name=optionPG45]").click(function () {
        dana = $("input[name='optionPG45']:checked").val();
	});
    $("input[name=optionPG46]").click(function () {
        dana = $("input[name='optionPG46']:checked").val();
	});
    $("input[name=optionPG47]").click(function () {
        dana = $("input[name='optionPG47']:checked").val();
	});
    $("input[name=optionPG48]").click(function () {
        dana = $("input[name='optionPG48']:checked").val();
	});
    $("input[name=optionPG49]").click(function () {
        dana = $("input[name='optionPG49']:checked").val();
	});
    $("input[name=optionPG50]").click(function () {
        dana = $("input[name='optionPG50']:checked").val();
	});
	
    $("input[name=optionPG51]").click(function () {
        dana = $("input[name='optionPG51']:checked").val();
	});
    $("input[name=optionPG52]").click(function () {
        dana = $("input[name='optionPG52']:checked").val();
	});
    $("input[name=optionPG53]").click(function () {
        dana = $("input[name='optionPG53']:checked").val();
	});
    $("input[name=optionPG54]").click(function () {
        dana = $("input[name='optionPG54']:checked").val();
	});
    $("input[name=optionPG55]").click(function () {
        dana = $("input[name='optionPG55']:checked").val();
	});
    $("input[name=optionPG56]").click(function () {
        dana = $("input[name='optionPG56']:checked").val();
	});
    $("input[name=optionPG57]").click(function () {
        dana = $("input[name='optionPG57']:checked").val();
	});
    $("input[name=optionPG58]").click(function () {
        dana = $("input[name='optionPG58']:checked").val();
	});
    $("input[name=optionPG59]").click(function () {
        dana = $("input[name='optionPG59']:checked").val();
	});
    $("input[name=optionPG60]").click(function () {
        dana = $("input[name='optionPG60']:checked").val();
	});
	
    $("input[name=optionPG61]").click(function () {
        dana = $("input[name='optionPG61']:checked").val();
	});
    $("input[name=optionPG62]").click(function () {
        dana = $("input[name='optionPG62']:checked").val();
	});
    $("input[name=optionPG63]").click(function () {
        dana = $("input[name='optionPG63']:checked").val();
	});
    $("input[name=optionPG64]").click(function () {
        dana = $("input[name='optionPG64']:checked").val();
	});
    $("input[name=optionPG65]").click(function () {
        dana = $("input[name='optionPG65']:checked").val();
	});
    $("input[name=optionPG66]").click(function () {
        dana = $("input[name='optionPG66']:checked").val();
	});
    $("input[name=optionPG67]").click(function () {
        dana = $("input[name='optionPG67']:checked").val();
	});
    $("input[name=optionPG68]").click(function () {
        dana = $("input[name='optionPG68']:checked").val();
	});
    $("input[name=optionPG69]").click(function () {
        dana = $("input[name='optionPG69']:checked").val();
	});
    $("input[name=optionPG70]").click(function () {
        dana = $("input[name='optionPG70']:checked").val();
	});
	
    $("input[name=optionPG71]").click(function () {
        dana = $("input[name='optionPG71']:checked").val();
	});
    $("input[name=optionPG72]").click(function () {
        dana = $("input[name='optionPG72']:checked").val();
	});
    $("input[name=optionPG73]").click(function () {
        dana = $("input[name='optionPG73']:checked").val();
	});
    $("input[name=optionPG74]").click(function () {
        dana = $("input[name='optionPG74']:checked").val();
	});
    $("input[name=optionPG75]").click(function () {
        dana = $("input[name='optionPG75']:checked").val();
	});
    $("input[name=optionPG76]").click(function () {
        dana = $("input[name='optionPG76']:checked").val();
	});
    $("input[name=optionPG77]").click(function () {
        dana = $("input[name='optionPG77']:checked").val();
	});
    $("input[name=optionPG78]").click(function () {
        dana = $("input[name='optionPG78']:checked").val();
	});
    $("input[name=optionPG79]").click(function () {
        dana = $("input[name='optionPG79']:checked").val();
	});
    $("input[name=optionPG80]").click(function () {
        dana = $("input[name='optionPG80']:checked").val();
	});
	
    $("input[name=optionPG81]").click(function () {
        dana = $("input[name='optionPG81']:checked").val();
	});
    $("input[name=optionPG82]").click(function () {
        dana = $("input[name='optionPG82']:checked").val();
	});
    $("input[name=optionPG83]").click(function () {
        dana = $("input[name='optionPG83']:checked").val();
	});
    $("input[name=optionPG84]").click(function () {
        dana = $("input[name='optionPG84']:checked").val();
	});
    $("input[name=optionPG85]").click(function () {
        dana = $("input[name='optionPG85']:checked").val();
	});
    $("input[name=optionPG86]").click(function () {
        dana = $("input[name='optionPG86']:checked").val();
	});
    $("input[name=optionPG87]").click(function () {
        dana = $("input[name='optionPG87']:checked").val();
	});
    $("input[name=optionPG88]").click(function () {
        dana = $("input[name='optionPG88']:checked").val();
	});
    $("input[name=optionPG89]").click(function () {
        dana = $("input[name='optionPG89']:checked").val();
	});
    $("input[name=optionPG90]").click(function () {
        dana = $("input[name='optionPG90']:checked").val();
	});
	
    $("input[name=optionPG91]").click(function () {
        dana = $("input[name='optionPG91']:checked").val();
	});
    $("input[name=optionPG92]").click(function () {
        dana = $("input[name='optionPG92']:checked").val();
	});
    $("input[name=optionPG93]").click(function () {
        dana = $("input[name='optionPG93']:checked").val();
	});
    $("input[name=optionPG94]").click(function () {
        dana = $("input[name='optionPG94']:checked").val();
	});
    $("input[name=optionPG95]").click(function () {
        dana = $("input[name='optionPG95']:checked").val();
	});
    $("input[name=optionPG96]").click(function () {
        dana = $("input[name='optionPG96']:checked").val();
	});
    $("input[name=optionPG97]").click(function () {
        dana = $("input[name='optionPG97']:checked").val();
	});
    $("input[name=optionPG98]").click(function () {
        dana = $("input[name='optionPG98']:checked").val();
	});
    $("input[name=optionPG99]").click(function () {
        dana = $("input[name='optionPG99']:checked").val();
	});
    $("input[name=optionPG100]").click(function () {
        dana = $("input[name='optionPG100']:checked").val();
	});
	});
	
    
	
	
	function nextSoal($idN, $idB)
	{
		$($idB).hide();
		$($idN).show();
	}
	
	function simpanSoal($idN, $idB, $id)
	{
		showLoading();
		$('#btnSave').text('Proses...'); //change button text
		$('#btnSave').attr('disabled',true); //set button enable 
		var url = "<?php echo site_url('backend/cat/saveSoal')?>/"+$id+"/"+dana;

		// ajax adding data to database
		$.ajax({
			url : url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status){
					dana = "E";
					$('#btnSave').text('Simpan'); //change button text
					$('#btnSave').attr('disabled',false); //set button enable 
					$('#jmlTerjawabTmp').text(data.jmlTerjawab);
					$('#jmlSisaSoalTmp').text(<?=$jmlSoal?> - data.jmlTerjawab);
					$('#jmlSoalTmp').text(<?=$jmlSoal?>);
					$resN = $idN.substring(1, $idN.length);
					$resB = $idB.substring(1, $idB.length);
					window.location.href = '<?=base_url()?>backend/cat/sim/'+$resN+"/"+$resB;
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				$("#alerERR").show();
				$('#btnSave').text('Login'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable 
			}
		});
	};
	
	function selesaiKerja()
	{
		showLoading();
		$('#btnSave').text('Proses...'); //change button text
		$('#btnSave').attr('disabled',true); //set button enable 
		var url = "<?php echo site_url('backend/cat/selesaiKerja')?>";

		// ajax adding data to database
		$.ajax({
			url : url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status){
					window.location.href = '<?=base_url()?>backend/hasil/paket/'+data.idParentTmp;
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				$("#alerERR").show();
				$('#btnSave').text('Login'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable 
			}
		});
	};
	</script>
	
	</script>
	
<section>
<?php if($masukInd == 'index') {?>
		<div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">&nbsp;</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 coming-soon-content">
				</div>
			</div>
		</div>
<?php } else {?>
        <div class="container">
            <div class="row">
                <div class="col-md-8 coming-soon-content">
                   <?php $idSekarang = 0; $idSelanjutnya = 0; $idTmp = ""; $coma = "";
				   foreach($soal as $s){
					   $idSekarang = $idSekarang + 1;
					   if($s->tes_detail_jawaban !== ""){
						   $idTmp = $idTmp . $coma . $idSekarang;
						   $coma = " , ";
					   }
				   }
				   $idSekarang = 0; $idSelanjutnya = 0;
				   foreach($soal as $s){
					   $indActive = "N";
						$idSekarang = $idSekarang + 1;	
						if($idSekarang == '100'){
							$idSelanjutnya = 1;	
						} else {
							$idSelanjutnya = $idSekarang + 1;	
						}
						?>
							<div class="portlet light " id="soal<?=$idSekarang?>" style="display: none">

                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase"><?=$s->soal_type;?> - <?=$s->kategori_soal_nama;?> </span>
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
                                                <label class="col-md-12">
												<?=$idSekarang?>. <?=$s->soal_pertanyaan;?>
                                                </label>
                                            </div>
											<div class="form-group">
											<div class="col-md-9">
                                                    <div class="mt-radio-list">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionPG<?=$idSekarang?>" id="optionPG<?=$idSekarang?>" value="A" > 
															A. <?=$s->soal_jawaban_a;?>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionPG<?=$idSekarang?>" id="optionPG<?=$idSekarang?>" value="B" > 
															B. <?=$s->soal_jawaban_b;?>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionPG<?=$idSekarang?>" id="optionPG<?=$idSekarang?>" value="C" > 
															C. <?=$s->soal_jawaban_c;?>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionPG<?=$idSekarang?>" id="optionPG<?=$idSekarang?>" value="D" > 
															D.<?=$s->soal_jawaban_d;?>
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="optionPG<?=$idSekarang?>" id="optionPG<?=$idSekarang?>" value="E" > 
															E. <?=$s->soal_jawaban_e;?>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions" style="margin-bottom:15px">
                                            <div class="row">
                                                <div class="col-md-6">
													<button type="button" id="btnSave" class="btn btn-info btn-circle " onclick="simpanSoal(<?="'#soal".$idSelanjutnya."'"?>, <?="'#soal".$idSekarang."'"?>, <?="'".$s->tes_detail_id."'"?>)">Simpan</button>
													<button type="button" id="btnNext" class="btn btn-info btn-circle " onclick="nextSoal(<?="'#soal".$idSelanjutnya."'"?>, <?="'#soal".$idSekarang."'"?>)">Lanjut</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
								</div>
                                <div class="portlet-title">
									<?php
									if($idSekarang <= 20){
									?>									
                                    <div class="col-md-1">
										<p>
										<a href="javascript:;" class="icon-btn" onclick="nextSoal(<?="'#soal81'"?>, <?="'#soal".$idSekarang."'"?>)">
										<<
                                        </a>
										</p>
									</div>
									<div class="col-md-10 text-center">
										<p>
									<?php
									for ($i = 1; $i <= 20; $i++) {
										if($i <= 10){
											if($i == 10){
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
										</p>
										<p>
									<?php
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
										</p>
										<p>
									<?php				
												}
											} else {
												if( strpos($idTmp, $i."") !== false ) {
									?>
													<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)">&nbsp;<?=$i?>&nbsp;</button>
									<?php			
												} else {													
									?>
													<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)">&nbsp;<?=$i?>&nbsp;</button>
									<?php			
												}
											}											
										} else {
												if(strpos($idTmp, $i."") !== false) {
									?>
													<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php
												} else {
									?>
													<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php													
												}		
										}
									}
									?>
                                        </p>
									</div>
                                    <div class="col-md-1">
										<p>
											<a href="javascript:;" class="icon-btn" onclick="nextSoal(<?="'#soal21'"?>, <?="'#soal".$idSekarang."'"?>)">
											>>
											</a>
										</p>
									</div>
									<?php
									} else if ($idSekarang <= 40 && $idSekarang > 20){
									?>									
                                    <div class="col-md-1">
										<p>
										<a href="javascript:;" class="icon-btn" onclick="nextSoal(<?="'#soal1'"?>, <?="'#soal".$idSekarang."'"?>)">
										<<
                                        </a>
										</p>
									</div>
									<div class="col-md-10 text-center">
										<p>
									<?php
									for ($i = 21; $i <= 40; $i++) {
										if($i <= 30){
											if($i == 30){
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
										</p>
										<p>
									<?php
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
										</p>
										<p>
									<?php			
												}			
											} else {
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php	
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php														
												}		
											}											
										} else {
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php		
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php															
												}
										}
									}
									?>
                                        </p>
									</div>
                                    <div class="col-md-1">
										<p>
											<a href="javascript:;" class="icon-btn" onclick="nextSoal(<?="'#soal41'"?>, <?="'#soal".$idSekarang."'"?>)">
											>>
											</a>
										</p>
									</div>
									<?php
									} else if ($idSekarang <= 60 && $idSekarang > 40){
									?>									
                                    <div class="col-md-1">
										<p>
										<a href="javascript:;" class="icon-btn" onclick="nextSoal(<?="'#soal21'"?>, <?="'#soal".$idSekarang."'"?>)">
										<<
                                        </a>
										</p>
									</div>
									<div class="col-md-10 text-center">
										<p>
									<?php
									for ($i = 41; $i <= 60; $i++) {
										if($i <= 50){
											if($i == 50){
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
										</p>
										<p>
									<?php			
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
										</p>
										<p>
									<?php																
												}
											} else {
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php			
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php			
												}
											}											
										} else {
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php		
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php		
												}
										}
									}
									?>
                                        </p>
									</div>
                                    <div class="col-md-1">
										<p>
											<a href="javascript:;" class="icon-btn" onclick="nextSoal(<?="'#soal61'"?>, <?="'#soal".$idSekarang."'"?>)">
											>>
											</a>
										</p>
									</div>
									<?php
									} else if ($idSekarang <= 80 && $idSekarang > 60){
									?>									
                                    <div class="col-md-1">
										<p>
										<a href="javascript:;" class="icon-btn" onclick="nextSoal(<?="'#soal41'"?>, <?="'#soal".$idSekarang."'"?>)">
										<<
                                        </a>
										</p>
									</div>
									<div class="col-md-10 text-center">
										<p>
									<?php
									for ($i = 61; $i <= 80; $i++) {
										if($i <= 70){
											if($i == 70){
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
										</p>
										<p>
									<?php		
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
										</p>
										<p>
									<?php		
												}	
											} else {
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php			
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php			
												}
											}											
										} else {
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php		
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php		
												}
										}
									}
									?>
                                        </p>
									</div>
                                    <div class="col-md-1">
										<p>
											<a href="javascript:;" class="icon-btn" onclick="nextSoal(<?="'#soal81'"?>, <?="'#soal".$idSekarang."'"?>)">
											>>
											</a>
										</p>
									</div>
									<?php
									}else if ($idSekarang <= 100 && $idSekarang > 80){
									?>									
                                    <div class="col-md-1">
										<p>
										<a href="javascript:;" class="icon-btn" onclick="nextSoal(<?="'#soal61'"?>, <?="'#soal".$idSekarang."'"?>)">
										<<
                                        </a>
										</p>
									</div>
									<div class="col-md-10 text-center">
										<p>
									<?php
									for ($i = 81; $i <= 100; $i++) {
										if($i <= 90){
											if($i == 90){
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
										</p>
										<p>
									<?php			
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
										</p>
										<p>
									<?php			
													
												}
											} else {
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php			
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php			
												}
											}											
										} else {
												if(strpos($idTmp, $i."") !== false) {
									?>
										<button type="button" class="btn red btn-outline active" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php		
												} else {
									?>
										<button type="button" class="btn red btn-outline" onclick="nextSoal(<?="'#soal".$i."'"?>, <?="'#soal".$idSekarang."'"?>)"><?=$i?></button>
									<?php		
												}
										}
									}
									?>
                                        </p>
									</div>
                                    <div class="col-md-1">
										<p>
											<a href="javascript:;" class="icon-btn" onclick="nextSoal(<?="'#soal1'"?>, <?="'#soal".$idSekarang."'"?>)">
											>>
											</a>
										</p>
									</div>
									<?php
									}
									?>
                                    
								</div>
							</div>
				   <?php }?>
                </div>
				<div class="col-md-4 coming-soon-content">
                   
                            <div class="portlet light ">
								
                                <div class="portlet-title">
                                    <div class="caption font-dark col-md-12">
										<button type="submit" id="btnFinish" class="btn btn-info btn-circle col-md-12" onclick="showModal()">Selesai</button>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-title">
								
                                    <!-- BEGIN FORM-->
                                    <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>Sudah Dijawab</td>
                                                    <td class="text-center">
														<label class="btn btn-transparent blue btn-outline btn-circle btn-sm active" id="jmlTerjawabTmp"></label>
													</td>
                                                </tr>
                                                <tr>
                                                    <td>Belum Dijawab</td>
                                                    <td class="text-center">
														<label class="btn btn-transparent red btn-outline btn-circle btn-sm active" id="jmlSisaSoalTmp"></label>
													</td>
                                                </tr>
                                                <tr>
                                                    <td>Total Soal</td>
                                                    <td class="text-center">
														<label class="btn btn-transparent red btn-outline btn-circle btn-sm" id="jmlSoalTmp"></label>
													</td>
                                                </tr>
												</tbody>
                                        </table>
                                    <!-- END FORM-->
								</div>
                                <div class="portlet-title">
                                    <div class="caption font-dark col-md-12">													
												<div id="timer" class="control-label" style="font-size: 25px"></div>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
							</div>
                </div>
				<div id="viewDetail" class="modal bd-example-modal-sm" style="display: none;">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ujian CAT</h4>
                                </div>
                                <div class="modal-body">
									<form action="#" class="form-horizontal form-row-seperated" id="formNya">
									<input type="text" name="id" hidden /> 
										<div class="form-group">
                                            <label class="control-label col-md-12"  style="text-align: left !important;">Apakah anda yakin sudah menyelesaikan ujian ini ?
                                            </label>
										</div>
									</form>
								</div>
                                <div class="modal-footer">
									<button type="button" id="btnKerjakan" class="btn green" onclick="selesaiKerja();"><i class="fa fa-check"></i> Ya</button>
									<button type="button" class="btn grey-salsa btn-outline" onclick="hideModal();">Tidak</button>
                                </div>
							</div>
						</div>
					</div>
					
            </div>
        </div>
<?php } ?>
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