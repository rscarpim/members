<?php

require_once "../../vendor/autoload.php";
require_once "../../app//helpers/helpers.php";
require_once "../../app/routes/Routes.php";

/* Declaring Variables. */
$vErrors    = false;

$vValidUser = false;

if (isset($_POST['btnSubmit']) && !empty($_POST['btnSubmit'])) {



    /* Vallidating the Form */
    $vErrors = (empty($_POST['pUserName'])) ? true : false;

    $vErrors = (empty($_POST['pUserPassword'])) ? true : false;


    /* Login Process.  */
    if (!$vErrors) {

        /* Instantiating the Controller. */
        $Login = new LoginController;

        /* Valid User */
        if ($Login->FLogin($_POST)) {


            /* According with User Level. */
            switch ((int)$_SESSION['uIsAdmin']) {

                    /* Administrators. */
                case 1:
                    /* Redirecting. */
                    PRedirect('/admin/admin.php');
                    break;

                    /* Regular Users */
                default:

                    PRedirect('/member/insufficient.php');
                    break;
            }
        } else {

            /* Show Message Invalid User Name or Password.*/
            $vValidUser = true;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member Login</title>

    <link rel="stylesheet" type="text/css" href="../assets/css/index.css">
</head>

<body>


    <div class="center">

        <h3 style="text-align: center;">User Login</h3>

        <form action="" id="FrmLogin" method="post" style="text-align: center;">

            <span class="span-error">* Required Fields</span>
            <br /><br />
            User Name: <span class="span-error">*</span><br />
            <input type="text" name="pUserName" id="UserName" value="" autofocus>
            <br />
            <span class="span-error" id="UserName-validation" value=""></span>
            <br />

            Password: <span class="span-error">*</span><br />
            <input type="password" name="pUserPassword" id="UserPassword" value="">
            <br />
            <span class="span-error" id="UserPassword-validation"></span>
            <br />

            <span class="span-error"><?php if ($vErrors === true) {
                                            echo "User name and Password are required Fields";
                                        } ?></span>
            <br />

            <span class="span-error"><?php if ($vValidUser === true) {
                                            echo "Invalid User Name or Password!";
                                        } ?></span>

            <br><br>
            <input type="submit" value="Submit" name="btnSubmit">

            <br /><br />
            <a style="text-decoration: none;" href="/member/sign-up.php">Not a Member? - <strong>Sig-up</strong></a>
        </form>
    </div>
</body>

</html> 