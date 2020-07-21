<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverRequest;
use App\Http\Requests\DriverUpdateRequest;
use App\Models\Driver;
use App\Models\DriverVehicle;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $drivers = Driver::orderBy('driver_status', 'DESC')
            ->get(['nid_driver', 'first_name', 'last_name', 'address', 'email', 'contact_number', 'contact_number_second', 'driver_status']);

        return view('driver.index', compact('drivers'));
    }

    public function show($id)
    {
        if (request()->ajax()) {
            $driver = Driver::find($id);
            return response()->view('ajax.driver_detail', compact('driver'));
        } else {
            abort(401, 'Acceso Ilegal');
        }
    }

    public function create()
    {
        return view('driver.create');
    }

    public function store(DriverRequest $request)
    {
        $nid_driver = $request->nid_driver;

        if ($this->validatePrimary($nid_driver)) {
            return redirect()->route('driver.create')->with('warning', 'El NUMERO NID: ' . $nid_driver . ', YA EXISTE')->withInput(
                $request->except('nid_driver')
            );
        }

        DB::beginTransaction();
        try {
        $driver = new Driver;
        $driver->nid_driver = $nid_driver;
        $driver->first_name = $request->first_name;
        $driver->last_name = $request->last_name;
        $driver->address = $request->address;
        $driver->email = $request->email;
        $driver->contact_number = $request->contact_number;
        $driver->contact_number_second = $request->contact_number_second;
        $driver->blood_type = $request->blood_type;
        $driver->date_birth = $request->date_birth;
        $driver->medical_observation = $request->medical_observation;
        $driver->place_care = $request->place_care;
        $driver->arl = $request->arl;
        $driver->driver_status = 1;
        $driver->save();
        
        $user= new User();
        $user->email=$driver->email;
        $user->type_user=3;
        $user->password= Hash::make('secret');
        $user->user_status=1;
        $user->usable_type='App\Models\Driver';
        $user->usable_id=$driver->nid_driver;
        $user->save();    

        $user->assignRoles('conductor');
        DB::commit();

        if ($user) {
            return response()->json(['success' => 'CONDUCTOR CREADO CON EXITO!']);
        }
        return response()->json(['warning' => 'ERROR AL GUARDAR DATOS']);
        }catch (\Exception $ex) {
            DB::rollback();
            dd($ex);
            return false;
        }

        
    }

    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('driver.edit', compact('driver'));
    }

    public function update(DriverUpdateRequest $request, $id)
    {

        $driver = Driver::findOrFail($id);

        $driver->first_name = $request->first_name;
        $driver->last_name = $request->last_name;
        $driver->address = $request->address;
        $driver->email = $request->email;
        $driver->contact_number = $request->contact_number;
        $driver->contact_number_second = $request->contact_number_second;
        $driver->blood_type = $request->blood_type;
        $driver->date_birth = $request->date_birth;
        $driver->medical_observation = $request->medical_observation;
        $driver->place_care = $request->place_care;
        $driver->arl = $request->arl;
        $driver->update();
        if($driver){
        return response()->json(['success' => 'CONDUCTOR: ' . $driver->name_complete . ' ACTUALIZADO CON EXITO!']);
       

        }
        return response()->json(['warning' => 'ERROR AL ACTUALIZAR DATOS']);


    }

    public function validatePrimary($id)
    {
        $driver = Driver::find($id);
        if ($driver) {
            return true;
        } else {
            return false;
        }
    }

    public function changeStatus($id)
    {
        $driver = Driver::findOrFail($id);
        if ($driver->driver_status) {
            $driver->update(['driver_status' => 0]);
        } else {
            $driver->update(['driver_status' => 1]);
        }
        return redirect()->route('driver.index')->with('success', 'ESTADO CONDUCTOR: ' . $driver->name_complete . ' ACTUALIZADO CON EXITO!');
    }

    public function viewLiquidacion()
    {
        $drivers=DriverVehicle::DriverVehicle();
        return view('liquidacion.reporte', compact('drivers'));
    }

    public function consutaLiquidacion(Request $request)
    {
        $liquidaciones=DriverVehicle::getLiquidacion($request->nid_driver, $request->date1, $request->date2);
        
        return response()->view('ajax.table-liquidaciones', compact('liquidaciones'));
    }
    
}
