<?php

namespace App\Http\Middleware;

use Closure;

class IsKh
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */ 
    public function handle($request, Closure $next)
    {
        if (auth()->user()) {

            $cek = auth()->user()->pegawai->jenis_karantina;

            // NULL atau kosong berarti untuk superadmin dan admin yang tidak mempunyai jenis karantina
            if (is_null($cek) || $cek === '' || $cek === 'kh') return $next($request); 

            return back()->withWarning('Hak Akses Hanya Untuk Fungsional Karantina Hewan!');
                
        }

        return redirect(route('login'));
    }
}
