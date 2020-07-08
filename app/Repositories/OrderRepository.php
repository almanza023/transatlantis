<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Departament;
use App\Models\Municipality;
use App\Models\Order;
use App\Models\OrderSchedule;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Provider;
use App\Models\PurchaseOrderDetail;
use App\Models\TimePayment;
use App\Models\TypeCustomer;
use App\Models\TypePayment;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class OrderRepository
{

    public function getOrders()
    {
        return Order::Status('')->get();
    }

    public function getCotizacionesClientes($nid)
    {
        return Order::CotizacionCliente($nid)->get();
    }

    public function getQuations()
    {
        return Order::StatusCotizacion(2)->get();
    }


    public function getProviders()
    {
        return Provider::active()->get(['nit', 'first_name', 'last_name', 'full_name']);
    }

    public function getCustomers()
    {
        return Customer::all(['nid', 'first_name', 'last_name', 'full_name']);
    }

    public function getTypeCustomers()
    {
        return TypeCustomer::all(['id_type_customer', 'type_customer', 'description']);
    }

    public function getDepartaments()
    {
        return Departament::all(['id_departament', 'name_departament']);
    }

    public function getMunicipalities()
    {
        return Municipality::all(['id_municipality', 'name_municipality', 'id_departament']);
    }

    public function getTypePayments()
    {
        return TypePayment::all(['id_type_payment', 'type_payment', 'description']);
    }
    
    public function getTimesPayments()
    {
        return TimePayment::all(['id_time_payment', 'time_payment', 'description']);
    }

    public function getProducts()
    {
        return Product::with('priceActive:id_price,price,id_product')->get(['id_product', 'name_product', 'price', 'type_price', 'id_type_unit']);
    }

    public function getVehiclesActiveWithDriver()
    {
        return DB::select('SELECT d.first_name, d.last_name, d.nid_driver, v.placa, v.capacity, v.volume, d.first_name, d.last_name  FROM driver_vehicle dv 
        INNER JOIN drivers d ON d.nid_driver=dv.nid_driver
        INNER JOIN vehicles v on v.placa=dv.placa');
        
    }

    public function findByIdWithDetails($id)
    {
        return Order::findById($id)->with('orderDetails.product:id_product,name_product,id_type_unit', 'orderDetails.product.typeUnit')->first();
    }

    public function findWithDetails($id)
    {
        return Order::where('id_order', $id)->with('orderDetails.product:id_product,name_product,id_type_unit', 'orderDetails.product.typeUnit')->first(['id_order']);
    }

    public function findByIdWithHistoriesStatus($id)
    {
        return Order::where('id_order', $id)->with('historyOrders.orderStatus')->first(['id_order']);
    }

    public function findWithProviders($id)
    {
        return Order::where('id_order', $id)
            ->with(
                'orderDetails.product:id_product,name_product,id_type_unit',
                'orderDetails.product.typeUnit',
                'orderDetails.providers.municipality.departament')
            ->first(['id_order']);
    }

    public function findByIdWithCountSchedule($id)
    {
        return Order::findById($id)
            ->with('orderDetails.product')
            ->withCount('orderSchedules')
            ->first();
    }

    public function findById($id)
    {
        return Order::findOrFail($id);
    }

    public function filterOrders($priority, $status, $date, $date2)
    {

        $orders = "";

        if ($priority and !$status and !$date) {
            $orders = Order::status('')->priority($priority)->get();
        }

        if (!$priority and $status and !$date) {
            $orders = Order::statusSpecific($status)->get();
        }

        if (!$priority and !$status and $date) {
            $orders = Order::status('')->DateOrder($date, $date2)->get();
        }

        if ($priority and $status and !$date) {
            $orders = Order::statusSpecific($status)->priority($priority)->get();
        }

        if ($priority and !$status and $date and $date2) {
            $orders = Order::status('')->priority($priority)->DateOrder($date, $date2)->get();
        }

        if (!$priority and $status and $date and $date2) {
            $orders = Order::statusSpecific($status)->DateOrder($date, $date2)->get();
        }

        if ($priority and $status and $date and $date2) {
            $orders = Order::statusSpecific($status)->priority($priority)->DateOrder($date, $date2)->get();
        }

        return $orders;

    }

    public function validateFilters($priority, $status, $date, $date2)
    {
        if (!$priority and !$status and !$date and !$date2) {
            return false;
        }
        return true;
    }

    public function validateStatus($histories, $status)
    {
        foreach ($histories as $history) {
            if ($history->orderStatus->name == $status) {
                return true;
            }
        }
        return false;
    }

    public function changeStatusOrders($order, $status)
    {
        DB::beginTransaction();
        try {
            $this->updateStatusOrder($order, $status);
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollback();
            return false;
        }

    }

    public function validateApprove($order)
    {
        return (!$this->validateStatus($order->historyOrders, 'Aprobado') and !$this->validateStatus($order->historyOrders, 'Rechazado')) ? true : false;
    }

    public function validatePurchase($order)
    {
        return ($this->validateStatus($order->historyOrders, 'Aprobado') and !$this->validateStatus($order->historyOrders, 'Compra')) ? true : false;
    }

    public function validateSchedule($order)
    {
        return ($this->validateStatus($order->historyOrders, 'Aprobado') and $this->validateStatus($order->historyOrders, 'Compra')) ? true : false;
    }

    public function updateStatusOrder($order, $status)
    {
        foreach ($order->historyOrders as $history) {
            $order->orderStatus()->updateExistingPivot($history->id_order_status, ['status' => 0]);
        }

        $order_status = OrderStatus::where('name', $status)->first();
        $order->orderStatus()->attach($order_status->id_order_status, ['observation' => $status, 'status' => 1]);
    }

    public function saveDiscount($request)
    {
        $order = $this->findById($request->id_order);
        $order->discount = $request->discount;

        return $order->save();
    }

    public function savePurchase($order, $request)
    {

        DB::beginTransaction();
        try {

            $this->storePurchase($request);
            $this->updateStatusOrder($order, 'Compra');

            DB::commit();

            return true;

        } catch (\Exception $ex) {
            DB::rollback();
            return false;
        }

    }

    public function saveSchedule($order, $request)
    {

        $schedule = new OrderSchedule;

        $schedule = $this->createObjectSchedule($request, $schedule);

        DB::beginTransaction();
        try {

            $schedule->save();

            $this->storeScheduleDetails($request, $schedule);

            $this->updateStatusOrder($order, 'Agendado');

            DB::commit();

            return true;

        } catch (\Exception $ex) {
            DB::rollback();
            return false;
        }

    }

    public function storePurchase($request)
    {
        $order_details = $request->id_order_detail;

        $nits = $request->nit;
        $amounts = $request->amount;

        for ($i = 0; $i < count($order_details); $i++) {
            PurchaseOrderDetail::create([
                'nit' => $nits[$i],
                'id_order_detail' => $order_details[$i],
                'amount' => $amounts[$i],
            ]);
        }

    }

    public function createObjectSchedule($request, $schedule)
    {
        $schedule->id_order = $request->id_order;
        $schedule->description = $request->description_schedule;
        $schedule->date_departure = $request->date_departure;
        $schedule->time_departure = $request->time_departure;
        $schedule->status = 1;

        return $schedule;

    }

    public function storeScheduleDetails($request, $schedule)
    {

        $vehicles = $request->placa;
        $descriptions = $request->description;
        $stimateds = $request->time;
        $viajes = $request->viaje;

        for ($i = 0; $i < count($vehicles); $i++) {
            $parte = explode("-", $vehicles[$i]);
            $schedule->orderScheduleDetails()->create([
                'placa' => $parte[0],
                'nid_driver' => $parte[1],
                'description_carga' => $descriptions[$i],
                'time_stimated' => $stimateds[$i],
                'nro_viaje' => $viajes[$i],
                'status' => 2,
            ]);
        }

    }

    public function purchaseOrder($id){
        
    }

    public function getCustomer($id){
        
        $customer=DB::select("SELECT DISTINCT  CONCAT(c.first_name,' ',c.last_name) AS cliente, c.nid, d.address, CONCAT(m.name_municipality,' ',de.name_departament) AS municipio 
        FROM orders o
        INNER JOIN customer_domicile cd ON o.id_customer_domicile=cd.id_customer_domicile
        INNER JOIN customers c ON c.nid=cd.nid
        
        INNER JOIN domiciles d ON d.id_domicile=cd.id_domicile
        INNER JOIN municipalities m ON d.id_municipality=m.id_municipality
        INNER JOIN departaments de ON de.id_departament=m.id_departament
        where o.id_order=?
        ", [$id]);
        return $customer;
    }

    public function getVehiclesAgendados(){
        return DB::select("SELECT CONCAT(d.first_name,' ',d.last_name) AS conductor, osd.placa, os.date_departure, os.time_departure   FROM order_schedules os
        INNER JOIN order_schedule_details osd ON os.id_order_schedule=osd.id_order_schedule_details
        INNER JOIN drivers d ON d.nid_driver=osd.nid_driver
        INNER JOIN history_orders ho ON ho.id_order=os.id_order
        WHERE ho.id_order_status=8 AND ho.`status`=1");
    }


}
