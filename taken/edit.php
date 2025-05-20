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
    <title>Taken / Aanpassen</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>
    <?php require_once __DIR__.'/../components/header.php'; ?>
    <div class="container">
        <form action="<?php echo $base_url; ?>/backend/takenController.php" method="POST">
            <?php
                require_once __DIR__.'/../backend/conn.php';
                $id = $_GET['id'];
                $query = "SELECT * FROM taken  WHERE id = :id";
                $statement = $conn->prepare($query);
                $statement->execute([":id" => $id]);
                $taken = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach($taken as $taak): ?>
                <h1>Taak #<?php echo $taak['id']; ?> aanpassen</h1>
                <div class="form-group">
                    <label for="user">User:</label>
                    <input type="text" name="user" id="user" value="<?php echo $taak['user']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="taak">Taak:</label>
                    <input type="text" name="taak" id="taak" value="<?php echo $taak['taak']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="beschrijving">Beschrijving:</label>
                    <textarea name="beschrijving" rows="5" cols="50"><?php echo $taak['beschrijving']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="afdeling">Afdelingen:</label>
                    <select name="afdeling" id="afdeling" required>
                        <option value="horeca" <?php if($taak['afdeling'] === 'horeca') echo 'selected'; ?>>horeca</option>
                        <option value="attracties" <?php if($taak['afdeling'] === 'attracties') echo 'selected'; ?>>attracties</option>
                        <option value="merchandise" <?php if($taak['afdeling'] === 'merchandise') echo 'selected'; ?>>merchandise</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="taakgever">Taakgever:</label>
                    <?php echo $taak['taakgever']; ?>
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline:</label>
                    <input type="date" name="deadline" id="deadline" value="<?php echo $taak['deadline']; ?>">
                </div>
                <div class="form-group">
                    <label for="voortgang">Voortgang:</label>
                    <select name="voortgang" id="voortgang" required>
                        <option value="<?php echo $taak['voortgang']; ?>"><?php echo $taak['voortgang']; ?></option>
                        <option value="todo">Todo</option>
                        <option value="in progress">In progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="datum_aangemaakt">Aangemaakt op:</label>
                    <?php echo $taak['datum_aangemaakt']; ?>
                </div>
            <?php endforeach; ?>

            <input type="submit" value="Verstuur aanpassing">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </form>
    </div>
</body>

</html>
