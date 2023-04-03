<?php

namespace App\Http\Controllers\Auth;

use App\Actions\PasswordAction;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): Response
    {
        return Inertia::render('Auth/ConfirmPassword');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request, PasswordAction $action): RedirectResponse
    {
        if (! $action->storeValidate($request) ) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $action->storeConfirmation($request);
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
