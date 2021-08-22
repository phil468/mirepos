<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\Permanencias;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class PermanenciasController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $permanencias=DB::table('permanencias')
            ->where ('nombre','LIKE','%'.$query.'%')
            ->where ('system_state',1)
            ->orderBy('id','desc')
            ->paginate(7);
            return view('poder_judicial.permanencias.index',["permanencias" =>$permanencias,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("poder_judicial.permanencias.create");
    }
    public function store(Request $request)
    {
        $permanencias = new Permanencias;
        $permanencias->nombre = $request->get('nombre');
        $permanencias->system_state = 1;
        $mytime=Carbon::now('America/Lima');
        $permanencias->created_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $permanencias->user_create=$user;
        $permanencias->save();
        return redirect()->route('poder_judicial.permanencias.index')->with('info','Permanencia creada con exito');     
    }
    public function edit($id)
    {
        return view("poder_judicial.permanencias.edit",["permanencias"=>Permanencias::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $permanencias=permanencias::findOrFail($id);
        $permanencias->nombre=$request->get('nombre');
        $mytime=Carbon::now('America/Lima');
        $permanencias->updated_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $permanencias->user_update=$user;
        $permanencias->update();
        return Redirect::to('poder_judicial/permanencias')->with('info','Permanencia modificada con exito'); 
    }
    public function destroy($id)
    {
        $permanencias=permanencias::findOrFail($id);
        $permanencias->system_state = 0;
        $mytime=Carbon::now('America/Lima');
        $permanencias->deleted_at=$mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $permanencias->user_delete=$user;
        $permanencias->update();
        return Redirect::to('poder_judicial/permanencias')->with('info','Permanencia eliminada con exito');
    }
}
