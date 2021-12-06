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

<script src="<?=base_url();?>asset/pages/js/form-validation-soal.js" type="text/javascript"></script>

<script>
var save_method;
var table;

$(document).ready(function() {
    //datatables
	reset();
	loadKategori("TWK", "#soal_kategori_id");
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
            "url": "<?php echo site_url('backend/soal/loadTable')?>",
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
	
    $('#soal_type').change(function () {
		var type = $('#soal_type option:selected').val();
		if(type == 'TKP'){
			$("#bagianTKP").show();
			$("#bagianTWKTIU").hide();
			loadKategori(type, "#soal_kategori_id");
			resetNilai();
		} else {
			$("#bagianTKP").hide();
			$("#bagianTWKTIU").hide();
			loadKategori(type, "#soal_kategori_id");
			resetNilai();
		}
	});
	hideLoading();
});

function loadKategori(type, idIsi)
{
    $.ajax({
	url:"<?php echo base_url();?>backend/soal/tampilKategori",
	data:"kategori_soal_jenis=" + type,
	success: function(html)
	{
        $(idIsi).html(html);            
	}
	});
}

function resetNilai()
{	
	$('[name="soal_nilai_a"]').val("0");
	$('[name="soal_nilai_b"]').val("0");
	$('[name="soal_nilai_c"]').val("0");
	$('[name="soal_nilai_d"]').val("0");
	$('[name="soal_nilai_e"]').val("0");
	$('[name="soal_nilai_benar"]').val("5");
	$('[name="soal_nilai_salah"]').val("0");
	$('[name="soal_nilai_kosong"]').val("0");
}

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
    $('[name="soal_sesi"]').val("");
    $('[name="soal_pertanyaan"]').val("");
    $('[name="soal_jawaban_a"]').val("");
    $('[name="soal_jawaban_b"]').val("");
    $('[name="soal_jawaban_c"]').val("");
    $('[name="soal_jawaban_d"]').val("");
    $('[name="soal_jawaban_e"]').val("");
    $('[name="soal_kunci_jawaban"]').val("");
	resetNilai();
};

function showInputan() {
	showLoading();
	reset();
	$("#inputan").show();
    $('[name="soal_sesi"]').focus();
	hideLoading();
};

