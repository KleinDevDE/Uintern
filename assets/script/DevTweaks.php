<?php
session_start();
$debug = false;

function login($password)
{
    $sql = new PDO("sqlite:".getRoot()."/data.db");
    $result = $sql->prepare('SELECT * FROM accounts;');
    $result->execute();
    foreach ($result as $row) {
        if (password_verify($password, $row['password'])) {
            switch ($row['account_type']){
                case "teacher":
                    $_SESSION['type'] = "teacher";
                    $_SESSION['timestamp'] = time();
                    header("Location: ".getWebroot()."/index.php");
                    break;
                case "student":
                    $_SESSION['type'] = "student";
                    $_SESSION['timestamp'] = time();
                    header("Location: ".getWebroot()."/index.php");
                    break;
                case "alturspringbund":
                    $_SESSION['type'] = "alturspringbund";
                    $_SESSION['timestamp'] = time();
                    header("Location: ".getWebroot()."/index.php");
                    break;
                default:
                    break;
            }
        }
    }
    return '<text id="error">Passwort ungültig!</text>';
}

function admin_login($password){
    $sql = new PDO("sqlite:".getRoot()."/data.db");
    $result = $sql->prepare('SELECT * FROM accounts WHERE account_type=\'admin\';');
    $result->execute();
    foreach ($result as $row) {
        if (password_verify($password, $row['password'])) {
                    $_SESSION['type'] = "admin";
                    $_SESSION['timestamp'] = time();
                    header("Location: ".getWebroot()."/index.php");
        }
    }
    return '<text id="error">Passwort ungültig!</text>';
}

function logout()
{
    unset($_SESSION['type']);
    session_destroy();
    header("Location: ".getWebroot()."/index.php");
    header("Location: ".getWebroot()."/index.php");
}

function isLoggedIn()
{
    return isset($_SESSION['type']);
}

function isStudent()
{
    if (isset($_SESSION['type'])) {
        return $_SESSION['type'] == "student";
    } else return false;
}

function isTeacher()
{
    if (isset($_SESSION['type'])) {
        return $_SESSION['type'] == "teacher";
    } else return false;
}

function isAltUrspringBund()
{
    if (isset($_SESSION['type'])) {
        return $_SESSION['type'] == "alturspringbund";
    } else return false;
}

function redirect($site)
{
    if (isLoggedIn()) {
        switch ($_SESSION['type']) {
            case "student":
                switch ($site) {
                    case "overview":
                        header("Location: ".getWebroot()."/index.php?a=overview");
                        break;
                    case "representationplan":
                        header("Location: ".getWebroot()."/index.php?a=representationplan");
                        break;
                    case "downloads":
                        header("Location: ".getWebroot()."/index.php?a=downloads");
                        break;
                    case "mensa":
                        header("Location: ".getWebroot()."/index.php?a=mensa");
                        break;
                }
                break;
            case "teacher":
                switch ($site) {
                    case "overview":
                        header("Location: ".getWebroot()."/index.php?a=overview");
                        break;
                    case "representationplan":
                        header("Location: ".getWebroot()."/index.php?a=representationplan");
                        break;
                    case "downloads":
                        header("Location: ".getWebroot()."/index.php?a=downloads");
                        break;
                }
                break;
            case "alturspringbund":
                switch ($site) {
                    case "overview":#
                        header("Location: ".getWebroot()."/index.php?a=overview");
                        break;
                    case "downloads":
                        header("Location: ".getWebroot()."/index.php?a=downloads");
                        break;
                }
                break;
            case "admin":
                switch ($site) {
                    case "overview":
                        header("Location: ".getWebroot()."/admin/index.php?a=overview");
                        break;
                    case "representationplan":
                        header("Location: ".getWebroot()."/admin/index.php?a=representationplan");
                        break;
                    case "settings":
                        header("Location: ".getWebroot()."/admin/index.php?a=settings");
                        break;
                }
                break;
            default:
                header("Location: index.php?a=error");
                break;
        }
    } else if ($site == "login") header("Location: login.php");
}

