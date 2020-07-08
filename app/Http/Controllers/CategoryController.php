<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('category.index')->with('success', 'CATEGORIA DE PRODUCTO GUARDADO CON EXITO!');
    }

    public function update(Request $request, $id)
    {
        $datos = $request->all();
        $datos = array_except($datos, array('id_category'));

        Category::findOrFail($request->id_category)->update($datos);

        return redirect()->route('category.index')->with('success', 'CATEGORIA DE PRODUCTO ACTUALIZADO CON EXITO!');
    }
}
