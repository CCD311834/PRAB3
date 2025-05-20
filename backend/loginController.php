<?php

session_start();
$username = $_POST['username'];
$password = $_POST['password'];

require_once 'conn.php';
$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([
    ':username' => $username
]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if($statement->rowCount() < 1)
{
    $error = "Account bestaat niet";
    header("Location: ../login.php?error=$error");
    exit;
}

if(!password_verify($password, $user['password']))
{
    $error = "Wachtwoord niet juist";
    header("Location: ../login.php?error=$error");
    exit;
}

$_SESSION['user_id'] = $user['id'];
$msg= "Ingelogd als $username";
header("Location: ../index.php?msg=$msg");

?>