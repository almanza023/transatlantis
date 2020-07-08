<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate();
        return view('roles.index', compact('roles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();

        return view('roles.edit', compact('role','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($request->all());
        //Actualizar permisos
        $role->permissions()->sync($request->get('permissions'));

        if($role){
            return redirect()->route('roles.index')->with('success', 'Rol Guardado Exitosamente');
        }else {
            return redirect()->route('roles.index')->with('warning', 'Se ha Presentado Un error al Registrar Rol');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //Actualizar usuario
        $role->update($request->all());        

        //Actualizar permisos
        $role->permissions()->sync($request->get('permissions'));

        if($role){
            return redirect()->route('roles.index')->with('success', 'Rol Actualizado Exitosamente');
        }else {
            return redirect()->route('roles.index')->with('warning', 'Se ha Presentado Un error al Actualizar Rol');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role=Role::find($id);
        $role->delete();

        if($role){
            return redirect()->route('roles.index')->with('success', 'Rol Eliminado Exitosamente');
        }else {
            return redirect()->route('roles.index')->with('warning', 'Se ha Presentado Un error al Eliminar Rol');
        }

    }
}
