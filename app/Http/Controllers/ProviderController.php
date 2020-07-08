<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use App\Http\Requests\ProviderUpdateRequest;
use App\Models\Municipality;
use App\Models\Provider;
use App\Models\TypeProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $providers = Provider::with('typeProvider')
            ->orderBy('provider_status', 'DESC')
            ->get(['nit', 'id_type_provider', 'full_name', 'first_name', 'last_name', 'provider_status']);

        return view('provider.index', compact('providers'));
    }

    public function show($id)
    {
        if (request()->ajax()) {
            $provider = Provider::with('municipality.departament', 'typeProvider:id_type_provider,type_provider')
            ->where('nit', $id)
            ->first();
            return response()->view('ajax.provider_detail', compact('provider'));
        } else {
            abort(401, 'Acceso Ilegal');
        }
    }

    public function create()
    {
        $typeproviders = TypeProvider::all();
        $municipalities = Municipality::with('departament')->get();
        return view('provider.create', compact('typeproviders', 'municipalities'));
    }

    public function store(ProviderRequest $request)
    {
        $nit = $request->nit;

        if ($this->validatePrimary($nit)) {
            return redirect()->route('provider.create')->with('warning', 'El NUMERO NIT: ' . $nit . ', YA EXISTE')->withInput(
                $request->except('nit')
            );
        }
        DB::beginTransaction();
        try {

        $provider = new Provider;
        $provider->nit = $nit;
        $provider->id_type_provider = $request->id_type_provider;
        $provider->id_municipality = $request->id_municipality;
        $provider->full_name = $request->full_name;
        $provider->first_name = $request->first_name;
        $provider->last_name = $request->last_name;
        $provider->address = $request->address;
        $provider->email = $request->email;
        $provider->contact_number = $request->contact_number;
        $provider->provider_status = 1;

        $provider->save();

        $user= new User();
        $user->email=$provider->email;
        $user->type_user=5;
        $user->password= Hash::make('secret');
        $user->user_status=1;
        $user->usable_type='App\Models\Provider';
        $user->usable_id=$provider->nit;
        $user->save();    

        $user->assignRoles('proveedor');
        DB::commit();

        if($provider){
            return response()->json(['success' => 'PROVEEDOR: ' . $provider->full_name . ' CREADO CON EXITO!']);
          }
        return response()->json(['warning' => 'ERROR AL REGISTRAR DATOS']);

        }catch (\Exception $ex) {
            DB::rollback();
            dd($ex);
            return false;
        }


    }

    public function edit($id)
    {
        $provider = Provider::findOrFail($id);
        $typeproviders = TypeProvider::all();
        $municipalities = Municipality::with('departament')->get();
        return view('provider.edit', compact('provider', 'typeproviders', 'municipalities'));
    }

    public function update(ProviderUpdateRequest $request, $id)
    {

        $provider = Provider::findOrFail($id);
        $provider->id_type_provider = $request->id_type_provider;
        $provider->id_municipality = $request->id_municipality;
        $provider->full_name = $request->full_name;
        $provider->first_name = $request->first_name;
        $provider->last_name = $request->last_name;
        $provider->address = $request->address;
        $provider->email = $request->email;
        $provider->contact_number = $request->contact_number;

        $provider->update();

        if($provider){
            return response()->json(['success' => 'PROVEEDOR: ' . $provider->full_name . ' ACTUALIZADO CON EXITO!']);
          }
        return response()->json(['warning' => 'ERROR AL ACTUALIZAR DATOS']);
    }

    public function validatePrimary($id)
    {
        $provider = Provider::find($id);
        if ($provider) {
            return true;
        } else {
            return false;
        }
    }

    public function changeStatus($id)
    {
        $provider = Provider::findOrFail($id);
        if ($provider->provider_status) {
            $provider->update(['provider_status' => 0]);
        } else {
            $provider->update(['provider_status' => 1]);
        }
        return redirect()->route('provider.index')->with('success', 'ESTADO PROVEEDOR: ' . $provider->name_complete . ' ACTUALIZADO CON EXITO!');
    }

    public function getPedidos(Request $request){
        
    }

    public function getProductos()
    {
        $nit=auth()->user()->usable_id;
        $products=Provider::getProductos($nit);
        return view('provider.consultar', compact('products'));
    }

}
