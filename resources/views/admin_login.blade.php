<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
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

        form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 10px #ccc;
            border-radius: 10px;
            padding: 30px;
            width: 400px;
        }

        legend {
            font-size: 40px;
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
            font-size: 20px;
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

        form p {
            margin-top: 10px;
            text-align: center;
        }


    </style>
</head>
<body>
    @if (session()->has('message'))
        <p style="color: #fff; background: #3cea1d; width: 100%; text-align: center; padding: 10px;" x-data="{show: true}" x-init="setTimeout(() => show=false,3000)" x-show="show">{{session()->get('message')}}</p>
    @endif
    @if (session()->has('error'))
        <p style="color: #fff; background: red; width: 100%; text-align: center; padding: 10px;" x-data="{show: true}" x-init="setTimeout(() => show=false,3000)" x-show="show">{{session()->get('error')}}</p>
    @endif
    <form action="" method="POST">
        @csrf
        <legend>Login Here</legend>
        <div class="input-box">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" />
        </div>
        <div class="input-box">
            <label for="password">password</label>
            <input type="password" name="password" id="password" />
        </div>
        <button type="submit">Login</button>
        <p>Don't have an account? <a href="/admin_register">Register</a></p>
    </form>
</body>
</html>