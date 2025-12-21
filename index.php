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
   <style>
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f7f6;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    h2 {
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    
    form {
        background: white;
        border: 1px solid #ddd;
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 400px;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #555;
    }

    input {
        border-radius: 6px;
        padding: 12px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    input:focus {
        border-color: #007bff;
        outline: none;
    }

    button {
        background-color: #007bff;
        color: white;
        padding: 12px;
        border-radius: 8px;
        border: none;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    
    .error-msg {
        color: #d9534f;
        background-color: #f2dede;
        border: 1px solid #ebccd1;
        padding: 10px;
        border-radius: 6px;
        margin-top: 20px;
        width: 100%;
        max-width: 400px;
        text-align: center;
        box-sizing: border-box;
    }
</style>
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
    <?php if(isset($error)) echo "<p class='error-msg' >$error</p>"; ?>
</body>
</html>