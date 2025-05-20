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
    <title>Voltooide Taken</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>
    <?php require_once __DIR__.'/../components/header.php'; ?>
    <div class="container">
        <h1>Voltooide Taken</h1>

        <?php
            require_once __DIR__.'/../backend/conn.php';
            $query = "SELECT taak, afdeling FROM taken WHERE voortgang = 'done'";
            $statement = $conn->prepare($query);
            $statement->execute();
            $doneTaken = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php if(count($doneTaken) > 0): ?> 
            <table>
                <tr>
                    <th>Taak</th>
                    <th>Afdeling</th>
                </tr>
                <?php foreach($doneTaken as $taak): ?>
                    <tr>
                        <td><?php echo $taak['taak']; ?></td>
                        <td><?php echo $taak['afdeling']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Er zijn geen voltooide taken.</p>
        <?php endif; ?>

        <b><a href="index.php">Terug naar alle taken</a></b>
    </div>
</body>
</html>
