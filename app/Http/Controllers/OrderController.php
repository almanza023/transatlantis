<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequest;
use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Departament;
use App\Models\Driver;
use App\Models\DriverVehicle;
use App\Models\HistoryOrder;
use App\Models\Load;
use App\Models\Order;
use App\Models\OrderDelivery;
use App\Models\OrderDetail;
use App\Models\OrderInvoice;
use App\Models\OrderSchedule;
use App\Models\OrderScheduleDetail;
use App\Models\OrderStatus;
use App\Models\Porcentage;
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

class OrderController extends Controller
{

    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }

    public function index()
    {
       
        $orders = $this->repository->getOrders();
        $vehicles = $this->repository->getVehiclesActiveWithDriver();
        $listvehicles = $this->repository->getVehiclesAgendados();
        $municipalities = $this->repository->getMunicipalities();        
        return view('order.index', compact('orders', 'vehicles', 'municipalities', 'listvehicles' ));

    }

    public function show($id)
    {
        if (request()->ajax()) {
            $order = $this->repository->findByIdWithDetails($id);
            return response()->view('ajax.order-detail', compact('order'));
        }
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
            $customer = $this->repository->getCustomer($id);            
            return response()->view('ajax.order-products', compact('order', 'customer'));
        }
    }

    public function showEntregasConductor(){
        $drivers=Driver::all();
        return view('order.reporte_order_driver', compact('drivers'));

    }

    public function create(Request $request)
    {
        $porcentages=Porcentage::all();
        
        $customers =  $this->repository->getCustomers();
        $departaments = $this->repository->getDepartaments();
        $typepayments = $this->repository->getTypePayments();
        $timepayments = $this->repository->getTimesPayments();
        $products = $this->repository->getProducts();
       
        $municipalities = $this->repository->getMunicipalities();
        $typecustomers = $this->repository->getTypeCustomers();
        return view('order.create', compact('typecustomers', 'customers', 'departaments', 'typepayments', 
        'timepayments', 'products', 'municipalities', 'porcentages'));
    }

    public function store(OrderRequest $request)
    {
        if (request()->ajax()) {
            $order = new Order;
            $order = $this->createObjectOrder($request, $order);
            DB::beginTransaction();
            try {
                $order->save();
                $this->storeHystoryOrder($order);
                $id=$order->id_order;                
                $this->storeOrderDetail($request, $order);
                
                DB::commit();
                return response()->json(['success' => 'PEDIDO #'.$id.' CREADO CON EXITO!']);
            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json(['warning' => 'ERROR AL GUARDAR DATOS']);
            }
        }

    }

    public function storeClonar(OrderRequest $request)
    {
        if (request()->ajax()) {
            if($request->clonar==1){
                
            $order = new Order;
            $order = $this->createObjectOrder($request, $order);
            DB::beginTransaction();
            try {
                $order->save();
                $id=$order->id_order;                
                $this->storeOrderDetail($request, $order);
                $this->storeHystoryOrder($order);
                DB::commit();
                return response()->json(['success' => 'PEDIDO #'.$id.' CREADO CON EXITO HASTA PRE-ORDEN!']);
            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json(['warning' => 'ERROR AL GUARDAR DATOS']);
            }
            }else {
            $order = new Order;
            //Se crea la Orden
            $order = $this->createObjectOrder($request, $order);
            DB::beginTransaction();
            try {
                $order->save();
                $id=$order->id_order;         
                // Se guardan los detalles       
                $this->storeOrderDetail($request, $order);
                 // Se guardan los detalles       
                $h1=new HistoryOrder();
                $h1->id_order=$id;
                $h1->id_order_status=3;
                $h1->observation='Sin Revisar';
                $h1->status=0;
                $h1->save();

                $h2=new HistoryOrder();
                $h2->id_order=$id;
                $h2->id_order_status=5;
                $h2->observation='Aprobado';
                $h2->status=0;
                $h2->save();

                //Se obtiene los detalles de la orden con el id de la orden a clonar
                $orderd=OrderDetail::where('id_order', $id)->get();
                //Se obtienen todas las compras con los detalles de la orden a clonar
                $orderP= PurchaseOrderDetail::getPurchaseOrder($request->id_old);
                for ($i = 0; $i < count($orderd); $i++) {
                    //Se guardar todas las nuevas compras con tados de la nueva orden
                    PurchaseOrderDetail::create([
                        'nit' => $orderP[$i]->nit,
                        'id_order_detail' => $orderd[$i]->id_order_detail,
                        'amount' => $orderP[$i]->amount,
                    ]);
                }

                //Registar el estado de compra en el historial
                $h3=new HistoryOrder();
                $h3->id_order=$id;
                $h3->id_order_status=4;
                $h3->observation='Compra';
                $h3->status=1;
                $h3->save();

                DB::commit();
                return response()->json(['success' => 'PEDIDO #'.$id.' CREADO CON EXITO HASTA COMPRA!']);
            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json(['warning' => $ex->getMessage()]);
            }
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
        $order->address_invoice = $request->address_invoice;
        $order->type_invoice = $request->type_invoice;

        return $order;

    }

    public function storeOrderDetail($request, $order)
    {
        $products = $request->id_product;
        $amounts = $request->amount;
        $unit_prices = $request->unit_price;
        $percentages = $request->porcentage_id;

        for ($i = 0; $i < count($products); $i++) {
            $order->orderDetails()->create([
                'id_product' => $products[$i],
                'amount' => $amounts[$i],
                'unit_price' => $unit_prices[$i],
                'percentage' => $percentages[$i],
            ]);
        }
    }

    public function storeHystoryOrder($order)
    {
        $order_status = OrderStatus::where('name', 'Pre-Orden')->first();
        $order->orderStatus()->attach($order_status->id_order_status, ['observation' => 'Sin Revisar', 'status' => 1]);

    }

    public function edit($id)
    {
        $order = Order::findById($id)->with('orderDetails.product:id_product,name_product')->first();
        $customers = Customer::all(['nid', 'first_name', 'last_name', 'full_name']);
        $departaments = Departament::with('municipalities')->get();
        $typepayments = TypePayment::all(['id_type_payment', 'type_payment', 'description']);
        $timepayments = TimePayment::all(['id_time_payment', 'time_payment', 'description']);
        $products = Product::with('priceActive:id_price,price,id_product')->get(['id_product', 'name_product', 'price', 'type_price']);
        return view('order.edit-order', compact('order', 'customers', 'departaments', 'typepayments', 'timepayments', 'products'));

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

                DB::beginTransaction();
                try {

                    $order->update();

                    $order->products()->detach();

                    $this->storeOrderDetail($request, $order);

                    DB::commit();

                    return response()->json(['success' => 'PEDIDO ACTUALIZADO CON EXITO!']);

                } catch (\Exception $ex) {
                    DB::rollback();
                    return response()->json(['warning' => 'ERROR AL ACTUALIZAR DATOS']);
                }
            } 

        

    }

    public function approveOrder($id)
    {
        if (request()->ajax()) {

            $order = $this->repository->findByIdWithHistoriesStatus($id);
            $validate = $this->repository->validateApprove($order);

            if ($validate) {
                $exito = $this->repository->changeStatusOrders($order, 'Aprobado');
                if ($exito) {
                    return response()->json(['success' => 'ORDEN APROBADA CON EXITO!', 'status' => 'Aprobado', 'order' => $order->id_order]);
                } else {
                    return response()->json(['warning' => 'OOPS! ERROR DEL SERVIDOR']);
                }
            } else {
                return response()->json(['warning' => 'ESTE PEDIDO YA FUE APROBADA O RECHAZADA']);
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

    

    public function savePurchase(Request $request)
    {

        //return $request;
        $order = $this->repository->findByIdWithHistoriesStatus($request->id_order);
        $validate = $this->repository->validatePurchase($order);

        if ($validate) {
            $exito = $this->repository->savePurchase($order, $request);

            if ($exito) {
                return response()->json(['success' => 'ORDEN DE COMPRA CREADA CON EXITO!', 'order' => $order->id_order, 'status' => 'Compra']);
            } else {
                return response()->json(['warning' => 'ERROR AL GUARDAR DATOS']);
            }
        } else {
            return response()->json(['warning' => 'ESTE PEDIDO YA TIENE ORDEN DE COMPRA!']);
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
            $date1 = $request->date1;
            $date2 = $request->date2;

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
    public function filterAgendados(Request $request)
    {

       
        if($request->ajax()){        
            $placa = $request->placa;           
            $date1 = $request->date1;
            $date2 = $request->date2;           
            $orders=Order::getFilterAgendados($placa, $date1, $date2);          

            if (count($orders) > 0) {
                return response()->view('ajax.table-agendados', compact('orders'));
            } else {
                return response()->json(['warning' => 'NO SE ENCONTRARON DATOS RELACIONADOS CON ESTA BUSQUEDA..']);
            }
        }else {
            return 'No Recibido';
        }

    }

    public function filterQuotation(Request $request)
    {

       
        if($request->ajax()){                   
            $date1 = $request->date1;
            $date2 = $request->date2;           

            if (empty($date1) && empty($date2)) {
                return response()->json(['warning' => 'DEBES ESCOGER UN RANGO DE FECHAS']);
            }

            if(auth()->user()->hasRole('cliente')==1){
            $orders=Order::CotizacionClienteFecha(auth()->user()->usable_id, $date1, $date2)->get();

            }
            $orders=Order::CotizacionAll($date1, $date2)->get();
            if (count($orders) > 0) {
                return response()->view('ajax.table-quotations', compact('orders'));
            } else {
                return response()->json(['warning' => 'NO SE ENCONTRARON DATOS RELACIONADOS CON ESTA BUSQUEDA..']);
            }
        }else {
            return response()->json(['warning' => 'DATOS NO RECIBIDOS']);

            
        }

    }

    public function getReporteOrders(){

        return view('order.reporte');
       
    }

    public function getAgendados(){

        
        if(auth()->user()->hasRole('conductor')){
            $nid=auth()->user()->usable_id;
            $orders=Order::getAgendados($nid);
            $vehicles=DriverVehicle::where('nid_driver', $nid)->orderBy('id_driver_vehicle', 'desc')->get();
        }else {
            $orders=Order::getAgendados('');
            $vehicles=DriverVehicle::DriverVehicle();
        }
        return view('order.agendados', compact('orders', 'vehicles'));
       
    }

    public function getFacturados()
    {
        
        if(auth()->user()->hasRole('regular') || auth()->user()->hasRole('super-admin')){
           
            $orders=Order::StatusCotizacion(9)->get();
            
            return view('order.facturar', compact('orders'));
        }
       
       
    }

    public function getPrintOrders(Request $request)
    {
            
            $priority = $request->filter_priority;
            $status = $request->filter_status;
            $date1 = $request->date1;
            $date2 = $request->date2;
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

    public function saveEntregas(Request $request){
       
        DB::beginTransaction();
        try {
        if($request->status==3){
            $order= new OrderDelivery();
            $order->id_order=$request->id_order;
            $order->status=$request->status;
            $order->date=$request->date;
            $order->hour=$request->hour;
            $order->weight=$request->weight;
            $order->observation=$request->observation;
            $order->save();
    
            $history = HistoryOrder::where('id_order',$request->id_order)
            ->where('id_order_status', 8)->update(['status' => 0])  ;            
            
            $history = new  HistoryOrder(); 
            $history->id_order=$request->id_order;      
            $history->id_order_status=11;
            $history->observation='Proceso de Entrega';
            $history->status=1;
            $history->save();   

            DB::commit();
            return response()->json(['success' => 'INICIO DE ENTREGA REGISTRADO EXITOSAMENTE']);

          

        }else {

            if(empty($request->weight1) && $request->type_inovice==2){
                return response()->json(['warning' => 'CAMPO CANTIDAD/PESO ESTA VACIO']); 
            }
            //OBTENER EL PRODUCTO ID
            $resul=OrderDetail::where('id_order', $request->order_id)
            ->where('id_product', $request->id_product)
            ->first();

            $sum=OrderDelivery::where('id_order', $request->order_id)
            ->where('id_product', $request->id_product)
            ->sum('weight');

            $total=$resul->amount;
            $res=$total-($sum)-$request->weight1;
           

            if($res>=0){
            $order= new OrderDelivery();
            $order->id_order=$request->order_id;
            $order->id_product=$request->id_product;
            $order->placa=$request->placa;
            $order->nid_driver=$request->nid_driver;
            $order->status=$request->status1;
            $order->date=$request->date3;
            $order->weight=$request->weight1;
            $order->hour=$request->hour1;
            $order->ticket=$request->ticket;
            $order->observation=$request->observation1;         

            if($request->status1==2){
                
                $order->save();
                $schedule=OrderSchedule::where('id_order', $request->order_id)->get();
                $history = OrderScheduleDetail::where('id_order_schedule', $schedule[0]->id_order_schedule)
                ->where('placa', $request->placa)->where('nid_driver', $request->nid_driver)->update(['status' => 1])  ;

                $sum=OrderDelivery::where('id_order', $request->order_id)
                ->where('id_product', $request->id_product)
                ->sum('weight');    
                $total=$resul->amount;    
                $res=$total-($sum);
                DB::commit();
               
                return response()->json(['success' => ' SE REGISTRO LA ENTREGADAS '.$sum.' RESTANTES: '.$res. ' TOTAL: '.$total]); 
              


            }else {
                if(empty($request->ticket)){
                    return response()->json(['warning' => 'CAMPO TICKET ESTA VACIO']); 
                }
                $order->save();
                $history = new  HistoryOrder(); 
                $history->id_order=$request->order_id;      
                $history->id_order_status=9;
                $history->observation='Entregado';
                $history->status=1;        
                $history->save();                   
                $schedule=OrderSchedule::where('id_order', $request->order_id)->get();
               

                $update = OrderScheduleDetail::where('id_order_schedule', $schedule[0]->id_order_schedule)
                ->where('placa', $request->placa)->where('nid_driver', $request->nid_driver)->update(['status' => 1])  ;

                    if($request->cerrar==1){
                        $history =  DB::table('order_schedules')->where('id_order',$request->order_id)
                        ->where('status', 1)->update(['status' => 0])  ;

                        $history = HistoryOrder::where('id_order',$request->order_id)
                    ->where('id_order_status', 11)
                    ->orWhere('id_order_status', 14)
                    ->update(['status' => 0])  ;
                    }                 

                    $viajes=OrderDelivery::where('id_order', $request->order_id)
                    ->where('id_product', $request->id_product)                    
                    ->sum('weight');                   

                   
                    $det=OrderDetail::where('id_order', $request->order_id)
                    ->where('id_product', $request->id_product)->get();

                    $flete=($viajes*$det[0]->unit_price)*($det[0]->percentage/100);
                  
                    $load=Load::where('id_order', $request->order_id)
                    ->where('id_product', $request->id_product)
                    ->where('placa', $request->placa)->update(['flete'=>$flete, 'ticket'=>$request->ticket, 'carried'=>$viajes, 'status'=>2]);
                    
                    if($viajes!=$total){
                        return response()->json(['warning' => ' NO SE HA COMPLETADO EL TOTAL SOLICITADO']); 
                    }
                    DB::commit();
                    return response()->json(['success' => ' ENTREGA REGISTRADA EXITOSAMENTE']); 
                   
              
            }
    
            
         } else {
            return response()->json(['warning' => ' NO SE PUEDE SOPREPASAR EL TOTAL SOLICITADO']); 
          }                
               
        }         

        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['warning' => $ex->getMessage()]);

        }
    }

    public function saveInvoice(Request $request){
        
        $fecha = Carbon::now()->format('Y-m-d');
        if($request->date < $fecha){
            return response()->json(['warning' => 'La Fecha No Puede ser Menor a la Fecha Actual']);    
        }
        DB::beginTransaction();
        try {
        $order= new OrderInvoice();
        $order->id_order=$request->id_order;
        $order->id_admin=$request->id_admin;
        $order->type=$request->type;
        $order->total=$request->total;
        $order->descuento=$request->discount;
        $order->valor=$request->total_fact;
        $order->date=$request->date;     
        $order->observation=$request->observation;
        $order->save();

        $history = HistoryOrder::where('id_order',$request->id_order)
        ->where('id_order_status', 9)->update(['status' => 0])  ;
          
        
        $history = new  HistoryOrder(); 
        $history->id_order=$request->id_order;      
        $history->id_order_status=10;
        $history->observation='Facturado';
        $history->status=1;
        $history->save();   
       
        DB::commit();
        return response()->json(['success' => 'PEDIDO N°'.$request->id_order.' FACTURADO CON EXITO']);                   

        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['warning' => $ex->getMessage()]);      
        }
    }

    public function getOrderDriver(Request $request)

    {                 
            $nid =$request->nid_driver;;          
            $date1 = $request->date1;  
            $date2 = $request->date2;  
            $fecha = Carbon::now()->format('d-m-Y');
            
            if(!empty($nid) && !empty($date1) && !empty($date2)){

            
            $orders = OrderScheduleDetail::Entregados($nid, $date1, $date2);
           
            
            
            if (count($orders) > 0) {                
                $pdf = PDF::loadView('reportes.orders_drivers', compact('orders', 'fecha', 'driver'));
               
                return $pdf->stream('Listado Ordenenes Entregadas POr Conductores.pdf');              
            } else {
                
                return response()->json(['warning' => 'NO SE ENCONTRARON DATOS RELACIONADOS CON ESTA BUSQUEDA..']);
            }  
        }else {
            return response()->json(['warning' => 'DEBE SELECCIONAR LOS CAMPOS EN EL FORMULARIO']);
        }   

    }


    public function getOrder($id)
    {
    
       $order = $this->repository->findByIdWithDetails($id);    
        $direccionF=Order::find($id)->address_invoice;
        $histories=HistoryOrder::where('id_order', $id)->get();
        $entregas=DB::select("SELECT osd.placa, CONCAT(d.first_name,' ',d.last_name) AS conductor, deo.date, deo.hour  FROM order_schedules os
        INNER JOIN order_schedule_details osd ON os.id_order_schedule=osd.id_order_schedule
        INNER JOIN drivers d ON d.nid_driver=osd.nid_driver
        INNER JOIN deliveries_orders deo ON deo.id_order=os.id_order
        WHERE deo.`status`<=3 and os.id_order=?", [$id]);
        $fecha = Carbon::now()->format('d-m-Y');
        $factura=OrderInvoice::where('id_order', $id)->get();
        
        $pdf = PDF::loadView('reportes.order', compact('order', 'fecha', 'histories', 'direccionF', 'entregas', 'factura'));
        return $pdf->stream('Listado de Pedidos.pdf');      
    
    }

    public function reversar(Request $request)
    {
    
        $id_order=$request->id_order;
        $status=$request->status;
       

        $ho=HistoryOrder::where('id_order', $id_order)->where('status', 1)->get();
        $idstatus=OrderStatus::where('name', $ho->id_order_status)->get();
        if($status=='Pre-Orden'){
        
           
        }


         
    
    }

    

    public function editSchedule($id){
      
        $schedule=OrderSchedule::where('id_order',$id)->get();
       
        $vehicles = $this->repository->getVehiclesActiveWithDriver();
        $details=OrderScheduleDetail::where('id_order_schedule', $schedule[0]->id_order_schedule)->get();
       
        return view('order.edit-schedule', compact('schedule', 'vehicles', 'details'));
    }

    public function updateSchedule(Request $request){
      
        
            $drivers=$request->driver;
            $id_details=$request->id_order_schedule_details;

           
        
            DB::beginTransaction();
            try {
            $exito = OrderSchedule::where('id_order',$request->id_order)
                ->update(['date_departure' => $request->date_departure, 'time_departure'=>$request->time_departure])  ;
    
            for($i=0; $i<count($drivers); $i++){
                if($drivers[$i]==0){
               
                }else {
                    $partes = explode("-", $drivers[$i]);
                    $placa=$partes[0];
                    $nid_driver=$partes[1];
                    $detail=OrderScheduleDetail::find($id_details[$i]);
                    $detail->placa=$placa;
                    $detail->nid_driver=$nid_driver;
                    $detail->save();
                }

            }
              
            
            
            DB::commit();
            return redirect()->route('orders.index')->with('success', 'CAMBIO DE FECHA DE ENTREGA REALIZADA EXITOSAMENTE');
    
            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json(['warning' => $ex->getMessage()]);    
                return redirect()->route('orders.index')->with('warning', 'ERROR AL ACTULIZAR CAMBIO DE FECHA DE ENTREGA EXITOSAMENTE');  
            }     
      

    }

    public function getOrderTotal($id){
        
        $total=DB::select("SELECT o.id_order, o.discount AS descuento,  SUM((od.unit_price * od.amount)) AS total FROM orders o
        INNER JOIN order_details od ON o.id_order=od.id_order
        WHERE o.id_order=?", [$id]);

        $peso=OrderDelivery::where('id_order', $id)
        ->where('status', '1')
        ->get();
        return response()->view('ajax.invoice', compact('total', 'peso'));

      
    }



}
