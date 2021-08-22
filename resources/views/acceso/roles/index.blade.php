@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Roles
				@can('acceso.roles.create')
				<a href="{{route('acceso.roles.create')}}"> <button class="btn btn-success">Nuevo Role</button></a>	
				@endcan			
			</h3>
			@include('acceso.roles.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>ID</th>
						<th>Nombre</th>
						<th>Slug</th>
						<th>Descripción</th>
						<th>Opciones</th>
					</thead>
					@foreach($roles as $usu)
					<tr>
						<td>{{$usu->id}}</td>
						<td>{{$usu->name}}</td>
						<td>{{$usu->slug}}</td>
						<td>{{$usu->description}}</td>
						<td>
							@can('acceso.roles.edit')
							<a href="{{route('acceso.roles.edit',$usu->id)}}"><button style="margin-right: 10px" class="btn btn-info">Editar</button></a>
							@endcan
							@can('acceso.roles.destroy')
							<a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal"><button style="margin-right: 10px" class="btn btn-danger">Eliminar</button></a>
							@endcan
						</td>
					</tr>
					@include('acceso.roles.modal')
					@endforeach
				</table>
			</div>
			{{$roles->render()}}
		</div>
	</div>
</div>
@endsection