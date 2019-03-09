<?php

    /* Route for Model */
    require_once ABS_PATH_MODELS .          "/Model.php";

    /* Route for Members Controller/Model. */
    require_once ABS_PATH_CONTROLLERS .     "/MembersController.php";
    require_once ABS_PATH_MODELS .          "/MembersModel.php";  


    /* Route for Login Controller/Model. */
    require_once ABS_PATH_CONTROLLERS .     "/LoginController.php";
    require_once ABS_PATH_MODELS .          "/LoginModel.php";  


    /* Route for Login Function. */
    require_once ABS_PATH_SRC .             "/Login.php"; 

    /* Route for Redirect Function. */
    require_once ABS_PATH_SRC .             "/Redirect.php";     