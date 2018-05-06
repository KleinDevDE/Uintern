<?php
include_once (dirname(__FILE__)."/../assets/script/DevTweaks.php");

if (isLoggedIn() && isAdmin()){
    if (isset($_GET['a'])){
        switch ($_GET['a']){
            case "overview":
                includeSite("overview");
                break;
            case "representationplan":
                if (isset($_POST) && $_POST != null) {
                    die("uploaded?<br>".$_POST);
                    //include_once getRoot() . "/assets/script/convertRepresentationPlan.php";
                }
                includeSite("representationplan");
                break;
            case "settings":
                includeSite("settings");
                break;
            case "logout":
                logout();
                break;
            default:
                includeSite("overview");
                break;
        }
    } else includeSite("overview");
} else include getRoot()."/admin/login.php";

