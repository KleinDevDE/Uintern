<?php
?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="Author" content="Max Klein">

    <title>Urspring Intranet ~ Admin</title>

    <link rel="stylesheet" href="<?php echo getWebroot(); ?>/assets/css/reset.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Varela+Round">
    <link rel="stylesheet" href="<?php echo getWebroot(); ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?php echo getWebroot(); ?>/admin/assets/css/spinner1.css">
    <link rel="stylesheet" href="<?php echo getWebroot(); ?>/admin/assets/css/upload6.css">
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
            <li><a href="?a=settings">
                    Einstellungen</a>
            </li>
            <li class="logout"><a href="?a=logout">
                    <font color="#ff3b36">Logout</font></a>
            </li>
        </ul>
    </div>
</div>
<div id="content">
    <div class="wrp">
        <form action="index.php?a=representationplan" method="POST">
            <input type="file" multiple>
            <p>Drag your files here or click in this area.</p>
            <button type="submit">Upload</button>
        </form>
            <?php if(isset($_POST['files'])){
                echo '        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>';
            }
            print_r($_POST);
            ?>
    </div>

</div>
<div id="footer" class="blueBg">
    <a href="<?php echo getWebroot(); ?>/images.php">Fotodownload</a> |
    <a href="<?php echo getWebroot(); ?>/assets/files/download/Wochenendfreizeitplaner_SJ16-17.pdf">Wochenendfreizeitplanung</a>
    |
    <a href="<?php echo getWebroot(); ?>/assets/files/download/AG-Programm_SJ16-17.pdf">AG-Plan</a> |
    <a href="https://www.urspringschule.de/de/impressum/">Impressum</a>

    <script src="<?php echo getWebroot(); ?>/admin/assets/js/upload.js" ></script>
</div>
</body>
</html>