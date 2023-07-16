<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use PharException;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
use Flat3\Lodata\Controller\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::select('*')
        ->where('id', 2)
        ->OrWhere('stock',9)
        ->get();
// dd($product);
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
                return response()->json(['error' => 'Send all required parameters'], Response::HTTP_UNPROCESSABLE_ENTITY);
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
            return response()->json(['message' => 'Post created successfully', 'data' => $baseData], Response::HTTP_OK);
        } catch (PharException $e) {
            abort(Response::HTTP_ACCEPTED, 'An error occurred.');
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
        // $product->update($request->all());

        $showbase = Product::findOrFail($id);
        $showbase->employee_nr = $request->input('name');
        $showbase->employee_name = $request->input('detail');
        $showbase->user_name = $request->input('price');
        $showbase->company = $request->input('stock');


        $result = $showbase->update();
        
        if ($result) {
            return response()->json(['message' => 'Post created successfully', 'data' => $result], Response::HTTP_OK);
        } else {
            return ["Not updated data"];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
       $product->delete();
       return response()->json(['message' => 'Deleted successfully', 'data' => $product], Response::HTTP_NO_CONTENT);
    //    return response([null, Response::HTTP_NO_CONTENT])
    }
}
