<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

    <title>Login</title>
</head>
<body>
    <h1>Admin Login Page</h1>
    <form action="/log" method="post">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="enter your email..." required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <input type="submit" value="Login">
    </form>
</body>
</html>