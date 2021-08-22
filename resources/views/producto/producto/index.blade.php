@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Productos
				@can('producto.producto.create')
				<a href="{{route('producto.producto.create')}}"> <button class="btn btn-success">Nuevo Producto</button></a>
				@endcan
			</h3>
			@include('producto.producto.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>CODIGO</th>
						<th>Descripción</th>
						<th>Opciones</th>
					</thead>
					@foreach($producto as $cat)
					<tr>
						<td>{{$cat->codigo}}</td>
						<td>{{$cat->descripcion}}</td>
						<td>
							@can('producto.producto.edit')
							<a href="{{route('producto.producto.edit',$cat->id)}}"><button style="margin-right: 10px" class="btn btn-info">Editar</button></a>
							@endcan
							@can('producto.producto.destroy')
							<a href="" data-target="#modal-delete-{{$cat->id}}" data-toggle="modal"><button style="margin-right: 10px" class="btn btn-danger">Eliminar</button></a>
							@endcan
						</td>
					</tr>
					@include('producto.producto.modal')
					@endforeach
				</table>
			</div>
			{{$producto->render()}}
		</div>
	</div>
</div>
@endsection