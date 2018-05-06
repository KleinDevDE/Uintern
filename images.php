<?php
include_once (dirname(__FILE__)."/assets/script/DevTweaks.php");
include_once (dirname(__FILE__)."/assets/script/Images.php");
isInstalled();
debug();

if (!isset($_GET['t']))
    header("Location: ".getWebroot()."/images.php?t=review");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="Author" content="Max Klein">

    <title>Urspring Intranet ~ Login</title>

    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Varela+Round">
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
<div id="header">
    <div class="wrp">
        <a href="<?php echo getWebroot();?>/index.php"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRztpbmL4J2kshBxqkuCHbsij_JhcYaQWq2VRmoUFZywpi6TK9xVw" width="40" style="margin-top: 20px;"></a>
        <ul id="mainNav">
            <li><a href="<?php echo getWebroot();?>/images.php?t=review">
                    Rückblick</a>
            </li>
            <li><a href="<?php echo getWebroot();?>/images.php?t=chronik">
                    Blog</a>
            </li>
            <li><a href="<?php echo getWebroot();?>/images.php?t=summerparty">
                    Sommerfest</a>
            </li>
            <li><a href="<?php echo getWebroot();?>/images.php?t=others">
                    Sonstiges</a>
            </li>
        </ul>
    </div>
</div>
<div id="content">

</div>
<div id="footer" class="blueBg">
    <a href="images.php">Fotodownload</a> |
    <a href="assets/files/download/Wochenendfreizeitplaner_SJ16-17.pdf">Wochenendfreizeitplanung</a> |
    <a href="assets/files/download/AG-Programm_SJ16-17.pdf">AG-Plan</a> |
    <a href="https://www.urspringschule.de/de/impressum/">Impressum</a> |
    <a href="/index.php?a=feedback" id="feedbackFooter">Feedback</a>
</div>
</body>
</html>