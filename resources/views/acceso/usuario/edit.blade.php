@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Editar Usuario: {{$usuario->nombre}}</h3>
            @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!! Form::model($usuario, ['route' => ['acceso.usuario.update', $usuario->id],
                    'method' => 'PUT','files'=>'true']) !!}
            {{Form::token()}}
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <center>
                        @if(($usuario ->foto)!="")
                        <img src="{{asset('public/img/usuario/'.$usuario->foto)}}" id="img">
                        @else
                        <img src="{{asset('img/user.jpg')}}" id="img">
                        @endif
                        <div class="image-upload">
                            <label for="file-input">
                                <img src="{{asset('img/fotografia.png')}}"/>
                            </label>
                            <input id="file-input" type="file" name="foto"/>
                        </div>
                  </center>  
                </div>
            </div>
             <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">        
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label for="name" class="control-label">Nombre</label>
                    <input id="name" type="text" class="form-control" name="name" required value="{{ $usuario->name }}" autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label for="user" class="control-label">Usuario</label>
                    <input id="user" type="text" class="form-control"  name="user" required value="{{ $usuario->user }}" autofocus>
                    @if ($errors->has('user'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">        
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label for="dni" class="control-label">Documento de Identidad</label>
                    <input id="dni" type="text" class="form-control" readonly name="dni" required value="{{ $usuario->dni }}" autofocus>
                    @if ($errors->has('dni'))
                        <span class="help-block">
                            <strong>{{ $errors->first('dni') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label for="email" class="control-label">Correo Electronico </label>
                    <input id="email" type="email" class="form-control" name="email"  value="{{ $usuario->email }}" autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
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
<style type="text/css">
    
    #img {
      
      width: 350px;
      height: 350px;
      object-fit: cover;
      border-radius: 50%;
      opacity: 0.5;
      filter: alpha(opacity=50);
    }

    .image-upload > input
    {
        display: none;
    }

    .image-upload img
    {
        width: 80px;
        cursor: pointer;
        position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          -ms-transform: translate(-50%, -50%);
    }
    @media only screen and (max-width: 600px) {
      /* For tablets: */
        #img  {
          width: 250px; 
          height: 250px;
        }
        .image-upload img
        {
            width: 40px;
        }
    }
</style>
{!!Form::close()!!}
@endsection