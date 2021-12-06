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
	$ada = true;
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
	table = $('#table').DataTable({ 
		"retrieve": true,
		"bFilter": true,
		"bPaginate": true,
		"destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('backend/beranda/loadTableJadwalUjian')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });
	$('#tableNilaiUjianTidak').DataTable({ 
		"retrieve": true,
		"bFilter": true,
		"bPaginate": true,
		"destroy": true
	});
	$('#tableNilaiUjianLulus').DataTable({ 
		"retrieve": true,
		"bFilter": true,
		"bPaginate": true,
		"destroy": true
	});
});

function lihatHasil(idUjian){
	
}
</script>
<div class="row">
<?php
if($ind == 'AG'){
?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span><?=$jmlSiswa?></span>
                                        </h3>
                                        <small>Jumlah Siswa</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span><?=$jmlGuru?></span>
                                        </h3>
                                        <small>Jumlah Guru</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 100%;" class="progress-bar progress-bar-success red-haze">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span><?=$jmlUjianAkanDatang?></span>
                                        </h3>
                                        <small>Jml Ujian Mendatang</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-book"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 100%;" class="progress-bar progress-bar-success blue-sharp">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span><?=$jmlUjianBerlangsung?></span>
                                        </h3>
                                        <small>Jml Ujian Berlangsung</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-book"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 100%;" class="progress-bar progress-bar-success purple-soft">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
<?php
} else if ($ind == 'S'){
?>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span><?=$jmlFreePaketSelesai?></span>
                                        </h3>
                                        <small>Paket Free Selesai</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-clone"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 100%;" class="progress-bar progress-bar-success blue-sharp">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span><?=$jmlPremiumPaketSelesai?></span>
                                        </h3>
                                        <small>Paket Premium Selesai</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-clone"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 100%;" class="progress-bar progress-bar-success blue-sharp">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span><?=$jmlUjianAkanDatang?></span>
                                        </h3>
                                        <small>Jml Ujian Mendatang</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-book"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 100%;" class="progress-bar progress-bar-success blue-sharp">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span><?=$jmlUjianBerlangsung?></span>
                                        </h3>
                                        <small>Jml Ujian Berlangsung</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-book"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 100%;" class="progress-bar progress-bar-success purple-soft">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
}
?>

					<div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase">Jadwal Ujian</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
								<div class="portlet-body">
                                    <table id="table" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                        <thead>
                                            <tr>
                                                <th class="all" width="2%">No</th>
                                                <th class="all">Nama Ujian</th>
                                                <th class="min-phone-l">Tgl Mulai</th>
                                                <th class="min-phone-l">Tgl Akhir</th>
                                                <th class="min-phone-l">Keterangan</th>
                                                <th class="min-phone-l">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										</tbody>
									</table>                                    
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div> 
					
<?php 
if ($ind == 'S') { ?>
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
                                                <th class="all">Nama Ujian</th>
                                                <th class="min-phone-l">TWK</th>
                                                <th class="min-phone-l">TIU</th>
                                                <th class="min-phone-l">TKP</th>
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
												<th><?=$s->namaUjian?></th>
												<th><?=$s->nilaiTKW?></th>
												<th><?=$s->nilaiTIU?></th>
												<th><?=$s->nilaiTKP?></th>
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
                                                <th class="all">Nama Ujian</th>
                                                <th class="min-phone-l">TWK</th>
                                                <th class="min-phone-l">TIU</th>
                                                <th class="min-phone-l">TKP</th>
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
												<th><?=$s->namaUjian?></th>
												<th><?=$s->nilaiTKW?></th>
												<th><?=$s->nilaiTIU?></th>
												<th><?=$s->nilaiTKP?></th>
											</tr>
										<?php } ?>
										</tbody>
									</table>                                    
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div> 
<?php }
} ?>
