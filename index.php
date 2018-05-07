<!doctype html>

<html>

<head>
    <title>Personal information</title>
    <meta charset="utf-8"/>
</head>

<body>

<h1>Personal information</h1>

<?php

if (!isset($_POST) || empty($_POST) || !isset($_POST['username']) || !isset($_POST['password']))
    header("location: login.php");

else {
    $usersConnection = new mysqli("localhost", "root", "", "LoginProjectUsers");

    if ($usersConnection->connect_error) {
        header("location: login.php");
    }

    if ($result = $usersConnection->query("SELECT Password FROM Users WHERE Username='" . $_POST['username'] . "'")) {
        if ($result->num_rows > 0) {
            $obj = $result->fetch_object();
            if ($obj->Password === hash('sha256', $_POST['password'])) {

                $result->close();
                $dataConnection = new mysqli("localhost", "root", "", "LoginProjectData");

                if ($result = $dataConnection->query("SELECT * FROM PersonalInformation WHERE Username='" . $_POST['username'] . "'")) {

                    $req_data=$result->fetch_array(MYSQLI_ASSOC);

                    echo "<table>";
                    foreach($req_data as $key=>$row) {
                        echo "<tr>";
                        echo "<td>".$key."</td>";
                        echo "<td>".$row."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                } else {
                    die("Query error selecting data");
                }

            } else {
                die("Wrong password");
            }
        } else {
            die("Username doesn't exist");
        }
    } else header("location: login.php");

} ?>

</body>

</html>