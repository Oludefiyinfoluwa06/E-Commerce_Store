<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Products</title>
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
            box-shadow: 0 0 10px #ccc;
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

        .products {
            padding: 30px;
        }

        .products h1 {
            text-align: center;
        }

        .all-products {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            flex-wrap: wrap;
            gap: 2rem;
            margin-top: 20px;
        }

        .all-products .product {
            width: 300px;
            box-shadow: 0 0 6px #ccc;
            border-radius: 10px;
            padding: 15px 0;
            cursor: pointer;
        }

        .all-products .product:hover {
            transform: scale(1.05);
            transition: .5s;
        }

        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            object-position: center;
        }

        .product h3 {
            margin: 0 15px 15px;
            color: blue;
        }

        .product p {
            margin: 0 15px 15px;
            font-size: 17px;
            font-weight: bold;
            color: #000;
        }

        .product small {
            margin: 0 15px 15px;
            margin-bottom: 20px;
            color: #000;
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
            <li><a href="/products">Home</a></li>
            <li><a href="/add_product">Add Product</a></li>
            <li><a href="/orders">Orders</a></li>
            <li>
                @if (!session()->has('admin_email'))
                    <a href="/admin_login" class="btn">Login</a>
                @else
                    <a href="{{route('admin_logout')}}" class="btn">Logout</a>
                @endif
            </li>
        </ul>
    </nav>

    <div class="products">
        <h1>All Products</h1>

        <div class="all-products">
            @if ($products->count() > 0)
                @foreach ($products as $product)
                    <a  href="/admin_view_product/{{$product->id}}" class="product">
                        <h3>{{$product->name}}</h3>
                        <img src="{{asset('storage/' . $product->image)}}" alt="{{$product->name}}">
                        <p>₦{{$product->price}}</p>
                        <small>Quantity: {{$product->quantity}}</small>
                    </a>
                @endforeach
            @else
                <p>You have not added any product yet</p>
            @endif
        </div>
    </div>

    <div class="footer">
        <p>Copyright &copy; 2023 | All Rights Reserved</p>
    </div>
</body>
</html>