@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Usuario</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(['route'=>'acceso.usuario.store','method'=>'POST','files'=>'true'])!!}
			{{Form::token()}}
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">        
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="name" class="control-label">Nombre</label>
                    <input id="name" type="text" class="form-control" name="name" required value="{{ old('name') }}" autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">    
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="user" class="control-label">Usuario</label>
                    <input id="user" type="text" class="form-control" name="user" required value="{{ old('user') }}" autofocus>
                    @if ($errors->has('user'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">        
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="dni" class="control-label">Documento de Identidad</label>
                    <input id="dni" type="text" class="form-control" name="dni" required value="{{ old('dni') }}" autofocus>
                    @if ($errors->has('dni'))
                        <span class="help-block">
                            <strong>{{ $errors->first('dni') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="email" class="control-label">Correo Electronico </label>
                    <input id="email" type="email" class="form-control " name="email" required value="{{ old('email') }}" autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="password" class="control-label">Contraseña</label>     
                    <input id="password" type="password" class="form-control" name="password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="password-confirm" class="control-label">Confirmar Contraseña</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>  
            <div class="form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>IMAGEN</label>
                    <input type="file" name="foto"   class="form-control" >
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