<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    
    protected $repository;
    public function __construct(OrderRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;       
    }


    public function index()
    {

        
        $providers=Provider::GetCantidades();
        
        $num_pre = DB::table('history_orders')->where('id_order_status', 3)->count();
        $num_com = DB::table('history_orders')->where('id_order_status', 4)->count();
        $num_agen = DB::table('history_orders')->where('id_order_status', 8)->where('status', 1)->count();
        $num_ent = DB::table('history_orders')->where('id_order_status', 9)->where('status', 0)->count();
        $num_cot = DB::table('history_orders')->where('id_order_status', 2)->where('status', 1)->count();
        $num_fact = DB::table('history_orders')->where('id_order_status', 10)->count();

       
        $orders = $this->repository->getOrders();
        $products = Product::with('typeUnit:id_type_unit,type_unit', 'category:id_category,name_category', 'priceActive:id_price,price,id_product')
            ->orderBy('product_status', 'DESC')
            ->get(['id_product', 'id_type_unit', 'id_category', 'name_product', 'type_price', 'price', 'weight', 'volume', 'product_status']);
        return view('home', compact('products', 'orders', 'num_pre', 'num_com', 'num_agen', 'num_ent', 'providers', 'num_cot', 'num_fact'));
        

    
    }

    public function getPerfil($id){
        $type=User::find($id);
        if($type->type_user==1){
            $tipo=1;
            $user = DB::table('admins as a')
            ->join('users as u', 'u.usable_id', '=', 'a.id_admin')
            ->join('role_user as rs', 'rs.user_id', '=', 'u.id')
            ->join('roles as r', 'rs.role_id', '=', 'r.id')
            ->select('u.id','a.first_name', 'a.last_name', 'a.document', 'a.address','u.email', 'r.name')
            
            ->get();
            return response()->view('ajax.perfil', compact('user', 'tipo'));
        }

        if($type->type_user==3){
            $tipo=3;
            $user = DB::table('drivers as a')
            ->join('users as u', 'u.usable_id', '=', 'a.nid_driver')
            ->join('role_user as rs', 'rs.user_id', '=', 'u.id')
            ->join('roles as r', 'rs.role_id', '=', 'r.id')
            ->select('u.id','a.first_name', 'a.last_name', 'a.contact_number', 'a.address','u.email', 'r.name')
            
            ->get();
            return response()->view('ajax.perfil', compact('user', 'tipo'));
        }

        if($type->type_user==4){
            $tipo=4;
            $user = DB::table('customers as a')
            ->join('users as u', 'u.usable_id', '=', 'a.nid')
            ->join('role_user as rs', 'rs.user_id', '=', 'u.id')
            ->join('roles as r', 'rs.role_id', '=', 'r.id')
            ->select('u.id','a.first_name', 'a.last_name', 'u.email', 'r.name')
            
            ->get();
            return response()->view('ajax.perfil', compact('user', 'tipo'));
        }
        if($type->type_user==5){
            $tipo=5;
            $user = DB::table('providers as a')
            ->join('users as u', 'u.usable_id', '=', 'a.nit')
            ->join('role_user as rs', 'rs.user_id', '=', 'u.id')
            ->join('roles as r', 'rs.role_id', '=', 'r.id')
            ->select('u.id','a.first_name', 'a.last_name', 'a.full_name', 'u.email', 'r.name')
            
            ->get();
            return response()->view('ajax.perfil', compact('user', 'tipo'));
        }

    }

    public function updatePassword(Request $request){
        $user=User::find($request->id);
        $user->password=Hash::make($request->password);
        $user->save();
        if($user){
            return redirect()->route('home')->with('success', 'CAMBIO DE CLAVE REALIZADO EXITOSAMENTE');
        }
        return redirect()->route('home')->with('warning', 'ERROR AL CAMBIAR CLAVE');
        

    }
}
