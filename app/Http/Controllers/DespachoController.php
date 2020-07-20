<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderSchedule;
use App\Models\Vehicle;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;

class DespachoController extends Controller
{
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }

    public function index()
    {

        $orders = DB::select("SELECT os.id_order, CONCAT(d.first_name,' ',d.last_name) AS conductor, osd.placa, os.date_departure from order_schedule_details osd 
        INNER JOIN order_schedules os ON os.id_order_schedule=osd.id_order_schedule
        INNER JOIN drivers d ON d.nid_driver=osd.nid_driver
        INNER JOIN history_orders ho ON ho.id_order=os.id_order
        WHERE ho.id_order_status=8 AND ho.`status`=1
         ");
        return view('schedule.index', compact('orders'));

    }

    public function create($id) 
    {
        if (request()->ajax()) {

            $order = $this->repository->findByIdWithCountSchedule($id);
            $products=OrderDetail::getProductsOrder($id);
            $vehicles = Vehicle::getVehicles();
            
            return response()->view('ajax.create-schedule', compact('order', 'products', 'vehicles'));
        }
    }

    public function edit($id)
    {
        $schedule = OrderSchedule::where('id_order_schedule', $id)->with('orderScheduleDetails')->first();
        $vehicles = Vehicle::all('placa', 'brand');
        $municipalities = Municipality::all('id_municipality', 'name_municipality');
        return view('despacho.edit', compact('schedule', 'vehicles', 'municipalities'));

    }

    public function update(Request $request, $id)
    {
        $schedule = OrderSchedule::find($id);
        $schedule->description = $request->description;
        $schedule->date_departure = $request->date_departure;
        $schedule->time_departure = $request->time_departure;
        DB::beginTransaction();
        try {

            $schedule->update();
            $vehicles = $request->placa;
            $origins = $request->id_municipality_origin;
            $destinations = $request->id_municipality_destination;
            $address = $request->address_destination;
            $descriptions = $request->description_carga;
            $returns = $request->time_return;
            $stimateds = $request->time_stimated;
            $schedule->vehicles()->detach();

            for ($i = 0; $i < count($vehicles); $i++) {
                $schedule->orderScheduleDetails()->create([
                    'placa' => $vehicles[$i],
                    'id_municipality_origin' => $origins[$i],
                    'id_municipality_destination' => $destinations[$i],
                    'address_destination' => $address[$i],
                    'description_carga' => $descriptions[$i],
                    'time_return' => $returns[$i],
                    'time_stimated' => $stimateds[$i],
                    'status' => 2,
                ]);
            }

            DB::commit();

            return response()->json(['success' => 'AGENDA DE ORDEN ACTUALIZADA CON EXITO!']);

        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['warning' => 'ERROR AL GUARDAR DATOS']);
        }

    }

    public function reporte($id)
    {
        $order = OrderSchedule::findById($id)->with('vehicles.currentDriver', 'order.orderDetails.providers')->first();
        $date = Carbon::now();
        $order->fecha = $date->format('d-m-Y H:i:s');
        $pdf = PDF::loadView('reportes.schedule', compact('order'));
        return $pdf->download('orden_agenda.pdf');
    }

}
