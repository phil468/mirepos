<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $roles=DB::table('roles')->where ('name','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('acceso.roles.index',["roles" =>$roles,"searchText"=>$query]);
        }
    }

    public function create()
    {
         $permissions=Permission::get();
        return view("acceso.roles.create",compact('permissions'));
    }

    public function store(Request $request)
    {
        $roles=Role::create($request->all());
        $roles->permissions()->sync($request->get('permissions'));
        return redirect()->route('acceso.roles.index')->with('info','Rol guardado con exito');   
    }

    public function edit($id)
    {
        $permissions=Permission::get();
        return view("acceso.roles.edit",["roles"=>Role::findOrFail($id),"permissions"=>$permissions])->with('info','Rol modificado con exito');;
    }

    public function show($id)
    {
        return view("acceso.roles.show",["roles"=>Role::findOrFail($id)]);
    }

    public function update(Request $request,$id)
    {
        $roles=Role::findOrFail($id);
        $roles->name=$request->get('name');
        $roles->slug=$request->get('slug');
        $roles->description=$request->get('description');
        $roles->update();

        $roles->permissions()->sync($request->get('permissions'));
        return Redirect::to('acceso/roles')->with('info','Rol editado con exito');
    }
    
        public function destroy($id)
    {
        $roles=DB::table('roles')->where('id','=',$id)->delete();
        return back()->with('info','Rol eliminado Correctamente');
    }
}
