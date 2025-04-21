<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Override redirectTo so it doesn't try to redirect to a web route
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // In web apps, this would redirect to 'login'
            // In APIs, return null to trigger a JSON 401 response
            return null;
        }

        return null;
    }
}
