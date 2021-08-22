<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-subir_pecosa-{{$cat->id}}">
	{{Form::Open(['route'=>['pedidos.pecosa.subir_pecosa',$cat->id],'method'=>'POST','files'=>'true'])}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Subir Pecosa Firmada</h4>
			</div>
			<div class="modal-body">
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<div class="form-group">
						<label>Foto de la Pecosa</label>
						<input type="file" name="imagen"   class="form-control" >
						<br>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::close()}}
</div>