function includeSite($site)
{
    if (isLoggedIn()) {
        switch ($_SESSION['type']) {
            case "student":
                switch ($site) {
                    case "overview":
                        include getRoot()."/assets/sites/student/overview.php";
                        break;
                    case "representationplan":
                        include_once getRoot()."/assets/sites/student/representationplan.php";
                        break;
                    case "mensa":
                        include_once getRoot()."/assets/sites/student/mensa.php";
                        break;
                    case "downloads":
                        include_once getRoot()."/assets/sites/student/downloads.php";
                        break;
                    case "logout":
                        logout();
                        break;
                    default:
                        include_once getRoot()."/assets/sites/student/overview.php";
                        break;
                }
                break;
            case "teacher":
                switch ($site) {
                    case "overview":
                        include_once getRoot()."/assets/sites/teacher/overview.php";
                        break;
                    case "representationplan":
                        include_once getRoot()."/assets/sites/teacher/representationplan.php";
                        break;
                    case "downloads":
                        include_once getRoot()."/assets/sites/teacher/downloads.php";
                        break;
                    case "mensa":
                        include_once getRoot()."/assets/sites/teacher/mensa.php";
                        break;
                    case "logout":
                        logout();
                        break;
                    default:
                        include_once getRoot()."/assets/sites/teacher/overview.php";
                        break;
                }
                break;
            case "alturspringbund":
                switch ($site) {
                    case "overview":
                        include_once getRoot()."/assets/sites/alturspringbund/overview.php";
                        break;
                    case "downloads":
                        include_once getRoot()."/assets/sites/alturspringbund/downloads.php";
                        break;
                    case "mensa":
                        include_once getRoot()."/assets/sites/alturspringbund/mensa.php";
                        break;
                    case "logout":
                        logout();
                        break;
                    default:
                        include_once getRoot()."/assets/sites/alturspringbund/overview.php";
                        break;
                }
                break;
            case "admin":
                switch($site){
                    case "overview":
                        include_once(getRoot()."/admin/assets/sites/overview.php");
                        break;
                    case "representationplan":
                        include_once(getRoot()."/admin/assets/sites/representationplan.php");
                        break;
                    case "settings":
                        include_once(getRoot()."/admin/assets/sites/settings.php");
                        break;
                    case "mensa":
                        include_once getRoot()."/admin/assets/sites/mensa.php";
                        break;
                    case "logout":
                        logout();
                        break;
                    default:
                        include_once(getRoot()."/admin/assets/sites/overview.php");
                        break;
                }
                break;
        }
        if ($site == "login") die("Called Login, but already logged in!<br>");
    } else if ($site == "login") header("Location: ".getWebroot()."/login.php");
}

function isAdmin()
{
    return $_SESSION['type'] == "admin";
}

function checkTimeStamp()
{
    if (isset($_SESSION['timestamp'])) {
        if ($_SESSION['timestamp'] + (60 * 15) < time()) {
            echo placePopup("timeout", "Information", "Sie wurden nach 15 Minuten automatisch ausgeloggt<br>Automatische Weiterleitung in wenigen Sekunden, sollte dies nicht pasieren <a href=\"https://comenius.urspringschule.de/urspring\">Klick mich</a>");
            session_destroy();
            header("refresh:8; url=" . getWebroot() . "/index.php");
        } else $_SESSION['timestamp'] = time();
    }
}

function downloadDirectly($filename)
{
    $file = getRoot() . "/assets/files/download/" . $filename;
    $size = filesize($file);
    header('Content-Description: File Transfer');
    header("Content-Type: application/force-download");
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit();
}


function getValue($key)
{
    $sql = new SQLite3("data.db");
}

function isInstalled()
{
    // Prüfe zudem ob Datenbank existent ist.
    // Wenn nicht & .locked existent ist, leite auf NoDatabase.php
    if (!file_exists(getRoot()."/install/.locked")) {
        include(getRoot()."/install/assets/sites/NotInstalled.php");
        exit;
    }
    return true;
}

function debug(){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $debug = true;
}
function placePopup($name, $title, $content, $closeable)
{
    if ($closeable)
        return '       <div id="' . $name . '" class="overlay">
            <div class="popup">
                <h2>' . $title . '</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                    ' . $content . '
                </div>
            </div>
        </div>';
    else return '        <div id="' . $name . '" class="overlay">
            <div class="popup">
                <h2>' . $title . '</h2>
                <div class="content">
                    ' . $content . '
                </div>
            </div>
        </div>';
}

