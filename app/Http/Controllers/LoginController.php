<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view("login");
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('account.login')
                ->withInput()
                ->withErrors($validator);
        }

        $credentials = $request->only('email', 'password');
        // if (Auth::guard("admin")->attempt($credentials)) {
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->to('/');
        } else {
            return back()->withErrors([
                'email' => 'invalid email or password',
            ]);
        }
    }
    public function logout()
    {
        // employee Logout
        Auth::logout();

        // Admin Logout
        // Auth::guard('admin')->logout();
        return redirect()->route('account.login');
    }
}
