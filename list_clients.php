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
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 40px;
        background-color: #f9f9f9;
    }

    nav {
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
    }

    nav a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse; 
        background-color: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    th, td {
        text-align: left;
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
        text-transform: uppercase;
        font-size: 13px;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>
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