function getWebroot(){
    // Load the absolute server path to the directory the script is running in
    $fileDir = dirname(__FILE__);

// Make sure we end with a slash
    if (substr($fileDir, -1) != '/') {
        $fileDir .= '/';
    }

// Load the absolute server path to the document root
    $docRoot = $_SERVER['DOCUMENT_ROOT'];

// Make sure we end with a slash
    if (substr($docRoot, -1) != '/') {
        $docRoot .= '/';
    }

// Remove docRoot string from fileDir string as subPath string
    $subPath = preg_replace('~' . $docRoot . '~i', '', $fileDir);

// Add a slash to the beginning of subPath string
    $subPath = '/' . $subPath;
    $subPath = str_replace('/assets/script/', '', $subPath);

// Test subPath string to determine if we are in the web root or not
    if ($subPath == '/') {
        // if subPath = single slash, docRoot and fileDir strings were the same
        return $_SERVER['SERVER_NAME'];
    } else {
        // Anyting else means the file is running in a subdirectory
         return "https://" . $_SERVER['SERVER_NAME'].$subPath;
    }
}

function getRoot(){
    // Load the absolute server path to the directory the script is running in
    $fileDir = dirname(__FILE__);

// Make sure we end with a slash
    if (substr($fileDir, -1) != '/') {
        $fileDir .= '/';
    }

// Load the absolute server path to the document root
    $docRoot = $_SERVER['DOCUMENT_ROOT'];

// Make sure we end with a slash
    if (substr($docRoot, -1) != '/') {
        $docRoot .= '/';
    }

// Remove docRoot string from fileDir string as subPath string
    $subPath = preg_replace('~' . $docRoot . '~i', '', $fileDir);

// Add a slash to the beginning of subPath string
    $subPath = '/' . $subPath;
    $subPath = str_replace('/assets/script/', '', $subPath);
    $subPath = str_replace('\\assets\\script\\', '', $subPath);

// Test subPath string to determine if we are in the web root or not
    if ($subPath == '/') {
        // if subPath = single slash, docRoot and fileDir strings were the same
        return $_SERVER['DOCUMENT_ROOT'];
    } else {
        // Anyting else means the file is running in a subdirectory
        return $_SERVER['DOCUMENT_ROOT'].$subPath;
    }
}


function URLexists($url){
    $file_headers = @get_headers($url);
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        return false;
    }
    else {
        return true;
    }
}

function delete_old_files ($path, $days, $tmsp) {
    $files = glob($path.'*');
    $i=0;
    $res = array();
    foreach ($files as $file) {
        if (!is_dir($file) && $file != '.' && $file != '..'){
            $time_limit = $tmsp-(36000*24*$days);
            if(@filemtime($path.$file) >= $time_limit){
                $res[$i]['name'] = $file;
                if (@unlink($path.$file)) { $res[$i]['status'] = 'ok'; } else { $res[$i]['status'] = 'error'; }
                $i++;
            }
        }
}
    return $res;
}

function SQLITE_getSetting($setting){
    $sql = new PDO("sqlite:".getRoot()."/data.db");
    $result = $sql->query('SELECT * FROM settings;');
    foreach ($result as $row) {
        if ($row['setting'] == $setting) {
            return $row['content'];
        }
    }
    return null;
}

function SQLITE_setSetting($setting, $content){
    $sql = new PDO("sqlite:".getRoot()."/data.db");
    $sql->exec("insert or replace into settings values (null, \"$setting\", \"$content\");");
}

/**
 * @param string $file - eg. filename
 * @param string $name - The name of the file
 * @param string - All 0 | Teacher 1 | Student 2 | Alturspingbund 3
 * @return bool
 */
function SQLITE_setFile(string $file, string $name, string $permission){
    $sql = new PDO("sqlite:".getRoot()."/data.db");
    return boolval($sql->exec("insert or replace into files values (null, \"$file\", \"$name\", \"$permission\");"));
}

/**
 * @param string $file - eg. filename
 * @return array - returns the Permission (0|1|2|3) | null if no Key found
 */
function SQLITE_getFileProperties(string $file){
    $sql = new PDO("sqlite:".getRoot()."/data.db");
    $result = $sql->query('SELECT * FROM files;');
    foreach ($result as $row) {
        if ($row['file'] == $file) {
            return array(
                "file" => $row['file'],
                "name" => $row['filename'],
                "permissions" => str_split($row['permission'], 1)
            );
        }
    }
    return null;
}