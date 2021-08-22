@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="/css/imprimir.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart1);
	function drawChart1() {
	  var data = google.visualization.arrayToDataTable([
	    ['Mes', 'Costo Total S/.',{type: 'string', role: 'annotation'}],
	    @foreach($reporte as $r)
	          ['{{$r->mes}}',{{$r->total}}, 'S/. {{$r->total}}'],
	        @endforeach
	  ]);

	  var options = {
	  	title: "Costo Total por Mes",
	    hAxis: {title: 'Mes', titleTextStyle: {color: 'red'}}
	 };

	var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));

	google.visualization.events.addListener(chart, 'ready', function () {
        chart.innerHTML = '<img src="' + chart.getImageURI() + '">';
        console.log(chart.innerHTML);
      });

	  chart.draw(data, options);

	  google.visualization.events.addListener(chart, 'select', selectHandler); 

	    function selectHandler(e)     { 
	    
	    //window.open('{{url("reportes/consumo_mensual/oojj_producto/2019-12/53")}}'); 
	        //alert(data.getValue(chart.getSelection()[0].row, 2));
	        var año_mes = data.getValue(chart.getSelection()[0].row, 0);
	        var id = $("#oojj").val();
	        var URL = '../../reportes/consumo_mensual/oojj_producto/'+año_mes+'/'+id;
	        //alert(URL);
	        window.open(URL); 
	        //console.log(año_mes);
	        //console.log(id);
	    }
	}

	$(window).resize(function(){
	  drawChart1();	 
	});
</script>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<center><img  src="{{asset('img/logo.png') }}" height="80px" width="90px"></center>
			<h3><center>Consumo anual por Órgano Jurisdiccional<center></h3><br>
			<br>
            {!! Form::open(array('url'=>'reportes/consumo_anual/oojj','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
			<center>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<select name="oojj" id="oojj" class="form-control selectpicker" data-live-search="true" required autofocus>
			            <option value="">--Seleccionar Órgano Jurisdiccional</option>
			            @foreach($combo_oojj as $combo_oojj)
			              <option value="{{$combo_oojj->id}}" @if($combo_oojj->id==$oojj) selected='selected' @endif>{{$combo_oojj->nombre}}</option>
			            @endforeach
	                </select>
                </div>	
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			 		<button id="filtroButton" type="submit" class="btn btn-primary">Aplicar Filtro</button>
			 	</div>	
			</center>  	
			<button id="printPageButton" onclick="window.print();" class="btn btn-info">Imprimir</button> 
			<br>
			<br>	
			<label id="label">&nbsp;&nbsp;&nbsp; Doble clic sobre las barras para más información</label>
	        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        	<br>
	        	<div id="chart_div1" class="chart"></div>
			</div>		
		</div>
	</div>
</div>
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
@endsection