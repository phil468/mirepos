@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Editar Permiso: {{$permisos->name}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!! Form::model($permisos, ['route' => ['acceso.permisos.update', $permisos->id],
                    'method' => 'PUT']) !!}
			{{Form::token()}}
			
			<div class="row">
				<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
					<div class="form-group">
						<label for="name">Nombre:</label>
						<input type="text" name="name"required value="{{$permisos->name}}" class="form-control" autofocus>
					</div>
				</div>	
				<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
					<div class="form-group">
						<label for="slug">Slug:</label>
						<input type="text" name="slug"  required value="{{$permisos->slug}}" class="form-control"  autofocus>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="description">Descripción:</label>
						<input type="text" name="description" required value="{{$permisos->description}}" class="form-control" autofocus>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Guardar</button>
						<a href="{{ URL::previous() }}" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>		
	{!!Form::close()!!}

@endsection