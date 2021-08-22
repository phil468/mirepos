@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/imprimir.css')}}">
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<center><img  src="{{asset('img/logo.png') }}" height="80px" width="90px"></center>
			<h3><center>Solicitudes de Pedidos<center></h3><br>
			<br>
			<button id="printPageButton" onclick="window.print();" class="btn btn-info">Imprimir</button> 	
			
	        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        	<div class="table-responsive">   
	        		<br> 
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
								<th>Fecha</th>
								<th>Sede</th>
								<th>Órgano Jurisdiccional</th>
								<th>Cantidad de Productos</th>
								
								<th id="col"></th>
							</tr>	
						</thead>
						<tbody>
							<?php $i=1 ?>
							@foreach($top as $reg)
							<tr>
								<td>{{$i}}</td>
								<td>{{$reg->created_at}}</td>
								<td>{{$reg->sede}}</td>
								<td><center>{{$reg->oojj}}</center></td>
								<td><center>{{$reg->total_producto.' Articulos'}}</center></td>
								<td id="tabla">				
									<a href="{{route('reportes.consumo_mensual.pedido_mensual_oojj',$reg->id)}}"><button style="margin-right: 10px" class="btn btn-warning">Ver Detalle</button></a>
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