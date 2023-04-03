<?php

namespace App\Http\Controllers\Auth;

use App\Actions\PasswordAction;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request, PasswordAction $action): RedirectResponse
    {
        $action->update($request);

        return back();
    }
}
