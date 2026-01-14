<?php

namespace App\Http\Controllers;

use App\Services\ShippingService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShippingController extends Controller
{
    use ApiResponser;

    public $shippingService;

    public function __construct(ShippingService $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    public function index()
    {
        return $this->successResponse($this->shippingService->obtainShippings());
    }

    public function store(Request $request)
    {
        return $this->successResponse($this->shippingService->createShipping($request->all()), Response::HTTP_CREATED);
    }

    public function show($shipping)
    {
        return $this->successResponse($this->shippingService->obtainShipping($shipping));
    }

    public function update(Request $request, $shipping)
    {
        return $this->successResponse($this->shippingService->editShipping($request->all(), $shipping));
    }

    public function calculate(Request $request)
    {
        return $this->successResponse($this->shippingService->calculateShipping($request->all()));
    }
}