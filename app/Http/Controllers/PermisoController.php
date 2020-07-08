<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate();
        return view('permisos.index', compact('permissions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $permisos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission=Permission::find($id);
        return view('permisos.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $permisos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission=Permission::find($id);
       return view('permisos.edit', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        return view('permisos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = Permission::create($request->all());
        if($permission){
            return redirect()->route('permisos.index')->with('success', 'Permiso Guardado Exitosamente');
        }else {
            return redirect()->route('permisos.index')->with('warning', 'Error al Registrar Permiso');
        }
        

        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $permisos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission=Permission::find($id);
        $permission->update($request->all());        
        if($permission){
            return redirect()->route('permisos.index')->with('success', 'Permiso Actualizado Exitosamente');
        }else {
            return redirect()->route('permisos.index')->with('warning', 'Error al
            Actualizar Permiso');

        }

       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $permisos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission=Permission::find($id);
        $permission->delete();

        return redirect()->route('permisos.index')->with('success', 'Permiso Eliminado Exitosamente');
    }
}
