@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/imprimir.css')}}">
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<center><img  src="{{asset('img/logo.png') }}" height="80px" width="90px"></center>
			<h3><center>Productos Solicitados<center></h3><br>
			<br>
			<button id="printPageButton" onclick="window.print();" class="btn btn-info">Imprimir</button> 	
			
	        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        	<div class="table-responsive">   
	        		<br> 
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th width="10px">N°</th>
								<th>Producto</th>
								<th>Stock Actual</th>
								<th>Cantidad Solicitada</th>
								
								<th id="col"></th>
							</tr>	
						</thead>
						<tbody>
							<?php $i=1 ?>
							@foreach($top as $reg)
							<tr>
								<td>{{$i}}</td>
								<td>{{$reg->descripcion}}</td>
								<td><center>{{$reg->stock.' '.$reg->UM }}</center></td>
								<td><center>{{$reg->cantidad.' '.$reg->UM }}</center></td>
								<td id="tabla">					
									<a href="{{route('reportes.consumo_mensual.pedido_mensual_producto',$reg->id)}}"><button style="margin-right: 10px" class="btn btn-warning">Ver Sedes</button></a>
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