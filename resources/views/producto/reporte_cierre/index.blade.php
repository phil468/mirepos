@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <h2>Registro de Reportes de Cierre</h2>
    </div> 
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
      <div class="pull-left">
        <div class="btn-group">
          <!--<a href="#" class="btn btn-info">Importar Excel</a>-->
          <form action="{{route('producto.reporte_cierre.import')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            @if(Session::has('message'))
            <p>{{Session::get('message')}}</p>
            @endif
            <label>Importar Excel</label><br>
            <input type="file" class="btn btn-warning" name="archivo" id="archivo"><br>
            <input type="submit" class="btn btn-info" value="Importar"/><br>
          </form>
        </div>
      </div>
    </div>  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <br>
        @include('producto.reporte_cierre.search')
    </div>    
    <div class="table-container">
      <table id="mytable" class="table table-bordred table-striped">
       <thead>
        <?php $i=1 ?>
         <th>N°</th>
         <th>CODIGO</th>
         <th>DESCRIPCION</th>
         <th>CANTIDAD</th>
       </thead>
       <tbody>
        @if($registros->count())  
        
        @foreach($registros as $registro)  
        <tr>
          <td>{{$i }}</td>
          <td>{{$registro->CODIGO}}</td>
          <td>{{$registro->DESCRIPCION}}</td>
          <td>{{$registro->CANTIDAD.' '.$registro->UM}}</td>
        </tr>
        <?php $i++ ?>
         @endforeach 
         
         @else
        <tr>
          <td colspan="8">No hay registro !!</td>
        </tr>
        @endif
       </tbody>
      </table>
    </div>
    {{ $registros->links() }}
    </div>
  </div>
</div>
@endsection