<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
  public function handle(Request $request, Closure $next, ...$roles): Response
  {
    if (Auth::check() && in_array(Auth::user()->role, $roles)) {
      return $next($request);
    }

    return redirect('/login')->with('error', 'Akses ditolak.');
  }
}
