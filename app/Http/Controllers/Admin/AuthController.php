<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $password = $request->input('password');
        $adminPassword = config('portfolio.admin_password', 'admin123');

        if ($password === $adminPassword) {
            $request->session()->put('admin', true);

            return redirect()->route('admin.dashboard');
        }

        return redirect()
            ->route('admin.login')
            ->with('error', 'Password salah. Silakan coba lagi.');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('admin');

        return redirect()->route('admin.login');
    }
}
