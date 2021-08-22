@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Asignar Rol a {{$usuario->name}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!! Form::model($usuario, ['route' => ['acceso.usuario.rolAssigned', $usuario->id],
                    'method' => 'PUT']) !!}
			{{Form::token()}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <h3>Lista de Roles</h3>
               <div class="form-group">
                    <ul class="list-unstyled">
                    @foreach($roles as $rol)
                    <li>
                        <label>
                            {{Form::checkbox('roles[]',$rol->id,null)}}
                            {{$rol->name}}
                            <em>({{$rol->description ?: 'Sin Descripción'}})</em>
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
{!!Form::close()!!}
@endsection