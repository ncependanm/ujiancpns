<?php
$msgAlert = "";
$msgAlertErr = "";
$ada = false;
/* admin */
if($this->session->userdata('user_akses')=='A')
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

<script src="<?=base_url();?>asset/pages/js/form-validation-siswa.js" type="text/javascript"></script>

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
            "url": "<?php echo site_url('backend/siswa/loadTable')?>",
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
	$("#passTmp").hide();
    $('[name="user_nama"]').val("");
    $('[name="user_email"]').val("");
    $('[name="user_username"]').val("");
    $('[name="user_no_hp"]').val("");
    $('[name="user_password"]').val("");
};

function showInputan() {
	showLoading();
	reset();
	$("#inputan").show();
    $('[name="user_nama"]').focus();
	hideLoading();
};

function showData() {
	showLoading();
	reset();
	$("#data").show();
    $('[name="user_nama"]').focus();
	hideLoading();
};

function add()
{
	showLoading();
	showInputan();
    save_method = 'add';
	$("#passTmp").show();
	hideLoading();
};

function edit(id)
{
	showLoading();
    save_method = 'update';
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('backend/siswa/prepareEdit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			showInputan();
			$("#passTmp").show();
            $('[name="id"]').val(data.user_id);
            $('[name="user_nama"]').val(data.user_nama);
            $('[name="user_email"]').val(data.user_email);
            $('[name="user_username"]').val(data.user_username);
            $('[name="user_no_hp"]').val(data.user_no_hp);
            $('[name="user_password"]').val("-");
            $('[name="user_tgl_lahir"]').val(data.user_tgl_lahir);
            $('[name="user_asal_sekolah"]').val(data.user_asal_sekolah);
            $('[name="user_kelas"]').val(data.user_kelas);
            $('[name="user_alamat"]').val(data.user_alamat);
            $('[name="user_ind"]').val(data.user_ind);

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
};

function save()
{
	showLoading();
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('backend/siswa/save')?>";
		$("#msgSKS").text("Data Berhasil Ditambah !!");
		$("#msgERR").text("Data Gagal Ditambah !!");
    } else {
        url = "<?php echo site_url('backend/siswa/update')?>";
		$("#msgSKS").text("Data Berhasil Diubah !!");
		$("#msgERR").text("Data Gagal Diubah !!");
    }

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
				load();
				$("#alerSKS").show();
            } else {
				load();
				$("#alerERR").show();
				$("#msgERR").text(data.msg);
			}

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			$("#alerERR").show();
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
};

$(document).on("click","#hapusData",function(){
	var id=$(this).attr("data-id");
	swal({
		title:"Hapus Data",
		text:"Yakin akan menghapus data ini?",
		type: "warning",
		showCancelButton: true,
		confirmButtonText: "Hapus",
		closeOnConfirm: true,
	},
		function(){
		 $.ajax({
			url:"<?php echo site_url('backend/siswa/delete');?>"+'/'+id,
			data: id,
			success: function(data){
				load();
				$("#msgSKS").text("Data Berhasil Dihapus !!");
				$("#alerSKS").show();
			} ,
			error: function ()
			{
				$("#msgERR").text("Data Gagal Dihapus !!");
				$("#alerERR").show();
			}
		 });
	});
});

function importData()
{
	showLoading();
	showImport();
    save_method = 'add';
	$("#passTmp").show();
	hideLoading();
};

function showImport() {
	resetImport();
	$("#import").show();
};

function resetImport(){	
	$("#data").hide();
	$("#import").hide();
	$("#alerSKS").hide();
	$("#alerERR").hide();
	$("#passTmp").hide();
}

