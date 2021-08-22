@extends('layouts.app')
@section('content')
<html>
  <head>
  	<link rel="stylesheet" type="text/css" href="/css/imprimir.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript">
	  google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart1);
		function drawChart1() {
		  var data = google.visualization.arrayToDataTable([
		    ['OOJJ', 'Cantidad',{type: 'string', role: 'annotation'}],
		    @foreach($reporte as $r)
		    ['{{$r->oojj}}',{{$r->cantidad}},'{{$r->cantidad.' '.$r->UM}}'],
		    @endforeach
		  ]);

		  var options = {
		  	title: "Cantidad Solicitada por Órgano Jurisdiccional",
		    hAxis: {title: 'Órgano Jurisdiccional', titleTextStyle: {color: 'red'}}
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
	  							<center><h3>Estadísticos <button id="printPageButton" onclick="window.print();" class="btn btn-info">Imprimir</button></h3></center>
	  						</th>
	  					</tr>
	  					<tr>
	  						<th>
	  							<label><b>Codigo: </b>{{$top->codigo}}</label>
	  						</th>
	  						<th colspan="2">
	  							<label><b>Producto:</b>{{$top->descripcion}}</label>
	  						</th>
	  					</tr>
	  					<tr>
	  						<th>Sede</th>
	  						<th>Órgano Jurisdiccional</th>
	  						<th>Cantidad</th>
	  					</tr>
	  				</thead>
	  				<tbody>
	  					@foreach($reporte as $r)
	  					<tr>
	  						<td>{{$r->sede}}</td>
	  						<td>{{$r->oojj}}</td>
	  						<td>{{$r->cantidad.$r->UM}}</td>
	  					</tr>
	  					@endforeach
	  				</tbody>
	  				<tfoot>
	  					<tr>
	  						<th colspan="2" style="text-align: right;"><h4>Total</h4></th>
	  						<th><h4><center>{{$top->cantidad.' '.$top->UM}}</center></h4></th>
	  					</tr>
	  				</tfoot>
	  			</table>
	  		</div>
	  		<div class="col-md-12">
				<div id="chart_div1" class="chart"></div>	
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