<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cart () {
        if (!session()->has('user_email')) {
            return redirect('/user_login');
        }

        $email = session()->get('user_email');

        $user = DB::table('users')->where('email', $email)->first();
        $user_id = $user->id;

        $cart_products = DB::table('carts')->where('user_id', $user_id)->get();

        return view('cart', [
            'cart_products' => $cart_products,    
        ]);
    }

    public function add_to_cart (Request $request) {
        $email = session()->get('user_email');

        $user = DB::table('users')->where('email', $email)->first();
        $user_id = $user->id;

        DB::table('carts')->insert([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => $request->input('image'),
            'user_id' => $user_id
        ]);

        return redirect('/cart')->with('message', 'Product added to cart successfully');
    }

    public function delete_cart_product ($cartProductId) {
        $cart_product = DB::table('carts')->where('id', $cartProductId)->first();

        if (!$cart_product) {
            abort(404);
        }

        DB::table('carts')->where('id', $cartProductId)->delete();

        return redirect('/cart')->with('message', 'Product deleted from cart successfully!');
    }
}
