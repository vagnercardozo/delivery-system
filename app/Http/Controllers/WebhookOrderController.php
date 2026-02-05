<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookOrderController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $payload = $request->all();

        return response()->json(['ok' => $payload]);
    }
}
