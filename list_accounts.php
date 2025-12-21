<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
include 'db.php';

$sql = "SELECT accounts.*, clients.name as owner_name 
        FROM accounts 
        JOIN clients ON accounts.client_id = clients.client_id";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Comptes - Bankly V2</title>
    <style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        margin: 40px;
        background-color: #f8f9fa;
        color: #333;
    }

    nav {
        margin-bottom: 20px;
        padding: 10px;
        background: white;
        border-radius: 5px;
        display: flex;
        justify-content: center;
    }

    nav a {
        text-decoration: none;
        color: #007bff;
        font-weight: 600;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden; 
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #f1f3f5;
        font-size: 13px;
        text-transform: uppercase;
        color: #666;
    }

    tr:hover {
        background-color: #fdfdfd;
    }

    
    td:nth-child(5) {
        font-weight: bold;
        text-transform: capitalize;
    }

    
    .btn-action {
        background-color: #007bff;
        color: white !important;
        padding: 6px 12px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 13px;
    }

    .btn-action:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <nav>
        <a href="dashboard.php">Dashboard</a> | 
        <a href="add_account.php">Créer un Compte</a>
    </nav>
    <hr>
    <h2>Tous les comptes bancaires</h2>
    
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Numéro de Compte</th>
                <th>Propriétaire</th>
                <th>Type</th>
                <th>Solde</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['account_number']; ?></td>
                <td><?php echo $row['owner_name']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td><strong><?php echo number_format($row['balance'], 2); ?> MAD</strong></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <a href="make_transaction.php?acc_id=<?php echo $row['account_id']; ?>">Transaction</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>