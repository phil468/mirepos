@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/imprimir.css')}}">
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<center><img  src="{{asset('img/logo.png') }}" height="80px" width="90px"></center>
			<h3><center>Consumo Mensual por Órgano Jurisdiccional<center></h3><br>
			<br>
            {!! Form::open(array('url'=>'reportes/consumo_mensual/oojj','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
			<center>
				<input type="month" id="año_mes" name="año_mes" value="{{$año_mes}}">
			 	<button id="filtroButton" type="submit" class="btn btn-primary">Aplicar Filtro</button>
			</center>  	
			<button id="printPageButton" onclick="window.print();" class="btn btn-info">Imprimir</button> 	
			
	        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        	<div class="table-responsive">   
	        		<br> 
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th width="10px">N°</th>
								<th><CENTER>Órgano Jurisdiccional</CENTER></th>
								<th>Consumo Mensual</th>
								<th id="col"></th>
							</tr>	
						</thead>
						<tbody>
							<?php $i=1 ?>
							@foreach($reporte as $reg)
							<tr>
								<td>{{$i}}</td>
								<td>{{$reg->oojj}}</td>
								<td>{{'S/. '.$reg->total}}</td>
								<td id="col">
									@can('reportes.consumo_mensual.oojj_producto')						
									<a href="{{url('reportes/consumo_mensual/oojj_producto', array('año_mes' => $año_mes, 'id' => $reg->id))}}">Ver estadísticos</a>
									@endcan
								</td>
		                    </tr>
		                    <?php $i++ ?>
		                	@endforeach
		                </tbody>	
					</table>
				</div>
			</div>		
		</div>
	</div>
</div>
@endsection