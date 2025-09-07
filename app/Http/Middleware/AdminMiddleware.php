<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'Vui lòng đăng nhập');
        }

        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('auth.login')->with('error', 'Vui lòng đăng nhập');
            abort(403, 'Bạn không có quyền truy cập');
        }

        return $next($request);
    }
}
