<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/* CONSTANTS. */
define('ABS_PATH_MODELS',           '../../app/models');

define('ABS_PATH_ROUTES',           '../../app/routes');

define("ABS_PATH_CONTROLLERS",      '../../app/controllers');

define("ABS_PATH_SRC",              '../../app/src');



/********************************************************************************************************************************************************/
/* INCLUDES */
/********************************************************************************************************************************************************/

require  ABS_PATH_MODELS . "/DBConnection.php";
require ABS_PATH_MODELS .  "/Model.php";

/* Setting the Routes. */
require_once ABS_PATH_ROUTES . "/Routes.php";

/* Password Hash*/
require_once ABS_PATH_SRC . "/Password.php";




/********************************************************************************************************************************************************/
/* FUNCTIONS */
/********************************************************************************************************************************************************/


function json($data)
{

    header('Content-Type: application/json');

    echo json_encode($data);
}


function addQuotes($str)
{
    return '"$str"';
}


function path()
{

    $vendorDIR = dirname(dirname(__FILE__));

    return dirname($vendorDIR);
}


/* Validating an Email */
function FValidateEmail($email)
{

    if (!isset($email)) {

        return;
    }

    return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
}


/* Redirect the Page */
function PRedirect($target)
{

    Redirect::PRedirect($target);

    die();
}

/* Return the Page back. */
function back()
{

    Redirect::back();

    die();
}



function FReturnTable($pData)
{

    $toReturn = "";

    $toReturn = "<table>";
    $toReturn .= "<thead>";
    $toReturn .= "<tr>";
    $toReturn .= "<th class='align-text'>#</th>";
    $toReturn .= "<th class='align-text'>First Name</th>";
    $toReturn .= "<th class='align-text'>Last Name</th>";
    $toReturn .= "<th class='align-text'>User Name</th>";
    $toReturn .= "<th class='align-text'>Email Address</th>";
    $toReturn .= "</tr>";
    $toReturn .= "</thead>";
    $toReturn .= "<tbody>";

    /* Counter */
    $i = 0;

    /* If There's Data. */
    if (count($toPopulate) > 0) {

        /* Populating the Table.*/
        foreach ($pData as $key => $value) {

            $i++;

            $toReturn .= "<tr>";
            $toReturn .= "<td>" . $i . "</td>";
            $toReturn .= "<td>" . $value->u_user_first_name . "</td>";
            $toReturn .= "<td>" . $value->u_user_last_name . "</td>";
            $toReturn .= "<td>" . $value->u_user_name . "</td>";
            $toReturn .= "<td>" . $value->u_user_email . "</td>";
            $toReturn .= "<td style='width: 110px;'><button class='btnDelete'  data-id='" . $value->u_id . "'>Delete</button></td>";
            $toReturn .= "<td style='width: 110px;'><button class='btnSuccess' data-id='" . $value->u_id . "'>Update</button></td>";
            $toReturn .= "</tr>";
        }

        $toReturn .= "</tbody>";
        $toReturn .= "</table>";
        return $toReturn;
    }
}









/********************************************************************************************************************************************************/
/* ROUTS */
/********************************************************************************************************************************************************/

/* Check the Model to be Called. */
if (isset($_POST['controller'])) {

    /* Switch According with the Controller Name passed as an Parameter. */
    switch ($_POST['controller']) {


            /*********************************************************************/
            /*  Members Controller */
            /*********************************************************************/
        case ('Members'):


            /* instantiate the Controller. */
            $Members = new MembersController;

            /* Swith Accordint with the Function Name. */
            switch ($_POST['function']) {

                    /* Get all Members. */
                case ('FGetAllMembers'):

                    print_r(json_encode($Members->FGetAllMembers()));
                    break;
            }
            break;

            break;
    }
}
