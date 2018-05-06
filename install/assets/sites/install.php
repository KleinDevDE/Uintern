<?php
include_once (dirname(__FILE__)."/../../../assets/script/DevTweaks.php");
include_once(dirname(__FILE__)."/../../../install/assets/script/sql.php");

$errormessage = '';
if (isset($_POST['passwordAdmin'])){
    createTables();
    setPassword("admin",$_POST['passwordAdmin']);
    setPassword("teacher", $_POST['passwordTeacher']);
    setPassword("student", $_POST['passwordStudent']);
    setPassword("alturspringbund", $_POST['passwordAlturspringbund']);
    file_put_contents(getRoot()."/install/.locked", 'Do not remove if you dont know what you do');
    echo placePopup("success", "Installation abgeschlossen", "Sie werden automatisch weitergeleitet, sollte dies nicht passieren <a href=\"".getWebroot()."/index.php\">Klick mich</a>", false);
    header("refresh:5; url=".getWebroot()."/index.php");
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
    <div class="wrp" align="center">
        <center><h1>Installation</h1></center>
        <form class="install" action="<?php echo htmlspecialchars(getWebroot()."/install/index.php");?>" method="post">
            <p>Passwörter</p><br>
            <label >Admin</label><br>
            <input type="password" required name="passwordAdmin" id="passwordAdmin">
            <img width="20" src="<?php echo getWebroot();?>/assets/img/Auge.png" onmouseover="mouseoverPass('passwordAdmin');" onmouseout="mouseoutPass('passwordAdmin');" /><br><br>

            <label>Lehrer</label><br>
            <input type="password" required name="passwordTeacher" id="passwordTeacher">
            <img width="20" src="<?php echo getWebroot();?>/assets/img/Auge.png" onmouseover="mouseoverPass('passwordTeacher');" onmouseout="mouseoutPass('passwordTeacher');" /><br><br>

            <label>Schüler</label><br>
            <input type="password" required name="passwordStudent" id="passwordStudent">
            <img width="20" src="<?php echo getWebroot();?>/assets/img/Auge.png" onmouseover="mouseoverPass('passwordStudent');" onmouseout="mouseoutPass('passwordStudent');" /><br><br>

            <label>Alturspringbund</label><br>
            <input type="password" required name="passwordAlturspringbund" id="passwordAlturspringbund">
            <img width="20" src="<?php echo getWebroot();?>/assets/img/Auge.png" onmouseover="mouseoverPass('passwordAlturspringbund');" onmouseout="mouseoutPass('passwordAlturspringbund');" /><br><br>

            <button type="submit" class="blueBtn" id="submit">Installation abschließen</button><br><br>
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