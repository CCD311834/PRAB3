<?php session_start(); ?>
<!doctype html>
<html lang="nl">

<head>
    <title>Takenlijst B3</title>
    <?php require_once 'components/head.php'; ?>
</head>
<body>
    <?php require_once 'components/header.php'; ?>

    <img src="img/logo-big-v4.png" class="logobody" alt="logobody">
    <div class="container">
    <?php
    if(isset($_GET['msg']))
    {
        echo "<div class='msg'>" . $_GET['msg'] . "</div>";
    }
    ?>
    </div>
</body>

</html>
