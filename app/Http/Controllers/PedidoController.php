<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use App\DetallePedido;
use App\Pedido;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        if ($request)
        {
            $RolActual = PedidoController::getRolUser();
           
            if($RolActual === "GENERAL")
            {
                $query=trim($request->get('searchText'));
	            $pedidos=DB::table('pedido as p')
                ->leftjoin('pecosa as pe','pe.pedido_id','=','p.id')
                ->join('oojjs as o','o.id','=','p.oojj_id')
                ->join('sedes as s','s.id','=','o.sede_id')
	            ->select('s.nombre as sede','p.id', 'p.codigo', 'p.estado_pedido','pe.foto_pecosa','o.nombre as oojj','p.created_at')
                ->distinct()
	            ->where('s.nombre','LIKE','%'.$query.'%')
	            ->where('p.system_state',1)
	            ->orderBy('p.id','desc')
	            ->paginate(10);

	            return view('pedidos.pedidos.index',["pedidos" =>$pedidos,"searchText"=>$query]);
            }
            else
            {
                $query=trim($request->get('searchText'));
	            $pedidos=DB::table('pedido as p')
                ->leftjoin('pecosa as pe','pe.pedido_id','=','p.id')
                ->join('oojjs as o','o.id','=','p.oojj_id')
                ->join('sedes as s','s.id','=','o.sede_id')
	            ->select('s.nombre as sede','p.id', 'p.codigo', 'p.estado_pedido','pe.foto_pecosa','o.nombre as oojj','p.created_at')
                ->distinct()
	            ->where ('s.nombre','LIKE','%'.$query.'%')
	            ->where('p.user_create',\Auth::user()->id)
	            ->where ('p.system_state',1)
	            ->orderBy('p.id','desc')
	            ->paginate(10);
	            return view('pedidos.pedidos.index',["pedidos" =>$pedidos,"searchText"=>$query]);
            }
            
        }
    }

    public function indexPecosa(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $pedidos=DB::table('pedido as p')
            ->join('oojjs as o','o.id','=','p.oojj_id')
            ->join('sedes as s','s.id','=','o.sede_id')
            ->select('s.nombre as sede','p.id', 'p.codigo', 'p.estado_pedido','o.nombre as oojj', 'p.created_at')
            ->where ('p.codigo','LIKE','%'.$query.'%')
            ->where ('p.estado_pedido','=','En espera')
            ->where ('p.system_state',1)
            ->orderBy('p.id','asc')
            ->paginate(10);
            return view('pedidos.pecosa.index',["pedidos" =>$pedidos,"searchText"=>$query]);
        }
    }

    public function create()
    {
        $user=\Auth::user()->id;

		$sedes = DB::table('users as u')
		->join('user_sede as us','u.id','=','us.user_id')
		->join('sedes as s','s.id','=','us.sede_id')
		->select('s.id','s.nombre')
        ->distinct()
		->where('us.user_id','=',$user)
        ->orderBy('s.nombre')
        ->get();

        $producto = DB::table('producto')
        ->where('cantidad','>',0)
        ->whereNull ('system_state')
        ->orderBy('descripcion')
        ->get(); 

        return view("pedidos.pedidos.create",["sedes"=>$sedes,"producto"=>$producto]);
    }

   	public function store(Request $request)
    {
     try{
            DB::beginTransaction();
            $pedidos = new Pedido;
            
            $pedidos->oojj_id = $request->get('oojj_id');
            $mytime=Carbon::now('America/Lima');
            $pedidos->fecha=$mytime->toDateString();
            $pedidos->total_producto = $request->get('total_producto');
            $max=DB::table('pedido')->max('codigo');
            
            if (!empty($max))
            {
                $codigo=$max+1;
                $pedidos->codigo = sprintf('%08d', $codigo);
            }
            else
            {
                $max=1;
                $pedidos->codigo = sprintf('%08d', $max);
            } 
           
            $mytime=Carbon::now('America/Lima');
            $pedidos->created_at=$mytime->toDateTimeString();
            $user=\Auth::user()->id;
            $pedidos->user_create=$user;
            $pedidos->estado_pedido='En espera';
            $pedidos->system_state=1;
            $pedidos->save();
     
            $producto_id =$request->get('producto_id');
            $cantidad =$request->get('cantidad');
            $cont =0;

            while ($cont < count($producto_id)) 
            {            
                $detalle = new DetallePedido();

                $detalle->pedido_id = $pedidos->id;
                $detalle->producto_id = $producto_id[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->system_state = 1;
                $detalle->created_at=$mytime->toDateTimeString();
                $detalle->user_create=$user;
                $detalle->save();
                             
                $cont=$cont+1;
                
            }
           
            DB::commit();
            $request->session()->forget('cart');

        }
        catch(\Exception $e)
        {

        	//DB::roolback();
            return back()->withInput()->with('infoError','Error al guardar la información , Enviar mensaje al Administrador: '.$e->getMessage());
    	}

    	return Redirect::to('pedidos/pedidos')->with('info','Solicitud de pedido enviado con exito');

    }

    public function show($id)
    {
        
        $pedidos=DB::select('CALL pedidos(?)',[$id]);
        $detalles=DB::select('CALL detalle_pedido(?)',[$id]);       
        
        return view("pedidos.pedidos.show", ["pedidos"=>$pedidos,"detalles"=>$detalles]);

    }

    public function seguimiento($id)
    {
        $pecosa=DB::select('CALL pecosa_seg(?)',[$id]);
        $detalles=DB::select('CALL detalle_pecosa_seg(?)',[$id]);       
        
        return view("pedidos.pedidos.seguimiento", ["pecosa"=>$pecosa,"detalles"=>$detalles]);
    }

   	public function destroy($id)
    {
        $pedidos=Pedido::findOrFail($id);
        $pedidos->estado_pedido='Anulado';
        $pedidos->system_state=0;
        $mytime=Carbon::now('America/Lima');
        $pedidos->deleted_at=$mytime->toDateTimeString();
        $user=\Auth::user()->id;
        $pedidos->user_delete=$user;
        $fecha=$mytime->toDateTimeString();
        $pedidos->update();

        $detalle_pedido=DB::table('detalle_pedido')
        ->where('pedido_id',$id)
        ->update(array('system_state'=>0,'deleted_at'=>$fecha,'user_delete'=>$user));

        return Redirect::to('pedidos/pedidos')->with('info','Pedido eliminado con exito');
    }

    public function rechazar($id)
    {
        $pedidos=Pedido::findOrFail($id);
        $pedidos->estado_pedido='Rechazado';
        $pedidos->update();

        return back()->with('info','Pedido rechazado con exito');
    }

    public function subir_pecosa(Request $request, $id)
    {
        if(Input::hasFile('imagen'))  
        {
            $filenameimg = DB::table('pecosa as pe')
            ->join('pedido as p','p.id','=','pe.pedido_id')        
            ->where('p.id','=',$id)
            ->value('pe.codigo');

            $file=Input::file('imagen');
            $extname = PedidoController::after_last('.', $file->getClientOriginalName());
            $filenameimg = $filenameimg.'.'.$extname;
            $file-> move(public_path().'/img/pecosa/',$filenameimg);

            $pecosa=DB::table('pecosa')
            ->where('pedido_id',$id)
            ->update(array('foto_pecosa'=>$filenameimg));

            $pedido = Pedido::findOrFail($id);
            $pedido->estado_pedido = 'Confirmado';
            $mytime=Carbon::now('America/Lima');
            $fecha=$mytime->toDateString();
            $pedido->fecha_pecosa = $fecha;
            $pedido->update();

            return back()->with('info','Pecosa subida con exito');
        }
        else{
            return back()->with('infoError', 'No se selecciono ningun archivo a importar');
        }        
    }

    private function getRolUser()
    {
        $user=\Auth::user()->user;
        $resultrol= DB::table('users')
            ->join('role_user','users.id','=','role_user.user_id')
            ->join('roles','roles.id','=','role_user.role_id')
            ->select('roles.slug')
            ->where('users.user','=', $user)
            ->get();

        $RolTo="null";
        //var_dump($resultrol);

        if(isset($resultrol))
        {
            foreach ($resultrol as $rr) 
            {    
                $RolTo=$rr->slug;  
                
            }
        }
        //var_dump($RolTo);
        return strtoupper($RolTo);
        
    }

    public function byPecosa($id)
    {
        return DB::table('detalle_pedido as dp')
        ->join('producto as p','p.id','=','dp.producto_id')
        ->select('p.id','p.codigo','p.descripcion')
        ->where('dp.pedido_id',$id)
        ->orderBy('p.descripcion','asc')
        ->get();
    }

    public function byPecosaPedido($id, $id1)
    {
        return DB::table('detalle_pedido as dp')
        ->join('producto as p','p.id','=','dp.producto_id')
        ->select('p.um','p.pre_unit','dp.cantidad','p.cantidad as stock')
        ->where('dp.producto_id',$id)
        ->where('dp.pedido_id',$id1)
        ->get();
    }

    private function after_last ($chart, $inthat)
    {
        if (!is_bool(PedidoController::strrevpos($inthat, $chart)))
        return substr($inthat, PedidoController::strrevpos($inthat, $chart)+strlen($chart));
    }
    
    private function strrevpos($instr, $needle)
    {
        $rev_pos = strpos (strrev($instr), strrev($needle));
        if ($rev_pos===false) return false;
        else return strlen($instr) - $rev_pos - strlen($needle);
    }
}
