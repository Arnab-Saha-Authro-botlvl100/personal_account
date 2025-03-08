<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rules;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();
        
    //     $user = Auth::user(); // Get the authenticated user

    //     // Check if the user's next payment date has passed
    //     if ($user->next_payment_date && Carbon::now()->greaterThan($user->next_payment_date)) {
    //         // Update payment status to pending
    //         $user->update(['payment_status' => 'pending']);
    
    //         // Redirect to bKash payment page
    //         return redirect()->route('bkash.payment.page')->with('error', 'Your subscription has expired. Please complete the payment.');
    //     }
    

    //     $request->session()->regenerate();

    //     session()->flash('logged_in', __("You're logged in!"));

    //     return redirect()->intended(RouteServiceProvider::HOME);
    // }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        
        $user = Auth::user(); // Get the authenticated user

        // Check if the user's next payment date has passed
        if ($user->next_payment_date && Carbon::now()->greaterThan($user->next_payment_date)) {
            // Log the user out
            Auth::logout();

            // Clear the session to prevent access
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect to bKash payment page with an error message
            return redirect()->route('bkash.payment.page', ['user_id' => $user->id])
            ->with('error', 'Your subscription has expired. Please complete the payment.');
        }

        // Regenerate session ID for security
        $request->session()->regenerate();

        // Flash a success message
        session()->flash('logged_in', __("You're logged in!"));

        // Redirect to the intended page
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
