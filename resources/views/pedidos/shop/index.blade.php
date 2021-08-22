@extends('layouts.app')
@section('content')
<div class="container products">
 		@include('pedidos.shop.search')
        <div class="row">
 			
            @foreach($products as $product)
                <div class="col-xs-18 col-sm-6 col-md-3">
                    <div class="thumbnail" >
                        <img src="{{asset('/public/img/productos/'.$product->codigo.'.jpg')}}" style="height: 220px;">
                        <div class="caption">
                            <h4>{{ $product->descripcion }}</h4>
                            <p><strong>Codigo: </strong> {{ $product->id }}</p>
                            <p><strong>Codigo: </strong> {{ $product->codigo }}</p>
                            <p><strong>UM: </strong> {{ $product->UM }}</p>
                            <p class="btn-holder"><a href="{{ url('add-to-cart/'.$product->id) }}" class="btn btn-warning btn-block text-center" role="button">Añadir al carrito</a> </p>
                        </div>
                    </div>
                </div>
            @endforeach
 
        </div><!-- End row -->
        {{$products->render()}}
    </div>
@endsection