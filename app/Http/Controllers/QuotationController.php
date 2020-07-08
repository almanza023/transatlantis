<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequest;
use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Departament;
use App\Models\Driver;
use App\Models\DriverVehicle;
use App\Models\HistoryOrder;
use App\Models\Order;
use App\Models\OrderDelivery;
use App\Models\OrderDetail;
use App\Models\OrderScheduleDetail;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\PurchaseOrderDetail;
use App\Models\TimePayment;
use App\Models\TypePayment;
use App\Repositories\OrderRepository;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use NumerosEnLetras;

class QuotationController extends Controller
{

    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }

    public function index()
    {
        if(auth()->user()->hasRole('cliente')==1){
            $orders= $this->repository->getCotizacionesClientes(auth()->user()->usable_id);
           
        }else {
            $orders = $this->repository->getQuations();     
        }
          
        
        return view('cotizaciones.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findById($id)->with('orderDetails.product:id_product,name_product')->first();
        return view('cotizaciones.show', compact('order'));
    }

    public function history($id)
    {
        $fecha = Carbon::now()->format('d-m-Y');
        $histories = HistoryOrder::where('id_order', $id)->get();
        if (count($histories) > 0) {
            
            $pdf = PDF::loadView('reportes.order_history', compact('histories', 'fecha' ));
            return $pdf->stream('Historial de Pedido.pdf');              
        } else {
            return redirect()->route('orders.index')->with('warning', 'NO SE ENCONTRARON DATOS RELACIONADOS CON ESTA BUSQUEDA..');
        }
    }

    public function showDetail($id)
    {
        if (request()->ajax()) {
            $order = $this->repository->findWithProviders($id);
            return response()->view('ajax.order-products', compact('order'));
        }
    }

    

    public function create(Request $request)
    {
        if(auth()->user()->hasRole('cliente')==1){
            $customers=Customer::find(auth()->user()->usable_id)->domicileCurrent()->first();       
            //return $customers;    
        }else{
            $customers =  $this->repository->getCustomers();
        }
        
        $departaments = $this->repository->getDepartaments();
        $typepayments = $this->repository->getTypePayments();
        $timepayments = $this->repository->getTimesPayments();
        $products = $this->repository->getProducts();
        $municipalities = $this->repository->getMunicipalities();
        $typecustomers = $this->repository->getTypeCustomers();

        if(auth()->user()->hasRole('cliente')==1){
        return view('cotizaciones.create_customer', compact('typecustomers', 'customers', 'departaments', 'typepayments', 'timepayments', 'products', 'municipalities'));

        }
        
        return view('cotizaciones.create', compact('typecustomers', 'customers', 'departaments', 'typepayments', 'timepayments', 'products', 'municipalities'));
    }

    public function store(OrderRequest $request)
    {
        if (request()->ajax()) {

            $order = new Order;
            $order = $this->createObjectOrder($request, $order);
            DB::beginTransaction();
            try {
                $order->save();
                $id=$order->id_order;                
                $this->storeOrderDetail($request, $order);
                $this->storeHystoryOrder($id);
                DB::commit();
                
                return response()->json(['success' => ' COTIZACIÓN CREADA CON EXITO!']);
            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json(['warning' => 'ERROR AL GUARDAR DATOS']);
            }
        }

    }

    

    public function createObjectOrder($request, $order)
    {

        $order->id_customer_domicile = $request->id_customer_domicile;
        $order->id_type_payment = $request->id_type_payment;
        $order->id_time_payment = $request->id_time_payment;
        $order->date_order = Carbon::now();
        $order->priority = $request->priority;
        $order->type = 2;
        return $order;

    }

    public function storeOrderDetail($request, $order)
    {
        $products = $request->id_product;
        $amounts = $request->amount;
        $unit_prices = $request->unit_price;

        for ($i = 0; $i < count($products); $i++) {
            $order->orderDetails()->create([
                'id_product' => $products[$i],
                'amount' => $amounts[$i],
                'unit_price' => $unit_prices[$i],
            ]);
        }
    }

    public function storeHystoryOrder($id)
    {
        HistoryOrder::create([
            'id_order' => $id,
            'id_order_status' => 2,
            'observation' => "Cotización",
            'status'=>'1'
        ]);

    }

    public function edit($id)
    {
        $order = Order::findById($id)->with('orderDetails.product:id_product,name_product')->first();
        $customers = Customer::all(['nid', 'first_name', 'last_name', 'full_name']);
        $departaments = Departament::with('municipalities')->get();
        $typepayments = TypePayment::all(['id_type_payment', 'type_payment', 'description']);
        $timepayments = TimePayment::all(['id_time_payment', 'time_payment', 'description']);
        $products = Product::with('priceActive:id_price,price,id_product')->get(['id_product', 'name_product', 'price', 'type_price']);
        return view('cotizaciones.edit-order', compact('order', 'customers', 'departaments', 'typepayments', 'timepayments', 'products'));

    }

    public function clonar($id)
    {
        
        $order = Order::findById($id)->with('orderDetails.product:id_product,name_product')->first();
        $customers = Customer::all(['nid', 'first_name', 'last_name', 'full_name']);
        $departaments = Departament::with('municipalities')->get();
        $typepayments = TypePayment::all(['id_type_payment', 'type_payment', 'description']);
        $timepayments = TimePayment::all(['id_time_payment', 'time_payment', 'description']);
        $products = Product::with('priceActive:id_price,price,id_product')->get(['id_product', 'name_product', 'price', 'type_price']);
        return view('order.clonar', compact('order', 'customers', 'departaments', 'typepayments', 'timepayments', 'products'));

    }

    public function update(OrderRequest $request, $id)
    {
        if (request()->ajax()) {

                 $order = Order::findOrFail($id);    
                $order->id_customer_domicile = $request->id_customer_domicile;
                $order->id_type_payment = $request->id_type_payment;
                $order->id_time_payment = $request->id_time_payment;
                $order->priority = $request->priority;
                $order->date_order=Carbon::now()->toDateTimeString();

                DB::beginTransaction();
                try {

                    $order->update();

                    $order->products()->detach();

                    $this->storeOrderDetail($request, $order);

                    $history = HistoryOrder::where('id_order',$id)
                     ->where('id_order_status', 2)->update(['status' => 0])  ;

                    HistoryOrder::create([
                        'id_order' => $id,
                        'id_order_status' => 12,
                        'observation' => "Esperando Aprobación Cliente",
                        'status'=>'1'
                    ]);

                    DB::commit();

                    return response()->json(['success' => 'COTIZACION ACTUALIZADA CON EXITO!']);

                } catch (\Exception $ex) {
                    DB::rollback();
                    return response()->json(['warning' => 'ERROR AL ACTUALIZAR DATOS']);
                }
           

        }

    }

    public function aprobar($id)
    {
        if (request()->ajax()) {

            DB::beginTransaction();
            try {

               
                $history = HistoryOrder::where('id_order', $id)
                 ->where('id_order_status', 12)->update(['status' => 0])  ;

                HistoryOrder::create([
                    'id_order' => $id,
                    'id_order_status' => 3,
                    'observation' => "Pre-Orden",
                    'status'=>'1'
                ]);

                DB::commit();

                return response()->json(['success' => 'COTIZACION APROBADA CON EXITO!']);

            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json(['warning' => 'ERROR AL REGISTRAR DATOS']);
            }
            

            
        }
    }

    public function denyOrder($id)
    {
        if (request()->ajax()) {

            $order = $this->repository->findByIdWithHistoriesStatus($id);
            $validate = $this->repository->validateApprove($order);

            if ($validate) {
                $exito = $this->repository->changeStatusOrders($order, 'Rechazado');
                if ($exito) {
                    return response()->json(['success' => 'ORDEN RECHAZADA CON EXITO!', 'status' => 'Rechazado', 'order' => $order->id_order]);
                } else {
                    return response()->json(['warning' => 'OOPS! ERROR DEL SERVIDOR']);
                }
            } else {
                return response()->json(['warning' => 'ESTE PEDIDO YA FUE APROBADA O RECHAZADA']);
            }
        }

    }

    

    

    public function saveSchedule(Request $request)
    {
        $order = $this->repository->findByIdWithHistoriesStatus($request->id_order);
        $validate = $this->repository->validateSchedule($order);

        if ($validate) {
            $exito = $this->repository->saveSchedule($order, $request);
            if ($exito) {
                return response()->json(['success' => 'AGENDA DE PEDIDO GUARDADO CON EXITO!', 'order' => $order->id_order, 'status' => 'Agendado']);
            } else {
                return response()->json(['warning' => 'ERROR AL GUARDAR DATOS']);
            }
        } else {
            return response()->json(['warning' => 'ESTE PEDIDO DEBE LLEGAR A UN ESTADO DE COMPRA!']);
        }
    }

    public function changeMunicipalities($id)
    {
        if (request()->ajax()) {
            $departament = Departament::with('municipalities')->where('id_departament', $id)->first();
            return response()->json($departament->municipalities);
        }
    }

    public function changeDomiciles($id)
    {

        if (request()->ajax()) {
            $customer = Customer::where('nid', $id)->with('domicileCurrent.municipality.departament')->first();

            $order = Order::latest()->first(['id_order']);

            $fecha = Carbon::now();
            $date = $fecha->format('d-m-Y');

            $domicile = $customer->domicileCurrent->first();

            $idcustomerdomicile = $domicile->pivot->id_customer_domicile;

            $info = "{$domicile->address}, {$domicile->additional}, {$domicile->municipality->name_municipality}-{$domicile->municipality->departament->name_departament}";
            return response()->json(
                ['address' => $info,
                    'customerdomicile' => $idcustomerdomicile,
                    'customer' => $customer->nid,
                    'nro_order' => $order,
                    'fecha' => $date,
                    'email' => $customer->email,
                ]
            );
        }

    }

    public function saveDiscount(DiscountRequest $request)
    {
        if (request()->ajax()) {
            $order = $this->repository->saveDiscount($request);
            if ($order) {
                return response()->json(['success' => 'APLICACION DE DESCUENTO EXITOSO!', 'discount' => $request->discount]);
            } else {
                return response()->json(['warning' => 'NO SE PUDO APLICAR UN DESCUENTO!']);
            }
        }
    }

    public function filter(Request $request)
    {

       
        if($request->ajax()){        
            $priority = $request->filter_priority;
            $status = $request->filter_status;
            $date1 = $request->filter_date_inical;
            $date2 = $request->filter_date_final;

            $validate = $this->repository->validateFilters($priority, $status, $date1, $date2);

            if (!$validate) {
                return response()->json(['warning' => 'DEBES ESCOGER AL MENOS UN FILTRO']);
            }

            $orders = $this->repository->filterOrders($priority, $status, $date1, $date2);
            

            if (count($orders) > 0) {
                return response()->view('ajax.table-orders', compact('orders'));
            } else {
                return response()->json(['warning' => 'NO SE ENCONTRARON DATOS RELACIONADOS CON ESTA BUSQUEDA..']);
            }
        }else {
            return 'No Recibido';
        }

    }

    public function getReporteOrders(){

        return view('order.reporte');
       
    }

    public function getAgendados(){

        $orders = $this->repository->filterOrders('', 'Agendado', '', '');
        return view('order.agendados', compact('orders'));
       
    }

    public function getPrintOrders(Request $request)
    {
 
            $priority = $request->filter_priority;
            $status = $request->filter_status;
            $date1 = $request->filter_date_inical;
            $date2 = $request->filter_date_final;
            $fecha = Carbon::now()->format('d-m-Y');
            $validate = $this->repository->validateFilters($priority, $status, $date1, $date2);

            if (!$validate) {
                return response()->json(['warning' => 'DEBES ESCOGER AL MENOS UN FILTRO']);
            }
            $orders = $this->repository->filterOrders($priority, $status, $date1, $date2);
            if (count($orders) > 0) {
                
                $pdf = PDF::loadView('reportes.orders', compact('orders', 'fecha'));
                return $pdf->stream('Listado de Pedidos.pdf');              
            } else {
                return response()->json(['warning' => 'NO SE ENCONTRARON DATOS RELACIONADOS CON ESTA BUSQUEDA..']);
            }
       

    }

    

    public function getOrderDriver(Request $request)

    {                 
            $placa =$request->placa;;          
            $date1 = $request->date1;  
            $date2 = $request->date2;  
            $fecha = Carbon::now()->format('d-m-Y');
            
            if(!empty($placa) && !empty($date1) && !empty($date2)){

            
            $orders = OrderScheduleDetail::Entregados($placa, $date1, $date2)->get();
           
            $driver=DriverVehicle::DriverPlaca($placa);
            
            if (count($orders) > 0) {                
                $pdf = PDF::loadView('reportes.orders_drivers', compact('orders', 'fecha', 'driver'));
               
                return $pdf->stream('Listado Ordenenes Entregadas POr Conductores.pdf');              
            } else {
                return view('reportes.orders_drivers', compact('orders', 'fecha', 'driver'));
                return response()->json(['warning' => 'NO SE ENCONTRARON DATOS RELACIONADOS CON ESTA BUSQUEDA..']);
            }  
        }else {
            return response()->json(['warning' => 'DEBE SELECCIONAR LOS CAMPOS EN EL FORMULARIO']);
        }   

    }


    public function getQuotation($id)
    {
    
        $order = $this->repository->findByIdWithDetails($id);        
        $history=HistoryOrder::where('id_order', $id)->orderBy('id_order_status', 'desc')->first();
        $fecha = Carbon::now()->format('d-m-Y');
        
        
        $pdf = PDF::loadView('reportes.quotation', compact('order', 'fecha', 'history'));
        return $pdf->stream('Cotización.pdf');      
    
    }

    public function getQuotationDetalles($id)
    {
    
        $order = $this->repository->findByIdWithDetails($id);        
        $histories=HistoryOrder::where('id_order', $id)->get();
        $fecha = Carbon::now()->format('d-m-Y');
       
        
        $pdf = PDF::loadView('reportes.detalles-quotation', compact('order', 'fecha', 'histories'));
        return $pdf->stream('Cotización.pdf');      
    
    }

}
