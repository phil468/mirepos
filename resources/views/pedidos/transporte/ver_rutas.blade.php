@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('/css/imprimir.css')}}">
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
            	<br>
                <center><img  src="{{asset('img/logo.png') }}" height="80px" width="90px"></center>
				<h2><center>Listado de Pecosas por Ruta
				<center></h2>
                <div class="panel-body">  
	                @include('pedidos.transporte.filtro_ruta')   
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th width="10px"><CENTER>N° de Pecosa</CENTER></th>
								<th><CENTER>Sede</CENTER></th>
								<th><CENTER>Direcciòn</CENTER></th>
								<th><CENTER>Administrador</CENTER></th>
							</tr>	
						</thead>
						<tbody>
							<?php $i=0 ?>
							@foreach($ruta_pecosa as $reg)
							<tr>
								<td>{{$reg->codigo}}</td>
								<td>{{$reg->sede}}</td>
								<td>{{$reg->direccion}}</td>
								<td>{{$reg->name}}</td>
		                    </tr>
		                    <?php $i++ ?>
		                	@endforeach
		                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                		<center><p>{{'Se encontraron '.$i.' registros'}}</p></center>	
		                	</div>
		                </tbody>	
					</table>	
				</div>
			</div>
		</div>
	</div>
</div>

@endsection