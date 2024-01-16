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

        .content {
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        table img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            object-position: center;
        }

        table td:first-child {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 2rem;
        }

        table td:first-child p {
            font-weight: bold;
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

    <div class="content">
        <table>
            <thead>
                <th>Product</th>
                <th>Price</th>
                <th>Buyer's email</th>
                <th>Order Status</th>
            </thead>
            <tbody>
                @foreach ($checkouts as $checkout)
                    <tr>
                        <td>
                            <img src="{{asset('storage/' . $checkout->image)}}" alt="{{$checkout->name}}">
                            <p>{{$checkout->name}}</p>
                        </td>
                        <td>₦{{$checkout->price}}</td>
                        <td>{{$checkout->user_email}}</td>
                        <td>Pending</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Copyright &copy; 2023 | All Rights Reserved</p>
    </div>
</body>
</html>