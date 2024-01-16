<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function add_product (Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $email = session()->get('admin_email');

        $admin = DB::table('admin')->where('email', $email)->first();
        $admin_id = $admin->id;
        $image_path = $request->file('image')->store('product_images', 'public');

        DB::table('products')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'image' => $image_path,
            'admin_id' => $admin_id,
        ]);

        return redirect('/products')->with('message', 'Product added successfully!');
    }

    public function all_products () {
        $products = DB::table('products')->get();

        if (!$products) {
            abort(404);
        }

        return view('home', [
            'products' => $products,
        ]);
    }

    public function admin_products () {
        if (!session()->has('admin_email')) {
            return redirect('/admin_login');
        }

        $email = session()->get('admin_email');

        $admin = DB::table('admin')->where('email', $email)->first();
        $admin_id = $admin->id;
        $products = DB::table('products')->where('admin_id', $admin_id)->get();

        if (!$products) {
            abort(404);
        }

        return view('products', [
            'products' => $products,
        ]);
    }

    public function view_product ($productId) {
        $product = DB::table('products')->where('id', $productId)->first();
    
        if (!$product) {
            abort(404);
        }
    
        return view('view_product', [
            'product' => $product
        ]);
    }

    public function admin_view_product ($productId) {
        $product = DB::table('products')->where('id', $productId)->first();
    
        if (!$product) {
            abort(404);
        }
    
        return view('admin_view_product', [
            'product' => $product
        ]);
    }

    public function edit_product_page ($productId) {
        $product = DB::table('products')->where('id', $productId)->first();

        if (!$product) {
            abort(404);
        }

        return view('edit_product', [
            'product' => $product
        ]);
    }

    public function edit_product (Request $request, $productId) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $email = session()->get('admin_email');

        $admin = DB::table('admin')->where('email', $email)->first();
        $admin_id = $admin->id;
        $image_path = $request->file('image')->store('product_images', 'public');

        DB::table('products')->where('id', $productId)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'image' => $image_path,
            'admin_id' => $admin_id,
        ]);

        return redirect('/admin_view_product/' . $productId)->with('message', 'Product updated successfully!');
    }

    public function delete_product ($productId) {
        $product = DB::table('products')->where('id', $productId)->first();

        if (!$product) {
            abort(404);
        }

        DB::table('products')->where('id', $productId)->delete();

        return redirect('/products')->with('message', 'Product deleted successfully!');
    }
}
