<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Product</title>
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

        .product-detail {
            width: 450px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 0 6px #ccc;
            padding: 20px;
        }

        .product-detail h1 {
            text-align: center;
        }

        .product-detail img {
            width: 100%;
            margin: 20px 0;
        }

        .product-detail .desc {
            margin-bottom: 20px;
        }

        .product-detail .desc h3 {
            margin-bottom: 10px;
        }

        .product-detail a {
            text-align: center;
        }

        .product-detail a button, .product-detail button {
            padding: 10px;            
            background: #000;
            color: #fff;
            margin-top: 15px;
            width: 100%;
            border-radius: 7px;
            outline: none;
            border: none;
            text-transform: uppercase;
            cursor: pointer;
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

    <div class="product-detail">
        <h1>{{$product->name}}</h1>
        <img src="{{asset('storage/' . $product->image)}}" alt="{{$product->name}}">
        <div class="desc">
            <h2>Description</h2>
            <p>{{$product->description}}</p>
        </div>
        <p><b>Quantity</b>: {{$product->quantity}}</p>
        <p><b>Price</b>: ₦{{$product->price}}</p>
        <a href="/edit_product/{{$product->id}}"><button>Edit Product</button></a>
        <form action="{{ route('delete', ['productId' => $product->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button>Delete Product</button>
        </form>
    </div>

</body>
</html>