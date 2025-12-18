<?php
session_start();
include 'db.php';

if (isset($_POST['connexion'])) {
    $user = $_POST['name'];
    $pass = $_POST['password'];

    
    $user = mysqli_real_escape_string($conn, $user);
    $pass = mysqli_real_escape_string($conn, $pass);

    $sql = "SELECT * FROM users WHERE name = '$user' AND password = '$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Identifiants invalides !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bankly V2 - Connexion</title>
</head>
<body>
    <h2>Connexion des Employés</h2>
    <form method="POST">
        <label>Utilisateur :</label><br>
        <input type="text" name="name" required><br><br>
        <label>Mot de passe :</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit" name="connexion">Se connecter</button>
    </form>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
</body>
</html>