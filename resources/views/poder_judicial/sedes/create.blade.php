@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nueva Sede</h3>
            @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!!Form::open(['route'=>'poder_judicial.sedes.store','method'=>'POST'])!!}
            {{Form::token()}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="name" class="control-label">Nombre</label>
                    <input id="nombre" type="text" class="form-control" name="nombre" required value="{{ old('nombre') }}" autofocus>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group {{ $errors->has('observation') ? ' has-error' : '' }}">
                  <label for="direccion">Dirección</label>
                  <input id="direccion" type="text" class="form-control" name="direccion" required value="{{ old('direccion') }}" autofocus>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group {{ $errors->has('observation') ? ' has-error' : '' }}">
                  <label for="coordenadas_x">Coordenadas X</label>
                  <input id="coordenadas_x" type="text" class="form-control" name="coordenadas_x" value="{{ old('coordenadas_x') }}" >
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group {{ $errors->has('observation') ? ' has-error' : '' }}">
                  <label for="coordenadas_y">Coordenadas Y</label>
                  <input id="coordenadas_y" type="text" class="form-control" name="coordenadas_y"  value="{{ old('coordenadas_y') }}">
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
  {!!Form::close()!!}
@endsection