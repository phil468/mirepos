<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use DB;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $permisos=DB::table('permissions')->where ('name','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(10);
            return view('acceso.permisos.index',["permisos" =>$permisos,"searchText"=>$query]);
        }
    }
        public function create()
    {
        return view("acceso.permisos.create");
    }
    public function store(Request $request)
    {
        $permisos=Permission::create($request->all());
        return redirect()->route('acceso.permisos.index')->with('info','Permiso guardado con exito');

        
    }
        public function edit($id)
    {
        return view("acceso.permisos.edit",["permisos"=>Permission::findOrFail($id)])->with('info','Permiso modificado con exito');
    }
    public function show($id)
    {
        return view("acceso.permisos.show",["permisos"=>Permission::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $permisos=Permission::findOrFail($id);
        $permisos->name=$request->get('name');
        $permisos->slug=$request->get('slug');
        $permisos->description=$request->get('description');
        $permisos->update();
        return Redirect::to('acceso/permisos');
    }
        public function destroy($id)
    {
        $permisos=DB::table('permissions')->where('id','=',$id)->delete();
        return back()->with('info','Permiso eliminado con exito');
    }
}
