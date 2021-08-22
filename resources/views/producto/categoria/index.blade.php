@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Categorias
				@can('producto.categoria.create')
				<a href="{{route('producto.categoria.create')}}"> <button class="btn btn-success">Nuevo categoria</button></a>
				@endcan
			</h3>
			@include('producto.categoria.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>ID</th>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Opciones</th>
					</thead>
					@foreach($categoria as $cat)
					<tr>
						<td>{{$cat->id}}</td>
						<td>{{$cat->nombre}}</td>
						<td>{{$cat->descripcion}}</td>
						<td>
							@can('producto.categoria.edit')
							<a href="{{route('producto.categoria.edit',$cat->id)}}"><button style="margin-right: 10px" class="btn btn-info">Editar</button></a>
							@endcan
							@can('producto.categoria.destroy')
							<a href="" data-target="#modal-delete-{{$cat->id}}" data-toggle="modal"><button style="margin-right: 10px" class="btn btn-danger">Eliminar</button></a>
							@endcan
						</td>
					</tr>
					@include('producto.categoria.modal')
					@endforeach
				</table>
			</div>
			{{$categoria->render()}}
		</div>
	</div>
</div>
@endsection