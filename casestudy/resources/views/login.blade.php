<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <form action="login" method="post">
        @csrf

        <label for="username">User Name</label>
        <input type="text" name="username" id="username"><br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="Log In">
    </form>
</body>

</html>