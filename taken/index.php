<?php 
session_start();
if(!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: ../login.php?msg=$msg");
    exit;
}
require_once __DIR__.'/../backend/config.php'; 
?>
<!doctype html>
<html lang="nl">

<head>
    <title>Taken</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>
    <?php require_once __DIR__.'/../components/header.php'; ?>
    <div class="container">
        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>
        <h1>Taken</h1>
        <b><a href="create.php">Nieuwe taak &gt;</a></b>

        <?php
            require_once '../backend/conn.php';
            $query = "SELECT * FROM taken WHERE voortgang <> 'done' ORDER BY deadline";
            $statement = $conn->prepare($query);
            $statement->execute();
            $taken = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table>
            <tr>
                <th>Taak</th>
                <th>Beschrijving</th>
                <th>Afdeling</th>
                <th>Taakgever</th>
                <th>Deadline</th>
                <th>Datum aangemaakt</th>
                <th>Voortgang</th>
                <th>Verwijderen</th>
                <th>Aanpassen</th>
            </tr>
            <?php foreach($taken as $taak): ?>
                <tr>
                    <td><?php echo $taak['taak']; ?></td>
                    <td><?php echo $taak['beschrijving']; ?></td>
                    <td><?php echo $taak['afdeling']; ?></td>
                    <td><?php echo $taak['taakgever']; ?></td>
                    <td><?php echo $taak['deadline']; ?></td>
                    <td><?php echo $taak['datum_aangemaakt']; ?></td>
                    <td><?php echo $taak['voortgang']; ?></td>
                    <td><a href="delete.php?id=<?php echo $taak['id'];?>">verwijderen</a></td>
                    <td><a href="edit.php?id=<?php echo $taak['id'];?>">aanpassen</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <b><a href="done.php">Alle voltooide taken</a></b>
    </div>

</body>

</html>