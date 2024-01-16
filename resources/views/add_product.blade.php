<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
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

        form {
            margin: 20px auto;
            box-shadow: 0 0 10px #ccc;
            border-radius: 10px;
            padding: 30px;
            width: 400px;
        }

        legend {
            font-size: 30px;
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .input-box {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .input-box label {
            font-size: 17px;
            margin-bottom: 6px;
        }

        .input-box input {
            width: 100%;
            border: 1px solid #ccc;
            padding: 5px 10px;
        }

        form button {
            width: 100%;
            padding: 10px;
            border: none;
            background: black;
            color: #fff;
            text-transform: uppercase;
            cursor: pointer;
        }

        .input-box p {
            color: red;
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

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <legend>Add Product</legend>
        <div class="input-box">
            <label for="name">Product name</label>
            <input type="text" name="name" id="name" />
            @error('name')
                <p>{{$message}}</p>
            @enderror
        </div>
        <div class="input-box">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" />
            @error('description')
                <p>{{$message}}</p>
            @enderror
        </div>
        <div class="input-box">
            <label for="price">Price (in Naira)</label>
            <input type="number" name="price" id="price" />
            @error('price')
                <p>{{$message}}</p>
            @enderror
        </div>
        <div class="input-box">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" />
            @error('quantity')
                <p>{{$message}}</p>
            @enderror
        </div>
        <div class="input-box">
            <label for="image">Product Image</label>
            <input type="file" name="image" id="image" />
            @error('image')
                <p>{{$message}}</p>
            @enderror
        </div>
        <button type="submit">Add Product</button>
    </form>

    <div class="footer">
        <p>Copyright &copy; 2023 | All Rights Reserved</p>
    </div>
</body>
</html>