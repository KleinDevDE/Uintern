<?php
include getRoot()."/assets/script/convertRepresentationPlan.php";
?>


<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="Author" content="Max Klein">

    <title>Urspring Intranet ~ Vertretungsplan</title>

    <link rel="stylesheet" href="<?php echo getWebroot(); ?>/assets/css/reset.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Varela+Round">
    <link rel="stylesheet" href="<?php echo getWebroot(); ?>/assets/css/global.css">
</head>
<body>
<div id="header">
    <div class="wrp">
        <ul id="mainNav">
            <li><a href="?a=overview">
                    Startseite</a>
            </li>
            <li class="active"><a href="?a=representationplan">
                    Vertretungsplan</a>
            </li>
            <li><a href="?a=mensa">
                    Mensa</a>
            </li>
            <li><a href="?a=downloads">
                    Downloads</a>
                <ul>
                    <li><a href="?a=downloads&d=deka.pdf">Dekadenplan</a></li>
                    <li><a href="?a=downloads&d=klassen.pdf">Stundenplan</a></li>
                </ul>
            </li>
            <li class="logout"><a href="?a=logout">
                    <font color="#ff3b36">Logout</font></a>
            </li>
        </ul>
    </div>
</div>
<div id="content">
    <a href="?=downloads&d=Vertretungsplan.docx" class="buttonDownload" style="position: fixed">  Download (PDF)</a>
    <div class="wrp">
        <div class="representationplan" align="center">
            <?php
            include_once getRoot() . "/assets/files/vertretungsplan/Vertretungsplan.html";
            ?>
        </div>
    </div>
</div>
<div id="footer" class="blueBg">
    <a href="<?php echo getWebroot(); ?>/images.php">Fotodownload</a> |
    <a href="<?php echo getWebroot(); ?>/assets/files/download/Wochenendfreizeitplaner_SJ16-17.pdf">Wochenendfreizeitplanung</a>
    |
    <a href="<?php echo getWebroot(); ?>/assets/files/download/AG-Programm_SJ16-17.pdf">AG-Plan</a> |
    <a href="https://www.urspringschule.de/de/impressum/">Impressum</a>
</div>
</body>
</html>