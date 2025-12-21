<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
include 'db.php';


$sql = "SELECT transactions.*, accounts.account_number, clients.name 
        FROM transactions 
        JOIN accounts ON transactions.account_id = accounts.account_id 
        JOIN clients ON accounts.client_id = clients.client_id ";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Transactions - Bankly V2</title>
   
</head>
<body>

    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="list_accounts.php">Comptes</a>
    </nav>

    <h2>Historique Global des Transactions</h2>

    <table>
        <thead>
            <tr>
                <th>Client</th>
                <th>Compte</th>
                <th>Type</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['account_number']; ?></td>
                <td class="<?php echo ($row['type'] == 'deposit') ? 'type-deposit' : 'type-withdrawal'; ?>">
                    <?php echo ($row['type'] == 'deposit') ? 'Dépôt' : 'Retrait'; ?>
                </td>
                <td><strong><?php echo number_format($row['amount'], 2); ?> MAD</strong></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>