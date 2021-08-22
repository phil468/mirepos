@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('/css/imprimir.css')}}">
<div class="container">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <center><img  src="{{asset('img/logo.png') }}" height="80px" width="90px"></center>
            <br>
          </div>    
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <center><h3> PEDIDO DE COMPROBANTE DE SALIDA</h3></center>
            <br>
          </div>
        </div>
        @foreach($pecosa as $pecosa)
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <p>Entregar a: <b>{{$pecosa->admin}}</b></p>
            <p>Con destino a: <b>{{$pecosa->sede.' - '.$pecosa->oojj}}</b></p>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <p>Fecha y Hora: <b>{{$pecosa->fecha}}</b></p>
              <p>Salida N°: <b>{{$pecosa->num_pecosa}}</b></p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <p>Observación: {{$pecosa->observacion}}</p>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="table-responsive">
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
              <thead style="background-color: #A9D0F5">
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Importe</th>
                <th>Importe Total</th>
              </thead>
              <tfoot>
                <th align="right"><h4><B>TOTAL</B></h4></th>
                <th></th>
                <th></th>
                <th><h4 id="total"><b>{{'S/. '.$pecosa->total_pecosa}}</b></h4></th>
              </tfoot>
              <tbody>   
              @foreach($detalles as $det)
                <tr>
                  <td>{{$det->descripcion}}</td>
                  <td>{{$det->cantidad.' '.$det->UM}}</td>
                  <td>{{'S/. '.$det->importe}}</td>
                  <td>{{'S/. '.$det->importe_total}}</td>
                </tr>
              @endforeach           
              </tbody>
            </table>
          </div>
        </div>  
        @endforeach
      </div> 
    </div>
      <a href="{{ URL::previous() }}" id="regresarButton" class="btn btn-danger">Regresar</a>
      <button id="printPageButton" onclick="window.print();" class="btn btn-info">Imprimir</button>
  </div>
</div>
@endsection