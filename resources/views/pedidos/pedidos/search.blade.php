{!! Form::open(array('url'=>'pedidos/pedidos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		<SPAN class="input-group-btn">
			<button type="submit" class="btn btn-primary">
				Buscar
			</button>
		</SPAN>
	</div>
</div>

{{Form::close()}}