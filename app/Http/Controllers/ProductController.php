<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Price;
use App\Models\Product;
use App\Models\TypeUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::with('typeUnit:id_type_unit,type_unit', 'category:id_category,name_category', 'priceActive:id_price,price,id_product')
            ->orderBy('product_status', 'DESC')
            ->get(['id_product', 'id_type_unit', 'id_category', 'name_product', 'type_price', 'price', 'weight', 'volume', 'product_status']);
        return view('product.index', compact('products'));
    }

    public function show($id)
    {
        if (request()->ajax()) {
            $product = Product::with('typeUnit:id_type_unit,type_unit', 'category:id_category,name_category', 'prices', 'priceActive:id_price,price,id_product')
                ->where('id_product', $id)
                ->first();
            return response()->view('ajax.product_detail', compact('product'));
        } else {
            abort(401, 'Acceso Ilegal');
        }
    }

    public function create()
    {
        $categories = Category::all(['id_category', 'name_category', 'description']);
        $typeunits = TypeUnit::all(['id_type_unit', 'type_unit', 'description']);
        return view('product.create', compact('categories', 'typeunits'));
    }

    public function store(ProductRequest $request)
    {
        $type_price = $request->type_price;
        $price = $request->price;
        $product = new Product;

        $product->id_type_unit = $request->id_type_unit;
        $product->id_category = $request->id_category;
        $product->name_product = $request->name_product;
        $product->description = $request->description;
        $product->type_price = $type_price;
        $product->weight = $request->weight;
        $product->volume = $request->volume;
        $product->product_status = 1;

        if ($type_price == 2) {
            $product->price = $price;
            $product->save();
        } else {
            $this->initStorePrice($request, $product, $price);
        }

        if($product){
            return response()->json(['success' => 'PRODUCTO '.$product->name_product.' CREADO CON EXITO']);
        }
        return response()->json(['warning' => 'ERROR AL REGISTRAR DATOS']);

    }

    public function initStorePrice($request, $product, $price)
    {
        DB::beginTransaction();
        try {
            $prices = new Price;
            $prices->effective_date = $request->effective_date;
            $prices->price = $price;
            $prices->price_status = 1;
            $product->save();
            $product->prices()->save($prices);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('product.create')->with('warning', 'OCURRIO UN ERROR CON EL SERVIDOR POR FAVOR INTENTE NUEVAMENTE!');
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $price=Price::where('id_product', $id)->first();
        $categories = Category::all(['id_category', 'name_category', 'description']);
        $typeunits = TypeUnit::all(['id_type_unit', 'type_unit', 'description']);
        return view('product.edit', compact('product', 'categories', 'typeunits', 'price'));
    }

    public function update(ProductRequest $request, $id)
    {
        $type_price = $request->type_price;
        $price = $request->price;

        $product  = Product::findOrFail($id);
        $product->id_type_unit = $request->id_type_unit;
        $product->id_category = $request->id_category;
        $product->name_product = $request->name_product;
        $product->description = $request->description;
        $product->type_price = $type_price;
        $product->weight = $request->weight;
        $product->volume = $request->volume;

        $this->initUpdatePrice($product, $type_price, $price);

        if($product){
            return response()->json(['success' => 'PRODUCTO '.$product->name_product.' ACTUALIZADO CON EXITO']);
        }
        return response()->json(['warning' => 'ERROR AL ACTUALIZAR DATOS']);
    }

    public function initUpdatePrice($product, $type_price, $price)
    {
        DB::beginTransaction();
        try {
            if ($type_price == 2) {
                $product->price = $price;
                $product->update();
                //$product->priceActive()->first()->update(['price_status' => 0]);
                DB::commit();
            } else {
                $product->update();
                $product->priceActive()->first()->update(['price' => $price]);
                DB::commit();
            }
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('product.index')->with('warning', 'OCURRIO UN ERROR CON EL SERVIDOR POR FAVOR INTENTE NUEVAMENTE!');
        }
    }



    public function changeStatus($id)
    {
        $product = Product::findOrFail($id);
        if ($product->product_status) {
            $product->update(['product_status' => 0]);
        } else {
            $product->update(['product_status' => 1]);
        }
        return redirect()->route('product.index')->with('success', 'ESTADO PRODUCTO: ' . $product->name_product . ' ACTUALIZADO CON EXITO!');
    }
}
