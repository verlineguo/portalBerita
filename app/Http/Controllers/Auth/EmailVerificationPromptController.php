<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
{
    if ($request->user()->hasVerifiedEmail()) {
        $authUserRole = $request->user()->role;

        if ($authUserRole == 0) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        } else if ($authUserRole == 1) {
            return redirect()->intended(route('writer.dashboard', absolute: false));
        } else {
            return redirect()->intended(route('visitor.page', absolute: false));
        }
    }

    return view('auth.verify-email');
}
}
