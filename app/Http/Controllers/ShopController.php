<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use DB;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
        	$products = DB::table('producto')
            ->where ('descripcion','LIKE','%'.$query.'%')
            ->where('cantidad','>',0)
            ->whereNull ('system_state')
            ->orderBy('descripcion')
            ->paginate(12);
     
            return view('pedidos.shop.index', ["products" =>$products,"searchText"=>$query]);
        }
    }

    public function cart()
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

        return view('pedidos.shop.cart',['sedes'=>$sedes]);
    }
    public function addToCart($id)
    {


        $product = Producto::find($id);
 
        if(!$product) {
 
            abort(404);
 
        }
 
        $cart = session()->get('cart');
 
        // if cart is empty then this the first product
        if(!$cart) {
 
            $cart = [
                    $id => [
                        "id" => $product->id,
                        "UM" => $product->UM,
                        "descripcion" => $product->descripcion,
                        "codigo" => $product->codigo,
                        "cantidad" => 1,
                        "PRE_UNIT" => $product->PRE_UNIT,
                        "foto" => $product->foto
                    ]
            ];
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('info', '¡Producto agregado al carrito con éxito!');
        }
 
        // if cart not empty then check if this product exist then increment cantidad
        if(isset($cart[$id])) {
 
            $cart[$id]['cantidad']++;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('info', '¡Producto agregado al carrito con éxito!');
 
        }
 
        // if item not exist in cart then add to cart with cantidad = 1
        $cart[$id] = [
            "id" => $product->id,
            "UM" => $product->UM,
            "codigo" => $product->codigo,
            "descripcion" => $product->descripcion,
            "cantidad" => 1,
            "PRE_UNIT" => $product->PRE_UNIT,
            "foto" => $product->foto
        ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('info', '¡Producto agregado al carrito con éxito!');
    }

    public function update(Request $request)
    {
        if($request->id and $request->cantidad)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["cantidad"] = $request->cantidad;

            session()->put('cart', $cart);

            session()->flash('info', 'Carrito actualizado con éxito');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
            }
 
            session()->flash('info', 'Producto eliminado con éxito');
        }
    }


}
