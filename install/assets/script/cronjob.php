<?php
include "../../../assets/script/DevTweaks.php";
if ($argc > 1) {
    switch ($argv[1]){
        case "representationplan":
            include_once getRoot()."/assets/script/convertRepresentationPlan";
            break;
        case "mensa":
            include_once getRoot()."/assets/script/convertMensa.php";
            break;
        case "checkUpdate":
            include_once getRoot()."/assets/script/checkUpdate.php";
            break;
        case "cleanUp":
            delete_old_files(getRoot()."/assets/files/mensa/", 30, time());
            break;
    }
} else {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        exec("schtasks /tn \"Uintern-PHPCron\" /sc hourly /tr ".PHP_BINARY." ".getRoot()."/assets/script/cronjob.php mensa");
        exec("schtasks /tn \"Uintern-PHPCron\" /sc hourly /tr ".PHP_BINARY." ".getRoot()."/assets/script/cronjob.php representationplan");
        exec("schtasks /tn \"Uintern-PHPCron\" /sc daily /tr ".PHP_BINARY." ".getRoot()."/assets/script/cronjob.php checkUpdate");
        exec("schtasks /tn \"Uintern-PHPCron\" /sc monthly /tr ".PHP_BINARY." ".getRoot()."/assets/script/cronjob.php cleanUp");
    } else {
        exec("echo -e \"`crontab -l`\n0 * * * * ".PHP_BINARY." ".getRoot()."/assets/script/cronjob.php mensa\" | crontab -");
        exec("echo -e \"`crontab -l`\n0 * * * * ".PHP_BINARY." ".getRoot()."/assets/script/cronjob.php representationplan\" | crontab -");
        exec("echo -e \"`crontab -l`\n0 0 * * * ".PHP_BINARY." ".getRoot()."/assets/script/cronjob.php mensa\" | crontab -");
        exec("echo -e \"`crontab -l`\n0 0 * 1-12 * ".PHP_BINARY." ".getRoot()."/assets/script/cronjob.php cleanUp\" | crontab -");
    }
}

exit;