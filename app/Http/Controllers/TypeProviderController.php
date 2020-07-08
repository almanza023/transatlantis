<?php

namespace App\Http\Controllers;

use App\Models\TypeProvider;
use Illuminate\Http\Request;

class TypeProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $typeproviders = TypeProvider::all();
        return view('typeprovider.index', compact('typeproviders'));
    }

    public function store(Request $request)
    {

        TypeProvider::create($request->all());

        return redirect()->route('typeprovider.index')->with('success', 'TIPO DE PROVEEDOR GUARDADO CON EXITO!');
    }

    public function update(Request $request, $id)
    {
        $datos = $request->all();

        $datos = array_except($datos, array('id_type_provider'));

        TypeProvider::findOrFail($request->id_type_provider)->update($datos);

        return redirect()->route('typeprovider.index')->with('success', 'TIPO DE PROVEEDOR ACTUALIZADO CON EXITO!');
    }
}
