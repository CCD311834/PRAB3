<?php

session_start();
if(!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: ../login.php?msg=$msg");
    exit;
}
require_once 'config.php'; 

$action = $_POST['action'];

if ($action == 'create'){
    $taak = $_POST['taak'];
    $afdeling = $_POST['afdeling'];
    $beschrijving = $_POST['beschrijving'];
    $taakgever = $_POST['taakgever'];
    if(empty($_POST['deadline'])){
        $deadline = null;
    } else {
        $deadline = $_POST['deadline'];
    }
    $datum_aangemaakt = $_POST['datum_aangemaakt'];
    $voortgang = $_POST['voortgang'];

    require_once 'conn.php';
    $query = "INSERT INTO taken (taak, afdeling, beschrijving, taakgever, deadline, datum_aangemaakt, voortgang)
    VALUES(:taak, :afdeling, :beschrijving, :taakgever, :deadline, :datum_aangemaakt, :voortgang)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":taak" => $taak,
        ":afdeling" => $afdeling,
        ":beschrijving" => $beschrijving,
        ":taakgever" => $taakgever,
        ":deadline" => $deadline,
        ":datum_aangemaakt" => $datum_aangemaakt,
        ":voortgang" => $voortgang
    ]);

    if(empty($taak))
    {
        $errors[] = "Vul de taak in.";
    }
    if(empty($afdeling))
    {
        $errors[] = "Kies de afdeling.";
    }
    if(isset($errors))
    {
    var_dump($errors);
    die();
    }

    header("Location: ../taken/index.php?msg=Taak opgeslagen");
}

if ($action == 'update'){
    $id = $_POST['id'];
    $beschrijving = $_POST['beschrijving'];
    if(empty($_POST['deadline'])){
        $deadline = null;
    } else {
        $deadline = $_POST['deadline'];
    }
    $voortgang = $_POST['voortgang'];
    $action = $_POST['action'];

    require_once 'conn.php';
    $query = "UPDATE taken 
    SET beschrijving = :beschrijving, deadline = :deadline, voortgang = :voortgang  WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":beschrijving" => $beschrijving,
        ":deadline" => $deadline,
        ":voortgang" => $voortgang,
        ":id" => $id
        ]);

    header("Location: ../taken/index.php?msg=Melding aangepast");
}
