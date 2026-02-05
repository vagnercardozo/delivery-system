<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessExternalOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookOrderController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $payload = $request->all();

        ProcessExternalOrder::dispatch($payload);

        return response()->json(['ok' => $payload]);
    }
}
