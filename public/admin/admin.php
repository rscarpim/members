<?php


require_once "../../vendor/autoload.php";
require_once "../../app//helpers/helpers.php";
require_once "../../app/routes/Routes.php";

$vUserName = "";

$toPopulate;
$toReturn;

/* Checking if is Logged */
if (!empty($_SESSION)) {

    /* Setting the User Name. */
    $vUserName = $_SESSION['uUserName'];

    if ($_SESSION['isLoggedIn'] === 'true') {

        /* Bring all User's Data. */
        $vUsers = new MembersController;

        /* Return all Users, Array. */
        $toPopulate = $vUsers->FGetAllMembers();
    } else {

        /* Redirecting the User. */
        PRedirect('/member/login.php');
    }
} else {

    /* Redirecting the User. */
    PRedirect('/member/login.php');
}

/* Search for a User Name. */
if (isset($_POST['btnSearch']) && !empty($_POST['btnSearch'])) {

    /* Sanitizing. */
    $vSearch = filter_var($_POST['searchUserName'], FILTER_SANITIZE_STRING);

    /* IF there's a Valid Input Entered. */
    if (!empty($vSearch)) {

        /* Instantiating the Controller. */
        $User = new MembersController;

        /* Array */
        $toReturn = $User->FCheckUserName($vSearch);
    }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Portal</title>

    <link rel="stylesheet" type="text/css" href="../assets/css/index.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" rel="stylesheet" type="text/css" />
</head>

<body>



    <h1 class="animated zoomIn">Welcome <?php echo $vUserName;  ?><span><a class="btnLogout" href="/member/logout.php">LogOut</a></span></h1>
    <br />

    <div class="center">

        <h3>User's List</h3>
        <hr />

        <form method="post" accept-charset="UTF-8">


            <label for="searchUserName">Search for a User.</label>
            <input id="searchUserName" type="text" name="searchUserName" value="" placeholder='Enter the user name.' style="width: 320px;">
        </form>

        <br />
        <table id="TBUsersList">
            <thead>
                <tr>
                    <th class="align-text">#</th>
                    <th class="align-text">First Name</th>
                    <th class="align-text">Last Name</th>
                    <th class="align-text">User Name</th>
                    <th class="align-text">Email Address</th>
                </tr>
            </thead>
            <tbody>

                <?php 

                /* Counter */
                $i = 0;

                /* If There's Data. */
                if (count($toPopulate) > 0) {

                    /* Populating the Table.*/
                    foreach ($toPopulate as $key => $value) {

                        $i++;

                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . $value->u_user_first_name . "</td>";
                        echo "<td>" . $value->u_user_last_name . "</td>";
                        echo "<td>" . $value->u_user_name . "</td>";
                        echo "<td>" . $value->u_user_email . "</td>";
                        echo "<td style='width: 110px;'><button class='btnDelete'  data-id='" . $value->u_id . "'>Delete</button></td>";
                        echo "<td style='width: 110px;'><button class='btnSuccess' data-id='" . $value->u_id . "'>Update</button></td>";
                        echo "</tr>";
                    }

                    echo "<tr class='notfound'>";
                    echo "<td colspan='4'>No record found</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

    <script type=" text/javascript" src="../assets/js/index.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@7.32.2/dist/sweetalert2.all.min.js"></script>
</body>

</html> 