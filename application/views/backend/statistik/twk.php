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
                renderTo: 'mygraphTWK1',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Pancasila'
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
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTWK2',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian UUD 1945'
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
                          name: 'UUD 1945',
                          data: [<?=$nilaiTWK2?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTWK3',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Bhineka Tunggal Ika'
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
                          name: 'Bhineka Tunggal Ika',
                          data: [<?=$nilaiTWK3?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTWK4',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Negara Kesatuan Republik Indonesia'
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
                          name: 'Negara Kesatuan Republik Indonesia',
                          data: [<?=$nilaiTWK4?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTWK5',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Bahasa Indonesia'
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
                          name: 'Bahasa Indonesia',
                          data: [<?=$nilaiTWK5?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTWK6',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Tata negara'
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
                          name: 'Tata negara',
                          data: [<?=$nilaiTWK6?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTWK7',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Demokrasi Indonesia'
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
                          name: 'Demokrasi Indonesia',
                          data: [<?=$nilaiTWK7?>]
                        }
                    ]
          });
		  chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraphTWK8',
                type: 'line'
             },   
             title: {
                text: 'Nilai Hasil Ujian Sejarah Penting'
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
                          name: 'Sejarah Penting',
                          data: [<?=$nilaiTWK8?>]
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
                    <div id ="mygraphTWK1"></div>
                </div>
			</div>
			<div class="panel panel-primary">
                <div class="panel-body">
                    <div id ="mygraphTWK2"></div>
                </div>
			</div>
			<div class="panel panel-primary">
                <div class="panel-body">
                    <div id ="mygraphTWK3"></div>
                </div>
			</div>
			<div class="panel panel-primary">
                <div class="panel-body">
                    <div id ="mygraphTWK4"></div>
                </div>
			</div>
			<div class="panel panel-primary">
                <div class="panel-body">
                    <div id ="mygraphTWK5"></div>
                </div>
			</div>
			<div class="panel panel-primary">
                <div class="panel-body">
                    <div id ="mygraphTWK6"></div>
                </div>
			</div>
			<div class="panel panel-primary">
                <div class="panel-body">
                    <div id ="mygraphTWK7"></div>
                </div>
			</div>
			<div class="panel panel-primary">
                <div class="panel-body">
                    <div id ="mygraphTWK8"></div>
                </div>
			</div>
                            </div>
                        </div>
						
                    </div>
<?php } ?>
