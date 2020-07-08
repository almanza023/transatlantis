<?php

namespace App\Http\Controllers;

use App\Models\TypeUnit;
use Illuminate\Http\Request;

class TypeUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $typeunits = TypeUnit::all();
        return view('typeunit.index', compact('typeunits'));
    }

    public function store(Request $request)
    {

        TypeUnit::create($request->all());

        return redirect()->route('typeunit.index')->with('success', 'TIPO DE UNIDAD GUARDADO CON EXITO!');
    }

    public function update(Request $request, $id)
    {
        $datos = $request->all();

        $datos = array_except($datos, array('id_type_unit'));

        TypeUnit::findOrFail($request->id_type_unit)->update($datos);

        return redirect()->route('typeunit.index')->with('success', 'TIPO DE UNIDAD ACTUALIZADO CON EXITO!');
    }
}
