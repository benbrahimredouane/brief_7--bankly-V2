<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
include 'db.php';

// On utilise JOIN pour lier la table accounts et la table clients
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