<?php echo $this->session->flashdata('msg'); ?>
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
								<div class="portlet-title" style="border-bottom: none !important;">
                                    <button type="button" class="btn btn-primary" onclick="add();">Tambah</button>

                                    <button type="button" class="btn btn-primary" onclick="importData();">Import</button>
                                </div>
                                <div class="portlet-body">
                                    <table id="table" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                        <thead>
                                            <tr>
                                                <th class="all" width="2%">No</th>
                                                <th class="all">Nama</th>
                                                <th class="min-phone-l">Email</th>
                                                <th class="min-phone-l">Username</th>
                                                <th class="min-phone-l">No Hp</th>
                                                <th class="min-phone-l">Tgl Lahir</th>
                                                <th class="min-phone-l">Asal Sekolah</th>
                                                <th class="min-phone-l">Kelas</th>
                                                <th class="min-phone-l">Alamat</th>
                                                <th class="all">Status Siswa</th>
                                                <th class="all">Foto</th>
                                                <th class="all">Status</th>
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
                                    <form id="form" class="form-horizontal" autocomplete="off">
									    <input type="text" name="id" hidden /> 
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> Inputan masih belum sesuai. Mohon periksa kembali ! </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Sukses ! </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Nama
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_nama" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-2">No Hp
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_no_hp" data-required="1" class="form-control" /> 
												</div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-2">Email
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_email" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-2">Username
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_username" data-required="1" class="form-control" /> 
												</div>
                                            </div>
											<div class="form-group">
                                                <label class="control-label col-md-2">Tanggal Lahir
                                                    <span class="required"> * </span>
                                                </label>
												<div class="col-md-4">
                                                    <input type="text" placeholder="yyyy-mm-dd" name="user_tgl_lahir" class="tanggal form-control" readonly  />
                                                </div>
												<div id="passTmp">
                                                <label class="control-label col-md-2">Password
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="password" name="user_password" maxlength="20" data-required="1" class="form-control" /> 
												</div>
												</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Asal Sekolah
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_asal_sekolah" maxlength="30" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-2">Kelas
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_kelas" maxlength="3" data-required="1" class="form-control" /> 
												</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Status Siswa
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">                                                    
                                                    <select class="form-control" id="user_ind" name="user_ind">
														<option value="F">Free</option>
														<option value="D">Deluxe</option>
														<option value="S">Super</option>
														<option value="P">Premium</option>
                                                    </select> 
												</div>
                                                <label class="control-label col-md-2">Alamat
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <textarea name="user_alamat" maxlength="250" class="form-control"></textarea> 
												</div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
													<button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                                                    <!--<button type="button" class="btn default" onclick="showData();">Cancel</button>-->
													<a class="btn default" href="<?=base_url();?>backend/siswa">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
								</div>
							</div>
						</div>
					</div>
					
					<div class="row" id="import" style="display:none;">
                        <div class="col-md-6">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase">Import dari Excel</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
									<form class="form-horizontal">
										<div class="form-body">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Ketentuan Upload
                                                </label>
                                                <div class="col-md-8">
													<p class="control-label" style="text-align: left !important;">Downloadlah file .xls yang sudah disediakan sebagai template, nanti tinggal masukan semua data yang diperlukan sesuaikan dengan kolom yang tersedia di template,
													jangan merubah struktur kolom nya, karena itu sudah dibuat default demikian. </br>
													Catatan, ada satu baris data contoh, itu bisa di hapus saja jika sudah mengerti !</br>
													<a href="<?=base_url()?>/asset/upload_user.xls">Download template disini !!</a></p>
												</div>
                                            </div>
                                        </div>
									</form>
                                    <!-- BEGIN FORM-->
									<form class="form-horizontal" action="<?php echo base_url();?>backend/siswa/upload/" enctype="multipart/form-data" method="post">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Upload Data
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
													<input type="file" name="file" class="form-control" />
												</div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
													<button type="submit" id="btnImport" class="btn btn-primary">import</button>
                                                    <!--<button type="button" class="btn default" onclick="showData();">Cancel</button>-->
													<a class="btn default" href="<?=base_url();?>backend/siswa">Cancel</a>
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
