<?php
include_once(dirname(__FILE__) . "/../../../assets/script/DevTweaks.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="Author" content="Max Klein">

    <title>Urspring Intranet ~ Feedback</title>

    <link rel="stylesheet" href="<?php echo getWebroot(); ?>/assets/css/reset.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Varela+Round">
    <link rel="stylesheet" href="<?php echo getWebroot(); ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?php echo getWebroot(); ?>/assets/css/stars.css">
</head>
<body>
<div id="header">
    <div class="wrp">
        <a href="<?php echo getWebroot(); ?>/index.php"><img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRztpbmL4J2kshBxqkuCHbsij_JhcYaQWq2VRmoUFZywpi6TK9xVw"
                    width="40" style="margin-top: 20px;"></a>
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
    <center><h2 id="h2small">Feedback</h2></center>
    <div class="wrp">
        <form method="post" action="<?php echo getWebroot() ?>/index.php?a=feedback" class="feedback">
            <div class="stars">
                <input type="radio" name="star" class="star-1" id="star-1"/>
                <label class="star-1" for="star-1">1</label>
                <input type="radio" name="star" class="star-2" id="star-2"/>
                <label class="star-2" for="star-2">2</label>
                <input type="radio" name="star" class="star-3" id="star-3"/>
                <label class="star-3" for="star-3">3</label>
                <input type="radio" name="star" class="star-4" id="star-4"/>
                <label class="star-4" for="star-4">4</label>
                <input type="radio" name="star" class="star-5" id="star-5"/>
                <label class="star-5" for="star-5">5</label>
                <span></span>
            </div>
            <br>
            <input name="subject" id="subject" placeholder="Betreff"><br><br>
            <textarea name="message" id="message" placeholder="Nachricht"></textarea><br><br>
            <button type="submit" class="bu">Absenden</button>
        </form>
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