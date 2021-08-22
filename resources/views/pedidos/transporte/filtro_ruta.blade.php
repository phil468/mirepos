{!! Form::open(array('url'=>'pedidos/transporte/ver_rutas','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class="card card-primary">
	<div class="card-body"> 
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="row">              	       
			    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group">
					  <label for="nombre">Ruta</label>
					  <select name="id" id="id" value="{{$id}}" class="form-control selectpicker" data-live-search="true" required autofocus>
					  <option value="">--Seleccionar Ruta</option>
					  @foreach($ruta as $ruta)
					  <option value="{{$ruta->id}}" @if($ruta->id==$id) selected='selected' @endif>{{$ruta->ruta}}</option>
					  @endforeach
					  </select>
					</div>
	            </div>
	            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
					<div class="form-group">
					  <label for="nombre">Transportista</label>
					  <select name="transportista_id" id="transportista_id" value="{{$transportista_id}}" class="form-control selectpicker" data-live-search="true" required autofocus>
					  <option value="">--Seleccionar Transportista</option>
	                      @foreach($transporte as $transporte)
	                      <option value="{{$transporte->id}}" @if($transporte->id==$transportista_id) selected='selected' @endif>{{$transporte->name}}</option>
	                      @endforeach
	                  </select>    
					</div>
	            </div>
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                <div class="form-group">
	                     <label for="nombre">Fecha de Envio</label>
	                    <input type="date" name="fecha" class="form-control" value="{{$fecha}}" required autofocus> 
	                </div>
	            </div>
	            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	            	<br>
		            <button id="filtroButton" type="submit" class="btn btn-primary">Aplicar Filtro</button>
		        </div> 
		        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
	            	<br>
		        <button id="printPageButton" onclick="window.print();" class="btn btn-info">Imprimir</button>
		        </div> 
		    </div> 
		</div>        
	</div>  
</div>	
{{Form::close()}}