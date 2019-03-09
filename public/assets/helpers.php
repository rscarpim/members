<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



/********************************************************************************************************************************************************/
/* ROUTS */
/********************************************************************************************************************************************************/

/* Check the Model to be Called. */
if(isset($_POST['controller'])){

    /* Switch According with the Controller Name passed as an Parameter. */
    switch($_POST['controller']){


        /*********************************************************************/
        /*  Members Controller */
        /*********************************************************************/ 
        case('Members'):


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