function showData() {
	showLoading();
	reset();
	$("#data").show();
    $('[name="soal_sesi"]').focus();
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
        url : "<?php echo site_url('backend/soal/prepareEdit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			showInputan();
            $('[name="id"]').val(data.soal_id);
            $('[name="soal_sesi"]').val(data.soal_sesi);
            $('[name="soal_pertanyaan"]').val(data.soal_pertanyaan);
            $('[name="soal_jawaban_a"]').val(data.soal_jawaban_a);
            $('[name="soal_jawaban_b"]').val(data.soal_jawaban_b);
            $('[name="soal_jawaban_c"]').val(data.soal_jawaban_c);
            $('[name="soal_jawaban_d"]').val(data.soal_jawaban_d);
            $('[name="soal_jawaban_e"]').val(data.soal_jawaban_e);
            $('[name="soal_kunci_jawaban"]').val(data.soal_kunci_jawaban);
            $('[name="soal_penyelesaian"]').val(data.soal_penyelesaian);
            $('[name="soal_type"]').val(data.soal_type);
            $('[name="soal_kategori_id"]').val(data.soal_kategori_id);
			if(data.soal_type == 'TIU'){
				$("#bagianTKP").hide();
				$("#bagianTWKTIU").hide();
				resetNilai();
				$('[name="soal_nilai_benar"]').val(data.soal_nilai_benar);
				$('[name="soal_nilai_salah"]').val(data.soal_nilai_salah);
				$('[name="soal_nilai_kosong"]').val(data.soal_nilai_kosong);
			}else if(data.soal_type == 'TWK'){
				$("#bagianTKP").hide();
				$("#bagianTWKTIU").hide();
				resetNilai();
				$('[name="soal_nilai_benar"]').val(data.soal_nilai_benar);
				$('[name="soal_nilai_salah"]').val(data.soal_nilai_salah);
				$('[name="soal_nilai_kosong"]').val(data.soal_nilai_kosong);
			}else if(data.soal_type == 'TKP'){
				$("#bagianTKP").show();
				$("#bagianTWKTIU").hide();
				resetNilai();
				$('[name="soal_nilai_a"]').val(data.soal_nilai_a);
				$('[name="soal_nilai_b"]').val(data.soal_nilai_b);
				$('[name="soal_nilai_c"]').val(data.soal_nilai_c);
				$('[name="soal_nilai_d"]').val(data.soal_nilai_d);
				$('[name="soal_nilai_e"]').val(data.soal_nilai_e);
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
};

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('backend/soal/save')?>";
		$("#msgSKS").text("Data Berhasil Ditambah !!");
		$("#msgERR").text("Data Gagal Ditambah !!");
    } else {
        url = "<?php echo site_url('backend/soal/update')?>";
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
			url:"<?php echo site_url('backend/soal/delete');?>"+'/'+id,
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

</script>
 <script src="../../tinymce/js/tinymce/tinymce.min.js"></script>

  <!--<script>
//tinymce.init({ selector:'textarea' });
tinymce.init({
        ...
        mode : "specific_textareas",
        editor_selector :  "mceEditor",
		theme : "simple" 
});

</script> -->
<script>tinyMCE.init({

    mode : "exact",
    elements : "myarea1",
	 plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});</script>



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
                                </div>
                                <div class="portlet-body">
                                    <table id="table" class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                                        <thead>
                                            <tr>
                                                <th class="all" width="2%">No</th>
                                                <th class="all">Type Soal</th>
                                                <th class="all">Kategori</th>
                                                <th class="all">Sesi Ke</th>
                                                <th class="all">Pertanyaan</th>
                                                <th class="min-phone-l">Jawaban a</th>
                                                <th class="min-phone-l">Jawaban b</th>
                                                <th class="min-phone-l">Jawaban c</th>
                                                <th class="min-phone-l">Jawaban d</th>
                                                <th class="min-phone-l">Jawaban e</th>
                                                <th class="min-phone-l">Kunci Jawaban</th>
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
                                                <button class="close" data-close="alert"></button> Sukses ! 
											</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Type Soal
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-3">
                                                    <select class="form-control" id="soal_type" name="soal_type">
														<option value="TWK">TWK</option>
														<option value="TIU">TIU</option>
														<option value="TKP">TKP</option>
                                                    </select> 
												</div>
                                                <label class="control-label col-md-2">Kategori Soal
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-3">
													<select class="form-control" id="soal_kategori_id" name="soal_kategori_id">

													</select>
												</div>
											</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Untuk Sesi Ke
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-3">
													<input type="text" name="soal_sesi" data-required="1" class="form-control" /> 
												</div>
											</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Soal
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
													<textarea class="form-control" name="soal_pertanyaan" id="myarea1"></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-2">Jawaban
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-2">A
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <input type="text" name="soal_jawaban_a" data-required="1" class="form-control" /> 
												</div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-2">B
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <input type="text" name="soal_jawaban_b" data-required="1" class="form-control" /> 
												</div>
                                            </div>
											<div class="form-group">
                                                <label class="control-label col-md-2">C
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <input type="text" name="soal_jawaban_c" data-required="1" class="form-control" /> 
												</div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-2">D
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <input type="text" name="soal_jawaban_d" data-required="1" class="form-control" /> 
												</div>
                                            </div>
											<div class="form-group">
                                                <label class="control-label col-md-2">E
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <input type="text" name="soal_jawaban_e" data-required="1" class="form-control" /> 
												</div>
                                            </div>
											<div class="form-group">
												<label class="control-label col-md-2">Nilai
											</div>
											<div class="form-group" id="bagianTKP" style="display: none">
                                                <label class="control-label col-md-2">A
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-1">
                                                    <input type="text" name="soal_nilai_a" value="0" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-1">B
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-1">
                                                    <input type="text" name="soal_nilai_b" value="0" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-1">C
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-1">
                                                    <input type="text" name="soal_nilai_c" value="0" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-1">D
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-1">
                                                    <input type="text" name="soal_nilai_d" value="0" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-1">E
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-1">
                                                    <input type="text" name="soal_nilai_e" value="0" data-required="1" class="form-control" /> 
												</div>
                                            </div>
											<div class="form-group" id="bagianTWKTIU" style="display: none">
                                                <label class="control-label col-md-2">Benar
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-1">
                                                    <input type="text" value="0" name="soal_nilai_benar" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-1">Salah
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-1">
                                                    <input type="text" value="0" name="soal_nilai_salah" data-required="1" class="form-control" /> 
												</div>
                                                <label class="control-label col-md-1">Kosong
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-1">
                                                    <input type="text" value="0" name="soal_nilai_kosong" data-required="1" class="form-control" /> 
												</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Kunci
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-3">
                                                    <select class="form-control" name="soal_kunci_jawaban">
														<option value="">Pilih Kunci Jawaban</option>
															<option value="A">A</option>
															<option value="B">B</option>
															<option value="C">C</option>
															<option value="D">D</option>
															<option value="E">E</option>
                                                    </select> 
												</div>
											</div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Penyelesaian
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
													<textarea class="form-control" name="soal_penyelesaian"></textarea>
												</div>
											</div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
													<button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                                                    <!--<button type="button" class="btn default" onclick="showData();">Cancel</button>-->
													<a class="btn default" href="<?=base_url();?>backend/soal">Cancel</a>
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
