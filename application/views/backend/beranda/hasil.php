<?php
$msgAlert = "";
$msgAlertErr = "";
$ada = false;
$ind = 'AG';
/* admin */
if($this->session->userdata('user_akses')=='A')
{
	$ada = true;
}
/* guru */
if($this->session->userdata('user_akses')=='G')
{
	$ada = false;
}
/* siswa */
if($this->session->userdata('user_akses')=='S')
{
	$ada = true;
	$ind = 'S';
}
if(!$ada){
	?>
					<div class="row">
                        <div class="col-md-12 page-404">
                            <div class="number font-green">  </div>
                            <div class="details">
                                <h3>Terjadi kesalahan</h3>
                                <p> Maaf, anda tidak dapat mengakses halaman ini.
                                    <br>
                                    <a href="index.html"> Kembali ke dashboard </a></p>
                            </div>
                        </div>
                    </div>
<?php }else{ ?>

<script>

$(document).ready(function() {
    //datatables
	$('#tableNilaiUjianTidak').DataTable({ 
		"retrieve": true,
		"bFilter": true,
		"bPaginate": true,
		"destroy": true,
		"dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
	});
	$('#tableNilaiUjianLulus').DataTable({ 
		"retrieve": true,
		"bFilter": true,
		"bPaginate": true,
		"destroy": true,
		"dom": 'Bfrtip',
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
	});
});
</script>				
<div class="row">
                        <div class="col-md-6">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase">Ranking Lulus</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
								<div class="portlet-body">
                                    <table id="tableNilaiUjianLulus" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                        <thead>
                                            <tr>
                                                <th class="all" width="2%">No</th>
                                                <th class="all">Nama Peserta</th>
                                                <th class="min-phone-l">Email</th>
                                                <th class="min-phone-l">Sekolah</th>
                                                <th class="all">Nama Ujian</th>
                                                <th class="all">TWK</th>
                                                <th class="all">TIU</th>
                                                <th class="all">TKP</th>
                                                <th class="min-phone-l">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php $i=0; foreach($dataLulus as $s){ $i = $i +1;?>
											<?php if($this->session->userdata('user_nama') == $s->namaUser){?>
											<tr class="success">
											<?php } else { ?>
											<tr>
											<?php } ?>
												<th><?=$i?></th>
												<th><?=$s->namaUser?></th>
												<th><?=$s->emailUser?></th>
												<th><?=$s->asalSekolah?></th>
												<th><?=$s->namaUjian?></th>
												<th><?=$s->nilaiTKW?></th>
												<th><?=$s->nilaiTIU?></th>
												<th><?=$s->nilaiTKP?></th>
												<th><?=$s->nilaiTotal?></th>
											</tr>
										<?php } ?>
										</tbody>
									</table>                                    
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
						<div class="col-md-6">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase">Ranking Gagal</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
								<div class="portlet-body">
                                    <table id="tableNilaiUjianTidak" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                        <thead>
                                            <tr>
                                                <th class="all" width="2%">No</th>
                                                <th class="all">Nama Peserta</th>
                                                <th class="min-phone-l">Email</th>
                                                <th class="min-phone-l">Sekolah</th>
                                                <th class="all">Nama Ujian</th>
                                                <th class="all">TWK</th>
                                                <th class="all">TIU</th>
                                                <th class="all">TKP</th>
                                                <th class="min-phone-l">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php $i=0; foreach($dataGagal as $s){ $i = $i +1;?>
											<?php if($this->session->userdata('user_nama') == $s->namaUser){?>
											<tr class="success">
											<?php } else { ?>
											<tr>
											<?php } ?>
												<th><?=$i?></th>
												<th><?=$s->namaUser?></th>
												<th><?=$s->emailUser?></th>
												<th><?=$s->asalSekolah?></th>
												<th><?=$s->namaUjian?></th>
												<th><?=$s->nilaiTKW?></th>
												<th><?=$s->nilaiTIU?></th>
												<th><?=$s->nilaiTKP?></th>
												<th><?=$s->nilaiTotal?></th>
											</tr>
										<?php } ?>
										</tbody>
									</table>                                    
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div> 
                                        <div class="form-actions" style="margin-bottom:15px">
                                            <div class="row">
                                                <div class="col-md-12 text-center" >
													<a class="btn default" href="<?=base_url();?>backend/beranda">Kembali</a>
                                                </div>
                                            </div>
                                        </div>
<?php
} ?>
