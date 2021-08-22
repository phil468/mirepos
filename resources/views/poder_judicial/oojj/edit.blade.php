@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Órgano Juridiccional: {{$oojj->nombre}}</h3>
            @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!! Form::model($oojj, ['route' => ['poder_judicial.oojj.update', $oojj->id],
                    'method' => 'PUT']) !!}
            {{Form::token()}}

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="name" class="control-label">Nombre</label>
                    <input id="nombre" type="text" class="form-control" name="nombre" required value="{{ $oojj->nombre }}" autofocus>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Sede</label>
                    <select name="sede_id" class="form-control" data-live-search="true" required autofocus> 
                        <option value="" >-- Selecionar Sede</option>  
                        @foreach($sede as $pro)
                            <option value="{{$pro->id}}" @if($pro->id==$oojj->sede_id) selected='selected' @endif>{{$pro->nombre}}</option>
                         @endforeach
                    </select>
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