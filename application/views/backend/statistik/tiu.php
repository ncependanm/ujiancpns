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
                renderTo: 'mygraphTIU1',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kemampuan Verbal'
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
                        }
                    ]
          });
          
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTIU2',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Aritmatika'
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
                          name: 'Aritmatika',
                          data: [<?=$nilaiTIU2?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTIU3',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Perbandingan'
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
                          name: 'Perbandingan',
                          data: [<?=$nilaiTIU3?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTIU4',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Persamaan dan Pertidaksamaan Statistika'
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
                          name: 'Persamaan dan Pertidaksamaan Statistika',
                          data: [<?=$nilaiTIU4?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTIU5',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Jarak, Waktu, dan Kecepatan'
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
                          name: 'Jarak, Waktu, dan Kecepatan',
                          data: [<?=$nilaiTIU5?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTIU6',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Himpunan'
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
                          name: 'Himpunan',
                          data: [<?=$nilaiTIU6?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTIU7',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Barisan dan Deret'
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
                          name: 'Barisan dan Deret',
                          data: [<?=$nilaiTIU7?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTIU8',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Kemampuan Logika'
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
                          name: 'Kemampuan Logika',
                          data: [<?=$nilaiTIU8?>]
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
										<div id ="mygraphTIU1"></div>
									</div>
								</div>
								<div class="panel panel-primary">
									<div class="panel-body">
										<div id ="mygraphTIU2"></div>
									</div>
								</div>
								<div class="panel panel-primary">
									<div class="panel-body">
										<div id ="mygraphTIU3"></div>
									</div>
								</div>
								<div class="panel panel-primary">
									<div class="panel-body">
										<div id ="mygraphTIU4"></div>
									</div>
								</div>
								<div class="panel panel-primary">
									<div class="panel-body">
										<div id ="mygraphTIU5"></div>
									</div>
								</div>
								<div class="panel panel-primary">
									<div class="panel-body">
										<div id ="mygraphTIU6"></div>
									</div>
								</div>
								<div class="panel panel-primary">
									<div class="panel-body">
										<div id ="mygraphTIU7"></div>
									</div>
								</div>
								<div class="panel panel-primary">
									<div class="panel-body">
										<div id ="mygraphTIU8"></div>
									</div>
								</div>
								</div>
							</div>
						</div>
<?php } ?>
