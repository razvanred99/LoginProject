<!doctype html>

<html>

<head>
    <title>Personal information</title>
    <meta charset="utf-8"/>
</head>

<body>

<?php if(!isset($_POST) || empty($_POST) || !isset($_POST['username']) || !isset($_POST['password']))
    header("location: login.php");
    else{
        $loginConnection=new mysqli("localhost","root","","LoginProjectUsers");

        if($loginConnection->connect_error){
            header("location: login.php");
        }

        //$loginConnection->query("SELECT * FROM U");
    } ?>

</body>

</html>