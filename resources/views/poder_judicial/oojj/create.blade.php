@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Órgano Juridiccional</h3>
            @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!!Form::open(['route'=>'poder_judicial.oojj.store','method'=>'POST'])!!}
            {{Form::token()}}
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label>Sede</label>
                <select name="sede_id" class="form-control selectpicker" data-live-search="true" required autofocus>
                  <option value="" >-- Selecionar Sede</option>
                  @foreach($sede as $pro)
                  @if (old('sede_id') == $pro)
                  <option value="{{$pro->id}}" selected>{{$pro->nombre}}</option>
                  @else
                  <option value="{{$pro->id}}">{{$pro->nombre}}</option>
                  @endif
                  @endforeach
                </select>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="name" class="control-label">Nombre</label>
                    <input id="nombre" type="text" class="form-control" name="nombre" required value="{{ old('nombre') }}" autofocus>
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