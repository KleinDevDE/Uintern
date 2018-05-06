<?php
include_once (dirname(__FILE__)."/../../../assets/script/DevTweaks.php");
include_once (dirname(__FILE__)."/../../../install/assets/script/sql.php");
$errormessage = "";
debug();

if (isset($_POST['password'])){
    updatePassword($_POST['password']);
    unlink(getRoot()."/install/.resetAdmin");
    echo placePopup("success", "Passwort geändert", "Sie werden automatisch weitergeleitet, sollte dies nicht passieren <a href=\"".getWebroot()."/admin/index.php\">Klick mich</a>", false);
    header("refresh: 5; url=".getWebroot()."/admin/index.php");
}

?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="Author" content="Max Klein">

    <title>Urspring Intranet ~ Admin</title>

    <link rel="stylesheet" href="<?php echo getWebroot();?>/assets/css/reset.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Varela+Round">
    <link rel="stylesheet" href="<?php echo getWebroot();?>/assets/css/global.css">
</head>
<body>
<div id="header">
    <div class="wrp">
        <ul id="mainNav">
            <li><a href="https://urspringschule.de/">
                    Urspringschule</a>
            </li>
            <li><a href="https://urspringblog.de/">
                    Blog</a>
            </li>
            <li><a href="https://comenius.urspringschule.de/">
                    Comenius</a>
            </li>
            <li><a href="http://alturspringbund.de/">
                    Alturspringbund</a>
            </li>
        </ul>
    </div>
</div>
<div id="content">
    <center><h2 id="h2small">Interner Bereich ~ Admin</h2></center>
    <form class="login-form" action="<?php echo htmlspecialchars("index.php?resetAdmin");?>" method="post">
        <label>Neues Passwort</label><br>
        <input id="password" type="password" value="Passwort" onclick="if (this.value === 'Passwort') this.value = '';" name="password">
        <button type="submit">Passwort ändern</button>
    </form>
</div>
<div id="footer" class="blueBg">
    <a href="<?php echo getWebroot();?>/images.php">Fotodownload</a> |
    <a href="<?php echo getWebroot();?>/assets/files/download/Wochenendfreizeitplaner_SJ16-17.pdf">Wochenendfreizeitplanung</a> |
    <a href="<?php echo getWebroot();?>/assets/files/download/AG-Programm_SJ16-17.pdf">AG-Plan</a> |
    <a href="https://www.urspringschule.de/de/impressum/">Impressum</a>
</div>
</body>
</html>