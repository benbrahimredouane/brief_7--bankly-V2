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
      <style>
    body {
        font-family: Arial, sans-serif;
        margin: 40px;
        background-color: #f9f9f9;
    }

    nav {
        margin-bottom: 20px;
    }

    nav a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        margin-right: 15px;
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

    
    .type-deposit {
        color: #28a745; 
        font-weight: bold;
    }

    .type-withdrawal {
        color: #dc3545; 
        font-weight: bold;
    }

    tr:hover {
        background-color: #fbfbfb;
    }
</style>
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