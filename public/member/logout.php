<?php
session_start();
session_destroy();

require_once "../../app//helpers/helpers.php";

/* Redirecting the User. */
PRedirect('/member/login.php');

