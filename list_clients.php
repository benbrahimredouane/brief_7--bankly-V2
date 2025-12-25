<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM clients");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Liste des Clients</title>
    <style>
         body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 40px;
            color: #333;
        }

               nav {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            margin: 20px 0;
            display: flex;
            justify-content: center;
        }

        nav a {
            text-decoration: none;
            color: #007bff;
            margin-right: 15px;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background 0.3s;
        }

        nav a:hover {
            background: #e7f3ff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
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
     <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="list_clients.php"> Clients</a> 
        <a href="list_accounts.php"> Comptes</a> 
        <a href="make_transaction.php"> Transaction</a> 
        <a href="transactions_history.php"> Historique</a> 
        <a href="logout.php" style="color:red"> Déconnexion</a>
    </nav>
    <h2>Liste des Clients</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>CIN</th>
            <th>action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['client_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['cin']; ?></td>
                <td>
                <a href="delete_client.php?id=<?php echo $row['client_id']; ?>" style="color:red; font-weight:bold; text-decoration:none;">
                    Supprimer
                </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>