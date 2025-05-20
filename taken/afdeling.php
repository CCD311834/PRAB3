<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: ../login.php?msg=$msg");
    exit;
}

$afdelingen = ['horeca', 'attracties', 'merchandise'];
if (!isset($_GET['afdeling']) || !in_array($_GET['afdeling'], $afdelingen)) {
    header("Location: index.php?msg=Ongeldige afdeling");
    exit;
}

$afdeling = $_GET['afdeling'];

require_once __DIR__.'/../backend/config.php';
?>
<!doctype html>
<html lang="nl">

<head>
    <title>Taken - Afdeling <?php echo $afdeling; ?></title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>
    <?php require_once __DIR__.'/../components/header.php'; ?>
    <div class="container">
        <h1>Taken voor afdeling: <?php echo $afdeling; ?></h1>

        <?php
            require_once __DIR__.'/../backend/conn.php';
            $query = "SELECT * FROM taken WHERE afdeling = :afdeling ORDER BY CASE WHEN deadline IS NULL THEN 1 ELSE 0 END, deadline";
            $statement = $conn->prepare($query);
            $statement->execute([':afdeling' => $afdeling]);
            $taken = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php if(count($taken) > 0): ?>
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
        <?php else: ?>
            <p>Er zijn geen taken voor deze afdeling.</p>
        <?php endif; ?>
        
        <b><a href="index.php">Terug naar alle taken</a></b>
    </div>
</body>

</html>
