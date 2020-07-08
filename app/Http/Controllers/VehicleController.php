<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\HistoryVehicle;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $vehicles = Vehicle::all();

        return view('vehicle.index', compact('vehicles'));
    }


    public function create()
    {
        return view('vehicle.create');
    }

    public function store(VehicleRequest $request)
    {
        $placa = $request->placa;

        if ($this->validatePrimary($placa)) {
            return redirect()->route('vehicle.create')->with('warning', 'El PLACA: ' . $placa . ', YA EXISTE')->withInput(
                $request->except('placa')
            );
        }
        DB::beginTransaction();
        try {
            $obj= new Vehicle();
            $obj->placa=$request->placa;
            $obj->model=$request->model;
            $obj->type_vehicle=$request->type_vehicle;
            $obj->brand=$request->brand;
            $obj->volume=$request->volume;
            $obj->capacity=$request->capacity;
            $obj->save();
            
            $vob=new HistoryVehicle();
            $vob->placa=$request->placa;
            $vob->id_vehicle_status=1;
            $vob->status=1;
            $vob->observation='Vehiculo Libre';
            $vob->save();

          
            DB::commit();
            return redirect()->route('vehicle.create')->with('success', 'VEHICULO '.$placa.' GUARDADO CON EXITO!');
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
        $obj->update();
        return redirect()->route('vehicle.index')->with('success', 'VEHICULO: ' . $obj->placa . ' ACTUALIZADO CON EXITO!');
    }

    public function validatePrimary($id)
    {
        $driver = Vehicle::find($id);
        if ($driver) {
            return true;
        } else {
            return false;
        }
    }
}
