<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            list-style: none;
            font-family: sans-serif;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
        }

        nav ul {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 1rem;
        }

        nav ul li a {
            color: #000;
        }

        nav ul li a.btn {
            padding: 10px 20px;
            background: black;
            color: #fff;
        }

        .cart-products {
            padding: 30px;
        }

        .cart-products h1.cart, .cart-products p.empty {
            text-align: center;
            margin: 10px;
        }

        .cart-products .cart-product {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            gap: 2rem;
            box-shadow:  0 0 6px #ccc;
            padding: 10px;
            border-radius: 10px;
            margin: 30px 0;
        }

        .cart-product img {
            width: 200px;
        }

        .cart-product h1 {
            margin-bottom: 10px;
        }

        .cart-products button {
            padding: 10px 20px;
            background: #000;
            color: #fff;
            cursor: pointer;
            border: 0;
            margin-top: 8px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: #000;
            color: #fff;
            width: 100%;
        }
    </style>
</head>
<body>
    @if (session()->has('message'))
        <p style="color: #fff; background: #3cea1d; width: 100%; text-align: center; padding: 10px;" x-data="{show: true}" x-init="setTimeout(() => show=false,3000)" x-show="show">{{session()->get('message')}}</p>
    @endif

    <nav>
        <label>E-Commify</label>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/admin_login">Be a seller</a></li>
            <li><a href="/cart">Cart</a></li>
            <li><a href="/user_orders">Orders</a></li>
            <li>
                @if (!session()->has('user_email'))
                    <a href="/user_login" class="btn">Login</a>
                @else
                    <a href="{{route('user_logout')}}" class="btn">Logout</a>
                @endif
            </li>
        </ul>
    </nav>

    <div class="cart-products">
        <h1 class="cart">Your cart</h1>
        @if ($cart_products->count() > 0)
            @foreach ($cart_products as $cart_product)
                <div class="cart-product">
                    <img src="{{asset('storage/' . $cart_product->image)}}" alt="{{$cart_product->name}}">
                    <div class="cart-product-info">
                        <h1>{{$cart_product->name}}</h1>
                        <p>Price: ₦{{$cart_product->price}}</p>
                        <form action="{{ route('delete_cart_product', ['cartProductId' => $cart_product->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button>Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
            <form action="{{route('checkout')}}" method="POST">
                @csrf
                <input type="hidden" name="name" id="name" value="{{$cart_product->name}}" />
                <input type="hidden" name="price" id="price" value="{{$cart_product->price}}" />
                <input type="hidden" name="image" id="image" value="{{$cart_product->image}}" />
                <button>Checkout</button>
            </form>
        @else
            <p class="empty">Your cart is empty</p>
        @endif
    </div>

    <div class="footer">
        <p>Copyright &copy; 2023 | All Rights Reserved</p>
    </div>
</body>
</html>