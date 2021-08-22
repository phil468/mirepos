<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\Presupuesto;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class PresupuestoController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $presupuesto=DB::table('presupuesto')
            ->where ('nombre','LIKE','%'.$query.'%')
            ->where ('system_state',1)
            ->orderBy('id','desc')
            ->paginate(7);
            return view('poder_judicial.presupuesto.index',["presupuesto" =>$presupuesto,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("poder_judicial.presupuesto.create");
    }
    public function store(Request $request)
    {
        $presupuesto = new presupuesto;
        $presupuesto->nombre = $request->get('nombre');
        $presupuesto->presupuesto = $request->get('presupuesto');
        $presupuesto->año = $request->get('año');
        $presupuesto->system_state = 1;
        $mytime=Carbon::now('America/Lima');
        $presupuesto->created_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $presupuesto->user_create=$user;
        $presupuesto->save();
        return redirect()->route('poder_judicial.presupuesto.index')->with('info','Presupuesto creado con exito');     
    }
    public function edit($id)
    {
        return view("poder_judicial.presupuesto.edit",["presupuesto"=>presupuesto::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $presupuesto=presupuesto::findOrFail($id);
        $presupuesto->nombre=$request->get('nombre');
        $presupuesto->presupuesto = $request->get('presupuesto');
        $presupuesto->año = $request->get('año');
        $mytime=Carbon::now('America/Lima');
        $presupuesto->updated_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $presupuesto->user_update=$user;
        $presupuesto->update();
        return Redirect::to('poder_judicial/presupuesto')->with('info','Presupuesto modificado con exito'); 
    }
    public function destroy($id)
    {
        $presupuesto=presupuesto::findOrFail($id);
        $presupuesto->system_state = 0;
        $mytime=Carbon::now('America/Lima');
        $presupuesto->deleted_at=$mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $presupuesto->user_delete=$user;
        $presupuesto->update();
        return Redirect::to('poder_judicial/presupuesto')->with('info','Presupuesto eliminado con exito');
    }
}
