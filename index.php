<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once 'head.php'; ?>
</head>

<body>
    
    <div class="container">
    <h1>Users</h1>
        <a href="taken/create.php">Nieuwe tool &gt;</a>

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
