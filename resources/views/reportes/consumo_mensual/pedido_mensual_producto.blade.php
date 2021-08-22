@extends('layouts.app')
@section('content')
<html>
  <head>
  	<link rel="stylesheet" type="text/css" href="{{asset('css/imprimir.css')}}">
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
	  							<center><h3>Listado de Sedes <button id="printPageButton" onclick="window.print();" class="btn btn-info">Imprimir</button></h3></center>
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