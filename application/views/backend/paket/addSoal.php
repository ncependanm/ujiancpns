<?php
$msgAlert = "";
$msgAlertErr = "";
$ada = false;
/* admin */
if($this->session->userdata('user_akses')=='A')
{
	$ada = true;
}
if($this->session->userdata('user_akses')=='G')
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

<script>
var save_method;
var table;

$(document).ready(function() {
    //datatables
	reset();
    showLoading();
	$("#data").show();
	$("#jmlSoalTmp").text(<?=$jmlSoalTmp?>);
	hideLoading();
});

function loadTable(){
	$("#kategoriTmpSoal").val($('[name="soal_type"]').val());
	table = $('#table').DataTable({
		"destroy": true,
        "stateSave": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('backend/paket/loadTableSoal')?>/"+$('[name="soal_type"]').val()+"/"+<?=$idPaket?>,
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
}

function load(){
    showLoading();
	reset();
	$("#data").show();
//	$('#table').DataTable().ajax.reload();
	loadTable();
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

function showInputan() {
	showLoading();
	reset();
	$("#inputan").show();
    $('[name="paket_parent_nama"]').focus();
	hideLoading();
};

function showData() {
	showLoading();
	reset();
	$("#data").show();
    $('[name="paket_parent_nama"]').focus();
	hideLoading();
};

function add()
{
	showLoading();
	showInputan();
    save_method = 'add';
	hideLoading();
};

function edit(id)
{
	showLoading();
    save_method = 'update';
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('backend/paket/prepareEdit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			showInputan();
            $('[name="id"]').val(data.paket_parent_id);
            $('[name="paket_parent_nama"]').val(data.paket_parent_nama);
            $('[name="paket_parent_ket"]').val(data.paket_parent_ket);
            $('[name="paket_parent_durasi"]').val(data.paket_parent_durasi);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
};

function tambahkanSoal()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('backend/paket/save')?>";
		$("#msgSKS").text("Data Berhasil Ditambah !!");
		$("#msgERR").text("Data Gagal Ditambah !!");
    } else {
        url = "<?php echo site_url('backend/peket/update')?>";
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

$(document).on("click","#tambahData",function(){
	var id=$(this).attr("data-id");
	swal({
		title:"Tambahkan Soal ?",
		text:"Yakin akan menambah soal ini ?",
		type: "warning",
		showCancelButton: true,
		confirmButtonText: "Yakin",
		closeOnConfirm: true,
	},
		function(){
		 $.ajax({
			url:"<?php echo site_url('backend/paket/tambahsoal');?>"+'/'+<?=$idPaket?>+'/'+id+'/'+$('[name="kategoriTmpSoal"]').val(),
			data: id,
			success: function(data)
			{
				var json = $.parseJSON(data);
				if(json.status) //if success close modal and reload ajax table
				{
					load();
					$("#msgSKS").text(json.msg);
					$("#jmlSoalTmp").text(json.jmlSoal);
					$("#alerSKS").show();
					$("#alerERR").hide();
				} else {
					load();
					$("#msgERR").text(json.msg);
					$("#jmlSoalTmp").text(json.jmlSoal);
					$("#alerSKS").hide();
					$("#alerERR").show();
				}
			} ,
			error: function ()
			{
				$("#msgERR").text("Soal Gagal Ditambahkan, Karena Sudah 100 Soal di tambahkan !!");
				$("#alerERR").show();
					$("#alerSKS").hide();
			}
		 });
	});
});

function tambahkanSoalMulti()
{
    $('#btnSaveMulti').text('Tambah Select...'); //change button text
    $('#btnSaveMulti').attr('disabled',true); //set button disable 
    
	var url  = "<?php echo site_url('backend/paket/tambahkanSoalMulti')?>";
	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formSoal').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				load();
				$("#alerSKS").show();
				$("#msgSKS").text(data.msg);
            } else {
				load();
				$("#alerERR").show();
				$("#msgERR").text(data.msg);				
			}

            $('#btnSaveMulti').text('Tambah Select'); //change button text
            $('#btnSaveMulti').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			$("#alerERR").show();
            $('#btnSaveMulti').text('Tambah Select'); //change button text
            $('#btnSaveMulti').attr('disabled',false); //set button enable 

        }
    });
};

</script>
                    <div class="row" id="data" style="display:none;">
						<div class="col-md-3">
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
                                                <label class="control-label col-md-6">Sesi
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select class="form-control" id="soal_type" name="soal_type">
														<option value="TWK">TWK</option>
														<option value="TIU">TIU</option>
														<option value="TKP">TKP</option>
                                                    </select> 
												</div>
											</div>											
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
													<button type="button" id="btnCari" class="btn btn-primary" onclick="loadTable();">Cari</button>
													<a class="btn default" href="<?=base_url();?>backend/paket">Kembali</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
								</div>
							</div>
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                       <span class="caption-subject bold uppercase">Jumlah Soal Paket Ini</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
								
                                    <!-- BEGIN FORM-->
                                    <form class="form-horizontal" autocomplete="off">
                                        <div class="form-actions">
											<div class="row">
                                                <div class="col-md-12 text-center">
													<p id="jmlSoalTmp" style="font-size:30px"></p>
												</div>
											</div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
								</div>
							</div>
						</div>
                        <div class="col-md-8">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark col-md-12">
                                        <span class="bold uppercase col-md-12"><?= $title; ?></span>
									</div>
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
                                    <form id="formSoal" class="form-horizontal" autocomplete="off">
									</br>
									<input type="text" id="kategoriTmpSoal" name="kategoriTmpSoal" hidden />
                                    <table id="table" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                        <thead>
                                            <tr>
                                                <th class="all" width="2%">No</th>
                                                <th class="all">Sesi Ke</th>
                                                <th class="all">Type</th>
                                                <th class="all">Pertanyaan</th>
                                                <th class="all" width="15%">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										</tbody>
									</table>
									</form>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
<?php } ?>
