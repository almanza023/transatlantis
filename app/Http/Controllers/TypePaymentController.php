<?php

namespace App\Http\Controllers;

use App\Models\TypePayment;
use Illuminate\Http\Request;

class TypePaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $typepayments = TypePayment::all();
        return view('typepayment.index', compact('typepayments'));
    }

    public function store(Request $request)
    {

        TypePayment::create($request->all());

        return redirect()->route('typepayment.index')->with('success', 'TIPO DE PAGO GUARDADO CON EXITO!');
    }

    public function update(Request $request, $id)
    {
        $datos = $request->all();

        $datos = array_except($datos, array('id_type_payment'));

        $typepayment = TypePayment::findOrFail($request->id_type_payment)->update($datos);

        return redirect()->route('typepayment.index')->with('success', 'TIPO DE PAGO ACTUALIZADO CON EXITO!');
    }
}
