<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\Ruta_Pedido;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class TransporteController extends Controller
{
    public function index()
    {
    	
            $ruta=DB::table('pedido as  p')
            ->join('oojjs as o','o.id','=','p.oojj_id')
            ->join('sedes as s','s.id','=','o.sede_id')
            ->join('ruta as r','r.id','=','s.ruta_id')    
            ->select('r.ruta','r.id')
            ->distinct()
            ->orderBy('p.id','asc')
            ->where('p.estado_pedido','=','Preparando')
            ->get();

            

            return view('pedidos.transporte.index',["ruta" =>$ruta]);
        
    }

    public function ver_rutas(Request $request)
    {
        $ruta = DB::table('ruta')
        ->where('system_state','=',1)  
        ->orderby('ruta','asc')
        ->get();

        $transporte = DB::table('users as u')
        ->join('role_user as ru','ru.user_id','=','u.id')
        ->join('roles as r','r.id','=','ru.role_id')
        ->select('u.id','u.name')
        ->where('r.id','=',9)
        ->get();

        $ruta_id = trim($request->get('id'));
        $transportista_id = trim($request->get('transportista_id'));
        $fecha = trim($request->get('fecha'));
        
        if(!empty($ruta_id) and !empty($transportista_id) and !empty($fecha))
        {
            $ruta_pecosa = DB::select('CALL ruta_pecosa(?,?,?)',[$ruta_id,$fecha,$transportista_id]);
        }
        else
        {
            $ruta_pecosa = DB::select('CALL ruta_pecosa(?,?,?)',['0','0','0']);
        }
        
        return view("pedidos.transporte.ver_rutas",["ruta"=>$ruta,"transporte"=>$transporte,"id"=>$ruta_id, "transportista_id"=>$transportista_id, "ruta_pecosa"=>$ruta_pecosa, "fecha"=>$fecha]);
    }
    public function ejemplo()
    {
        return view("pedidos.transporte.ejemplo");
    }
}
