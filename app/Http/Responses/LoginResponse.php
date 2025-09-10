<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // Check if the user tried to log in as a church AND if their user account
        // has a church record associated with it.
        $isChurchLogin = $request->input('login_type') === 'church' && $request->user()->church;

        // Determine the redirect path.
        // NOTE: You will need to create the 'church.dashboard' route later.
        $redirectPath = $isChurchLogin
            ? route('dashboard') // Placeholder: change to 'church.dashboard' later
            : route('dashboard');

        return $request->wantsJson()
                    ? new JsonResponse('', 204)
                    : redirect()->intended($redirectPath);
    }
}
