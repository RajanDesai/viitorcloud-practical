<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;

class TenantDbConnectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $subdomain = $request->route('account');
        if($subdomain) {
            $tenant = Tenant::where('slug', $subdomain)->with('dbDetail')->first();
            if($tenant) {
                $dbDetail = $tenant->dbDetail;
                changeDbConnection($dbDetail->db_name, $dbDetail->db_username, $dbDetail->db_password);
            }
        }
        return $next($request);
    }
}
