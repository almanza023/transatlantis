<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\Driver;
use App\Models\DriverVehicle;
use App\Models\HistoryVehicle;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverVehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vehicles = DriverVehicle::orderBy('created_at', 'desc')->get();

        return view('driver_vehicle.index', compact('vehicles'));
    }


    public function create()
    {
        $vehicles=HistoryVehicle::where('id_vehicle_status', 1)->where('status', 1)->get();
        $drivers=Driver::orderBy('created_at', 'desc')->get();
        $fecha=Carbon::now();
        return view('driver_vehicle.create', compact('vehicles', 'drivers', 'fecha'));
    }

    public function store(VehicleRequest $request)
    {
        $nid_driver = $request->nid_driver;

        if ($this->validatePrimary($nid_driver)) {
            return redirect()->route('driver_vehicle.create')->with('warning', 'EL CONDUCOTR : ' . $nid_driver . ' YA TIENE VEHICULO ASIGNADO')->withInput(
                $request->except('nid_driver')
            );
        }
        
        DB::beginTransaction();
        try {
        $obj= new DriverVehicle();
        $obj->placa=$request->placa;
        $obj->nid_driver=$request->nid_driver;
        $obj->date_assigment=$request->date_assigment;        
        $obj->status=1;        
        $obj->save();

        $updated = DB::table('history_vehicles')
        ->where('id_vehicle_status', 1)
        ->where('status', 1)
        ->where('placa', $request->placa)
        ->update(['status'=>0]);

        $vob=new HistoryVehicle();
        $vob->placa=$request->placa;
        $vob->id_vehicle_status=4;
        $vob->status=1;
        $vob->observation='Vehiculo Asignado';
        $vob->save();


        DB::commit();
        return redirect()->route('driver_vehicle.index')->with('success', 'VEHICULO ' . $request->placa.' ASIGNADO CON EXITO AL CONDUCTOR ', $request->$nid_driver);
       
    } catch (\Exception $ex) {
        DB::rollback();
        return response()->json(['warning' => 'ERROR AL GUARDAR DATOS']);
    }

        

    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicle.edit', compact('vehicle'));
    }

    public function update(VehicleRequest $request, $id)
    {

        $obj = Vehicle::findOrFail($id);
        $obj->placa=$request->placa;
        $obj->model=$request->model;
        $obj->type_vehicle=$request->type_vehicle;
        $obj->brand=$request->brand;
        $obj->volume=$request->volume;
        $obj->capacity=$request->capacity;
        $obj->save();


        $obj->update();

        return redirect()->route('vehicle.index')->with('success', 'VEHICULO: ' . $obj->placa . ' ACTUALIZADO CON EXITO!');
    }

    public function validatePrimary($id)
    {
        $driver = DriverVehicle::where('nid_driver', $id)->where('status', 1)->count();
        if ($driver>0) {
            return true;
        } else {
            return false;
        }
    }

    

}

