@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card card-default">
                <div class="card-header">
                  <h3>Nueva Solicitud de Pedido</h3>
        
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Por favor corrige los siguentes errores:</strong>
                      <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                      </ul>
                    </div>   
                  @endif
                </div>
                {!!Form::open(['route'=>'pedidos.pedidos.store','method'=>'POST'])!!}
                {{Form::token()}}
                <div class="container">
                  <div class="panel-body">
                      <div class="row">
                          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                              <div class="form-group">
                                  <label for="nombre">Sede</label>
                                  <select name="sede_id" id="sede_id" class="form-control" data-live-search="true" required autofocus>
                                  <option value="">--Seleccionar Sede</option>
                                  @foreach($sedes as $sedes)
                                  <option value="{{$sedes->id}}">{{$sedes->nombre}}</option>
                                  @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                              <div class="form-group">
                                  <label for="nombre">Órgano Jurisdiccional</label>
                                  <select name="oojj_id" id="oojj_id" class="form-control" data-live-search="true" required autofocus>
                                  <option value="">--Seleccionar Órgano Jurisdiccional</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                              <div class="form-group">
                                <label>Producto</label>
                                <select name="producto_id" id="producto_id" class="form-control selectpicker" data-live-search="true" required autofocus>
                                <option value="">--Seleccionar Producto</option>
                                @foreach($producto as $producto)
                                <option value="{{$producto->id}}">{{$producto->descripcion}}</option>
                                @endforeach
                                </select>
                              </div>
                          </div>  
                          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                              <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number"  name="cantidad" id="cantidad" class="form-control">
                              </div>
                          </div>
                          <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12">
                              <div class="form-group">
                                <label for="um">UM</label>
                                <input type="text" disabled name="um" id="um" class="form-control">
                              </div>
                          </div>
                          <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12">
                              <div class="form-group">
                              <br>  
                              <button class="btn btn-primary" type="button" id="bt_add">Agregar</button>
                              </div>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class="table-responsive">
                                  <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                      <thead style="background-color: #A9D0F5">
                                          <th>Opciones</th>
                                          <th>Producto</th>
                                          <th>Cantidad</th>
                                      </thead>
                                      <tfoot>
                                          <th></th>
                                          <th>TOTAL</th>
                                          <th><h4 id="total">0</h4><input type="hidden" name="total_producto" id="total_producto"></th>
                                      </tfoot>
                                      <tbody>              
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">         
                              <div class="form-group">
                                  <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
                                  <button class="btn btn-primary" type="submit">Guardar</button>
                                  <a href="{{ URL::previous() }}" class="btn btn-danger">Cancelar</a>
                              </div>
                          </div>
                      </div>
                  </div>    
                </div>
                {!!Form::close()!!}
            </div> 
        </div>
    </div>
</div>               
 
@push ('scripts')

<script src="{{asset('js/pedido/create.js')}}"></script> 
<script src="{{asset('js/pedido/producto_create.js')}}"></script> 
<script>
    $(document).ready(function(){
        $('#bt_add').click(function(){
        agregar();
        });
    });

    var cont=0;
    total=0;
    subtotal=[];
    $("#guardar").hide();
    
    function limpiar()
    {
        $("#cantidad").val("");
    }

    function agregar()
    {
        datosproducto=document.getElementById('producto_id').value.split('_');
        
        producto_id=datosproducto[0];
        producto=$("#producto_id option:selected").text();
        cantidad=$("#cantidad").val();
        UM=$("#um").val();

        if (producto_id!="" &&  cantidad!="")
        {
            if(cantidad>=0)
            {
              subtotal[cont]=+cantidad;
               total=total+subtotal[cont];

             var fila='<tr class="selected" id="fila'+cont+'">'+
             '<td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td>'+
             '<td><input type="hidden" name="producto_id[]" value="'+producto_id+'">'+producto+'</td>'+
             '<td><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+' '+UM+'</td></tr>';
             cont++;
             limpiar();
             $('#total').html(total+' Articulos');
             $('#total_producto').val(total);
             evaluar();
             $('#detalles').append(fila);
            }  
            else
            {
              alert('Ingrese una cantidad valida');
            }    
        }
        else
        {
            alert("Error al ingresar el pedido, revise los datos del producto");
        }
    }

    function evaluar()
    {
        if (total>=0)
        {
            $("#guardar").show();
        }
        else
        {
            $("#guardar").hide(); 
        }
     }

     function eliminar(index)
     {
        total=total-subtotal[index]; 
        $("#total").html(total);  
        $("#total_producto").val(total);  
        $("#fila" + index).remove();
        evaluar();
    }

</script>
@endpush
@endsection