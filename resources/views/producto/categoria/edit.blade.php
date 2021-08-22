@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Categoria: {{$categoria->nombre}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!! Form::model($categoria, ['route' => ['producto.categoria.update', $categoria->id],
                    'method' => 'PUT']) !!}
			{{Form::token()}}

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="name" class="control-label">Nombre</label>
                    <input id="nombre" type="text" class="form-control" name="nombre" required value="{{ $categoria->nombre }}" autofocus>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
					<label>Descripción </label>
					<textarea rows="4" cols="150" name="descripcion" class="form-control" placeholder="Descripción">{{$categoria->descripcion}}</textarea>
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