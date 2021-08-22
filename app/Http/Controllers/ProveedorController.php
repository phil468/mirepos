<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\Proveedor;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $proveedor=DB::table('proveedor')
            ->where ('nombre','LIKE','%'.$query.'%')
            ->where ('system_state',1)
            ->orwhere ('ruc','LIKE','%'.$query.'%')
            ->where ('system_state',1)
            ->orderBy('id','desc')
            ->paginate(7);
            return view('proveedor.proveedor.index',["proveedor" =>$proveedor,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view("proveedor.proveedor.create");
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $v_document = DB::table('proveedor')
            ->where('ruc','=', $request->get('ruc'))
            //->where('razon_social','=', $request->get('razon_social'))
            ->where('system_state','=', 1)
            ->value('ruc');

            if (isset($v_document) or trim($v_document) !="" )
            {
                DB::rollback();
                return Redirect::back()->withInput()->with('infoError','Ya existe un Proveedor registado con el RUC '.$v_document . ' - Verique su existencia');
            }
            $v_razon = DB::table('proveedor')
            //->where('ruc','=', $request->get('ruc'))
            ->where('nombre','=', $request->get('nombre'))
            ->where('system_state','=', 1)
            ->value('nombre');

            if (isset($v_razon) or trim($v_razon) !="" )
            {
                DB::rollback();
                return Redirect::back()->withInput()->with('infoError','Ya existe una Proveedor registado con la Razón Social '.$v_razon . ' - Verique su existencia');
            }

            $proveedor = new Proveedor;
            $proveedor->nombre = $request->get('nombre');
            $proveedor->ruc = $request->get('ruc');
            $proveedor->telefono = $request->get('telefono');
            $proveedor->email = $request->get('email');
            $proveedor->system_state = 1;
            $mytime=Carbon::now('America/Lima');
            $proveedor->created_at = $mytime->toDateTimeString();
            $user=\Auth::user()->id;
            $proveedor->user_create=$user;
            $proveedor->save();
            return redirect()->route('proveedor.proveedor.index')->with('info','Proveedor creado con exito');    
        }
        catch(\Exception $e)
        {
            DB::rollback();
            if ($e->getCode() == 23000)
            {   
                return back()->withInput()->with('infoError','Error al guardar. El proveedor con la razón Razón Social o RUC ya existe.');
            }
            else
            {
                return back()->withInput()->with('infoError','Error al guardar la información , Enviar mensaje al Administrador: '.$e->getMessage());
            } 
        }      
    }

    public function edit($id)
    {
        return view("proveedor.proveedor.edit",["proveedor"=>Proveedor::findOrFail($id)]);
    }

    public function update(Request $request,$id)
    {
        $proveedor=Proveedor::findOrFail($id);
        $proveedor->nombre=$request->get('nombre');
        $proveedor->ruc = $request->get('ruc');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->email = $request->get('email');
        $mytime=Carbon::now('America/Lima');
        $proveedor->updated_at = $mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $proveedor->user_update=$user;
        $proveedor->update();
        return Redirect::to('proveedor/proveedor')->with('info','Proveedor modificado con exito'); 
    }

    public function destroy($id)
    {
        $proveedor=Proveedor::findOrFail($id);
        $proveedor->system_state = 0;
        $mytime=Carbon::now('America/Lima');
        $proveedor->deleted_at=$mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $proveedor->user_delete=$user;
        $proveedor->update();
        return Redirect::to('proveedor/proveedor')->with('info','Proveedor eliminado con exito');;
    }
}
