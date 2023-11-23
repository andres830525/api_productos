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

        return new ProductoCollection(Producto::paginate(10));
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
        $validatedData = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
            'precio' => 'required|numeric',
        ]);

        $producto = Producto::create($validatedData);
        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {





        // Retorna el producto desde la base de datos usando el id de el producto ingresado
        $producto = Producto::find($id);
        //dd($producto);



        // Validamos si el Producto existe
        if ($producto !== null) {
            //dd($producto);

            // Se retorna el producto como un JSON con el codigo 200 HTTP status

            return response()->json(new ProductoResource($producto), 200);
        } else {

            //Se retorna 404 Not Found HTTP status code si el producto no fue encontrado

            return response()->json(['message' => 'Producto no encontrado'], 404);
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
    public function update(Request $request,  string $id)
    {


        // Validamos los datos de request
        $validatedData = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
            'precio' => 'required|numeric',
        ]);

        $producto = Producto::find($id);

        // Si el producto fue encontrado
        if ($producto) {
            // Se actualiza el producto con los datos validados
            $producto->update($validatedData);



            //Se retorna el producto actualizado como un JSON con un 200 HTTP status code
            return response()->json($producto, 200,);
        } else {
            //Se retorna 404 Not Found HTTP status code si el producto no fue encontrado

            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, string $id)
    {


        $producto = Producto::find($id);

        // Si el producto fue encontrado
        if ($producto !== null) {
            // Borrar producto
            $producto->delete();


            // Return a 204 No Content HTTP status code
            return response()->json(null, 204);
        } else {
           //Se retorna 404 Not Found HTTP status code si el producto no fue encontrado
           return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    }
}