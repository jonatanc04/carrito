<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use Illuminate\Http\Request;

class CarritoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api',
        ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carrito = Carrito::get()->where('idCliente', $request->idCliente);
        return response()->json($carrito);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carritoExistente = Carrito::where('idCliente', $request->idCliente)->where('idProducto', $request->idProducto)->first();

        if ($carritoExistente) {
            $carritoExistente->cantidad += $request->cantidad;
            $carritoExistente->save();
            
            return response()->json($carritoExistente, 200);
        } else {
            $carrito = new Carrito();
            $carrito->idCliente = $request->idCliente;
            $carrito->idProducto = $request->idProducto;
            $carrito->cantidad = $request->cantidad;
            $carrito->save();

            return response()->json($carrito, 201);
        }
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
    public function update(Request $request, $id)
    {
        $carrito = Carrito::find($id);
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
    public function destroy($id)
    {
        $carrito = Carrito::find($id);
        $carrito->delete();
        return response()->json($carrito);
    }

    /**
     * Elimina el carrito de compra y lo devuelve.
     *
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function confirmarPedido($idCliente)
    {
        $lineasCarrito = Carrito::where('idCliente', $idCliente)->get();
        Carrito::where('idCliente', $idCliente)->delete();
        return response()->json($lineasCarrito);
    }



}