<?php
$msgAlert = "";
$msgAlertErr = "";
$ada = false;
/* admin */
if($this->session->userdata('user_akses')=='S')
{
	$ada = true;
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
                                    <a href="<?=base_url();?>backend/beranda"> Kembali ke dashboard </a></p>
                            </div>
                        </div>
                    </div>
<?php }else{ ?>

<script src="<?=base_url();?>asset/pages/js/form-validation-paket-selesai.js" type="text/javascript"></script>

<script>
var save_method;
var table;

$(document).ready(function() {
    //datatables
	reset();
    showLoading();
	$("#data").show();
	table = $('#table').DataTable({ 
		"retrieve": true,
		"destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('backend/paketSelesai/loadTable')?>",
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
	hideLoading();
});

function load(){
    showLoading();
	reset();
	$("#data").show();
	$('#table').DataTable().ajax.reload();
	hideLoading();
}

function reset() {
	$("#data").hide();
	$("#inputan").hide();
	$("#alerSKS").hide();
	$("#alerERR").hide();
    $('[name="paket_parent_nama"]').val("");
    $('[name="paket_parent_ket"]').val("");
    $('[name="paket_parent_durasi"]').val("");
};


function showTampilkanData() {
	showLoading();
	reset();
	$("#tampilkanData").show();
	hideLoading();
};

function show(id)
{
	showLoading();
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('backend/paketSelesai/prepareTampilkanData')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			showTampilkanData();
            $('[name="id"]').val(data.paket_parent_id);
            $('[name="paket_parent_nama"]').val(data.paket_parent_nama);
            $('[name="paket_parent_ket"]').val(data.paket_parent_ket);
            $('[name="paket_parent_durasi"]').val(data.paket_parent_durasi);
			$jenisPaket = "";
			if(data.paket_parent_ind == 'F'){
				$jenisPaket = "Free";
			} else if(data.paket_parent_ind == 'P'){
				$jenisPaket = "Premium";
			}
            $('[name="paket_parent_ind"]').val($jenisPaket);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
	table = $('#tableSoal').DataTable({ 
		"retrieve": true,
		"destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('backend/paketSelesai/loadTableSoalView')?>/" + id,
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
};
</script>
                    <div class="row" id="data" style="display:none;">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase"><?= $title; ?></span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
								<div id="alerSKS" class="custom-alerts alert alert-success fade in">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
										<p id="msgSKS"></p>
									</div>
									<div id="alerERR" class="custom-alerts alert alert-warning fade in">
										<button type="button" class="close" data-dismiss="alert" >x</button>
										<p id="msgERR"></p>
									</div>
                                <div class="portlet-body">
                                    <table id="table" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                        <thead>
                                            <tr>
                                                <th class="all" width="2%">No</th>
                                                <th class="all">Nama</th>
                                                <th class="min-phone-l">Jenis</th>
                                                <th class="min-phone-l">Keterangan</th>
                                                <th class="all">Lihat Solusi Soal</th>
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
                
					
					<div class="row" id="tampilkanData" style="display:none;">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase"><?= $titleInputan; ?></span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
								
                                    <!-- BEGIN FORM-->
                                    <form id="formTampilkan" class="form-horizontal" autocomplete="off">
									    <input type="text" name="id" hidden /> 
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> Inputan masih belum sesuai. Mohon periksa kembali ! </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Sukses ! 
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-2">Nama
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="paket_parent_nama" data-required="1" class="form-control" readonly/> 
												</div>
                                                <label class="control-label col-md-2">Durasi (.min)
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="paket_parent_durasi" data-required="1" class="form-control" readonly/> 
												</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Keterangan
                                                </label>
                                                <div class="col-md-10">
													<textarea class="form-control" name="paket_parent_ket" readonly></textarea>
												</div>
											</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Jenis Paket
                                                </label>
                                                <div class="col-md-10">
													<input type="text" name="paket_parent_ind" data-required="1" class="form-control" readonly/> 
												</div>
											</div>
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase">DAFTAR SOAL</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table id="tableSoal" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                        <thead>
                                            <tr>
                                                <th class="all" width="2%">No</th>
                                                <th class="all" width="10%">Type Soal</th>
                                                <th class="all" width="10%">Kategori</th>
                                                <th class="min-phone-l" width="80%">Soal</th>
                                                <th class="min-phone-l" width="80%">Jawaban</th>
                                                <th class="min-phone-l" width="80%">Kunci Jawaban</th>
                                                <th class="min-phone-l" width="80%">Penyelesaian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										</tbody>
									</table>
                                </div>
											
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
													<a class="btn default" href="<?=base_url();?>backend/paketSelesai">Tutup</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
								</div>
							</div>
						</div>
					</div>
<?php } ?>
