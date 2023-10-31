<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Http\Resources\ProductoResource;
use App\Http\Resources\ProductoCollection;
use App\Http\Requests\StoreProductosRequest;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Producto::all(), 200);

        //return new ProductoCollection(Producto::paginate(10));
        //return Producto::all();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
      ]); */
      
      
       
      

        $producto = Producto::create($request->all);
        return response()->json($producto, 201); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
       
        //$product = Product::find($producto->id);
        
     // Check if the product was found
    if ($poducto=1) {
        // Return the product as a JSON response with a 200 HTTP status code
            return response()->json(new ProductoResource($producto), 200);
         } else {
     // Return a 404 Not Found HTTP status code if the product was not found
        return response()->json(['message' => 'Product not found'], 404);
        
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {

        // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
  ]);

  // Check if the product was found
if ($product) {
    // Update the product with the validated data
    $product->update($validatedData);
    
    
      // Return the updated product as a JSON response with a 200 HTTP status code
       return response()->json($product, 200);
    } else {
      // Return a 404 Not Found HTTP status code if the product was not found
      return response()->json(['message' => 'Product not found'], 404);
    }
  
    
       /*  $producto->update($request->all());
        return response()->json($producto, 200); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Producto $producto)
    {
        // Check if the product was found
        if ($product=1) {
        // Delete the product
        $producto->delete();
      
      
        // Return a 204 No Content HTTP status code
        return response()->json(null, 204);
      } else {
        // Return a 404 Not Found HTTP status code if the product was not found
        return response()->json(['message' => 'Product not found'], 404);
      }
      }
    /* {
        $producto->delete();
        return response()->json(null, 204);
    } */
}
