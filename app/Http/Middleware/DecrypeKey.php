<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use App\Traits\ContractTraits\ContractDecryptionTrait;

class DecrypeKey
{
 
    use ContractDecryptionTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $this->decryptKeys($request);
        } catch (DecryptException $e) {
           dd('Entered id is invalid');
        }
        return $next($request);
    }
}
