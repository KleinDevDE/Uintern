<?php
include_once (dirname(__FILE__)."/../../../assets/script/DevTweaks.php");
include_once(dirname(__FILE__)."/../../../install/assets/script/sql.php");

$message = '';
if (isset($_POST['passwordAdmin']) || isset($_POST['passwordTeacher']) || isset($_POST['passwordStudent']) || isset($_POST['passwordAlturspringbund'])){
    if ($_POST['passwordAdmin'] != '') updatePassword("admin",$_POST['passwordAdmin']);
    if ($_POST['passwordTeacher'] != '')updatePassword("teacher", $_POST['passwordTeacher']);
    if ($_POST['passwordStudent'] != '') updatePassword("student", $_POST['passwordStudent']);
    if ($_POST['passwordAlturspringbund'] != '') updatePassword("alturspringbund", $_POST['passwordAlturspringbund']);
    $message = '<b>Passwort/Passwörter erfolgreich gespeichert!</b>';
}


?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="Author" content="Max Klein">

    <title>Urspring Intranet ~ Setup</title>

    <link rel="stylesheet" href="<?php echo getWebroot();?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo getWebroot();?>/assets/css/global.css">
    <link rel="stylesheet" href="<?php echo getWebroot();?>/install/assets/css/setup.css">
</head>
<body>
<div id="header">
    <div class="wrp">
        <ul id="mainNav">
            <li ><a href="?a=overview">
                    Startseite</a>
            </li>
            <li><a href="?a=representationplan">
                    Vertretungsplan</a>
            </li>
            <li class="active"><a href="?a=settings">
                    Einstellungen</a>
            </li>
            <li class="logout"><a href="?a=logout">
                    <font color="#ff3b36">Logout</font></a>
            </li>
        </ul>
    </div>
</div>
<div id="content">
    <div class="wrp" align="center">
        <?php echo $message?>
        <form class="install" action="<?php echo htmlspecialchars(getWebroot()."/admin/index.php?a=settings");?>" method="post">
            <p>Passwörter</p><br>
            <label >Admin</label><br>
            <input type="password" name="passwordAdmin" id="passwordAdmin">
            <img width="20" src="<?php echo getWebroot();?>/assets/img/Auge.png" onmouseover="mouseoverPass('passwordAdmin');" onmouseout="mouseoutPass('passwordAdmin');" /><br><br>

            <label>Lehrer</label><br>
            <input type="password" name="passwordTeacher" id="passwordTeacher">
            <img width="20" src="<?php echo getWebroot();?>/assets/img/Auge.png" onmouseover="mouseoverPass('passwordTeacher');" onmouseout="mouseoutPass('passwordTeacher');" /><br><br>

            <label>Schüler</label><br>
            <input type="password" name="passwordStudent" id="passwordStudent">
            <img width="20" src="<?php echo getWebroot();?>/assets/img/Auge.png" onmouseover="mouseoverPass('passwordStudent');" onmouseout="mouseoutPass('passwordStudent');" /><br><br>

            <label>Alturspringbund</label><br>
            <input type="password" name="passwordAlturspringbund" id="passwordAlturspringbund">
            <img width="20" src="<?php echo getWebroot();?>/assets/img/Auge.png" onmouseover="mouseoverPass('passwordAlturspringbund');" onmouseout="mouseoutPass('passwordAlturspringbund');" /><br><br>

            <label>SMV</label><br>
            <input type="password" name="passwordSMV" id="passwordSMV">
            <img width="20" src="<?php echo getWebroot();?>/assets/img/Auge.png" onmouseover="mouseoverPass('passwordSMV');" onmouseout="mouseoutPass('passwordSMV');" /><br><br><br>

            <button type="submit" class="blueBtn" id="submit">Übernehmen</button><br><br>
        </form>
    </div>
</div>
<div id="footer" class="blueBg">
    <a href="<?php echo getWebroot();?>/images.php">Fotodownload</a> |
    <a href="<?php echo getWebroot();?>/assets/files/download/Wochenendfreizeitplaner_SJ16-17.pdf">Wochenendfreizeitplanung</a> |
    <a href="<?php echo getWebroot();?>/assets/files/download/AG-Programm_SJ16-17.pdf">AG-Plan</a> |
    <a href="https://www.urspringschule.de/de/impressum/">Impressum</a>
</div>

<script type="text/javascript">
    function mouseoverPass(id) {
        var obj = document.getElementById(id);
        obj.type = "text";
    }
    function mouseoutPass(id) {
        var obj = document.getElementById(id);
        obj.type = "password";
    }
</script>
</body>
</html>