@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
            	<br>
                <center><img  src="{{asset('img/logo.png') }}" height="80px" width="90px"></center>
				<h2><center>Listado de Pecosas por Ruta
				<center></h2>
                <div class="panel-body">  
	               
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                            	<th><CENTER>Fecha</CENTER></th>
                                <th width="10px"><CENTER>N° de Pecosa</CENTER></th>
								<th><CENTER>Sede</CENTER></th>
								<th><CENTER>Direcciòn</CENTER></th>
								<th><CENTER>Administrador</CENTER></th>
								<th><CENTER>Opciones</CENTER></th>
							</tr>	
						</thead>
						<tbody>
							<?php $i=0 ?>
							@foreach($ruta_pecosa as $reg)
							<tr>
								<td>{{$reg->fecha_envio}}</td>
								<td>{{$reg->num_pecosa}}</td>
								<td>{{$reg->sede}}</td>
								<td>{{$reg->direccion}}</td>
								<td>{{$reg->name}}</td>
								<td>
									<a href="https://waze.com/ul?ll={{$reg->coordenadas_x}},{{$reg->coordenadas_y}}&z=10" target=»_blank»><button style="margin-right: 10px" class="btn btn-info">Ver Ruta</button></a>
									@can('pedidos.transporte.entrega')
									<a href="" data-target="#modal-delete-{{$reg->id}}" data-toggle="modal"><button style="margin-right: 10px" class="btn btn-success">Entregar</button></a>
									@endcan
								</td>
		                    </tr>
		                    <?php $i++ ?>
		                    @include('pedidos.transporte.modal')
		                	@endforeach
		                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                		<center><p>{{'Se encontraron '.$i.' registros'}}</p></center>	
		                	</div>
		                </tbody>	
					</table>	
				</div>
			</div>
		</div>
	</div>
</div>

@endsection