@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Sede: {{$sedes->nombre}}</h3>
            @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!! Form::model($sedes, ['route' => ['poder_judicial.sedes.update', $sedes->id],
                    'method' => 'PUT']) !!}
            {{Form::token()}}

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="name" class="control-label">Nombre</label>
                    <input id="nombre" type="text" class="form-control" name="nombre" required value="{{ $sedes->nombre }}" autofocus>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                    <label>Dirección </label>
                    <input id="direccion" type="text" class="form-control" name="direccion" required value="{{ $sedes->direccion }}" autofocus>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                    <label>coordenadas X </label>
                    <input id="coordenadas_x" type="text" class="form-control" name="coordenadas_x"  value="{{ $sedes->coordenadas_x }}" >
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                    <label>coordenadas Y </label>
                    <input id="coordenadas_y" type="text" class="form-control" name="coordenadas_y"  value="{{ $sedes->coordenadas_y }}" >
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