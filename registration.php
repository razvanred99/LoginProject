<!doctype html>

<html>

<head>
    <title>New</title>
    <meta charset="utf-8"/>
</head>

<body>

<script>
    function onSubmit() {
        const inpRepeatPassword = document.getElementById("inpRepeatPassword");

        if (document.getElementById("inpPassword").value !== inpRepeatPassword.value) {
            alert("Password doesn't match");
            inpRepeatPassword.value = '';
            return false;
        } else {
            return true;
        }
    }
</script>

<h1>Registration</h1>

<?php if (!isset($_POST) || empty($_POST)) {
    ?>
    <form method="POST" action="registration.php" id="registrationForm" onsubmit="return onSubmit()">
        <table>
            <tr>
                <td>
                    <label for="inpName">Name</label>
                </td>
                <td>
                    <input id="inpName" name="name" type="text" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="inpSurname">Surname</label>
                </td>
                <td>
                    <input id="inpSurname" name="surname" type="text" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="inpUsername">Username</label>
                </td>
                <td>
                    <input id="inpUsername" name="username" type="text" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="inpPassword">Password</label>
                </td>
                <td>
                    <input id="inpPassword" name="password" type="password" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="inpRepeatPassword">Repeat Password</label>
                </td>
                <td>
                    <input id="inpRepeatPassword" type="password" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <button onclick="location.href='login.php';" type="button" id="btnLogin">Back to login</button>
                </td>
                <td>
                    <input type="submit" value="Register now"/>
                </td>
            </tr>
        </table>
    </form>
<?php } else {
    $dbname = "LoginProjectUsers";
    $userTable = "Users";

    $connection = new mysqli("localhost", "root", "");

    if ($connection->connect_error)
        die("Connection failed: " . $connection->connect_error);

    $psw = hash("sha256", $_POST["password"]);
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];

    if ($connection->multi_query("CREATE DATABASE IF NOT EXISTS $dbname; 
                                            USE $dbname;
                                            CREATE TABLE IF NOT EXISTS $userTable (Name VARCHAR(64) NOT NULL,Surname VARCHAR(64) NOT NULL, Username VARCHAR(16) NOT NULL PRIMARY KEY, Password VARCHAR(64) NOT NULL);
                                           INSERT INTO $userTable VALUES (\"$name\",\"$surname\",\"$username\",\"$psw\");")) {

        if($connection->errno===0)
        echo "delicate ".$connection->errno;
        else
            echo "shit";
    } else
        echo "Error handling DB: " . $connection->error;

    $connection->close();
} ?>

</body>

</html>