<?php  
session_start();
if(!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: ../login.php?msg=$msg");
    exit;
}
require_once __DIR__.'/../backend/config.php';
date_default_timezone_set('Europe/Amsterdam'); // Ik zag dat de tijd 2 uur achterliep met het aanmaken van een taak, dus ik heb de tijdzone aangepast naar Amsterdam.
?>
<!doctype html>
<html lang="nl">

<head>
    <title>Taken / Nieuwe taak</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>
    <?php require_once __DIR__.'/../components/header.php'; ?>
    <div class="container">
        <h1>Nieuwe Taak</h1>
        <form action="<?php echo $base_url; ?>/backend/takenController.php" method="POST">
            <div class="form-group">
                <label for="taak">Taak</label>
                <input type="text" name="taak" id="taak" class="form-input">
            </div>
            <div class="form-group">
                <label for="beschrijving">Beschrijving</label>
                <input type="text" name="beschrijving" id="beschrijving" class="form-input">
            </div>
            <div class="form-group">
                <label for="afdeling">Afdelingen:</label>
                <select name="afdeling" id="afdeling" class="form-input" required>
                    <option value="">– kies een type –</option>
                    <option value="horeca">Horeca</option>
                    <option value="merchandise">Merchandise</option>
                    <option value="attracties">Attracties</option>
                </select>
            </div>
            <div class="form-group">
                <label for="taakgever">Taakgever</label>
                <input type="text" name="taakgever" id="taakgever" class="form-input">
            </div>
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="date" name="deadline" id="deadline">
            </div>
            <div class="form-group">
                <label for="voortgang">Voortgang:</label>
                <select name="voortgang" id="voortgang" class="form-input" required>
                    <option value="">– kies de voortgang –</option>
                    <option value="todo">Todo</option>
                    <option value="in progress">In progress</option>
                    <option value="done">Done</option>
                </select>
            </div>
            <div class="form-group">
                <label for="datum_aangemaakt">Aangemaakt op:</label>
                <input type="datetime-local" name="datum_aangemaakt" id="datum_aangemaakt" value="<?php echo date('Y-m-d\TH:i'); ?>" class="form-input" readonly>
            </div>
            <input type="submit" value="Verstuur melding">
            <input type="hidden" name="action" value="create">
        </form>
    </div>
</body>
</html>
