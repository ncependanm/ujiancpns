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
                renderTo: 'mygraphTKP1',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Integritas Diri'
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
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP2',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Semangat Berprestasi'
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
                          name: 'Semangat Berprestasi',
                          data: [<?=$nilaiTKP2?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP3',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Orientasi Pada Pelayanan'
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
                          name: 'Orientasi Pada Pelayanan',
                          data: [<?=$nilaiTKP3?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP4',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kemampuan Beradaptasi'
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
                          name: 'Kemampuan Beradaptasi',
                          data: [<?=$nilaiTKP4?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP5',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kemampuan Mengendalikan Diri'
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
                          name: 'Kemampuan Mengendalikan Diri',
                          data: [<?=$nilaiTKP5?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP6',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kemampuan Bekerja Mandiri dan Tuntas'
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
                          name: 'Kemampuan Bekerja Mandiri dan Tuntas',
                          data: [<?=$nilaiTKP6?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP7',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kemauan dan Kemampuan Belajar Berkelanjutan'
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
                          name: 'Kemauan dan Kemampuan Belajar Berkelanjutan',
                          data: [<?=$nilaiTKP7?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP8',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kemampuan Bekerja Sama dalam Kelompok'
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
                          name: 'Kemampuan Bekerja Sama dalam Kelompok',
                          data: [<?=$nilaiTKP8?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP9',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kemampuan Mengkoordinir Orang Lain'
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
                          name: 'Kemampuan Mengkoordinir Orang Lain',
                          data: [<?=$nilaiTKP9?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP10',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Orientasi Kepada Orang Lain'
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
                          name: 'Orientasi Kepada Orang Lain',
                          data: [<?=$nilaiTKP10?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP11',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kreativitas dan Inovasi'
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
                          name: 'Kreativitas dan Inovasi',
                          data: [<?=$nilaiTKP11?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP12',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kemampuan Berpikir Analitis'
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
                          name: 'Kemampuan Berpikir Analitis',
                          data: [<?=$nilaiTKP12?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTKP13',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kemampuan Berpikir Logis'
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
                          name: 'Kemampuan Berpikir Logis',
                          data: [<?=$nilaiTKP13?>]
                        }
                    ]
          });
       });  
</script>
                   
<div class="row">
    <div class="col-md-12">
		<div class="portlet light portlet-fit ">
			<div class="portlet-title">
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP1"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP2"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP3"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP4"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP5"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP6"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP7"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP8"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP9"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP10"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP11"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP12"></div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div id ="mygraphTKP13"></div>
					</div>
				</div>
			</div>
		</div>
    </div>
<?php } ?>
