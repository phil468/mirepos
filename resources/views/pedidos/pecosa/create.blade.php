@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card card-default">
                <div class="card-header">
                  <h3>Nueva Confirmación de Pedido</h3>
        
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
                {!!Form::open(['route'=>'pedidos.pecosa.store','method'=>'POST'])!!}
                {{Form::token()}}
                <div class="container">
                  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                      <div class="row">
                        <div class="panel panel-info">
                          <div class="panel-heading">
                            <div class="col-lg-10 col-sm-10 col-md-10 col-xs-12">
                              <div class="form-group">
                                <label for="nombre">Prioridad por Orden - Sede / Órgano Jurisdiccional</label>
                                <select name="pedido_id" id="pedido_id" class="form-control" data-live-search="true" required autofocus>
                                  <option value="">--Seleccionar Solicitud de Pedido</option>
                                  @foreach($pedido as $pedido)
                                    @if (isset($v_pecosa_id))
                                      @if ($v_pecosa_id == $pedido->id))
                                        <option value="{{$pedido->id}}" selected>
                                      @else
                                        <option value="{{$pedido->id}}">
                                      @endif
                                    @else
                                        <option value="{{$pedido->id}}">
                                      @endif
                                        {{'Solicitud de Pedido N° '.$pedido->codigo.' - '.$pedido->sede.' / '.$pedido->oojj}}
                                      </option>    
                                  @endforeach  
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                              <div class="form-group">
                                <label for="nombre">N° Pecosa</label>
                                <input type="text" name="num_pecosa" class="form-control" required autofocus>
                              </div>
                            </div>      
                            <br>
                            <br>
                            <br>
                          </div>
                        </div>  
                          <div class="panel-body">
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                              <div class="form-group">
                                <label>Observación</label>
                                  <textarea class="form-control" rows="2" name="observacion"></textarea>
                              </div>
                            </div>
                            <div class="col-lg-9 col-sm-9 col-md-9 col-xs-12">
                              <div class="form-group">
                                <label>Productos Solicitados</label>
                                <select name="producto_id" id="producto_id" class="form-control" required autofocus>
                                                     
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                              <div class="form-group">
                                <label for="cantidad">Cant. Solicitada</label>
                                <input type="number" disabled name="cantidad" id="cantidad" class="form-control">
                              </div>
                            </div>
                            <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12">
                              <div class="form-group">
                                <label for="um">UM</label>
                                <input type="text" disabled name="um" id="um" class="form-control">
                              </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                              <div class="form-group">
                                <label for="stock">Stock Disponible</label>
                                <input type="number" disabled name="stock" id="stock" class="form-control">
                              </div>
                            </div>
                            <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12">
                              <div class="form-group">
                                <label for="um1">UM</label>
                                <input type="text" disabled name="um1" id="um1" class="form-control">
                              </div>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                              <div class="form-group">
                                <label for="pre_unit">Precio Unit.</label>
                                <input type="number" readonly name="pre_unit" id="pre_unit" class="form-control">
                              </div>
                            </div>  
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                              <div class="form-group">
                                <label for="c_enviar">Cantidad a Enviar</label>
                                <input type="number"  name="c_enviar" id="c_enviar" class="form-control">
                              </div>
                            </div>
                            <div class="col-lg-1 col-sm-1 col-md-1 col-xs-12">
                              <div class="form-group">
                                <br>  
                                <button class="btn btn-primary" type="button" id="bt_add">Agregar</button>
                              </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                              <div class="table-responsive">
                                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                  <thead style="background-color: #A9D0F5">
                                    <th>Opciones</th>
                                    <th>Producto</th>
                                    <th>Cant. Emitida</th>
                                    <th>Precio Unit.</th>
                                    <th>Importe Total</th>
                                  </thead>
                                  <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>TOTAL</th>
                                    <th><h4 id="total">S/.0.00</h4><input type="hidden" name="total_pedido" id="total_pedido"></th>
                                  </tfoot>
                                  <tbody>              
                                  </tbody>
                                </table>
                              </div> 
                            </div>
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

<script src="{{asset('js/pecosa/create.js')}}"></script> 
<script src="{{asset('js/pecosa/pedido_create.js')}}"></script> 
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
        $("#stock").val("");
        $("#um").val("");
        $("#um1").val("");
        $("#c_enviar").val("");
        $("#pre_unit").val("");
    }

    function agregar()
    {
        datosPedido=document.getElementById('producto_id').value.split('_');
        
        producto_id=datosPedido[0];
        producto=$("#producto_id option:selected").text();
        cantidad=$("#cantidad").val()*1;
        stock=$("#stock").val()*1;
        UM=$("#um").val();
        enviar=$("#c_enviar").val()*1; 
        pre_unit=$("#pre_unit").val(); 

        if (producto_id!="" &&  enviar!="")
        {
            if(enviar<=cantidad)
            {
              if(enviar<=stock)
              {
                subtotal[cont]=(enviar*pre_unit);;
                total=total+subtotal[cont];

                   var fila='<tr class="selected" id="fila'+cont+'">'+
                   '<td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td>'+
                   '<td><input type="hidden" name="producto_id[]" value="'+producto_id+'">'+producto+'</td>'+
                   '<td><input type="hidden" name="cantidad[]" value="'+enviar+'">'+enviar+' '+UM+'</td>'+
                   '<td><input type="hidden" name="importe[]" value="'+pre_unit+'"> S/.'+pre_unit+'</td>'+
                   '<td><input type="hidden" name="importe_total[]" value="'+subtotal[cont]+'"> S/.'+subtotal[cont]+'</td>'+
                   +'</tr>';
                   cont++;
                   limpiar();
                   $('#total').html('S/. '+total);
                   $('#total_pedido').val(total);
                   evaluar();
                   $('#detalles').append(fila);
              }
              else
              {
                alert('La cantidad a enviar supera el stock del producto');
              }
            }  
            else
            {
              alert('La cantidad a enviar no puede ser mayor a la solicitada');
            }    
        }
        else
        {
            alert("Error al ingresar el detalle de la pecosa, revise los datos del pedido");
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
        $("#total_pedido").val(total);  
        $("#fila" + index).remove();
        evaluar();
    }

</script>
@endpush
@endsection