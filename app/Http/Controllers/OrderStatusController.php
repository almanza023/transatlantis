<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orderstatus = OrderStatus::all();
        return view('orderstatus.index', compact('orderstatus'));
    }

    public function store(Request $request)
    {
        OrderStatus::create($request->all());
        return redirect()->route('orderstatus.index')->with('success', 'ESTADO DE PEDIDOS GUARDADO CON EXITO!');
    }

    public function update(Request $request, $id)
    {
        $datos = $request->all();
        $datos = array_except($datos, array('id_order_status'));

        $orderstatus = OrderStatus::findOrFail($request->id_order_status)->update($datos);

        return redirect()->route('orderstatus.index')->with('success', 'ESTADO DE PEDIDOS ACTUALIZADO CON EXITO!');
    }
}
