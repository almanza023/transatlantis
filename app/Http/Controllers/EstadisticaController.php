<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{
    public function __construct(OrderRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }

    public function index()
    {
        return view('estadisticas.estado_pedidos');
    }

    public function consulta(Request $request)
    {

        $date1 = $request->date1;
        $date2 = $request->date2;
        $num_cot =DB::table('history_orders as h')->join('orders as o', 'h.id_order', '=', 'o.id_order')
        ->where('h.id_order_status', 2)->whereBetween('o.date_order', [$date1, $date2])->count();

        $num_fact =DB::table('history_orders as h')->join('orders as o', 'h.id_order', '=', 'o.id_order')
       ->where('h.id_order_status', 10)->whereBetween('o.date_order', [$date1, $date2])->count();

       $num_pre =DB::table('history_orders as h')->join('orders as o', 'h.id_order', '=', 'o.id_order')
       ->where('h.id_order_status', 3)->whereBetween('o.date_order', [$date1, $date2])->count();

        $num_com = DB::table('history_orders as h')->join('orders as o', 'h.id_order', '=', 'o.id_order')
        ->where('h.id_order_status', 4)->whereBetween('o.date_order', [$date1, $date2])->count();

        $num_agen = DB::table('history_orders as h')->join('orders as o', 'h.id_order', '=', 'o.id_order')
        ->where('h.id_order_status', 8)->where('h.status', 1)->whereBetween('o.date_order', [$date1, $date2])->count();

        $num_ent =  DB::table('history_orders as h')->join('orders as o', 'h.id_order', '=', 'o.id_order')
        ->where('h.id_order_status', 9)->whereBetween('o.date_order', [$date1, $date2])->count();

        $alta = DB::table('orders')->where('priority', 1)->whereBetween('date_order', [$date1, $date2])->count();
        $baja = DB::table('orders')->where('priority', 10)->whereBetween('date_order', [$date1, $date2])->count();
        $media = DB::table('orders')->where('priority', 5)->whereBetween('date_order', [$date1, $date2])->count();

        $clientes=DB::select('SELECT c.first_name, COUNT(o.id_order) AS cantidad FROM orders o INNER JOIN customer_domicile cd ON o.id_customer_domicile=cd.id_customer_domicile
        INNER JOIN customers c ON cd.nid=c.nid where o.date_order>=? and o.date_order<=? GROUP BY c.nid ORDER BY cantidad DESC LIMIT 5', [$date1, $date2]);

        $providers=DB::select('SELECT p.full_name, COUNT(*) AS cantidad FROM providers AS p
        INNER JOIN purchase_order_details pod ON p.nit=pod.nit WHERE DATE(pod.created_at)>=? AND DATE(pod.created_at)<=? GROUP BY p.nit ORDER BY cantidad desc
       ', [$date1, $date2]);
      
        
        return view('estadisticas.graficaEstado', compact('num_cot', 'num_fact', 'num_pre', 'num_com', 'num_agen', 'num_ent', 'alta', 'media', 'baja', 'clientes', 'providers',
        'date1', 'date2'));
    }

    public function update(Request $request, $id)
    {
        $datos = $request->all();
        $datos = array_except($datos, array('id_category'));

        Category::findOrFail($request->id_category)->update($datos);

        return redirect()->route('category.index')->with('success', 'CATEGORIA DE PRODUCTO ACTUALIZADO CON EXITO!');
    }
}
