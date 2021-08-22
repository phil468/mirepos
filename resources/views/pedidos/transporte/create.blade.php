@extends('layouts.app')
@section('content')

<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['map'],
      // Note: you will need to get a mapsApiKey for your project.
      // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
      'mapsApiKey': 'AIzaSyA7N9IG4efvb2TDbrbyyaRwQ3qxziBUtMc'
    });
    google.charts.setOnLoadCallback(drawMap);

    function drawMap () {
      var data = google.visualization.arrayToDataTable([
          ['Lat', 'Long', 'Name'],
          @foreach($pedido as $p)
          [{{$p->coordenadas_x}},{{$p->coordenadas_y}}, '{{$p->sede}}'],
          @endforeach
        ]);

      var options = {
        mapType: 'styledMap',
        zoomLevel: 12,
        showTooltip: true,
        showInfoWindow: true,
        useMapTypeControl: true,
        maps: {
          // Your custom mapTypeId holding custom map styles.
          styledMap: {
            name: 'Styled Map', // This name will be displayed in the map type control.
            styles: [
              {featureType: 'poi.attraction',
               stylers: [{color: '#fce8b2'}]
              },
              {featureType: 'road.highway',
               stylers: [{hue: '#0277bd'}, {saturation: -50}]
              },
              {featureType: 'road.highway',
               elementType: 'labels.icon',
               stylers: [{hue: '#000'}, {saturation: 100}, {lightness: 50}]
              },
              {featureType: 'landscape',
               stylers: [{hue: '#259b24'}, {saturation: 10}, {lightness: -22}]
              }
        ]}}      };

      var map = new google.visualization.Map(document.getElementById('map_div'));

      map.draw(data, options);
    }
  </script>
</head>



<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Asignar Pecosas a {{$ruta->ruta}}</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!! Form::model($ruta, ['route' => ['pedidos.transporte.store', $ruta->id],
                    'method' => 'PUT']) !!}
			{{Form::token()}}
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Transportista</label>
                    <select name="transportista_id" id="transportista_id" class="form-control selectpicker" data-live-search="true" required autofocus>
                      <option value="">--Seleccionar Transportista</option>
                      @foreach($transporte as $transporte)
                      <option value="{{$transporte->id}}">{{$transporte->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="form-group">
                     <label for="nombre">Fecha de Envio</label>
                    <input type="date" name="fecha" class="form-control" required value="{{ old('fecha') }}" autofocus>
                    
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <h3>Lista de Pedidos</h3>
               <div class="form-group">
                    <ul class="list-unstyled">
                    @foreach($pedido as $rol)
                    <li>
                        <label>
                            {{Form::checkbox('id[]',$rol->id,null)}}
                            {{'Pecosa Nº '.$rol->num_pecosa.' - '.$rol->sede.' / '.$rol->oojj}}
                        </label>
                    </li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <div id="map_div" style="height: 500px; width: 900px"></div>
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

