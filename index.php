<?php
require_once(dirname(__FILE__)."/assets/script/DevTweaks.php");
isInstalled();

if (isLoggedIn()) {
    if (isset($_GET['a'])) {
        includeSite($_GET['a']);
        checkTimeStamp();
    } else redirect("overview");
} else if (isset($_GET['a'])) {
    if ($_GET['a'] == "feedback")
        include_once getRoot()."/assets/sites/public/feedback.php";
    checkTimeStamp();
} else redirect("login");