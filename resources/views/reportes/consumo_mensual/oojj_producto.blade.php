@extends('layouts.app')
@section('content')
<html>
  <head>
  	<link rel="stylesheet" type="text/css" href="{{asset('css/imprimir.css')}}">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript">
	  google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart1);
		function drawChart1() {
		  var data = google.visualization.arrayToDataTable([
		    ['Producto', 'Costo Total S/.',{type: 'string', role: 'annotation'}],
		    @foreach($reporte as $r)
	          ['{{$r->descripcion}}',{{$r->total}}, 'S/. {{$r->total}}'],
	        @endforeach
		  ]);

		  var options = {
		  	title: "Costo Total por Producto",
		    hAxis: {title: 'Producto', titleTextStyle: {color: 'red'}}
		 };

		var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));

		google.visualization.events.addListener(chart, 'ready', function () {
	        chart.innerHTML = '<img src="' + chart.getImageURI() + '">';
	        console.log(chart.innerHTML);
	      });

		  chart.draw(data, options);
		}

		$(window).resize(function(){
		  drawChart1();	 
		});
	</script>

	<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Producto', 'Cantidad'],
          @foreach($reporte as $r)
	          ['{{$r->descripcion.' --- UNID. MEDIDA: '.$r->UM}}',{{$r->cantidad}}],
	        @endforeach
        ]);

        var options = {
        	title: "Cantidad de Productos"
          
        };

        var chart1 = new google.visualization.PieChart(document.getElementById('piechart_3d'));

        google.visualization.events.addListener(chart1, 'ready', function () {
	        chart1.innerHTML = '<img src="' + chart1.getImageURI() + '">';
	        console.log(chart1.innerHTML);
	      });

        chart1.draw(data, options);
      }
      $(window).resize(function(){
		  drawChart();	 
		});
    </script>

  </head>
  <body>
  <div class="container">   
    	<div class="row">
		  <div class="clearfix"></div>
		  <div class="col-md-12">
	  		<div class="table-responsive">
	  			<table class="table table-striped table-bordered table-condensed table-hover">
	  				<thead>
	  					<tr>
	  						<th colspan="3">
	  							<center><h3>Estadísticos <b>Mes:</b>  <?php echo $año_mes ?>&nbsp;<button id="printPageButton" onclick="window.print();" class="btn btn-info">Imprimir</button></h3></center>
	  						</th>
	  					</tr>
	  					<tr>
	  						<th>
	  							<label><b>Sede: </b>{{$datos->sede}}</label>
	  						</th>
	  						<th colspan="2">
	  							<label><b>Administrador:</b> {{$datos->name}}</label>
	  						</th>
	  					</tr>
	  					<tr>
	  						<th>
	  							<label><b>Órgano Jurisdiccional:</b> {{$datos->oojj}}</label>
	  						</th>
	  						<th colspan="2">
	  							<label><b>Magistrado:</b> </label>
	  						</th>
	  					</tr>
	  					<tr>
	  						<th>Producto</th>
	  						<th>Cantidad</th>
	  						<th>Costo Total</th>
	  					</tr>
	  				</thead>
	  				<tbody>
	  					@foreach($reporte as $r)
	  					<tr>
	  						<td>{{$r->descripcion}}</td>
	  						<td><center>{{$r->cantidad.' '.$r->UM}}</center></td>
	  						<td><center>S/. {{$r->total}}</center></td>
	  					</tr>
	  					@endforeach
	  				</tbody>
	  				<tfoot>
	  					@foreach($total as $t)
	  					<tr>
	  						<th colspan="2" style="text-align: right;"><h4>Total</h4></th>
	  						<th><h4><center>S/. {{$t->total}}</center></h4></th>
	  					</tr>
	  					@endforeach
	  				</tfoot>
	  			</table>
	  		</div>
	  		<div class="col-md-12">
				<div id="chart_div1" class="chart"></div>	
			</div>
			<div class="col-md-12">	
				<div id="piechart_3d" class="chart"></div>	
			</div>	
				<a href="{{ URL::previous() }}" id="regresarButton" class="btn btn-danger">Regresar</a>
		  </div>
		</div>   
	</div>
  </div>
  </body>
  <style type="text/css">

	@media only screen and (min-width: 768px) {
	  /* For desktop: */
	  	.chart {
		  width: 100%; 
		  min-height: 600px;
		}
		.row {
		  margin:0 !important;
		}
	}
	@media only screen and (max-width: 600px) {
	  /* For tablets: */
	  	.chart {
		  width: 100%; 
		  min-height: 250px;
		}
		.row {
		  margin:0 !important;
		}
	}

  </style>
</html>
@endsection