<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\DetallePecosa;
use App\Pecosa;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class PecosaController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $pecosa=DB::table('pecosa as pe')
            ->join('pedido as p','pe.pedido_id','=','p.id')
            ->join('oojjs as o','o.id','=','p.oojj_id')
            ->join('sedes as s','s.id','=','o.sede_id')
            ->select('s.nombre as sede','pe.id', 'pe.num_pecosa', 'p.estado_pedido','pe.foto_pecosa','o.nombre as oojj')
            ->where ('s.nombre','LIKE','%'.$query.'%')
            ->where ('pe.system_state',1)
            ->orderBy('pe.id','desc')
            ->paginate(10);
            return view('pedidos.pecosa.pedido',["pecosa" =>$pecosa,"searchText"=>$query]);
        }
    }

    public function create(Request $request)
    {
        $v_pecosa_id=trim($request->get('vsid'));

        $pedido=DB::table('pedido as  p')
        ->join('oojjs as o','o.id','=','p.oojj_id')
        ->join('sedes as s','s.id','=','o.sede_id')
        ->select('p.codigo','s.nombre as sede','p.id','o.nombre as oojj')
        ->orderBy('p.id','asc')
        ->where('p.estado_pedido','=','En espera')
        ->get();
        
        return view("pedidos.pecosa.create", ["pedido"=>$pedido,"v_pecosa_id"=>$v_pecosa_id]);
    }

    public function store(Request $request)
    {
     try{
            DB::beginTransaction();
            $pecosa = new Pecosa;
            
            $pecosa->pedido_id = $request->get('pedido_id');
            $mytime=Carbon::now('America/Lima');
            $pecosa->fecha=$mytime->toDateTimeString();
            $pecosa->num_pecosa = $request->get('num_pecosa');
            $pecosa->observacion = $request->get('observacion');
            $pecosa->total_pecosa = $request->get('total_pedido');
            $max=DB::table('pecosa')->max('codigo');
            
            if (!empty($max))
            {
                $codigo=$max+1;
                $pecosa->codigo = sprintf('%08d', $codigo);
            }
            else
            {
                $max=1;
                $pecosa->codigo = sprintf('%08d', $max);
            } 
           
            $mytime=Carbon::now('America/Lima');
            $pecosa->created_at=$mytime->toDateTimeString();
            $user=\Auth::user()->id;
            $pecosa->user_create=$user;
            $pecosa->system_state=1;
            $pecosa->save();
     
            $producto_id =$request->get('producto_id');
            $cantidad =$request->get('cantidad');
            $importe =$request->get('importe');
            $importe_total =$request->get('importe_total');
            $cont =0;

            while ($cont < count($producto_id)) 
            {            
                $detalle = new DetallePecosa();

                $detalle->pecosa_id = $pecosa->id;
                $detalle->producto_id = $producto_id[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->importe = $importe[$cont];
                $detalle->importe_total = $importe_total[$cont];
                $detalle->system_state = 1;
                $detalle->created_at=$mytime->toDateTimeString();
                $detalle->user_create=$user;
                $detalle->save();
                             
                $cont=$cont+1;
            }
           
            DB::commit();

        }
        catch(\Exception $e)
        {

            //DB::roolback();
            return back()->withInput()->with('infoError','Error al guardar la información , Enviar mensaje al Administrador: '.$e->getMessage());
        }

        $pedido_id=$request->get('pedido_id');
        $matricula=DB::table('pedido')
        ->where('id',$pedido_id)
        ->update(array('estado_pedido'=>'Preparando'));

        return Redirect::to('pedidos/pecosa')->with('info','Pecosa creada con exito');

    }

    public function show($id)
    {
        $pecosa=DB::select('CALL pecosa(?)',[$id]);
        $detalles=DB::select('CALL detalle_pecosa(?)',[$id]);       
        
        return view("pedidos.pecosa.show", ["pecosa"=>$pecosa,"detalles"=>$detalles]);
    }

    public function destroy($id)
    {
        $pecosa=Pecosa::findOrFail($id);
        $pecosa->system_state=0;
        $mytime=Carbon::now('America/Lima');
        $pecosa->deleted_at=$mytime->toDateTimeString();
        $fecha=$mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $pecosa->user_delete=$user;
        $pecosa->update();
        
        $pedido_id = Pecosa::findOrFail($id)->pedido_id;
        
        $pedido=DB::table('pedido')
        ->where('id',$pedido_id)
        ->update(array('estado_pedido'=>'En espera'));
        
        return Redirect::to('pedidos/pecosa/pedido')->with('info','PECOSA eliminada con exito');
    }

    public function subir_pecosa(Request $request, $id)
    {
        $pecosa=Pecosa::findOrFail($id);

        $filenameimg = Pecosa::findOrFail($id)->codigo;

        if(Input::hasFile('imagen'))
        {
            $file=Input::file('imagen');
            $extname = PecosaController::after_last('.', $file->getClientOriginalName());
            $filenameimg = $filenameimg.'.'.$extname;
            $file-> move(public_path().'/img/pecosa/',$filenameimg);
            $pecosa->foto_pecosa=$filenameimg;
        }

        $mytime=Carbon::now('America/Lima');
        $fecha=$mytime->toDateString();
        $pecosa->update();

        $pedido_id = Pecosa::findOrFail($id)->pedido_id;

        $pedido=DB::table('pedido')
        ->where('id',$pedido_id)
        ->update(array('estado_pedido'=>'Confirmado','fecha_entrega'=>$fecha));

        return back()->with('info','Pecosa subida con exito');
    }

    private function after_last ($chart, $inthat)
    {
        if (!is_bool(PecosaController::strrevpos($inthat, $chart)))
        return substr($inthat, PecosaController::strrevpos($inthat, $chart)+strlen($chart));
    }
    
    private function strrevpos($instr, $needle)
    {
        $rev_pos = strpos (strrev($instr), strrev($needle));
        if ($rev_pos===false) return false;
        else return strlen($instr) - $rev_pos - strlen($needle);
    }
}
