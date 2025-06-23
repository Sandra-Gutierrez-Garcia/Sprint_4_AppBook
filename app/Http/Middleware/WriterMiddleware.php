<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\WriterRequest; 
use Symfony\Component\HttpFoundation\Response;

class WriterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\App\Http\Requests\WriterRequest; ): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(WriterRequest $request, Closure $next): Response
    {
        $writer = $request->input('writer');

    if (!$writer || !isset($writer['username']) || !isset($writer['password'])) {
        return redirect('/login');
    }

    $credentials = [
        'username' => $writer['username'],
        'password' => $writer['password'],
    ];
        return $next($request);
    }
}
