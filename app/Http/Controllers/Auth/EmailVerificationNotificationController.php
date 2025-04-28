<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
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

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
