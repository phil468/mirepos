<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\OOJJ;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class OOJJController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $oojj=DB::table('oojjs as o')
            ->join('sedes as s','s.id','=','o.sede_id')
            ->select('o.nombre','s.nombre as sede','o.id')
            ->where ('o.nombre','LIKE','%'.$query.'%')
            ->where ('o.system_state',1)
            ->orderBy('o.id','desc')
            ->paginate(7);
            return view('poder_judicial.oojj.index',["oojj" =>$oojj,"searchText"=>$query]);
        }
    }
    public function create()
    {
        $sede = DB::table('sedes')->where('system_state',1)->orderBy('nombre')->get();

        return view("poder_judicial.oojj.create",["sede" =>$sede]);
    }
    public function store(Request $request)
    {
        $oojj = new OOJJ;
        $oojj->nombre = $request->get('nombre');
        $oojj->sede_id = $request->get('sede_id');
        $oojj->system_state = 1;
        $mytime=Carbon::now('America/Lima');
        $oojj->created_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $oojj->user_create=$user;
        $oojj->save();
        return redirect()->route('poder_judicial.oojj.index')->with('info','Órgano Juridiccional creado con exito');     
    }
    public function edit($id)
    {
        $sede = DB::table('sedes')->where('system_state',1)->orderBy('nombre')->get();

        return view("poder_judicial.oojj.edit",["oojj"=>oojj::findOrFail($id),"sede" =>$sede]);
    }
    public function update(Request $request,$id)
    {
        $oojj=OOJJ::findOrFail($id);
        $oojj->nombre=$request->get('nombre');
        $mytime=Carbon::now('America/Lima');
        $oojj->updated_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $oojj->user_update=$user;
        $oojj->update();
        return Redirect::to('poder_judicial/oojj')->with('info','Órgano Juridiccional modificado con exito'); 
    }
    public function show($id)
    {
        $oojj = DB::table('oojjs as o')
        ->join('sedes as s','s.id','=','o.sede_id')
        ->select('o.nombre as oojj','s.nombre as sede')
        ->where('o.id',$id)
        ->first();

        return view("poder_judicial.oojj.show",["oojj"=>$oojj]);
    }
    public function destroy($id)
    {
        $oojj=OOJJ::findOrFail($id);
        $oojj->system_state = 0;
        $mytime=Carbon::now('America/Lima');
        $oojj->deleted_at=$mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $oojj->user_delete=$user;
        $oojj->update();
        return Redirect::to('poder_judicial/oojj')->with('info','Órgano Juridiccional eliminado con exito');
    }

    public function byPedido($id)
    {
        return DB::table('oojjs')->where('sede_id',$id)->where('system_state',1)->get();
        //return OOJJ::where('sede_id',$id)->get();
    }
}
