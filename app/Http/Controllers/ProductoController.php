<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\Producto;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $producto=DB::table('producto')
            ->where ('descripcion','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('producto.producto.index',["producto" =>$producto,"searchText"=>$query]);
        }
    }
     public function create()
    {

        $categoria = DB::table('categorias')->where('system_state',1)->orderBy('nombre')->get();  

        return view("producto.producto.create",[ "categoria" =>$categoria]);
    }
    public function store(Request $request)
    {
        $producto = new Producto;
        $producto->codigo = $request->get('codigo');
        $producto->UM = $request->get('UM');
        $producto->PRE_UNIT = $request->get('PRE_UNIT');
        $producto->CANTIDAD = $request->get('CANTIDAD');
        $producto->descripcion = $request->get('descripcion');
        $producto->categoria_id = $request->get('categoria_id');

        $PRE_UNIT = $request->get('PRE_UNIT');
        $CANTIDAD = $request->get('CANTIDAD');

        $IMPORTE = $PRE_UNIT * $CANTIDAD;

        $producto->IMPORTE = $IMPORTE;

        if(Input::hasFile('foto'))
        {
            $file=Input::file('foto');
            $file->move(public_path().'/img/producto/',$file->getClientOriginalName());
            $producto->foto=$file->getClientOriginalName();
        }
        $producto->system_state = 1;
        $mytime=Carbon::now('America/Lima');
        $producto->created_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $producto->user_create=$user;
        $producto->save();
        return redirect()->route('producto.producto.index')->with('info','Producto creado con exito');     
    }
    public function edit($id)
    {
        $categoria = DB::table('categorias')->where('system_state',1)->orderBy('descripcion')->get();
        return view("producto.producto.edit",["producto"=>Producto::findOrFail($id),"categoria"=>$categoria]);
    }
    public function update(Request $request,$id)
    {
        $producto=Producto::findOrFail($id);
        $producto->descripcion = $request->get('descripcion');
        $producto->UM = $request->get('UM');
        $producto->PRE_UNIT = $request->get('PRE_UNIT');
        $producto->CANTIDAD = $request->get('CANTIDAD');

        $PRE_UNIT = $request->get('PRE_UNIT');
        $CANTIDAD = $request->get('CANTIDAD');

        $IMPORTE = $PRE_UNIT * $CANTIDAD;

        $producto->IMPORTE = $IMPORTE;
        
        $producto->categoria_id = $request->get('categoria_id');
        $mytime=Carbon::now('America/Lima');
        $producto->updated_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $producto->user_update=$user;
        $producto->update();
        return Redirect::to('producto/producto')->with('info','Producto modificado con exito'); 
    }
    public function destroy($id)
    {
        $producto=Producto::findOrFail($id);
        $producto->system_state = 1;
        $mytime=Carbon::now('America/Lima');
        $producto->deleted_at=$mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $producto->user_delete=$user;
        $producto->update();
        return Redirect::to('producto/producto')->with('info','Producto eliminado con exito');
    }
    public function byPedido($id)
    {
        return Producto::where('id','=',$id)->get();
    }
}
