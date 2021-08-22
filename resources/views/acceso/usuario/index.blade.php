@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Usuarios
				@can('acceso.usuario.create')
				<a href="{{route('acceso.usuario.create')}}"> <button class="btn btn-success">Nuevo Usuario</button></a>
				@endcan
			</h3>
			@include('acceso.usuario.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>ID</th>
						<th>Nombre</th>
						<th>DNI</th>
						<th>Opciones</th>
					</thead>
					@foreach($usuario as $usu)
					<tr>
						<td>{{$usu->id}}</td>
						<td>{{$usu->name}}</td>
						<td>{{$usu->dni}}</td>
						<td>
							@can('acceso.usuario.show')
							<a href="{{route('acceso.usuario.show',$usu->id)}}"><button style="margin-right: 10px" class="btn btn-secondary">Ver</button></a>
							@endcan
							@can('acceso.usuario.edit')
							<a href="{{route('acceso.usuario.edit',$usu->id)}}"><button style="margin-right: 10px" class="btn btn-info">Editar</button></a>
							@endcan
							@can('acceso.usuario.assignRol')
							<a href="{{route('acceso.usuario.assignRol',$usu->id)}}"><button style="margin-right: 10px" class="btn btn-primary">Asignar Rol</button></a>
							@endcan
							@can('acceso.usuario.assignSede')
							<a href="{{route('acceso.usuario.assignSede',$usu->id)}}"><button style="margin-right: 10px" class="btn btn-warning">Asignar Sede</button></a>
							@endcan
							@can('acceso.usuario.password')
							<a href="" data-target="#modal-password-{{$usu->id}}" data-toggle="modal"><button style="margin-right: 10px" class="btn btn-success">Cambiar Contraseña</button></a>
							@endcan
							@can('acceso.usuario.destroy')
							<a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal"><button style="margin-right: 10px" class="btn btn-danger">Eliminar</button></a>
							@endcan
						</td>
					</tr>
					@include('acceso.usuario.modal')
					@include('acceso.usuario.index_password')
					@endforeach
				</table>
			</div>
			{{$usuario->render()}}
		</div>
	</div>
</div>
@endsection