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

<script src="<?=base_url();?>asset/pages/js/form-validation-ujian.js" type="text/javascript"></script>

<script>
var save_method;
var table;

$(document).ready(function() {
	reset();
    //datatables
    showLoading();
	$("#data").show();
	loadTable("S");
	loadTableFree();
	$("#judulTable").text("Data Ujian yang sedang berlangsung");
	hideLoading();
});

function loadTable(ind)
{
	if(ind == 'S'){
		$("#judulTable").text("Data Ujian yang sedang berlangsung");
	} else 	if(ind == 'M'){
		$("#judulTable").text("Data Ujian yang akan datang");
	} else 	if(ind == 'L'){
		$("#judulTable").text("Data Ujian yang sudah lewat");
	}
    showLoading();
    table = $('#table').DataTable({ 
		"destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('backend/ujianKu/loadTable')?>/"+ind,
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
}

function loadTableFree()
{
    showLoading();
    table = $('#tableFree').DataTable({ 
		"destroy": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('backend/ujianKu/loadTableUjianFree')?>",
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
}

function reset() {
	$("#data").hide();
	$("#inputan").hide();
	$("#alerSKS").hide();
	$("#alerERR").hide();
    $('[name="ujian"]').val("");
};

function showModal(){
	$("#viewDetail").fadeIn(600);
}
function hideModal(){
	$("#viewDetail").fadeOut(300);
}

function view(id, ind, ujianInd)
{
	showLoading();
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('backend/ujianKu/prepareEdit')?>/" + id +"/"+ ujianInd,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			showModal();
			if(data.status){
				$('#formNya').show();
				$('#tmpMsg').hide();
				$('[name="id"]').val(data.data.idPaket);
				$('[name="ujian_nama_modal"]').val(data.data.nama);
				$('[name="ujian_tgl_mulai_modal"]').val(data.data.mulai);
				$('[name="ujian_tgl_akhir_modal"]').val(data.data.akhir);
				$('[name="ujian_durasi_modal"]').val(data.data.durasi+" Menit");
				$('[name="ujian_jml_soal_modal"]').val(data.data.jmlSoal);
				if(ind == 'K') {
					$('#footerModal').html('<button type="button" class="btn grey-salsa btn-outline" onclick="hideModal();">Tutup</button><button type="button" id="btnKerjakan" class="btn green" onclick="kerjakan('+ data.data.idPaket +');"><i class="fa fa-check"></i> Ikuti</button>');				
				} else if(ind == 'L') {
					$('#footerModal').html('<button type="button" class="btn grey-salsa btn-outline" onclick="hideModal();">Tutup</button>');
				}				
			} else {
				$('#formNya').hide();
				$('#tmpMsg').show();
				$('#msg').text(data.msg);
					$('#footerModal').html('<button type="button" class="btn grey-salsa btn-outline" onclick="hideModal();">Tutup</button>');
				
			}
			hideLoading();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
};

function kerjakan($id)
{
	showLoading();
    var url = "<?php echo site_url('backend/ujianKu/kerjakan')?>"+"/"+$id;
	$("#msgSKS").text("Data Berhasil Ditambah !!");
	$("#msgERR").text("Paket Tidak Bisa Diambil !!");
	$idBtn = "#btnKerjakan".$id;
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
				hideModal();
				$("#alerSKS").show();
				$("#msgSKS").text(data.msg);
				window.location.href = '<?=base_url()?>backend/cat';
            } else
			{
				hideModal();
				$("#alerERR").show();				
				$("#msgERR").text(data.msg);
				hideLoading();
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			hideModal();
			$("#alerERR").show();
			hideLoading();

        }
    });
};

function viewHasil($id){
	showLoading();
	$("#data").hide();
	//Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('backend/ujianKu/prepareTampilkanData')?>/" + $id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$("#tampilkanData").show();
            $('[name="id"]').val(data.ujian_id);
            $('[name="paket_parent_nama"]').val(data.ujian_nama);
            $('[name="paket_parent_durasi"]').val(data.ujian_durasi);
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
"dom": 'Bfrtip',
        "buttons": [
            'excel', 'pdf'
        ],

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('backend/ujianKu/loadTableSoalView')?>/" + $id,
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
}

</script>
                    <div class="row" id="data" style="display:none;">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase" id="judulTable"></span>
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
								<div class="portlet-title" style="border-bottom: none !important;">
                                    <button type="button" class="btn btn-primary" onclick="loadTable('S');">Lihat Ujian Berlangsung</button>
                                    <button type="button" class="btn btn-primary" onclick="loadTable('M');">Lihat Ujian Mendatang</button>
                                    <button type="button" class="btn btn-primary" onclick="loadTable('L');">Lihat Ujian Sudah Lewat</button>
                                </div>
                                <div class="portlet-body">
                                    <table id="table" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                        <thead>
                                            <tr>
                                                <th class="all" width="2%">No</th>
                                                <th class="all" width="10%">Nama Ujian</th>
                                                <th class="all" width="10%">Type Ujian</th>
                                                <th class="min-phone-l" width="10%">Tgl Mulai</th>
                                                <th class="min-phone-l" width="10%">Tgl Akhir</th>
                                                <th class="min-phone-l" width="10%">Durasi</th>
                                                <th class="min-phone-l" width="10%">Keterangan</th>
                                                <th class="all" width="15%">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										</tbody>
									</table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
						
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase">DATA UJIAN FREE</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table id="tableFree" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                        <thead>
                                            <tr>
                                                <th class="all" width="2%">No</th>
                                                <th class="all" width="10%">Nama Ujian</th>
                                                <th class="all" width="10%">Type Ujian</th>
                                                <th class="min-phone-l" width="10%">Durasi</th>
                                                <th class="min-phone-l" width="10%">Keterangan</th>
                                                <th class="all" width="15%">Opsi</th>
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
                
					<div class="row" id="inputan" style="display:none;">
                        <div class="col-md-6">
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
                                    <form id="form" class="form-horizontal" autocomplete="off">
									    <input type="text" name="id" hidden /> 
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> Inputan masih belum sesuai. Mohon periksa kembali ! </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Sukses ! 
											</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Paket Soal
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="ujian_paket_parent_id" name="ujian_paket_parent_id">
                                                    </select> 
												</div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-3">Nama
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" name="ujian_nama" data-required="1" class="form-control" /> 
												</div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-3">Tanggal Mulai
                                                    <span class="required"> * </span>
                                                </label>
												<div class="col-md-9">
                                                    <input type="text" placeholder="yyyy-mm-dd" name="ujian_tgl_mulai" class="tanggal form-control" readonly  />
                                                </div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-3">Tanggal Akhir
                                                    <span class="required"> * </span>
                                                </label>
												<div class="col-md-9">
                                                    <input type="text" placeholder="yyyy-mm-dd" name="ujian_tgl_akhir" class="tanggal form-control" readonly  />
                                                </div>
											</div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
													<button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                                                    <!--<button type="button" class="btn default" onclick="showData();">Cancel</button>-->
													<a class="btn default" href="<?=base_url();?>backend/kategori">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
								</div>
							</div>
						</div>
					</div>
					<!-- Modal [S]-->
					<div id="viewDetail" class="modal bd-example-modal-lg" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Detail Ujian</h4>
                                </div>
                                <div class="modal-body">
									<form class="form-horizontal form-row-seperated" id="tmpMsg">
									<div class="form-group">
                                        <label class="col-md-12 text-center"><p style="font-size: 18px" id="msg"></p>
                                        </label>
									</div>
									</form>
									<form action="#" class="form-horizontal form-row-seperated" id="formNya">
									<input type="text" name="id" hidden /> 
										<div class="form-group">
                                            <label class="control-label col-md-2">Nama Ujian
                                            </label>
											<div class="col-md-4">
                                                <input type="text" name="ujian_nama_modal" class="form-control" readonly  />
                                            </div>
												<label class="control-label col-md-2">Durasi
                                                </label>
											<div class="col-md-4">
                                                <input type="text" name="ujian_durasi_modal" class="form-control" readonly  />
                                            </div>
										</div>
										<div class="form-group">
                                            <label class="control-label col-md-2">Tanggal Mulai
                                            </label>
											<div class="col-md-4">
                                                <input type="text" name="ujian_tgl_mulai_modal" class="form-control" readonly  />
                                            </div>
												<label class="control-label col-md-2">Tanggal Berakhir
                                                </label>
											<div class="col-md-4">
                                                <input type="text" name="ujian_tgl_akhir_modal" class="form-control" readonly  />
                                            </div>
										</div>
										<div class="form-group">
                                            <label class="control-label col-md-2">Jumlah Soal
                                            </label>
											<div class="col-md-4">
                                                <input type="text" name="ujian_jml_soal_modal" class="form-control" readonly  />
                                            </div>
										</div>
									</form>
								</div>
                                <div class="modal-footer" id="footerModal">
                                </div>
							</div>
						</div>
					</div>
					<!-- Modal [E]-->
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
<br/><br/><br/>
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
													<a class="btn default" href="<?=base_url();?>backend/ujianKu">Tutup</a>
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
