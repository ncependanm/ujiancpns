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

<script src="<?=base_url();?>asset/pages/js/form-validation-profile.js" type="text/javascript"></script>

<script>
var save_method;
var table;

$(document).ready(function() {
    //datatables
	reset();
	showData();
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
	$("#inputanPassword").hide();
	$("#inputanFoto").hide();
	$("#alerSKS").hide();
	$("#alerERR").hide();
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

function showInputanPassword() {
	showLoading();
	reset();
	$("#inputanPassword").show();
	$('[name=user_password_old]').focus();
	hideLoading();
};

function showInputanFoto() {
	showLoading();
	reset();
	$("#inputanFoto").show();
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
	hideLoading();
};


function editFoto()
{
	$.ajax({
        url : "<?php echo site_url('backend/profile/prepareEdit')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			showInputanFoto();
            $('[name="id"]').val(data.user_id);
            $('#foto').html('<img src="<?=base_url('asset/upload')?>/'+data.user_foto+'" width="100%">');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
	hideLoading();
}

function editPass()
{
	$.ajax({
        url : "<?php echo site_url('backend/profile/prepareEdit')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			showInputanPassword();
            $('[name="id"]').val(data.user_id);

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
	hideLoading();
}

function edit()
{
	showLoading();
    //Ajax Load data from ajax
	showInputan();
	$.ajax({
        url : "<?php echo site_url('backend/profile/prepareEdit')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			showInputan();
            $('[name="id"]').val(data.user_id);
            $('[name="user_nama"]').val(data.user_nama);
            $('[name="user_email"]').val(data.user_email);
            $('[name="user_username"]').val(data.user_username);
            $('[name="user_no_hp"]').val(data.user_no_hp);
            $('[name="user_tgl_lahir"]').val(data.user_tgl_lahir);
            $('[name="user_asal_sekolah"]').val(data.user_asal_sekolah);
            $('[name="user_kelas"]').val(data.user_kelas);
            $('[name="user_alamat"]').val(data.user_alamat);

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
	hideLoading();
};

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url = "<?php echo site_url('backend/profile/update')?>";
		$("#msgSKS").text("Data Berhasil Diubah !!");
		$("#msgERR").text("Data Gagal Diubah !!");

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
				window.location.href = '<?=base_url()?>backend/profile';
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

function savePass()
{
	showLoading();
				$("#tmpErr").hide();
				$("#tmpSks").hide();
    $('#btnSavePass').text('saving...'); //change button text
    $('#btnSavePass').attr('disabled',true); //set button disable 
    var url = "<?php echo site_url('backend/profile/updatePass')?>";
	$("#msgTmpSks").text("Data Berhasil Diubah !!");
	$("#msgTmpErr").text("Data Gagal Diubah !!");

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formPass').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$("#tmpSks").show();
				window.location.href = '<?=base_url()?>backend/profile';
            } else {
				$("#tmpErr").show();
				$("#msgTmpErr").text(data.msg);
				$('#btnSavePass').text('save'); //change button text
				$('#btnSavePass').attr('disabled',false); //set button enable 	
			hideLoading();			
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			$("#tmpErr").show();
			$("#msgTmpErr").text("Gagal");
            $('#btnSavePass').text('save'); //change button text
            $('#btnSavePass').attr('disabled',false); //set button enable 
			hideLoading();

        }
    });
};

function saveFoto()
{
	showLoading();
	$("#tmpErr1").hide();
	$("#tmpSks1").hide();
    $('#btnSaveFoto').text('saving...'); //change button text
    $('#btnSaveFoto').attr('disabled',true); //set button disable 
    var url = "<?php echo site_url('backend/profile/updateFoto')?>";
	$("#msgTmpSks1").text("Data Berhasil Diubah !!");
	$("#msgTmpErr1").text("Data Gagal Diubah !!");
	var file_data = $('#file').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    // ajax adding data to database
    $.ajax({
        url: url, // point to server-side controller method
        dataType: 'JSON', // what to expect back from the server
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            if(data.status){
				window.location.href = '<?=base_url()?>backend/profile';
			} else {
				$("#tmpErr1").show();
				$('#btnSaveFoto').text('Save'); //change button text
				$('#btnSaveFoto').attr('disabled',false); //set button enable 	
				$("#msgTmpErr1").text(data.msg);
				hideLoading();
			}
        },
        error: function (data) {
			$("#tmpErr1").show();
			$('#btnSave').text('Save'); //change button text
			$('#btnSave').attr('disabled',false); //set button enable 	
				hideLoading();
        }
    });
};

</script>
<?php foreach($dataUser as $s){?>

                    <div class="profile" id="data">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="list-unstyled profile-nav">
                                                <li>
                                                    <img src="<?=base_url('asset/upload')?>/<?=$s->user_foto?>" class="img-responsive pic-bordered" alt="" />
                                                </li>
												<div class="col-md-12" style="margin-top: 10px">
													<button type="submit" id="btnFinish" class="btn btn-info btn-circle col-md-12" onclick="edit()">Ubah Profile</button>
												</div>
												<div class="col-md-12" style="margin-top: 10px">
													<button type="submit" id="btnFinish" class="btn btn-info btn-circle col-md-12" onclick="editFoto()">Ubah Foto</button>
												</div>
												<div class="col-md-12" style="margin-top: 10px">
													<button type="submit" id="btnFinish" class="btn btn-info btn-circle col-md-12" onclick="editPass()">Ubah Password</button>
												</div>
												<div class="col-md-12" style="margin-top: 10px">
													<a href="<?=base_url()?>backend/statistik" id="btnFinish" class="btn btn-info btn-circle col-md-12">Lihat Statistik</a>
												</div>
                                            </ul>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-8 profile-info">
                                                    <h1 class="font-green sbold uppercase"><?=$s->user_nama?></h1>
                                                </div>
                                            </div>
                                            <!--end row-->
                                            <div class="tabbable-line tabbable-custom-profile ">
                                                <div class="tab-content">
                                                    <div class="tab-pane active">
                                                        <div class="portlet-body">
                                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            Email 
                                                                        </td>
                                                                        <td class="hidden-xs"> <?=$s->user_email?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Username 
                                                                        </td>
                                                                        <td class="hidden-xs"> <?=$s->user_username?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            No Hp 
                                                                        </td>
                                                                        <td class="hidden-xs"> <?=$s->user_no_hp?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Tanggal Lahir
                                                                        </td>
                                                                        <td class="hidden-xs"> <?=$s->user_tgl_lahir?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Alamat
                                                                        </td>
                                                                        <td class="hidden-xs"> <?=$s->user_alamat?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Asal Sekolah
                                                                        </td>
                                                                        <td class="hidden-xs"> <?=$s->user_asal_sekolah?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Kelas
                                                                        </td>
                                                                        <td class="hidden-xs"> <?=$s->user_kelas?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Paket User
                                                                        </td>
                                                                        <td class="hidden-xs"> 
																		<?php if($s->user_ind == 'F'){ echo "Akun Free"; } 
else if($s->user_ind == 'D'){ echo "Akun Deluxe"; }
else if($s->user_ind == 'S'){ echo "Akun Super"; }
else if($s->user_ind == 'P'){ echo "Akun Premium";} ?> </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--tab_1_2-->
                        </div>
                    </div>
					<?php } ?> 
					<div class="row" id="inputan" style="display:none;">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase">Ubah Profile</span>
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
                                                <label class="control-label col-md-2">Asal Sekolah
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_asal_sekolah" maxlength="30" data-required="1" class="form-control" /> 
												</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2">Kelas
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <input type="text" name="user_kelas" maxlength="3" data-required="1" class="form-control" /> 
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
													<a class="btn default" href="<?=base_url();?>backend/profile">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
								</div>
							</div>
						</div>
					</div>
					
					<div class="row" id="inputanPassword" style="display:none;">
                        <div class="col-md-6">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase">Ubah Password</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
								
                                    <!-- BEGIN FORM-->
                                    <form id="formPass" class="form-horizontal" autocomplete="off">
									    <input type="text" name="id" hidden /> 
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide" id="tmpErr">
                                                <button class="close" data-close="alert"></button> <label id="msgTmpErr"></label>
											</div>
                                            <div class="alert alert-success display-hide" id="tmpSks">
                                                <button class="close" data-close="alert"></button> <label id="msgTmpSks"></label> </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Password Lama
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-7">
                                                    <input type="password" name="user_password_old" data-required="1" class="form-control" /> 
												</div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-5">Password Baru
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-7">
                                                    <input type="password" name="user_password_new" data-required="1" class="form-control" /> 
												</div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-5">Konfirmasi Password Baru
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-7">
                                                    <input type="password" name="user_password_new_konfirmasi" data-required="1" class="form-control" /> 
												</div>
											</div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
													<button type="button" id="btnSavePass" onclick="savePass();" class="btn btn-primary">Save</button>
                                                    <!--<button type="button" class="btn default" onclick="showData();">Cancel</button>-->
													<a class="btn default" href="<?=base_url();?>backend/profile">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
								</div>
							</div>
						</div>
					</div>
					
					<div class="row" id="inputanFoto" style="display:none;">
                        <div class="col-md-6">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase">Ubah Foto</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
								
                                    <!-- BEGIN FORM-->
                                    <form id="formPass" class="form-horizontal" autocomplete="off">
									    <input type="text" name="id" hidden /> 
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide" id="tmpErr1">
                                                <button class="close" data-close="alert"></button> <label id="msgTmpErr1"></label>
											</div>
                                            <div class="alert alert-success display-hide" id="tmpSks1">
                                                <button class="close" data-close="alert"></button> <label id="msgTmpSks1"></label> </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Foto
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-7" id="foto">
												</div>
											</div>
											<div class="form-group">
                                                <label class="control-label col-md-5">Ubah Foto
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-7">
                                                   <input type="file" id="file" name="file" />
												</div>
											</div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
													<button type="button" id="btnSaveFoto" onclick="saveFoto();" class="btn btn-primary">Save</button>
                                                    <!--<button type="button" class="btn default" onclick="showData();">Cancel</button>-->
													<a class="btn default" href="<?=base_url();?>backend/profile">Cancel</a>
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
