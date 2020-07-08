<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $customers = $this->repository->getCustomers();
        $departaments = $this->repository->getDepartaments();
        $municipalities = $this->repository->getMunicipalities();
        $typecustomers = $this->repository->getTypeCustomers();

        if (request()->ajax()) {
            $dependencias = $this->repository->getCustomers();
            return response()->view('ajax.table-customers', compact('customers'));
        }

        return view('customer.index', compact('customers', 'departaments', 'municipalities', 'typecustomers'));
    }

    public function show($id)
    {
        if (request()->ajax()) {
            $typecustomers = $this->repository->getTypeCustomers();
            $departaments = $this->repository->getDepartaments();
            $customer = $this->repository->findCustomerWithDomicile($id);
            $domicile = $customer->domicileCurrent->first();
            $municipalities = $this->repository->getMunicipalitiesById($domicile->municipality->departament->id_departament);
            return response()->view('ajax.customer_detail', compact('typecustomers', 'departaments', 'customer', 'domicile', 'municipalities'));
        } else {
            abort(401, 'Acceso Ilegal');
        }
    }

    public function edit($id)
    {

        if (request()->ajax()) {
            $typecustomers = $this->repository->getTypeCustomers();
            $departaments = $this->repository->getDepartaments();
            $customer = $this->repository->findCustomerWithDomicile($id);
            $domicile = $customer->domicileCurrent->first();
            $municipalities = $this->repository->getMunicipalitiesById($domicile->municipality->departament->id_departament);
            return response()->view('ajax.edit-customer', compact('typecustomers', 'departaments', 'customer', 'domicile', 'municipalities'));
        }
    }

    public function update(CustomerRequest $request, $id)
    {

        if (request()->ajax()) {

            $exito = $this->repository->updateCustomer($request, $id);

            if ($exito) {
                return response()->json(['success' => 'CLIENTE ACTUALIZADO CON EXITO!']);
            }
            return response()->json(['warning' => 'ERROR AL ACTUALIZAR DATOS']);
        }

        
       
    }

    public function store(CustomerRequest $request)
    {
        if (request()->ajax()) {

            $exito = $this->repository->saveCustomer($request);

            

            if ($exito) {
                return response()->json(['success' => 'CLIENTE ', $request->first_name.' '.$request->last_name,' CREADO CON EXITO!']);
            }
            return response()->json(['warning' => 'ERROR AL GUARDAR DATOS']);
        }
    }

}
