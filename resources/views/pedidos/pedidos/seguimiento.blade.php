@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('/css/imprimir.css')}}">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			@foreach($pecosa as $pecosa)
      <center>    
      <table id="estado">
        <tr>
        @if($pecosa->estado_pedido == 'Preparando')  
        <tr>
          <td>
          <span class="red1">Solicitud Enviada</span>  
          </td>
          <td>  
          <span class="red" style="margin-left: 16px">Orden confirmada</span>
          </td>
          <td>
          <span class="grey" style="margin-left: 16px">Orden lista para envio</span> 
          </td>
          <td>
          <span class="grey" style="margin-left: 16px">Orden entregada</span>       
          </td>
        </tr>
        <tr>
          <td>
            <p><center>Administrador de sede</center></p>
          </td>
          <td>
            <p><center>Almacén</center></p>
          </td>
        </tr>
        <tr>
          <td><center>{{ $pecosa->fecha_pedido }}</center></td>
          <td><center>{{ $pecosa->fecha_pecosa }}</center></td>
          <td><center></center></td>
          <td><center></center></td>
        </tr>
        @elseif($pecosa->estado_pedido == 'En reparto')
        <tr>
          <td>
          <span class="red1">Solicitud Enviada</span>
          </td>
          <td>
          <span class="red" style="margin-left: 16px">Orden confirmada</span>       
          </td>
          <td>    
          <span class="yellow" style="margin-left: 16px">Orden lista para envio</span> 
          </td>
          <td>  
          <span class="grey" style="margin-left: 16px">Orden entregada</span> 
        	</td>
        </tr>
        <tr>
          <td>
            <p><center>Administrador de sede</center></p>
          </td>
          <td>
            <p><center>Almacén</center></p>
          </td>
          <td>
            <p><center>Transporte</center></p>
          </td>
        </tr>
        <tr>
          <td><center>{{ $pecosa->fecha_pedido }}</center></td>
          <td><center>{{ $pecosa->fecha_pecosa }}</center></td>
          <td><center>{{ $pecosa->fecha_envio }}</center></td>
          <td><center></center></td> 
        </tr>  
        @elseif($pecosa->estado_pedido == 'Entregado')
        <tr>  
          <td>
          <span class="red1">Solicitud Enviada</span>
          </td>
          <td>
          <span class="red" style="margin-left: 16px">Orden confirmada</span> 
          </td>
          <td>
          <span class="yellow" style="margin-left: 16px">Orden lista para envio</span>      
          </td>
          <td>
          <span class="green" style="margin-left: 16px">Orden entregada</span> 
          </td>
        </tr>
        <tr>
          <td>
            <p><center>Administrador de sede</center></p>
          </td>
          <td>
            <p><center>Almacén</center></p>
          </td>
          <td>
            <p><center>Transporte</center></p>
          </td>
          <td>
            <p><center>Transporte / Administrador de Sede</center></p>
          </td>
        </tr>
        <tr>
          <td><center>{{ $pecosa->fecha_pedido }}</center></td>
          <td><center>{{ $pecosa->fecha_pecosa }}</center></td>
          <td><center>{{ $pecosa->fecha_envio }}</center></td>
          <td><center>{{ $pecosa->fecha_entrega }}</center></td> 
        </tr>  
        @else
        <tr>  
          <td>
          <span class="red1">Solicitado</span>
          </td>
          <td>
          <span class="grey" style="margin-left: 16px">Recibido </span> 
          </td>
          <td>
          <span class="grey" style="margin-left: 16px">Enviado</span>      
          </td>
          <td>
          <span class="grey" style="margin-left: 16px">Entregado</span>
          </td>
        </tr>
        <tr>
          <td>
            <p><center>Administrador de sede</center></p>
          </td>
        </tr>
        <tr>
          <td><center>{{ $pecosa->fecha_pedido }}</center></td>
          <td><center></center></td>
          <td><center></center></td>
          <td><center></center></td>                                                        
        </tr> 
        @endif 
      </table>
      </center>  
      <br>
      <br>
    </div>
  </div>
  <div>
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
      </div>
      @endforeach 
    </div>
      <a href="{{ URL::previous() }}" id="regresarButton" class="btn btn-danger">Regresar</a>
      <button id="printPageButton" onclick="window.print();" class="btn btn-info">Imprimir</button>
  </div>
</div>      
<style type="text/css">






span.grey {
  background: #cccccc;
  border-radius: 5.8em;
  -moz-border-radius: 5.8em;
  -webkit-border-radius: 5.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 10.6em;
  margin-right: 15px;
  text-align: center;
  width: 10.6em;  
}

span.green {
  background: #5EA226;
  border-radius: 5.8em;
  -moz-border-radius: 5.8em;
  -webkit-border-radius: 5.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 10.6em;
  margin-right: 15px;
  text-align: center;
  width: 10.6em; 
}

span.red1 {
  background: #7E1B1B;
  border-radius: 5.8em;
  -moz-border-radius: 5.8em;
  -webkit-border-radius: 5.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 10.6em;
  margin-right: 15px;
  text-align: center;
  width: 10.6em; 
}

span.red {
  background: #EE0F08;
  border-radius: 5.8em;
  -moz-border-radius: 5.8em;
  -webkit-border-radius: 5.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 10.6em;
  margin-right: 15px;
  text-align: center;
  width: 10.6em; 
}

span.yellow {
  background: #FAA906;
  border-radius: 5.8em;
  -moz-border-radius: 5.8em;
  -webkit-border-radius: 5.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 10.6em;
  margin-right: 15px;
  text-align: center;
  width: 10.6em; 
}
</style>
@endsection