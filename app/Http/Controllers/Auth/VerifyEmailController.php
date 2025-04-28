<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectUser($request->user());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->redirectUser($request->user());
    }

    private function redirectUser($user): RedirectResponse
    {
        $role = $user->role;

        if ($role == 0) {
            return redirect()->intended(route('admin.dashboard', absolute: false).'?verified=1');
        } elseif ($role == 1) {
            return redirect()->intended(route('writer.dashboard', absolute: false).'?verified=1');
        } else {
            return redirect()->intended(route('visitor.page', absolute: false).'?verified=1');
        }
    }

}
