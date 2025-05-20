<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/loginstyle.css">
    <title>Login</title>
</head>
<body>
    <?php 
    session_start();
    if(isset($_SESSION['user_id'])) {
        $msg = "Je bent al ingelogd!";
        header("Location: index.php?msg=$msg");
        exit;
    }
    if(isset($_GET['error'])) {
        $msg = $_GET['error'];
        header("msg=$msg");
    }
    ?>
    <h1>Login</h1>
    <form action="backend/loginController.php" method="post">
        <label for="username">Username:</label>
        <input type="username" name="username" id="username">
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

        <input type="submit" value="login">
    </form>
</body>
</html>
