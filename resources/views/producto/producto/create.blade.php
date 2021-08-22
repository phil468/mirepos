@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Producto</h3>
            @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!!Form::open(['route'=>'producto.producto.store','method'=>'POST'])!!}
            {{Form::token()}}
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label>Categoría</label>
                <select name="categoria_id" id="categoria_id" class="form-control selectpicker" data-live-search="true" required autofocus>
                  <option value="" >-- Selecionar Categoría</option>
                  @foreach($categoria as $pro)
                  @if (old('categoria_id') == $pro)
                  <option value="{{$pro->id}}" selected>{{$pro->nombre}}</option>
                  @else
                  <option value="{{$pro->id}}">{{$pro->nombre}}</option>
                  @endif
                  @endforeach
                </select>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="codigo" class="control-label">Código</label>
                    <input id="codigo" type="text" class="form-control" name="codigo" required value="{{ old('codigo') }}" autofocus>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group {{ $errors->has('observation') ? ' has-error' : '' }}">
                  <label for="descripcion">Descripción</label>
                  <textarea id="descripcion" rows="4" cols="150" name="descripcion" class="form-control" placeholder="Descripción">{{ old('descripcion') }}</textarea>
                  @if ($errors->has('descripcion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('descripcion') }}</strong>
                    </span>
                  @endif
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                <label for="CANTIDAD" class="control-label">Cantidad</label>
                    <input id="CANTIDAD" type="number" step="0.001" class="form-control" name="CANTIDAD" required value="{{ old('CANTIDAD') }}" autofocus>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                <label for="UM" class="control-label">UNIDAD DE MEDIDA</label>
                    <input id="UM" type="text" class="form-control" name="UM" required value="{{ old('UM') }}" autofocus>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                <label for="PRE_UNIT" class="control-label">Precio Unitario</label>
                    <input id="PRE_UNIT" type="number" step="0.0001" class="form-control" name="PRE_UNIT" required value="{{ old('PRE_UNIT') }}" autofocus>
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
  {!!Form::close()!!}
@push('scripts')
  <script src="/js/producto/create.js" > 
  </script>
@endpush
@endsection
