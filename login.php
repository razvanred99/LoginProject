<!doctype html>

<html>

<head>
    <title>Login</title>
    <meta charset="utf-8"/>
</head>

<body>

<h1>Login</h1>

<form action="index.php" method="POST">
    <table>
        <tr>
            <td>
                <label for="inpUsername">Username</label>
            </td>
            <td>
                <input type="text" id="inpUsername" name="username"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="inpPassword">Password</label>
            </td>
            <td>
                <input type="password" id="inpPassword"/>
            </td>
        </tr>
        <tr>
            <td>
                <button onclick="location.href='registration.php'" id="btnRegistration" type="button">New User</button>
            </td>
            <td>
                <input type="submit" value="LOGIN">
            </td>
        </tr>
    </table>
</form>

</body>

</html>