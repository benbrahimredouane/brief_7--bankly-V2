<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
include 'db.php';

if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $cin = mysqli_real_escape_string($conn, $_POST['cin']);

    $sql = "INSERT INTO clients (name, email, cin) VALUES ('$name', '$email', '$cin')";
    if (mysqli_query($conn, $sql)) {
        header("Location: list_clients.php");
    } else {
        $error = "Erreur: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
    body {
        font-family: sans-serif;
        background-color: #f4f4f4;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 50px;
    }

    h2 {
        color: #333;
        text-align: center;
    }

    form {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        width: 300px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box; 
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
    }

    button:hover {
        background-color: #218838;
    }

    a {
        margin-top: 15px;
        text-decoration: none;
        color: #007bff;
        font-size: 14px;
    }
</style>
    </head>
<body>
    <h2>Ajouter un Client</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Nom complet" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="text" name="cin" placeholder="CIN" required><br><br>
        <button type="submit" name="add">Enregistrer</button>
    </form>
    <a href="dashboard.php">Retour</a>
</body>
</html>