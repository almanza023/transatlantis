<?php

namespace App\Http\Controllers;

use App\Models\TimePayment;
use Illuminate\Http\Request;

class TimePaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $timepayments = TimePayment::all();
        return view('timepayment.index', compact('timepayments'));
    }

    public function store(Request $request)
    {
        TimePayment::create($request->all());
        return redirect()->route('timepayment.index')->with('success', 'TIEMPO DE PAGO GUARDADO CON EXITO!');
    }

    public function update(Request $request, $id)
    {
        $datos = $request->all();
        $datos = array_except($datos, array('id_time_payment'));

        $timepayment = TimePayment::findOrFail($request->id_time_payment)->update($datos);

        return redirect()->route('timepayment.index')->with('success', 'TIEMPO DE PAGO ACTUALIZADO CON EXITO!');
    }
}
