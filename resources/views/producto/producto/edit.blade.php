@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Producto: {{$producto->nombre}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!! Form::model($producto, ['route' => ['producto.producto.update', $producto->id],
                    'method' => 'PUT']) !!}
			{{Form::token()}}

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="name" class="control-label">Nombre</label>
                    <input id="nombre" type="text" class="form-control" name="nombre" required value="{{ $producto->nombre }}" autofocus>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="nombre">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-control" data-live-search="true" required autofocus> 
                      <option value="" >-- Selecionar Categoría</option>  
                      @foreach($categoria as $cat)
                              <option value="{{$cat->id}}" @if($cat->id==$producto->categoria_id) selected='selected' @endif>{{$cat->nombre}}</option>
                      @endforeach
                     </select>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
						<label>Descripción </label>
						<textarea rows="4" cols="150" name="descripcion" class="form-control" placeholder="Descripción">{{$producto->descripcion}}</textarea>
						@if ($errors->has('descripcion'))
			                <span class="help-block">
			                	<strong>{{ $errors->first('descripcion') }}</strong>
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
  {!!Form::close()!!}
@endsection