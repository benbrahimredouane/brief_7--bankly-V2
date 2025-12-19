<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM clients");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des Clients</title>
</head>
<body>
    <nav><a href="dashboard.php">Dashboard</a> | <a href="add_client.php">Ajouter Client</a></nav>
    <h2>Liste des Clients</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>CIN</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['client_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['cin']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>