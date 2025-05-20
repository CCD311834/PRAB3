<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: ../login.php?msg=$msg");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php?msg=Geen taak geselecteerd");
    exit;
}

$id = $_GET['id'];
require_once __DIR__.'/../backend/conn.php';

$query = "DELETE FROM taken WHERE id = :id";
$statement = $conn->prepare($query);
$statement->execute([":id" => $id]);
header("Location: index.php?msg=Taak verwijderd");
exit;
