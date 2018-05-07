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
    $usersDB = "LoginProjectUsers";
    $dataDB = "LoginProjectData";
    $userTable = "Users";
    $dataTable="PersonalInformation";

    $usersConnection = new mysqli("localhost", "root", "");

    if ($usersConnection->connect_error)
        die("Connection failed: " . $usersConnection->connect_error);

    $dataConnection = new mysqli("localhost", "root", "");

    if ($dataConnection->connect_error)
        die("Connection to data failed: " . $dataConnection->connect_error);

    $psw = hash("sha256", $_POST["password"]);
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];

    if ($usersConnection->multi_query("CREATE DATABASE IF NOT EXISTS $usersDB; 
                                            USE $usersDB;
                                            CREATE TABLE IF NOT EXISTS $userTable (Username VARCHAR(16) NOT NULL PRIMARY KEY, Password VARCHAR(64) NOT NULL)ENGINE=INNODB;
                                           INSERT INTO $userTable VALUES (\"$username\",\"$psw\");")) {

        if ($usersConnection->errno === 0) {

            if($dataConnection->multi_query("CREATE DATABASE IF NOT EXISTS $dataDB;
                                                    USE $dataDB;
                                                    CREATE TABLE IF NOT EXISTS $dataTable (Username VARCHAR(16) NOT NULL UNIQUE,Name VARCHAR(64) NOT NULL,Surname VARCHAR(64) NOT NULL)ENGINE=INNODB;
                                                    INSERT INTO $dataTable VALUES (\"$username\",\"$name\",\"$surname\")"))
                echo "Registration OK";
            else
                echo "Error while inserting data";

        } else
            echo "Error while inserting user";
    } else
        echo "Error handling DB: " . $usersConnection->error;

    $usersConnection->close() ?>

    <button onclick="location.href='login.php'" type="button">Back to login</button>

<?php } ?>

</body>

</html>