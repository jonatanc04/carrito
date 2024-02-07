<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carrito = Carrito::get();
        return response()->json($carrito, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carrito = new Carrito();
        $carrito->idCliente = $request->idCliente;
        $carrito->idProducto = $request->idProducto;
        $carrito->cantidad = $request->cantidad;
        $carrito->save();

        return response()->json($carrito, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function show(Carrito $carrito)
    {
        return response()->json($carrito, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carrito $carrito)
    {
        $carrito->idCliente = $request->idCliente;
        $carrito->idProducto = $request->idProducto;
        $carrito->cantidad = $request->cantidad;
        $carrito->save();

        return response()->json($carrito);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrito $carrito)
    {
        $carrito->delete();
        return response()->json($carrito);
    }
}
