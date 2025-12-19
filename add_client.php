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