<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::query();

        $keyword = $request->input('keyword');
        $category_id = $request->input('category_id');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');

        if (!empty($keyword)) {
            $products->where(function ($q) use ($keyword) {
                $name = "%{$keyword}%";
                $q->where('name', 'LIKE', $name);
                $q->orWhere('maker', 'LIKE', $name);
            });
        }
        if (!empty($category_id)) {
            $products->where('category_id', '=', $category_id);
        }
        if (!empty($min_price)) {
            $products->where('price', '>=', $min_price);
        }
        if (!empty($max_price)) {
            $products->where('price', '<=', $max_price,);
        }

        if ($request->has('sort')) {
            $sortField = 'price';
            $sortDirection = $request->input('sort') == 'price_asc' ? 'asc' : 'desc';
            $products->orderBy($sortField, $sortDirection);
        }

        $data = [
            "products" => $products->paginate(20),
        ];


        return view("products.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $data = ['product' => $product];
        return view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|numeric',
            'maker' => 'required|max:255',
            'name' => 'required|max:255',
            'price' => 'required|numeric|integer|min:0',
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->maker = $request->maker;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data = ['product' => $product];
        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // $this->authorize($product);
        $this->validate($request, [
            'category_id' => 'required|numeric',
            'maker' => 'required|max:255',
            'name' => 'required|max:255',
            'price' => 'required|numeric|integer|min:0',
        ]);
        $product->category_id = $request->category_id;
        $product->maker = $request->maker;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return redirect(route('products.index', $product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('products.index'));
    }
}
