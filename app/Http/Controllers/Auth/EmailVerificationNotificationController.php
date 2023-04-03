<?php

namespace App\Http\Controllers\Auth;

use App\Actions\EmailAction;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request, EmailAction $action): RedirectResponse
    {
        if ($action->store_verification($request)) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $action->store_sendEmail($request);

        return back()->with('status', 'verification-link-sent');
    }
}
