@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Rutas
				
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<?php $i=1 ?>
						<th>Nº</th>
						<th>Ruta</th>
						<th>Opciones</th>
					</thead>
					@foreach($ruta as $cat)
					<tr>
						<td>{{$i}}</td>
						<td>{{$cat->ruta}}</td>
						<td>
							@can('pedidos.transporte.create')
							<a href="{{route('pedidos.transporte.create',$cat->id)}}"><button style="margin-right: 10px" class="btn btn-warning">Asignar Transportista</button></a>
							@endcan
						</td>
					</tr>
					
					<?php $i++ ?>
					@endforeach

				</table>
			</div>
		</div>
	</div>
</div>
@endsection