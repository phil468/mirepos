<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\Sedes;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class SedesController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $sedes=DB::table('sedes')
            ->where ('nombre','LIKE','%'.$query.'%')
            ->where ('system_state',1)
            ->orderBy('id','desc')
            ->paginate(7);
            return view('poder_judicial.sedes.index',["sedes" =>$sedes,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("poder_judicial.sedes.create");
    }
    public function store(Request $request)
    {
        $sedes = new Sedes;
        $sedes->nombre = $request->get('nombre');
        $sedes->direccion = $request->get('direccion');
        $sedes->coordenadas_x = $request->get('coordenadas_x');
        $sedes->coordenadas_y = $request->get('coordenadas_y');
        $sedes->system_state = 1;
        $mytime=Carbon::now('America/Lima');
        $sedes->created_at = $mytime->toDateTimeString();
        
        $sedes->save();
        return redirect()->route('poder_judicial.sedes.index')->with('info','Sede creada con exito');     
    }
    public function edit($id)
    {
        return view("poder_judicial.sedes.edit",["sedes"=>Sedes::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $sedes=Sedes::findOrFail($id);
        $sedes->nombre=$request->get('nombre');
        $sedes->direccion = $request->get('direccion');
        $sedes->coordenadas_x = $request->get('coordenadas_x');
        $sedes->coordenadas_y = $request->get('coordenadas_y');
        $mytime=Carbon::now('America/Lima');
        $sedes->updated_at = $mytime->toDateTimeString();
        
        $sedes->update();
        return Redirect::to('poder_judicial/sedes')->with('info','Sede modificada con exito'); 
    }
    public function destroy($id)
    {
        $sedes=Sedes::findOrFail($id);
        $sedes->system_state = 0;
        $mytime=Carbon::now('America/Lima');
        $sedes->deleted_at=$mytime->toDateTimeString();
        
        $sedes->update();
        return Redirect::to('poder_judicial/sedes')->with('info','Sede eliminada con exito');
    }
}
