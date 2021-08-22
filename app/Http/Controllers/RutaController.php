<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\Ruta_Pedido;
use App\Pedido;
use App\Ruta;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class RutaController extends Controller
{
    public function assignRuta($id)
    {
        $pedido=DB::table('pecosa as pe')
        ->join('pedido as  p','p.id','=','pe.pedido_id')
        ->join('oojjs as o','o.id','=','p.oojj_id')
        ->join('sedes as s','s.id','=','o.sede_id')
        ->select('pe.num_pecosa','s.nombre as sede','o.nombre as oojj','pe.id','s.coordenadas_x','s.coordenadas_y')
        ->distinct()
        ->orderBy('s.nombre','asc')
        ->where('p.estado_pedido','=','Preparando')
        ->where('s.ruta_id','=',$id)
        ->get();

        $transporte = DB::table('users as u')
        ->join('role_user as ru','ru.user_id','=','u.id')
        ->join('roles as r','r.id','=','ru.role_id')
        ->select('u.id','u.name')
        ->where('r.id','=',9)
        ->where('u.system_state',1)
        ->get();

        return view("pedidos.transporte.create",["ruta"=>Ruta::findOrFail($id),"pedido"=>$pedido, "transporte"=>$transporte]);
    }

    public function rutaAssigned(Request $request, $id)
    {
        
        $cont =0;
        $pecosa_id =$request->get('id');
        $transportista_id =$request->get('transportista_id');
        $fecha =$request->get('fecha');

            while ($cont < count($pecosa_id)) {
                
                $detalle = new Ruta_Pedido();

                $detalle->ruta_id = $id;
                $detalle->pecosa_id = $pecosa_id[$cont];
                $detalle->transportista_id = $transportista_id;
                $detalle->fecha_envio = $fecha;
                $detalle->save();       
                
                $cont=$cont+1;
            }

        return Redirect::to('pedidos/transporte')->with('info','Ruta asignada con exito');
    }

    public function ruta_asignada()
    {
        $user=\Auth::user()->id;
        $ruta_pecosa = DB::select('CALL transportista(?)',[$user]);
        
        return view("pedidos.transporte.ruta_asignada",["ruta_pecosa"=>$ruta_pecosa]);
    }

    public function entrega(Request $request, $id)
    {
        $pedido=Pedido::findOrFail($id);
        $pedido->estado_pedido='Entregado';
        $mytime=Carbon::now('America/Lima');
        $pedido->fecha_entrega=$mytime->toDateTimeString();
        $pedido->observacion_entrega=$request->get('observacion');
        $pedido->update();

        return back()->with('info','Entrega registrada con exito');
    }
}





