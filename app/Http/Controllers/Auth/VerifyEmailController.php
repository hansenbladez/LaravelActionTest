<?php

namespace App\Http\Controllers\Auth;

use App\Actions\EmailAction;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request, EmailAction $action): RedirectResponse
    {

        $notVerify = ! $action->invoke($request);
        $marked = $action->invoke_mark($request);

        if ($notVerify  && $marked) {event(new Verified($request->user()));}
        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');

    }

    public function __invoke_DEPRECATED(EmailVerificationRequest $request): RedirectResponse{ //same exit is terrible
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
