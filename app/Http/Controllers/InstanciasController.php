<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\Instancias;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class InstanciasController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $instancias=DB::table('instancias')
            ->where ('nombre','LIKE','%'.$query.'%')
            ->where ('system_state',1)
            ->orderBy('id','desc')
            ->paginate(7);
            return view('poder_judicial.instancias.index',["instancias" =>$instancias,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("poder_judicial.instancias.create");
    }
    public function store(Request $request)
    {
        $instancias = new Instancias;
        $instancias->nombre = $request->get('nombre');
        $instancias->system_state = 1;
        $mytime=Carbon::now('America/Lima');
        $instancias->created_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $instancias->user_create=$user;
        $instancias->save();
        return redirect()->route('poder_judicial.instancias.index')->with('info','Instancia creada con exito');     
    }
    public function edit($id)
    {
        return view("poder_judicial.instancias.edit",["instancias"=>Instancias::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $instancias=Instancias::findOrFail($id);
        $instancias->nombre=$request->get('nombre');
        $mytime=Carbon::now('America/Lima');
        $instancias->updated_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $instancias->user_update=$user;
        $instancias->update();
        return Redirect::to('poder_judicial/instancias')->with('info','Instancia modificada con exito'); 
    }
    public function destroy($id)
    {
        $instancias=Instancias::findOrFail($id);
        $instancias->system_state = 0;
        $mytime=Carbon::now('America/Lima');
        $instancias->deleted_at=$mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $instancias->user_delete=$user;
        $instancias->update();
        return Redirect::to('poder_judicial/instancias')->with('info','Instancia eliminada con exito');
    }
}
