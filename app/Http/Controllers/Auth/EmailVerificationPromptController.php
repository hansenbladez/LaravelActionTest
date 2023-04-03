<?php

namespace App\Http\Controllers\Auth;

use App\Actions\EmailAction;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request, EmailAction $action): RedirectResponse|Response
    {

        if($action->invoke($request) ){return redirect()->intended(RouteServiceProvider::HOME); }
        else{ return Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);}

    }
}
