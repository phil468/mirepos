@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Usuario: {{$roles->name}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!! Form::model($roles, ['route' => ['acceso.roles.update', $roles->id],
                    'method' => 'PUT']) !!}
			{{Form::token()}}

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                            <label for="name" class="control-label">Nombre</label>
                                <input id="name" type="text" class="form-control" name="name" required value="{{ $roles->name }}" autofocus>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                            <label for="slug" class="control-label">Slug</label>
                                <input id="slug" type="text" readonly class="form-control" name="slug" required value="{{ $roles->slug }}" autofocus>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                            <label for="description" class="control-label">Descripción</label>
                                <input id="description" type="text" class="form-control" name="description" required value="{{ $roles->description }}" autofocus>
                            </div>
                        </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3>Permiso Especial</h3>
                            <div class="form-group">
                                <label>{{Form::radio('special','all-access')}} Acceso Total</label>
                                <label>{{Form::radio('special','no-access')}} Acceso Denegado</label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3>Lista de Permisos</h3>
                            <div class="form-group">
                                <ul class="list-unstyled">
                                    @foreach($permissions as $permission)
                                    <li>
                                        <label>
                                            {{Form::checkbox('permissions[]',$permission->id, null)}}
                                            {{$permission->name}}
                                            <em>({{$permission->description ?:'Sin descripción' }})</em>
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="form-group">
                            <br>
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