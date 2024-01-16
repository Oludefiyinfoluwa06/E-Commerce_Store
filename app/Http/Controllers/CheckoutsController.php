<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutsController extends Controller
{
    public function checkout (Request $request) {
        $email = session()->get('user_email');

        DB::table('checkouts')->insert([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => $request->input('image'),
            'user_email' => $email,
        ]);

        return redirect('/user_orders')->with('message', 'Checkout successful');
    }

    public function view_checkouts () {
        if (session()->has('user_email')) {
            $email = session()->get('user_email');

            $checkouts = DB::table('checkouts')->where('user_email', $email)->get();

            return view('user_orders', [
                'checkouts' => $checkouts,
            ]);
        }

        return redirect('/user_login');
    }

    public function admin_view_checkouts () {
        if (session()->has('admin_email')) {            
            $checkouts = DB::table('checkouts')->get();
    
            return view('orders', [
                'checkouts' => $checkouts,
            ]);
        }

        return redirect('/admin_login');
    }
}
