@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	@can('pedidos.pedidos.index')
        <center><img src="{{asset('img/medidas.jpg')}}" class="responsive"></center>
        @endcan
    </div>
</div>
<style type="text/css">
	.responsive {
	  width: 100%;
	  height: auto;
	}
</style>
@endsection