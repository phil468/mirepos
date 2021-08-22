@extends('layouts.app')
@section('content')
<div class="container"> 
    <div class="row">
        {!!Form::open(['route'=>'pedidos.pedidos.store','method'=>'POST'])!!}
        {{Form::token()}}
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
                <label for="nombre">Dependencia</label>
                <select name="oojj_id" id="oojj_id" class="form-control" data-live-search="true" required autofocus>
                    <option value="">--Seleccionar Órgano Jurisdiccional</option>
                </select>
            </div>
        </div>
    </div>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Producto</th>
            <th style="width:8%">Cantidad</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%">Opciones</th>
        </tr>
        </thead>
        <tbody>
 
        <?php $total = 0 ?>
 
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
 
                <?php $total +=  $details['cantidad'] ?>
 
                <tr>
                    <td data-th="Producto">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{asset('public/img/productos/'.$details['codigo'].'.jpg')}}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <input type="hidden" name="producto_id[]" value="{{ $details['id'] }}">{{ $details['descripcion'] }}
                            </div>
                        </div>
                    </td>
                    
                    <td data-th="Cantidad">
                        <input type="number" value="{{ $details['cantidad'] }}" class="form-control cantidad" />
                    </td>
                    <td data-th="Subtotal" class="text-center">
                        <input type="hidden" name="cantidad[]" value="{{ $details['cantidad'] }}">{{ $details['cantidad'].' '.$details['UM'] }}
                    </td>
                    <td class="actions" data-th="">
                        <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
 
        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Total </strong><input type="hidden" name="total_producto" value="{{$total}}"></td>
        </tr>
        <tr>
            <td><a href="{{ url('pedidos/shop') }}" class="btn btn-secondary"><i class="fa fa-angle-left"></i> Seguir Solicitando</a></td>
            <td class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total {{ $total }} Artículos</strong></td>
            <td><input name="_token" value="{{ csrf_token() }}" type="hidden"></input><button class="btn btn-success" type="submit">Enviar Pedido</button></td>
        </tr>
        </tfoot>
    </table>
</div> 
{!!Form::close()!!}   
@push ('scripts')
    <script src="{{asset('js/pedido/create.js')}}"></script> 
    <script type="text/javascript">
 
        $(".update-cart").click(function (e) {
           e.preventDefault();
 
           var ele = $(this);
 
            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), cantidad: ele.parents("tr").find(".cantidad").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
 
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
 
            if(confirm("¿Desea eliminar el producto seleccionado del carrito?")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
 
    </script>
@endpush
@endsection