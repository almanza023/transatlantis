<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Admin;
use App\Models\TimePayment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = Admin::getAll();
        //return $users;
        return view('users.index', compact('users'));
    }

    public function create()
    {
       
        return view('users.create');
    }

    public function edit($id){
        $user=Admin::getId($id);
        return view('users.edit', compact('user'));
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $admin=new Admin();
            $admin->first_name=$request->first_name;
            $admin->last_name=$request->last_name;
            $admin->document=$request->document;
            $admin->address=$request->address;
            $admin->email=$request->email;
            $admin->contact_number=$request->contact_number;
            $admin->save();

            $user= new User();
            $user->email=$request->email;
            $user->type_user=1;
            $user->password=Hash::make($request->password);;
            $user->user_status=1;
            $user->usable_type='App\Models\Admin';
            $user->usable_id=$admin->id_admin;
            $user->save();

            if($request->rol_id==1){
                $user->assignRoles('super-admin');
            }else{
                $user->assignRoles('regular');
            }

            DB::commit();
            return response()->json(['success' => 'USUARIO '.$admin->first_name.' '.$admin->last_name .' CREADO CON EXITO!']);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['warning' => $ex->getMessage()]);
        }
    }

    public function update(UserUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $admin=Admin::find($id);
            $admin->first_name=$request->first_name;
            $admin->last_name=$request->last_name;
            $admin->document=$request->document;
            $admin->address=$request->address;
            $admin->email=$request->email;
            $admin->contact_number=$request->contact_number;
            $admin->save();

            $user=User::find($request->idusuario);
            $user->email=$request->email;
            if($request->rol_id==1){
            $user->type_user=1;
            }else {
            $user->type_user=2;    
            }
            if(!empty($request->password)){
            $user->password=Hash::make($request->password);
            }
            $user->user_status=1;
            $user->usable_type='App\Models\Admin';
            $user->usable_id=$admin->id_admin;
            $user->save();

            if($request->rol_id==1){
                $user->syncRoles('super-admin');
            }else{
                $user->syncRoles('regular');
            }

            DB::commit();
            return response()->json(['success' => 'USUARIO '.$admin->first_name.' '.$admin->last_name .' ACTUALIZADO CON EXITO!']);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['warning' => $ex->getMessage()]);
        }
    
    }
}
