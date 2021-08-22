@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3> Organo Juridiccional</h3>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="name" class="control-label">Nombre</label>
                        <p>{{$oojj->oojj}}</p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="name" class="control-label">Sede</label>
                        <p>{{$oojj->sede}}</p>
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