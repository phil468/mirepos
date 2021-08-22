@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('/css/imprimir.css')}}">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			@foreach($pedidos as $pedidos)
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <center><img  src="{{asset('img/logo.png') }}" height="80px" width="90px"></center>
            </div>    
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <center><h3> Solicitud de Pedido N° {{$pedidos->codigo}}</h3></center>
                <br>
            </div> 
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <br>
                    <label for="role" class="control-label">Fecha de la Solicitud </label>
                    <p>{{$pedidos->fecha}}</p>
                </div>
            </div>  
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="name" class="control-label">Departamento Solicitante</label>
                <p>{{$pedidos->sede.' - '.$pedidos->oojj}}</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="name" class="control-label">Solicitante</label>
                <p>{{$pedidos->admin}}</p>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </thead>
                        <tfoot>
                            <th align="right"><h4><B>TOTAL</B></h4></th>
                            <th><B><h4 id="total">{{$pedidos->total_producto.' ARTICULOS'}}</B></h4></th>
                        </tfoot>
                        <tbody>   
                        @foreach($detalles as $det)
                            <tr>
                                <td>{{$det->descripcion}}</td>
                                <td>{{$det->cantidad.' '.$det->UM}}</td>
                            </tr>
                        @endforeach           
                        </tbody>
                    </table>
              @endforeach
              <a href="{{ URL::previous() }}" id="regresarButton" class="btn btn-danger">Regresar</a>
              <button id="printPageButton" onclick="window.print();" class="btn btn-info">Imprimir</button>
            </div>
          </div>
        </div>
	</div>
</div>
@endsection