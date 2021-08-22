@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Pedidos Solicitados
				@can('pedidos.pecosa.create')
				<a href="{{route('pedidos.pecosa.create')}}"><button style="margin-right: 10px" class="btn btn-success">Gestionar Pedidos</button></a>
				@endcan
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<?php $i=1 ?>
						<th>Nº</th>
						<th>Fecha y Hora</th>
						<th>Código</th>
						<th>Sede</th>
						<th>Dependencia</th>
						<th>Opciones</th>
					</thead>
					@foreach($pedidos as $cat)
					<tr>
						<td>{{$i}}</td>
						<td>{{$cat->created_at}}</td>
						<td>{{$cat->codigo}}</td>
						<td>{{$cat->sede}}</td>
						<td>{{$cat->oojj}}</td>
						<td>
							@can('pedidos.pedidos.show')
							<a href="{{route('pedidos.pedidos.show',$cat->id)}}"><button style="margin-right: 10px" class="btn btn-info">Ver Detalle del Pedido</button></a>
							@endcan
							@can('pedidos.pedidos.destroy')
							<a href="" data-target="#modal-rechazar-{{$cat->id}}" data-toggle="modal"><button style="margin-right: 10px" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></a>
							@endcan
						</td>	
						<!--<td>
							
							@can('pedidos.pecosa.create')
							<a href="{{route('pedidos.pecosa.create','vsid='.$cat->id)}}"><button style="margin-right: 10px" class="btn btn-warning">Gestionar Pedido</button></a>
							@endcan
						</td>-->
					</tr>
					@include('pedidos.pedidos.rechazar')
					<?php $i++ ?>
					@endforeach
				</table>
			</div>
			{{$pedidos->render()}}
		</div>
	</div>
</div>
@endsection