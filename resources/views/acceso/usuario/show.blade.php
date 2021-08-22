@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3> Usuario</h3>
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="name" class="control-label">Nombre</label>
                        <p>{{$usuario->name}}</p>
                </div>
            </div>
            <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="dni" class="control-label">Documento de identidad </label>
                        <p>{{$usuario->dni}}</p>
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="email" class="control-label">Correo Electronico </label>
                        <p>{{$usuario->email}}</p>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="role" class="control-label">Role </label>
                            <p>{{$usuario->rol}}</p>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="role" class="control-label">Sede </label>
                        @foreach($sede as $det)    
                            <p>{{$det->nombre}}</p>
                        @endforeach    
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <img src="{{asset('img/usuario/'.$usuario->foto)}}" alt="{{$usuario->foto}}" height="300px" width="300px">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <a href="{{ URL::previous() }}" class="btn btn-danger">Regresar</a>
                </div>
            </div>    
        </div>
	</div>
</div>
@endsection