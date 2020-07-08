<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;

use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       
    }
    public function show_general()
    {
        return view('vista-reportes.reporte-general');
    }

    public function show_facturados()
    {
        return view('vista-reportes.reporte-facturados');
    }

    public function show_historial()
    {
        return view('vista-reportes.reporte-historial-dia');
    }
    public function show_compras()
    {
        $providers=Provider::all(['nit', 'full_name']);
        return view('vista-reportes.reporte-compra_proveedor', compact('providers'));
    }

    public function show_viajes()
    {
        return view('vista-reportes.reporte-viajes-agendados');
    }


    public function getReporteGeneral(Request $request)
    {

      
        $date1 = $request->date1;
        $date2 = $request->date2;
        
        $totalclientes=Customer::count();
        $totalproveedores=Provider::count();
        $totalproductos=Product::count();
       
        $num_pre =DB::select("SELECT COUNT(*) as total FROM history_orders ho 
                            INNER JOIN orders o ON o.id_order=ho.id_order
                                WHERE DATE(o.date_order) >=? AND  DATE(o.date_order) >=? and ho.id_order_status=3 and ho.status=1", [$date1, $date2]);
        
        
       

       
        $num_com = DB::select("SELECT COUNT(*) as total FROM history_orders ho 
                            INNER JOIN orders o ON o.id_order=ho.id_order
                                WHERE DATE(o.date_order) >=? AND  DATE(o.date_order) >=? and ho.id_order_status=4 and ho.status=1", [$date1, $date2]);

        $num_agen =DB::select("SELECT COUNT(*) as total FROM history_orders ho 
                            INNER JOIN orders o ON o.id_order=ho.id_order
                                WHERE DATE(o.date_order) >=? AND  DATE(o.date_order) >=? and ho.id_order_status=8 and ho.status=1", [$date1, $date2]);

        $num_ent =  DB::select("SELECT COUNT(*) as total FROM history_orders ho 
                            INNER JOIN orders o ON o.id_order=ho.id_order
                                WHERE DATE(o.date_order) >=? AND  DATE(o.date_order) >=? and ho.id_order_status=9 and ho.status=1", [$date1, $date2]);

        $num_cot =  DB::select("SELECT COUNT(*) as total FROM history_orders ho 
                            INNER JOIN orders o ON o.id_order=ho.id_order
                                WHERE DATE(o.date_order) >=? AND  DATE(o.date_order) >=? and ho.id_order_status=2 and ho.status=1", [$date1, $date2]);

        $num_fact =  DB::select("SELECT COUNT(*) as total FROM history_orders ho 
                            INNER JOIN orders o ON o.id_order=ho.id_order
                                WHERE DATE(o.date_order) >=? AND  DATE(o.date_order) >=? and ho.id_order_status=10 and ho.status=1", [$date1, $date2]);

        $alta = DB::table('orders')->where('priority', 1)->whereBetween('date_order', [$date1, $date2])->count();
        $baja = DB::table('orders')->where('priority', 10)->whereBetween('date_order', [$date1, $date2])->count();
        $media = DB::table('orders')->where('priority', 5)->whereBetween('date_order', [$date1, $date2])->count();

        
        $clientes=DB::select('SELECT CONCAT(c.first_name," ",c.last_name) as cliente, COUNT(o.id_order) AS cantidad FROM orders o INNER JOIN customer_domicile cd ON o.id_customer_domicile=cd.id_customer_domicile
        INNER JOIN customers c ON cd.nid=c.nid where o.date_order>=? and o.date_order<=? GROUP BY c.nid ORDER BY cantidad DESC LIMIT 5', [$date1, $date2]);

       
        $providers=DB::select('SELECT p.full_name AS proveedor, COUNT(*) AS cantidad FROM providers AS p
        INNER JOIN purchase_order_details pod ON p.nit=pod.nit WHERE DATE(pod.created_at)>=? AND DATE(pod.created_at)<=? GROUP BY p.nit ORDER BY cantidad desc
       ', [$date1, $date2]);

       $productos=DB::select("SELECT p.name_product AS producto, SUM(od.amount) AS total FROM order_details od INNER JOIN purchase_order_details pod ON od.id_order_detail=pod.id_order_detail
       inner join products p ON p.id_product=od.id_product INNER JOIN orders o ON o.id_order=od.id_order
       WHERE o.date_order>=? AND o.date_order<=? group BY od.id_product ORDER BY total DESC LIMIT 5", [$date1, $date2]);


        $destinos=DB::select("SELECT CONCAT(m.name_municipality,' - ',de.name_departament) as destino, count(*)AS cantidad 
        FROM orders o INNER JOIN customer_domicile cd ON o.id_customer_domicile=cd.id_customer_domicile
        INNER JOIN domiciles d ON cd.id_domicile=d.id_domicile INNER JOIN municipalities m ON d.id_municipality=m.id_municipality
        INNER JOIN departaments de ON m.id_departament=de.id_departament INNER JOIN deliveries_orders do
         ON  o.id_order=do.id_order where date(o.date_order)>=? and date(o.date_order)<=? group BY m.id_municipality ORDER BY cantidad desc", [$date1, $date2]);

        
        $viajes_vehiculos=DB::select("SELECT v.brand, v.model, SUM(osd.nro_viaje) AS total FROM order_schedules os INNER JOIN order_schedule_details osd
        on os.id_order_schedule=osd.id_order_schedule inner join vehicles v ON v.placa=osd.placa 
        WHERE  os.date_departure>=? AND os.date_departure<=? GROUP BY osd.placa 
        ORDER BY total desc", [$date1, $date2]);

        $viajes_conductor=DB::select("SELECT  CONCAT(d.first_name, ' ',d.last_name) 
        as conductor, osd.placa, COUNT(*) AS cantidad  FROM order_schedules os
        INNER JOIN order_schedule_details osd ON osd.id_order_schedule=os.id_order_schedule
        INNER JOIN orders o ON o.id_order=os.id_order
        INNER JOIN history_orders ho ON o.id_order=ho.id_order
        INNER JOIN driver_vehicle dv ON dv.placa=osd.placa
        INNER JOIN drivers d ON d.nid_driver=dv.nid_driver
        WHERE ho.id_order_status=8 AND ho.`status`=0
        AND os.date_departure>=? AND os.date_departure<=?
        GROUP BY dv.nid_driver ORDER BY cantidad DESC", [$date1, $date2]);
        
        $productosDia=DB::select("SELECT pro.full_name, p.name_product, sum(od.amount) AS total FROM order_details od 
        INNER JOIN purchase_order_details pod ON od.id_order_detail=pod.id_order_detail
        INNER JOIN products p ON p.id_product=od.id_product
        INNER JOIN providers pro ON pro.nit=pod.nit
        WHERE DATE(pod.created_at)>=? and DATE(pod.created_at)<=?
        GROUP BY od.id_product", [$date1, $date2]);
      
        
         $fecha = Carbon::now()->format('d-m-Y');            
        $pdf = PDF::loadView('reportes.reporte_general', compact('fecha', 'date1', 'date2', 'num_pre', 'num_com', 'num_agen', 'num_ent', 'alta', 'media', 'baja', 'clientes', 'providers',
        'date1', 'date2', 'destinos', 'viajes_vehiculos', 'viajes_conductor', 'totalclientes', 'totalproductos', 'totalproveedores'
        ,'productos', 'num_cot', 'num_fact', 'productosDia'));
        return $pdf->stream('Listado de Pedidos.pdf');      
      
        
        
       
    }

    public function getReporteFacturados(Request $request)
    {
     
        $date1 = $request->date1;
        $date2 = $request->date2;        
        $orders=DB::select("SELECT CONCAT(c.first_name, ' ', c.last_name) AS cliente, c.nid, oi.id_order, oi.date, oi.total, CONCAT(a.first_name,' ',a.last_name) AS realizado FROM order_invoices oi 
        INNER JOIN orders o ON o.id_order=oi.id_order
        INNER JOIN customer_domicile cd ON cd.id_customer_domicile=o.id_customer_domicile
        INNER JOIN customers c ON cd.nid=c.nid
        INNER JOIN admins a ON oi.id_admin=a.id_admin
        where oi.date>=? and oi.date<=?", [$date1, $date2]);        
        $fecha = Carbon::now()->format('d-m-Y');            
        $pdf = PDF::loadView('reportes.reporte_facturados', compact('date1', 'date2', 'fecha', 'orders'));
        return $pdf->stream('Listado de Facturados.pdf');      
      
        
        
       
    }


    public function getViajesConductor(Request $request)
    {
     
        $date1 = $request->date1;
        $date2 = $request->date2;        
        $viajes=DB::select("SELECT CONCAT(d.first_name,' ',d.last_name) AS conductor, osd.placa, COUNT(*) AS entregas, SUM(osd.nro_viaje) as viajes FROM order_schedules os
        INNER JOIN order_schedule_details osd ON os.id_order_schedule=osd.id_order_schedule_details
        INNER JOIN drivers d ON d.nid_driver=osd.nid_driver
        INNER JOIN history_orders ho ON ho.id_order=os.id_order
        INNER JOIN deliveries_orders deo ON deo.id_order=os.id_order
        WHERE os.date_departure>=? and os.date_departure<=? and ho.id_order_status=9 AND ho.`status`=0 AND deo.`status`<=2

        GROUP BY osd.nid_driver", [$date1, $date2]);        
        $fecha = Carbon::now()->format('d-m-Y');            
        $pdf = PDF::loadView('reportes.viajes_conductor', compact('date1', 'date2', 'fecha', 'viajes'));
        return $pdf->stream('Listado de Viajes Conductor.pdf');      
      
        
        
       
    }

    public function getComprasProveedor(Request $request)
    {
     
        $nit=$request->nit;
        $date1 = $request->date1;
        $date2 = $request->date2;    
        
        if($nit>0){
        $purchases=DB::select("SELECT p.name_product, pri.price,  SUM(od.amount) AS total FROM purchase_order_details pod
        INNER JOIN order_details od ON pod.id_order_detail=od.id_order_detail
        INNER JOIN providers pro ON pro.nit=pod.nit
        INNER JOIN products p ON p.id_product=od.id_product
        INNER JOIN prices pri ON pri.id_product=p.id_product
        INNER JOIN orders o on o.id_order=od.id_order
        INNER JOIN history_orders ho ON ho.id_order=o.id_order
        WHERE  date(o.date_order)>=? and date(o.date_order)<=?
        and pro.nit=?
        GROUP BY p.id_product 
        ", [$date1, $date2, $nit]);  
        $tipo=1;
        }else {
        $purchases=DB::select("SELECT p.name_product, pri.price,  SUM(od.amount) AS total, pro.full_name as proveedor
         FROM purchase_order_details pod
        INNER JOIN order_details od ON pod.id_order_detail=od.id_order_detail
        INNER JOIN providers pro ON pro.nit=pod.nit
        INNER JOIN products p ON p.id_product=od.id_product
        INNER JOIN prices pri ON pri.id_product=p.id_product
        INNER JOIN orders o on o.id_order=od.id_order
        
        WHERE  date(o.date_order)>=? and date(o.date_order)<=?
        GROUP BY p.id_product 
        ", [$date1, $date2]);  
        $tipo=2;
       
        }
        
        $fecha = Carbon::now()->format('d-m-Y');            
        $pdf = PDF::loadView('reportes.compras_proveedores', compact('date1', 'date2', 'fecha', 'purchases', 'tipo'));
        return $pdf->stream('Listado de Compras.pdf');      
      
        
        
       
    }

    public function getReporteHistorial(Request $request)
    {

      
        $date1 = $request->date1;
        $date2 = $request->date2;
        
               
        $num_pre =DB::select("SELECT count(*) as cantidad FROM history_orders ho
        INNER JOIN orders o ON o.id_order=ho.id_order
        WHERE ho.id_order_status=3 AND ho.`status`=1 AND DATE(o.date_order)>=? and DATE(o.date_order)<=?", [$date1, $date2]);

       
        $num_com = DB::select("SELECT count(*) as cantidad FROM history_orders ho
        INNER JOIN orders o ON o.id_order=ho.id_order
        WHERE ho.id_order_status=4 AND ho.`status`=1 AND DATE(o.date_order)>=? and DATE(o.date_order)<=?", [$date1, $date2]);

        $num_agen =DB::select("SELECT count(*) as cantidad FROM history_orders ho
        INNER JOIN orders o ON o.id_order=ho.id_order
        WHERE ho.id_order_status=8 AND ho.`status`=1 AND DATE(o.date_order)>=? and DATE(o.date_order)<=?", [$date1, $date2]);

        $num_ent =  DB::select("SELECT count(*) as cantidad FROM history_orders ho
        INNER JOIN orders o ON o.id_order=ho.id_order
        WHERE ho.id_order_status=9 AND ho.`status`=1 AND DATE(o.date_order)>=? and DATE(o.date_order)<=?", [$date1, $date2]);

        $num_cot = DB::select("SELECT count(*) FROM history_orders ho
        INNER JOIN orders o ON o.id_order=ho.id_order
        WHERE ho.id_order_status=2 AND ho.`status`=1 AND DATE(o.date_order)>=? and DATE(o.date_order)<=?", [$date1, $date2]);

        $num_fact =  DB::select("SELECT count(*) as cantidad FROM history_orders ho
        INNER JOIN orders o ON o.id_order=ho.id_order
        WHERE ho.id_order_status=10 AND ho.`status`=1 AND DATE(o.date_order)>=? and DATE(o.date_order)<=?", [$date1, $date2]);


        $facturados=DB::select("SELECT CONCAT(c.first_name, ' ', c.last_name) AS cliente, c.nid, oi.id_order, oi.date, oi.total, CONCAT(a.first_name,' ',a.last_name) AS realizado FROM order_invoices oi 
        INNER JOIN orders o ON o.id_order=oi.id_order
        INNER JOIN customer_domicile cd ON cd.id_customer_domicile=o.id_customer_domicile
        INNER JOIN customers c ON cd.nid=c.nid
        INNER JOIN admins a ON oi.id_admin=a.id_admin
        where oi.date>=? and oi.date<=?", [$date1, $date2]);
       
        
      
        
         $fecha = Carbon::now()->format('d-m-Y');            
        $pdf = PDF::loadView('reportes.reporte_historial', compact('fecha', 'date1', 'date2', 'num_pre', 'num_com', 
        'num_agen', 'num_ent', 'num_cot', 'num_fact', 'facturados'));
        return $pdf->stream('Listado de Pedidos.pdf');      
      
        
        
       
    }

    
}
