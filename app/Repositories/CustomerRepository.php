<?php

namespace App\Repositories;

use App\Models\Customer;
use App\User;
use App\Models\CustomerDomicile;
use App\Models\Departament;
use App\Models\Domicile;
use App\Models\Municipality;
use App\Models\TypeCustomer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerRepository
{

    public function getCustomers()
    {
        return Customer::latest()->get(['nid', 'full_name', 'first_name', 'last_name', 'email']);
    }

    public function getDepartaments()
    {
        return Departament::all(['id_departament', 'name_departament']);
    }

    public function getMunicipalities()
    {
        return Municipality::all(['id_municipality', 'name_municipality', 'id_departament']);
    }

    public function getTypeCustomers()
    {
        return TypeCustomer::all(['id_type_customer', 'type_customer', 'description']);
    }

    public function saveCustomer($request)
    {

        $customer = new Customer;

        $customer = $this->objectCustomer($request, $customer);

        DB::beginTransaction();
        try {

            $customer->save();
            $domicile = new Domicile;
            $domicile = $this->objectDomicile($request, $domicile);
            $domicile->save();

            $this->objectCustomerDomicile($customer, $domicile);

            $user=$this->objectUser($customer);
            $user->assignRoles('cliente');
            DB::commit();

            return true;

        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex);
            return false;
        }
    }

    public function objectCustomer($request, $customer)
    {

        $customer->nid = $request->nid;
        $customer->id_type_customer = $request->id_type_customer;
        $customer->full_name = $request->full_name;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
     

        return $customer;
    }

    public function objectUser($customer)
    {
        $user= new User();
        $user->email=$customer->email;
        $user->type_user=4;
        $user->password= Hash::make('secret');
        $user->user_status=1;
        $user->usable_type='App\Models\Customer';
        $user->usable_id=$customer->nid;
        $user->save();    

        return $user;
    }

    public function objectDomicile($request, $domicile)
    {

        $domicile->id_municipality = $request->id_municipality;
        $domicile->address = $request->address;
        $domicile->additional = $request->additional;
        $domicile->contact_number = $request->contact_number;

        return $domicile;
    }

    public function objectCustomerDomicile($customer, $domicile)
    {
        $customer_domicile = CustomerDomicile::create([
            'id_domicile' => $domicile->id_domicile,
            'nid' => $customer->nid,
            'priority' => 1,
        ]);

        return $customer_domicile;
    }

    public function findCustomerWithDomicile($id)
    {
        return Customer::where('nid', $id)->with('domicileCurrent.municipality.departament')->first();
    }

    public function getMunicipalitiesById($id)
    {
        return Municipality::where('id_departament', $id)->get(['id_municipality', 'name_municipality', 'id_departament']);
    }

    public function updateCustomer($request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer = $this->objectCustomer($request, $customer);

        $domicile = Domicile::findOrfail($request->id_domicile);
        $domicile = $this->objectDomicile($request, $domicile);

        DB::beginTransaction();
        try {

            $customer->update();
            $domicile->update();

            DB::commit();

            return true;

        } catch (\Exception $ex) {
            DB::rollback();
            return false;
        }
    }

}
