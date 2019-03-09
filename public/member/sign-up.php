<?php
require_once "../../vendor/autoload.php";
require_once "../../app//helpers/helpers.php";
require_once "../../app/routes/Routes.php";

/* Errors */
$vErrorUserName     = false;
$vErrorPassLength   = false;
$vErrorRequiredFirstName    = false;
$vErrorRequiredLastName     = false;


if (isset($_POST['btnSubmit']) && !empty($_POST['btnSubmit'])) {

    /* Instantiating the Controller. */
    $Members = new MembersController;

    $vErrors = [];



    /* Sanitation $_POST */
    $vUserName      = filter_var($_POST['pUserName'], FILTER_SANITIZE_STRING);
    $vUserPassword  = filter_var($_POST['pUserPassword'], FILTER_SANITIZE_STRING);
    $vUserFirstName = filter_var($_POST['pUserFirstName'], FILTER_SANITIZE_STRING);
    $vUserLastName  = filter_var($_POST['pUserLastName'], FILTER_SANITIZE_STRING);



    /* Checking if the UserName is Available. */
    if (isset($vUserName)) {

        /* Validating the Form. */
        if ($Members->FCheckUserName($vUserName)) {

            $vErrorUserName = true;
            $vErrors = true;
        }
    }


    /* Checking if the password is a minimum of 6 characters. */
    if (isset($vUserPassword)) {

        /* Checking the Length. */
        (strlen($vUserPassword) < 6) ? $vErrorPassLength = true : false;

        /* Add Errors to the Array Errors. */
        ($vErrorPassLength === true) ? $vErrors = true : false;
    }


    /* Checking Required Fields. */
    (empty($vUserFirstName)) ? $vErrorRequiredFirstName = true : false;

    (empty($vUserLastName)) ? $vErrorRequiredLastName = true : false;

    /* Add Errors to the Array Errors. */
    (($vErrorRequiredFirstName === true) or ($vErrorRequiredLastName === true)) ? $vErrors = true : false;


    /* No Errors Submit the Form. */
    if (empty($vErrors)) {

        /* Saving the User Info. */
        $Members->FCRUDMember($_POST);

        /* Redirecting. */
        PRedirect('/index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="../assets/css/index.css">

    <title>User Sign</title>
</head>

<body>

    <div class="center">

        <h3 style="text-align: center;">User Sign</h3>

        <form action="" method="post" style="text-align: center;">

            <input type="hidden" name="pType" value="1">
            <input type="hidden" name="pUserID" value="0">

            <span class="span-error">* Required Fields</span>
            <br /><br />

            User Name: <br />
            <input type="text" name="pUserName" id="UserName" value="<?php echo isset($_POST['pUserName']) ? $_POST['pUserName'] : ''; ?>" autofocus>
            <br />
            <span class="span-error" id="UserName-validation" value=""><?php if ($vErrorUserName === true) {
                                                                            echo "This user name is Not Available";
                                                                        } ?></span>
            <br />

            Password: <br />
            <input type="password" name="pUserPassword" id="UserPassword" value="">
            <br />
            <span class="span-error" id="UserPassword-validation"><?php if ($vErrorPassLength === true) {
                                                                        echo "Password must have a minimum of 6 characters";
                                                                    } ?></span>
            <br />

            First name:<span class="span-error">*</span><br />
            <input type="text" name="pUserFirstName" value="<?php echo isset($_POST['pUserFirstName']) ? $_POST['pUserFirstName'] : ''; ?>">
            <br />
            <span class="span-error" id="UserFirstName-validation"><?php if ($vErrorRequiredFirstName === true) {
                                                                        echo "This is a Required Field.";
                                                                    } ?></span>
            <br>
            Last name:<span class="span-error">*</span><br />
            <input type="text" name="pUserLastName" value="<?php echo isset($_POST['pUserLastName']) ? $_POST['pUserLastName'] : ''; ?>">
            <br />
            <span class="span-error" id="UserLastName-validation"><?php if ($vErrorRequiredLastName === true) {
                                                                        echo "This is a Required Field.";
                                                                    } ?></span>
            <br>

            Email:<br />
            <input type="email" name="pUserEmail" id="UserEmail" value="<?php echo isset($_POST['pUserEmail']) ? $_POST['pUserEmail'] : ''; ?>">
            <span id="UserEmail-validation"></span>

            <br><br>
            <input type="submit" value="Submit" name="btnSubmit">

            <br /><br />
            <a style="text-decoration: none;" href="/member/login.php">Member Already? - <strong>Login</strong></a>
        </form>



    </div>



    <script type="text/javascript" src="../assets/js/functions.js"></script>
    <!-- <script type="text/javascript" src="../assets/js/index.js"></script> -->
</body>

</html> 