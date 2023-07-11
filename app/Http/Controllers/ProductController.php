<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use PharException;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  ProductCollection::collection(Product::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            if (
                !isset($request->name) || !isset($request->detail) ||
                !isset($request->price) || !isset($request->stock)
            ) {
                return response()->json(['error' => 'Send all required parameters'], 422);
            }

            // Retrieve the data from the request
            $name = $request->input('name');
            $detail = $request->input('detail');
            $price = $request->input('price');
            $stock = $request->input('stock');

       
            // Create a new Data model instance and store the data
            $baseData = new Product();

            $baseData->name = $name;
            $baseData->detail = $detail;
            $baseData->price = $price;
            $baseData->stock = $stock;


            $baseData->save();

            // Return a response
            return response()->json(['message' => 'Post created successfully', 'data' => $baseData], 201);
        } catch (PharException $e) {
            abort(500, 'An error occurred.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $showbase = Product::findOrFail($id);
        $showbase->employee_nr = $request->input('name');
        $showbase->employee_name = $request->input('detail');
        $showbase->user_name = $request->input('price');
        $showbase->company = $request->input('stock');

        $result = $showbase->update();
        if ($result) {
            return response()->json($showbase);
        } else {
            return ["Not updated data"];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $showbase = Product::find($id);
        $result = $showbase->delete();
        if ($result) {
            return [
                "result" => "Delete Successful"
            ];
        } else {
            return ["Not deleted data"];
        }  
    }
}
