<?php


require_once "../../vendor/autoload.php";
require_once "../../app//helpers/helpers.php";
require_once "../../app/routes/Routes.php";

$vUserName = "";

$toPopulate;

/* Checking if is Logged */
if (!empty($_SESSION)) {

    /* Setting the User Name. */
    $vUserName = $_SESSION['uUserName'];

    /* IF is not Loggedin. */
    if (!$_SESSION['isLoggedIn'] === 'true') {


        /* Redirecting the User. */
        PRedirect('/member/login.php');
    }
} else {

    /* Redirecting the User. */
    PRedirect('/member/login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insufficient</title>

    <link rel="stylesheet" type="text/css" href="../assets/css/index.css">
</head>

<body>

    <h1 class="animated zoomIn">Welcome <?php echo $vUserName;  ?> <span> You have <strong style="color:red;">Insufficient</strong> Previleges to access the Administration Page.</span><span><a class="btnLogout" href="/member/logout.php" id="btnLogout">LogOut</a></span></h1>
</body>

</html> 