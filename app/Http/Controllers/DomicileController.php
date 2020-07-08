<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomicileRequest;
use App\Models\Customer;
use App\Models\Domicile;
use Illuminate\Support\Facades\DB;

class DomicileController extends Controller
{
    public function saveDomicile(DomicileRequest $request)
    {
        if (request()->ajax()) {
            $domicile = $this->createObjectDomicile($request);

            DB::beginTransaction();
            try {

                $domicile->save();

                $customer = Customer::where('nid', $request->id_customer)->with('customerDomiciles')->first(['nid']);

                $this->updatePivotCustomerDomicile($customer, $domicile);

                $customer_domicile = $customer->domicilecurrent->first()->pivot->id_customer_domicile;

                $info = "{$domicile->address}, {$domicile->additional}, {$domicile->municipality->name_municipality}-{$domicile->municipality->departament->name_departament}";

                DB::commit();

                return response()->json(['success' => 'DOMICILIO CREADO CON EXITO!',
                    'customer' => $customer->nid,
                    'domicile' => $info,
                    'customerdomicile' => $customer_domicile]);

            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json(['warning' => 'ERROR AL GUARDAR DATOS']);
            }
        }

    }

    public function createObjectDomicile($request)
    {
        $domicile = new Domicile();

        $domicile->id_municipality = $request->id_municipality;
        $domicile->address = $request->address;
        $domicile->additional = $request->additional;
        $domicile->contact_number = $request->contact_number;

        return $domicile;
    }

    public function updatePivotCustomerDomicile($customer, $domicile)
    {

        foreach ($customer->customerDomiciles as $history) {
            $customer->domiciles()->updateExistingPivot($history->id_domicile, ['priority' => 0]);
        }

        $customer->domiciles()->attach($domicile->id_domicile, ['priority' => 1]);

    }
}
