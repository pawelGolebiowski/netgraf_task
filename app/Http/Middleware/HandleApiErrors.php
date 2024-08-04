<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class HandleApiErrors
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof Response) {
            if ($response->isClientError() || $response->isServerError()) {
                if ($response instanceof JsonResponse) {
                    $errorData = $response->json();

                    return back()->withErrors(['message' => $errorData['message'] ?? 'An error occurred']);
                }
            }
        }

        return $response;
    }
}


