<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\Categoria;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $categoria=DB::table('categorias')
            ->where ('nombre','LIKE','%'.$query.'%')
            ->where ('system_state',1)
            ->orderBy('id','desc')
            ->paginate(10);
            return view('producto.categoria.index',["categoria" =>$categoria,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("producto.categoria.create");
    }
    public function store(Request $request)
    {
        $categoria = new Categoria;
        $categoria->nombre = $request->get('nombre');
        $categoria->descripcion = $request->get('descripcion');
        $categoria->system_state = 1;
        $mytime=Carbon::now('America/Lima');
        $categoria->created_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $categoria->user_create=$user;
        $categoria->save();
        return redirect()->route('producto.categoria.index')->with('info','Categoria creada con exito');     
    }
    public function edit($id)
    {
        return view("producto.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion = $request->get('descripcion');
        $mytime=Carbon::now('America/Lima');
        $categoria->updated_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $categoria->user_update=$user;
        $categoria->update();
        return Redirect::to('producto/categoria')->with('info','Categoria modificada con exito'); 
    }
    public function destroy($id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->system_state = 0;
        $mytime=Carbon::now('America/Lima');
        $categoria->deleted_at=$mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $categoria->user_delete=$user;
        $categoria->update();
        return Redirect::to('producto/categoria')->with('info','Categoria eliminada con exito');;
    }
}
