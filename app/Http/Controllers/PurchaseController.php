<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Provider;
use App\Models\PurchaseOrderDetail;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class PurchaseController extends Controller
{

    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }

    public function index()
    {
        $orders = Order::has('orderDetails.providers')->statusSpecific('Compra')->get();
        return view('purchase.index', compact('orders'));
    }

    public function create($id)
    {
        if (request()->ajax()) {
            $order = $this->repository->findWithDetails($id);
            $providers = $this->repository->getProviders();
            return response()->view('ajax.create-purchase', compact('order', 'providers'));
        }
    }

    public function edit($id)
    {
        $purchase = PurchaseOrderDetail::find($id);
        $providers = Provider::active()->get(['nit', 'first_name', 'last_name', 'full_name']);
        return view('purchase.edit', compact('purchase', 'providers'));
    }

    public function update(Request $request, $id)
    {
        $purchase = PurchaseOrderDetail::find($id);
        $purchase->nit = $request->nit;

        $purchase->update();

        return redirect()->route('order.index')->with('success', 'ORDEN DE COMPRA A PROVEEDOR ACTUALIZADO CON EXITO!');

    }

    public function reporte($id)
    {
        $order = Order::where('id_order', $id)->with('orderDetails.providers', 'orderDetails.product')->first();
        $date = Carbon::now();
        $order->fecha = $date->format('d-m-Y H:i:s');
        $pdf = PDF::loadView('reportes.purchase', compact('order', 'date'));
        return $pdf->stream('orden_compra.pdf');
    }

}
