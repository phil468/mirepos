@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Pecosas Realizadas				
			</h3>
			@include('pedidos.pecosa.search')
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
						<th>Sede</th>
						<th>Órgano Jurisdiccional</th>
						<th>Opciones</th>
					</thead>
					@foreach($pecosa as $cat)
					<tr>
						<td>{{$i }}</td>
						<td>{{$cat->num_pecosa}}</td>
						<td>{{$cat->sede}}</td>
						<td>{{$cat->oojj}}</td>
						<td>
							@can('pedidos.pecosa.show')
							<a href="{{route('pedidos.pecosa.show',$cat->id)}}"><button style="margin-right: 10px" class="btn btn-info">Detalles</button></a>
							@endcan
							@if($cat->estado_pedido == 'Entregado')	
								<a href="{{ asset('public/img/pecosa/'.$cat->foto_pecosa) }}" target=»_blank»><button style="margin-right: 10px" class="btn btn-success">Ver Pecosa</button></a>
							@endif
							@if($cat->estado_pedido == 'Preparando')
								@can('pedidos.pecosa.destroy')
								<a href="" data-target="#modal-delete-{{$cat->id}}" data-toggle="modal"><button style="margin-right: 10px" class="btn btn-danger">Eliminar</button></a>
								@endcan
							@endif
						</td>
					</tr>
					@include('pedidos.pecosa.modal')
					@include('pedidos.pecosa.subir_pecosa')
					<?php $i++ ?>
					@endforeach

				</table>
			</div>
			{{$pecosa->render()}}
		</div>
	</div>
</div>
@endsection