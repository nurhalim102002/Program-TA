<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        $userLevel = $request->user()->level;

        // Pengecekan untuk menghindari redirect loop khusus untuk penilai
        $currentPath = $request->path();
        if ($currentPath === '/' && $userLevel == 'Penilai') {
            return redirect('homepenilai'); 
        }

        if (in_array($userLevel, $levels)) {
            return $next($request);
        }

        // Tidak perlu redirect jika admin berada di halaman utama
        if ($userLevel == 'Admin') {
            return $next($request); 
        }

        if ($userLevel == 'Penilai') {
            return redirect('homepenilai');
        }

        return abort(403); // Akses ditolak jika tidak sesuai level
    }


}
