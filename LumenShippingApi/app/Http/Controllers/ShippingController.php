<?php

namespace App\Http\Controllers;

use App\Shipping;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShippingController extends \Laravel\Lumen\Routing\Controller
{
    use ApiResponser;

    public function index()
    {
        $shippings = Shipping::all();

        return $this->successResponse($shippings);
    }

    public function store(Request $request)
    {
        $rules = [
            'order_id' => 'required|integer|min:1',
            'address' => 'required',
            'shipping_method' => 'required',
            'cost' => 'numeric',
            'status' => 'in:preparing,shipped,in_transit,delivered',
            'tracking_number' => 'max:255',
        ];

        $this->validate($request, $rules);

        $shipping = Shipping::create($request->all());

        return $this->successResponse($shipping, Response::HTTP_CREATED);
    }

    public function show($shipping)
    {
        $shipping = Shipping::findOrFail($shipping);

        return $this->successResponse($shipping);
    }

    public function update(Request $request, $shipping)
    {
        $rules = [
            'order_id' => 'integer|min:1',
            'address' => 'max:65535',
            'shipping_method' => 'max:255',
            'cost' => 'numeric',
            'status' => 'in:preparing,shipped,in_transit,delivered',
            'tracking_number' => 'max:255',
        ];

        $this->validate($request, $rules);

        $shipping = Shipping::findOrFail($shipping);

        $shipping->fill($request->all());

        if ($shipping->isClean()) {
            return $this->errorResponse('Al menos un atributo debe modificarse', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $shipping->save();

        return $this->successResponse($shipping);
    }

    public function calculate(Request $request)
    {
        // Solo validamos el shipping_method, NO pedimos order_id ni address aquí
        $this->validate($request, [
            'shipping_method' => 'required|in:standard,express',
        ]);

        $cost = ($request->shipping_method === 'express') ? 15.00 : 5.00;

        return response()->json(['cost' => $cost, 'currency' => 'USD']);
    }
    public function byOrder($order_id)
    {
        $shipping = Shipping::where('order_id', $order_id)->first();

        if (!$shipping) {
            return $this->errorResponse('Envío no encontrado para ese pedido', Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse($shipping);
    }
}
