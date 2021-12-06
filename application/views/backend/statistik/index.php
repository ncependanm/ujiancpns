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

<script src="<?=base_url();?>asset/pages/js/form-validation-siswa.js" type="text/javascript"></script>

<script>
    var chart1; 
    $(document).ready(function() {
          chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTWK',
                type: 'column'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kategori TWK'
             },
             xAxis: {
                categories: [<?=$ujianKe?>]
             },
             yAxis: {
                title: {
                   text: 'Nilai yang diperoleh'
                }
             },
                  series:             
                [
                        {
                          name: 'Pancasila',
                          data: [<?=$nilaiTWK1?>]
                        },
                        {
                          name: 'UUD 1945',
                          data: [<?=$nilaiTWK2?>]
                        },
                        {
                          name: 'Bhineka Tunggal Ika',
                          data: [<?=$nilaiTWK3?>]
                        },
                        {
                          name: 'Negara Kesatuan Republik Indonesia',
                          data: [<?=$nilaiTWK4?>]
                        },
                        {
                          name: 'Bahasa Indonesia',
                          data: [<?=$nilaiTWK5?>]
                        },
                        {
                          name: 'Tata negara',
                          data: [<?=$nilaiTWK6?>]
                        },
                        {
                          name: 'Demokrasi Indonesia',
                          data: [<?=$nilaiTWK7?>]
                        },
                        {
                          name: 'Sejarah Penting',
                          data: [<?=$nilaiTWK8?>]
                        }
                    ]
          });
          chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTIU',
                type: 'column'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kategori TIU'
             },
             xAxis: {
                categories: [<?=$ujianKe?>]
             },
             yAxis: {
                title: {
                   text: 'Nilai yang diperoleh'
                }
             },
                  series:             
                [
                        {
                          name: 'Kemampuan Verbal',
                          data: [<?=$nilaiTIU1?>]
                        },
                        {
                          name: 'Aritmatika',
                          data: [<?=$nilaiTIU2?>]
                        },
                        {
                          name: 'Perbandingan',
                          data: [<?=$nilaiTIU3?>]
                        },
                        {
                          name: 'Persamaan dan Pertidaksamaan Statistika',
                          data: [<?=$nilaiTIU4?>]
                        },
                        {
                          name: 'Jarak, Waktu, dan Kecepatan',
                          data: [<?=$nilaiTIU5?>]
                        },
                        {
                          name: 'Himpunan',
                          data: [<?=$nilaiTIU6?>]
                        },
                        {
                          name: 'Barisan dan Deret',
                          data: [<?=$nilaiTIU7?>]
                        },
                        {
                          name: 'Kemampuan Logika',
                          data: [<?=$nilaiTIU8?>]
                        }
                    ]
          });
          chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP',
                type: 'column'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kategori TKP'
             },
             xAxis: {
                categories: [<?=$ujianKe?>]
             },
             yAxis: {
                title: {
                   text: 'Nilai yang diperoleh'
                }
             },
                  series:             
                [
                        {
                          name: 'Integritas Diri',
                          data: [<?=$nilaiTKP1?>]
                        },
                        {
                          name: 'Semangat Berprestasi',
                          data: [<?=$nilaiTKP2?>]
                        },
                        {
                          name: 'Orientasi Pada Pelayanan',
                          data: [<?=$nilaiTKP3?>]
                        },
                        {
                          name: 'Kemampuan Beradaptasi',
                          data: [<?=$nilaiTKP4?>]
                        },
                        {
                          name: 'Kemampuan Mengendalikan Diri',
                          data: [<?=$nilaiTKP5?>]
                        },
                        {
                          name: 'Kemampuan Bekerja Mandiri dan Tuntas',
                          data: [<?=$nilaiTKP6?>]
                        },
                        {
                          name: 'Kemauan dan Kemampuan Belajar Berkelanjutan',
                          data: [<?=$nilaiTKP7?>]
                        },
                        {
                          name: 'Kemampuan Bekerja Sama dalam Kelompok',
                          data: [<?=$nilaiTKP8?>]
                        },
                        {
                          name: 'Kemampuan Mengkoordinir Orang Lain',
                          data: [<?=$nilaiTKP9?>]
                        },
                        {
                          name: 'Orientasi Kepada Orang Lain',
                          data: [<?=$nilaiTKP10?>]
                        },
                        {
                          name: 'Kreativitas dan Inovasi',
                          data: [<?=$nilaiTKP11?>]
                        },
                        {
                          name: 'Kemampuan Berpikir Analitis',
                          data: [<?=$nilaiTKP12?>]
                        },
                        {
                          name: 'Kemampuan Berpikir Logis',
                          data: [<?=$nilaiTKP13?>]
                        },
                    ]
          });
       });  
</script>
                   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit ">
                                <div class="portlet-title">
        <div class="panel panel-primary">
            <div class="panel-heading"><?=$titleInputan?></div>
                <div class="panel-body">
                    <div id ="mygraphTWK"></div>
                </div>
                <div class="panel-body">
                    <div id ="mygraphTIU"></div>
                </div>
                <div class="panel-body">
                    <div id ="mygraphTKP"></div>
                </div>
        </div>
                            </div>
                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
													<a class="btn default" href="<?=base_url();?>backend/profile">Kembali</a>
                                                </div>
                                            </div>
                                        </div>
						
                    </div>
<?php } ?>
