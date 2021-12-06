<?php
if($this->session->userdata('user_id')=='')
{
    redirect('login');
}
?>

<script>
function save($id)
{
	showLoading();
    var url = "<?php echo site_url('profile/kerjakan')?>"+"/"+$id;
	$("#msgSKS").text("Data Berhasil Ditambah !!");
	$("#msgERR").text("Paket Tidak Bisa Diambil !!");
	$idBtn = "#btnKerja".$id;
		$($idBtn).text('Kerjakan...'); //change button text
		$($idBtn).attr('disabled',true); //set button disable 

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
				$("#alerSKS").show();
				$("#msgSKS").text(data.msg);
				window.location.href = '<?=base_url()?>cat';
            } else
			{
				$("#alerERR").show();				
				$("#msgERR").text(data.msg);
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			$("#alerERR").show();

        }
    });
};

function goToHasil($id)
{
	window.location.href = '<?=base_url()?>hasil/paket/'+$id;
};


function lanjutCAT(){
	window.location.href = '<?=base_url()?>cat';
}
</script>

	<section class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">&nbsp</h2>
                    <h2 class="section-heading">Profile</h2>
                    <h2 class="section-heading">&nbsp</h2>
                </div>
            </div>
            <div class="row">
								<div id="alerSKS" class="custom-alerts alert alert-success fade in" style="display: none">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
										<p id="msgSKS"></p>
									</div>
									<div id="alerERR" class="custom-alerts alert alert-warning fade in" style="display: none">
										<button type="button" class="close" data-dismiss="alert" >x</button>
										<p id="msgERR"></p>
									</div>
			<form id="form" class="form-horizontal" autocomplete="off">
               
			<?php				
				foreach ($paketParent as $r)
				{
					$ind = 'A';
					foreach($tesParent as $t)
					{
						if($r->paket_parent_id == $t->tes_parent_paket_parent_id)
						{
							$ind = $t->tes_parent_ind;
							break;
						}
					}
					if($ind == 'Y')
					{
						echo '<div class="col-md-4 col-sm-6 portfolio-item">
							<div class="portfolio-caption">
								<h4>'. $r->paket_parent_nama .'</h4>
								<a class="btn btn-sm btn-info" href="#" title="Kerjakan" onclick="goToHasil('."'".$r->paket_parent_id."'".')"" >Sudah Dikerjakan</a>
							</div>
						</div>';
					} 
					else if($ind == 'N')
					{
						echo '<div class="col-md-4 col-sm-6 portfolio-item">
							<div class="portfolio-caption">
								<h4>'. $r->paket_parent_nama .'</h4>
								<a class="btn btn-sm btn-warning" href="#" title="Kerjakan" href="javascript:void(0)" title="Lihat" onclick="lanjutCAT()" >Belum Selesai</a>
							</div>
						</div>';
					}
					else
					{
						echo '<div class="col-md-4 col-sm-6 portfolio-item">
							<div class="portfolio-caption">
								<h4>'. $r->paket_parent_nama .'</h4>
								<a class="btn btn-sm btn-danger" id="btnKerja'.$r->paket_parent_id.'" href="javascript:void(0)" title="Kerjakan" onclick="save('."'".$r->paket_parent_id."'".')">Kerjakan</a>
							</div>
						</div>';	
					}
					
				}
			?>
                    </form>
                
            </div>
			
			<div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">&nbsp</h2>
                    <h2 class="section-heading">Ujian</h2>
                    <h2 class="section-heading">&nbsp</h2>
                </div>
            </div>
            <div class="row">
								<div id="alerSKS" class="custom-alerts alert alert-success fade in" style="display: none">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
										<p id="msgSKS"></p>
									</div>
									<div id="alerERR" class="custom-alerts alert alert-warning fade in" style="display: none">
										<button type="button" class="close" data-dismiss="alert" >x</button>
										<p id="msgERR"></p>
									</div>
			<form id="form" class="form-horizontal" autocomplete="off">
               
			<?php				
				foreach ($paketParentUjian as $r)
				{
					$ind = 'A';
					foreach($tesParentUjian as $t)
					{
						if($r->paket_parent_id == $t->tes_parent_paket_parent_id)
						{
							$ind = $t->tes_parent_ind;
							break;
						}
					}
					if($ind == 'Y')
					{
						echo '<div class="col-md-4 col-sm-6 portfolio-item">
							<div class="portfolio-caption">
								<h4>'. $r->paket_parent_nama .'</h4>
								<a class="btn btn-sm btn-info" href="#" title="Kerjakan" onclick="goToHasil('."'".$r->paket_parent_id."'".')"" >Sudah Dikerjakan</a>
							</div>
						</div>';
					} 
					else if($ind == 'N')
					{
						echo '<div class="col-md-4 col-sm-6 portfolio-item">
							<div class="portfolio-caption">
								<h4>'. $r->paket_parent_nama .'</h4>
								<a class="btn btn-sm btn-warning" href="#" title="Kerjakan" href="javascript:void(0)" title="Lihat" onclick="lanjutCAT()" >Belum Selesai</a>
							</div>
						</div>';
					}
					else
					{
						echo '<div class="col-md-4 col-sm-6 portfolio-item">
							<div class="portfolio-caption">
								<h4>'. $r->paket_parent_nama .'</h4>
								<a class="btn btn-sm btn-danger" id="btnKerja'.$r->paket_parent_id.'" href="javascript:void(0)" title="Kerjakan" onclick="save('."'".$r->paket_parent_id."'".')">Kerjakan</a>
							</div>
						</div>';	
					}
					
				}
			?>
                    </form>
                
            </div>
        </div>
    </section>