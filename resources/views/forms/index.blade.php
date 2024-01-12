<!DOCTYPE html>
<html>
<head>
    <title>Login and Register Page</title>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <h2>Register</h2>
        <form action="{{ url('/register') }}" method="POST" >
            @csrf
            <label for="reg-email">Name:</label>
            <input type="text" id="reg-email" name="name" required>
            <label for="reg-email">Email:</label>
            <input type="email" id="reg-email" name="email" required>
            <label for="reg-password">Password:</label>
            <input type="password" id="reg-password" name="password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>