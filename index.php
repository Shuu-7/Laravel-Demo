<!DOCTYPE html>
<html>
    <head>
    <style>
        body {
            background-image: url('res/tg4.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/stylesheet.css"/>
        <title>
            Some title here
        </title>
    </head>
    <body>
        <?php
require 'templates/menu.php';
?>
        <script type='text/javascript' src='scripts/index.js'></script>
        <div class="main">
            <a href='skillRecords.php?page=0'><div class="skills">
                <?php require 'templates/slides.php';
?>
            </div></a>
            <a href=''><div class="weapon">
                <?php require 'templates/slidessec.php';
?>
                <script src='scripts/skillRecords.js'></script>
            </div></a>
        </div>
    </body>
</html>