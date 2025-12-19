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
        h2{
            margin-top:20% ;
            font-family:cursive;
            text-align:center;
        }

        form{
            border:2px solid red;
            display:flex;
            flex-direction:column;
            align-items:center;
            width: 50%;
            margin:auto;
            padding:12px;
            border-radius:11px;
            box-shadow:0 5px 5px red;
        }
        label{
            font-weight:bold;
            font-family:cursive;

        }
        input{
            border-radius:6px;
            padding:3px;
            
        }
        button{
            background-color: blue;
            color:white;
            padding:5px;
            border-radius:11px;
            border:0;
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
    <?php if(isset($error)) echo "<p style='color:red ;text-align:center; margin:5%; font-size:20px; font-weight:bold;'>$error</p>"; ?>
</body>
</html>