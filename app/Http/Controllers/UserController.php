<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user_register (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        if ($user) {
            return redirect('/user_login')->with('message', 'Signup successful!');
        }

        return back()->with('error', 'Signup unsuccessful!');
    }

    public function user_login (Request $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            if (Hash::check($credentials['password'], $user->password)) {
                session()->put('user_email', $user->email);
                return redirect('/')->with('message', 'Login successful');
            }

            return back()->with('error', 'Incorrect password');
        }

        return back()->with('error', 'Account does not exist');
    }

    public function user_logout () {
        session()->forget('user_email');

        if (!session()->has('user_email')) {
            return redirect('/user_login');
        }

        return redirect('/');
    }

    public function admin_register (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6'
        ]);

        $admin = DB::table('admin')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        if ($admin) {
            return redirect('/admin_login')->with('message', 'Signup successful!');
        }

        return back()->with('error', 'Signup unsuccessful!');
    }

    public function admin_login (Request $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $admin = DB::table('admin')->where('email', $credentials['email'])->first();

        if ($admin) {
            if (Hash::check($credentials['password'], $admin->password)) {
                session()->put('admin_email', $admin->email);
                return redirect('/products')->with('message', 'Login successful');
            }

            return back()->with('error', 'Incorrect password');
        }

        return back()->with('error', 'Account does not exist');
    }

    public function admin_logout () {
        session()->forget('admin_email');

        if (!session()->has('admin_email')) {
            return redirect('/admin_login');
        }

        return redirect('/products');
    }
}
