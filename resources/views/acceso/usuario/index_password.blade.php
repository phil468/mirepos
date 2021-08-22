<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-password-{{$usu->id}}">
	{{Form::Open(['route'=>['acceso.usuario.password',$usu->id],'method'=>'PUT'])}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Cambiar Contraseña</h4>
			</div>
			<div class="modal-body">
				@if(count($errors)>0)
	            <div class="alert alert-danger">
	                <ul>
	                    @foreach($errors->all() as $error)
	                    <li>{{$error}}</li>
	                    @endforeach
	                </ul>
	            </div>
	            @endif
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    <label for="password" class="control-label">Nueva Contraseña</label> 
	                    <input id="password" type="password" class="form-control" name="password" required autofocus>
	                    @if ($errors->has('password'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('password') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>
	            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    <label for="password-confirm" class="control-label">Confirmar Contraseña</label>
	                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autofocus>
	                    @if ($errors->has('password_confirmation'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('password_confirmation') }}</strong>
	                        </span>
	                    @endif
	                </div>
            	</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::close()}}
</div>