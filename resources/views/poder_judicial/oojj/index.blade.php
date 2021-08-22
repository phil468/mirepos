@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Órganos Juridiccionales
				@can('poder_judicial.oojj.create')
				<a href="{{route('poder_judicial.oojj.create')}}"> <button class="btn btn-success">Nuevo Órgano Juridiccional</button></a>
				@endcan
			</h3>
			@include('poder_judicial.oojj.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>ID</th>
						<th>Nombre</th>
						<th>Sede</th>
						<th>Opciones</th>
					</thead>
					@foreach($oojj as $cat)
					<tr>
						<td>{{$cat->id}}</td>
						<td>{{$cat->nombre}}</td>
						<td>{{$cat->sede}}</td>
						<td>
							@can('poder_judicial.oojj.show')
							<a href="{{route('poder_judicial.oojj.show',$cat->id)}}"><button style="margin-right: 10px" class="btn btn-info">Detalles</button></a>
							@endcan
							@can('poder_judicial.oojj.edit')
							<a href="{{route('poder_judicial.oojj.edit',$cat->id)}}"><button style="margin-right: 10px" class="btn btn-info">Editar</button></a>
							@endcan
							@can('poder_judicial.oojj.destroy')
							<a href="" data-target="#modal-delete-{{$cat->id}}" data-toggle="modal"><button style="margin-right: 10px" class="btn btn-danger">Eliminar</button></a>
							@endcan
						</td>
					</tr>
					@include('poder_judicial.oojj.modal')
					@endforeach
				</table>
			</div>
			{{$oojj->render()}}
		</div>
	</div>
</div>
@endsection