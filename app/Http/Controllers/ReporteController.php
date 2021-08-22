<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class ReporteController extends Controller
{
    public function oojj(Request $request)
    {
    	$año_mes=trim($request->get('año_mes'));

        if (!empty($año_mes))
        {   
            
            $reporte=DB::select('CALL gasto_oojj_mes(?)',[$año_mes]);
        }
        else
        {
            $reporte=DB::select('CALL gasto_oojj_mes(?)',['0']);
        }

    	return view("reportes.consumo_mensual.oojj",["reporte"=>$reporte,"año_mes"=>$año_mes]);
    }

    public function producto($año_mes, $id)
    {
  			$datos = DB::table('oojjs as o')
  			->join('sedes as s','s.id','=','o.sede_id')
  			->join('user_sede as us','us.sede_id','=','s.id')
  			->join('users as u','us.user_id','=','u.id')
  			->select('o.nombre as oojj','s.nombre as sede', 'u.name')
  			->where('o.id','=',$id)
  			->first();

            $reporte=DB::select('CALL oojj_producto(?,?)',[$año_mes,$id]);

            $total=DB::select('CALL total_pecosa(?,?)',[$año_mes,$id]);
       
    	return view("reportes.consumo_mensual.oojj_producto",["reporte"=>$reporte,"año_mes"=>$año_mes,"datos"=>$datos, "total"=>$total]);    	
    }

    public function anual_oojj(Request $request)
    {
    	$combo_oojj = DB::table('pecosa as pe')
    	->join('pedido as p','p.id','=','pe.pedido_id')
    	->join('oojjs as o','o.id','=','p.oojj_id')
    	->select('o.id','o.nombre')
    	->distinct()
    	->where('pe.system_state',1)
    	->orderBy('o.nombre', 'asc')
    	->get();

    	$oojj=trim($request->get('oojj'));

        if (!empty($oojj))
        {   
            
            $reporte=DB::select('CALL anual_oojj(?)',[$oojj]);
        }
        else
        {
            $reporte=DB::select('CALL anual_oojj(?)',['0']);
        }

    	return view("reportes.consumo_anual.oojj",["reporte"=>$reporte,"oojj"=>$oojj,"combo_oojj"=>$combo_oojj]);
    }
    
    public function top_producto()
    {
    	$top = DB::table('top_producto')
    	->select('id','descripcion', 'cantidad', 'UM')
    	->get();

    	return view("reportes.consumo_anual.top_producto",["top"=>$top]);
    }

    public function producto_oojj($id)
    {
    	$top = DB::table('top_producto')
    	->select('descripcion', 'codigo', 'cantidad','UM')
    	->where('id',$id)
    	->first();

    	$reporte=DB::select('CALL producto_oojj(?)',[$id]);

    	return view("reportes.consumo_anual.producto_oojj",["reporte"=>$reporte,"top"=>$top]);
    }

    public function total_pedidos_mes()
    {
        $top = DB::table('total_pedidos_mes')
        ->select('id','descripcion', 'cantidad', 'UM', 'stock')
        ->get();

        return view("reportes.consumo_mensual.total_pedidos_mes",["top"=>$top]);
    }

    public function pedido_mensual_producto($id)
    {
        $top = DB::table('total_pedidos_mes')
        ->select('descripcion', 'codigo', 'cantidad','UM')
        ->where('id',$id)
        ->first();

        $reporte=DB::select('CALL pedido_mensual_producto(?)',[$id]);

        return view("reportes.consumo_mensual.pedido_mensual_producto",["reporte"=>$reporte,"top"=>$top]);
    }

    public function pedidos_oojj_mes()
    {
        $top = DB::table('pedidos_oojj_mes')
        ->select('id','sede', 'oojj', 'created_at','total_producto')
        ->get();

        return view("reportes.consumo_mensual.pedidos_oojj_mes",["top"=>$top]);
    }

    public function pedido_mensual_oojj($id)
    {
        $top = DB::table('pedidos_oojj_mes')
        ->select('id','sede', 'oojj', 'created_at','total_producto')
        ->where('id',$id)
        ->first();

        $reporte=DB::select('CALL pedido_mensual_oojj(?)',[$id]);

        return view("reportes.consumo_mensual.pedido_mensual_oojj",["reporte"=>$reporte,"top"=>$top]);
    }
}
