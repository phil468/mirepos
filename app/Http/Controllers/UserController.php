<?php

namespace App\Http\Controllers;

use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;
use Hash;
use App\Sedes;
use App\UsuarioSede;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request)
        {
            $query=trim($request->get('searchText'));
            $usuario=DB::table('users')
            ->where('name','LIKE','%'.$query.'%')
            ->where('system_state',1)
            ->orderBy('id','desc')
            ->paginate(7);
            return view('acceso.usuario.index',["usuario"=>$usuario,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sede = DB::table('sedes')
        ->where('system_state',1)
        ->orderBy('nombre')
        ->get();
        return view("acceso.usuario.create",["sede"=>$sede]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario=new User;
        $usuario->name=$request->get('name');
        $usuario->user=$request->get('user');
        $usuario->dni=$request->get('dni');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        
        $max=DB::table('users')->max('id');
            
        if (!empty($max))
        {
            $codigo=$max+1;
            $usuario->id = $codigo;
        }
        else
        {
            $max=1;
            $usuario->id = $max;
        }

        $filenameimg = $usuario->user;

        if (Input::hasFile('foto'))
        {
            $file=Input::file('foto');
            
            $extname = UserController::after_last('.', $file->getClientOriginalName());
            $filenameimg = $filenameimg.'.'.$extname;
            
            $file->move('./img/usuario',$filenameimg);
            $usuario->foto=$filenameimg;
        }
        $usuario->system_state=1;
        $usuario->save();
        return redirect()->route('acceso.usuario.index')->with('info','Usuario registrado con exito');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $usuario = DB::table('users as u')
        ->join('role_user as ru','u.id','=','ru.user_id')
        ->join('roles as r','ru.role_id','=','r.id')
        ->select('r.name as rol','u.name','u.user','u.email','u.foto', 'u.dni')
        ->where('u.id','=',$id)
        ->first();
        
        $sede = DB::table('users as u')
        ->join('user_sede as us','us.user_id','=','u.id')
        ->join('sedes as s','us.sede_id','=','s.id')
        ->select('s.nombre')
        ->where('u.id','=',$id)
        ->get();

        return view("acceso.usuario.show",["usuario"=>$usuario,"sede"=>$sede]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sede = DB::table('sedes')
        ->where('system_state',1)
        ->orderBy('nombre')
        ->get();
        return view("acceso.usuario.edit",["usuario"=>User::findOrFail($id),"sede"=>$sede]);
    }

    public function update(Request $request, $id)
    {
        $usuario=User::findOrFail($id);
        $usuario->name=$request->get('name');
        $usuario->user=$request->get('user');
        $usuario->dni=$request->get('dni');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->system_state = 1;
        
        if(Input::hasFile('foto'))
        {
            $file=Input::file('foto');
            $file->move(public_path().'/img/usuario/',$file->getClientOriginalName());
            $usuario->foto=$file->getClientOriginalName();
        }
        
        $usuario->update();
        return Redirect::to('home')->with('info','Usuario modificado con exito');
    }

    public function password(Request $request,$id)
    {
        $pass = $request->get('password');
        $new  = $request->get('password_confirmation');
        if($pass == $new)
        {
            $usuario=User::findOrFail($id);
            $usuario->password=bcrypt($request->get('password'));
            $usuario->update();
            return back()->with('info','Contraseña cambiada con exito');
        }
        else
        {
            return back()->with('infoError','Las contraseñas ingresadas no coinciden');
        }     
    }

    public function assignRol($id)
    {
        $roles=Role::get();
        return view("acceso.usuario.assignRol",["usuario"=>User::findOrFail($id),"roles"=>$roles]);
    }

    public function rolAssigned(Request $request, $id)
    {
        $usuario=User::findOrFail($id);
        $usuario->roles()->sync($request->get('roles'));
        $usuario->update();
        return Redirect::to('acceso/usuario')->with('info','Rol asignado con exito');
    }

    public function assignSede($id)
    {
        $sede=DB::table('sedes')
        ->orderBy('nombre','asc')
        ->where('system_state',1)
        ->get();
        return view("acceso.usuario.assignSede",["usuario"=>User::findOrFail($id),"sede"=>$sede]);
    }

    public function sedeAssigned(Request $request, $id)
    {
        
        $cont =0;
        $sede_id =$request->get('sede');
        $mytime=Carbon::now('America/Lima');

            while ($cont < count($sede_id)) {
                
                $detalle = new UsuarioSede();

                $detalle->user_id = $id;
                $detalle->sede_id = $sede_id[$cont];
                $detalle->created_at=$mytime->toDateTimeString();
                $detalle->updated_at=$mytime->toDateTimeString();
                $detalle->save();       
                
                $cont=$cont+1;
            }

        return Redirect::to('acceso/usuario')->with('info','Sede asignada con exito');;
    }

    public function destroy($id)
    {
        $usuario=User::findOrFail($id);
        $usuario->system_state = 0;
        $mytime=Carbon::now('America/Lima');
        $usuario->deleted_at=$mytime->toDateTimeString();
        $usuario->update();
        return Redirect::to('acceso/usuario')->with('info','Usuario eliminado con exito');;
    }

    private function after_last ($chart, $inthat)
    {
        if (!is_bool(UserController::strrevpos($inthat, $chart)))
        return substr($inthat, UserController::strrevpos($inthat, $chart)+strlen($chart));
    }
    
    private function strrevpos($instr, $needle)
    {
        $rev_pos = strpos (strrev($instr), strrev($needle));
        if ($rev_pos===false) return false;
        else return strlen($instr) - $rev_pos - strlen($needle);
    }

}
