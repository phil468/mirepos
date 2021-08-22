@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Solicitudes de Pedidos <b>MENSUALES</b></h3>
			@include('pedidos.pedidos.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<?php $i=1 ?>
						<th>Nº</th>
						<th>Código</th>
						<th>Fecha</th>
						<th>Sede</th>
						<th>Dependencia</th>
						<th>Estado</th>
						<th>Opciones</th>
					</thead>
					@foreach($pedidos as $cat)
					<tr>
						<td>{{$i }}</td>
						<td>{{$cat->codigo}}</td>
						<td>{{$cat->created_at}}</td>
						<td>{{$cat->sede}}</td>
						<td>{{$cat->oojj}}</td>
						<td>{{$cat->estado_pedido}}</td>
						<td>
							@can('pedidos.pedidos.show')
							<a href="{{route('pedidos.pedidos.show',$cat->id)}}"><button style="margin-right: 10px" class="btn btn-info">Detalles</button></a>
							@endcan
							@if ($cat->estado_pedido == 'Entregado' || $cat->estado_pedido == 'Confirmado' || $cat->estado_pedido == 'En reparto' )	
							@can('pedidos.pedidos.seguimiento')
							<a href="{{route('pedidos.pedidos.seguimiento',$cat->id)}}"><button style="margin-right: 10px" class="btn-sm btn-warning">Seguimiento del Pedido</button></a>
							@endcan
							@endif
							@if($cat->estado_pedido == 'Entregado')
								@can('pedidos.pecosa.subir_pecosa')
								<a href="" data-target="#modal-subir_pecosa_pedido-{{$cat->id}}" data-toggle="modal"><button style="margin-right: 10px" class="btn btn-default">Subir Pecosa</button></a>
								@endcan
							@elseif($cat->estado_pedido == 'Confirmado')	
								<a href="{{ asset('public/img/pecosa/'.$cat->foto_pecosa) }}" target=»_blank»><button style="margin-right: 10px" class="btn btn-success">Ver Pecosa</button></a>
							@endif
							@if ($cat->estado_pedido == 'En espera' || $cat->estado_pedido = 'Rechazado')	
							@can('pedidos.pedidos.destroy')
							<a href="" data-target="#modal-delete-{{$cat->id}}" data-toggle="modal"><button style="margin-right: 10px" class="btn btn-danger">Eliminar</button></a>
							@endcan
							@endif
						</td>
					</tr>
					@include('pedidos.pedidos.modal')
					@include('pedidos.pedidos.subir_pecosa')
					<?php $i++ ?>
					@endforeach

				</table>
			</div>
			{{$pedidos->render()}}
		</div>
	</div>
</div>
@endsection