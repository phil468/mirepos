<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\Especialidades;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class EspecialidadesController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $especialidades=DB::table('especialidades')
            ->where ('nombre','LIKE','%'.$query.'%')
            ->where ('system_state',1)
            ->orderBy('id','desc')
            ->paginate(7);
            return view('poder_judicial.especialidades.index',["especialidades" =>$especialidades,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("poder_judicial.especialidades.create");
    }
    public function store(Request $request)
    {
        $especialidades = new Especialidades;
        $especialidades->nombre = $request->get('nombre');
        $especialidades->system_state = 1;
        $mytime=Carbon::now('America/Lima');
        $especialidades->created_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $especialidades->user_create=$user;
        $especialidades->save();
        return redirect()->route('poder_judicial.especialidades.index')->with('info','Especialidad creada con exito');     
    }
    public function edit($id)
    {
        return view("poder_judicial.especialidades.edit",["especialidades"=>Especialidades::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $especialidades=Especialidades::findOrFail($id);
        $especialidades->nombre=$request->get('nombre');
        $mytime=Carbon::now('America/Lima');
        $especialidades->updated_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $especialidades->user_update=$user;
        $especialidades->update();
        return Redirect::to('poder_judicial/especialidades')->with('info','Especialidad modificada con exito'); 
    }
    public function destroy($id)
    {
        $especialidades=Especialidades::findOrFail($id);
        $especialidades->system_state = 0;
        $mytime=Carbon::now('America/Lima');
        $especialidades->deleted_at=$mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $especialidades->user_delete=$user;
        $especialidades->update();
        return Redirect::to('poder_judicial/especialidades')->with('info','Especialidad eliminada con exito');
    }
}
