<?php
include_once (dirname(__FILE__)."/../assets/script/DevTweaks.php");
if (isset($_GET['resetAdmin']) && file_exists(getRoot()."/install/.resetAdmin") && file_exists(getRoot()."/install/.locked")){
    include_once(getRoot()."/install/assets/sites/resetAdmin.php");
    exit;
}

if (file_exists(getRoot()."/install/.locked")){
    include_once(getRoot()."/install/assets/sites/AlreadyInstalled.php");
} else include_once(getRoot()."/install/assets/sites/install.php");