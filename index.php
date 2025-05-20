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
        <h1>Accounts</h1>

            <?php
                require_once 'backend/conn.php';
                $query = "SELECT * FROM users";
                $statement = $conn->prepare($query);
                $statement->execute();
                $users = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <table>
                <tr>
                    <th>Naam</th>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?php echo $user['naam']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['password']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
    </div>
</body>

</html>
