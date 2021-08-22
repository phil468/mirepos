@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Sedes
				@can('poder_judicial.sedes.create')
				<a href="{{route('poder_judicial.sedes.create')}}"> <button class="btn btn-success">Nueva Sede</button></a>
				@endcan
			</h3>
			@include('poder_judicial.sedes.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>ID</th>
						<th>Nombre</th>
						<th>Dirección</th>
						<th>Opciones</th>
					</thead>
					@foreach($sedes as $cat)
					<tr>
						<td>{{$cat->id}}</td>
						<td>{{$cat->nombre}}</td>
						<td>{{$cat->direccion}}</td>
						<td>
							@can('poder_judicial.sedes.edit')
							<a href="{{route('poder_judicial.sedes.edit',$cat->id)}}"><button style="margin-right: 10px" class="btn btn-info">Editar</button></a>
							@endcan
							@can('poder_judicial.sedes.destroy')
							<a href="" data-target="#modal-delete-{{$cat->id}}" data-toggle="modal"><button style="margin-right: 10px" class="btn btn-danger">Eliminar</button></a>
							@endcan
						</td>
					</tr>
					@include('poder_judicial.sedes.modal')
					@endforeach
				</table>
			</div>
			{{$sedes->render()}}
		</div>
	</div>
</div>
@endsection