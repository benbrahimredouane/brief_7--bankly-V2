<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php"); 
    exit();
}
include 'db.php';


$res_clients = mysqli_query($conn, "SELECT COUNT(*) as total FROM clients");
$total_clients = mysqli_fetch_assoc($res_clients)['total'] ?? 0;


$res_comptes = mysqli_query($conn, "SELECT COUNT(*) as total FROM accounts");
$total_comptes = mysqli_fetch_assoc($res_comptes)['total'] ?? 0;


$res_solde = mysqli_query($conn, "SELECT SUM(balance) as total_global FROM accounts");
$total_global = mysqli_fetch_assoc($res_solde)['total_global'] ?? 0;
?>

<!DOCTYPE html>è
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord - Bankly V2</title>
    <style>
        .stats-container { display: flex; gap: 20px; margin-top: 20px; }
        .card { border: 1px solid #ccc; padding: 20px; border-radius: 8px; text-align: center; min-width: 150px; background: #f9f9f9; }
        nav a { text-decoration: none; margin-right: 10px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Bankly V2 - Dashboard</h1>
    <p>Bienvenue, <strong><?php echo $_SESSION['user']; ?></strong></p>
    
    <nav>
        <a href="list_clients.php"> Clients</a> | 
        <a href="list_accounts.php"> Comptes</a> | 
        <a href="make_transaction.php"> Transaction</a> | 
        <a href="logout.php" style="color:red"> Déconnexion</a>
    </nav>
    <hr>

    <div class="stats-container">
        <div class="card">
            <h3>Clients</h3>
            <p><?php echo $total_clients; ?></p>
        </div>
        <div class="card">
            <h3>Comptes</h3>
            <p><?php echo $total_comptes; ?></p>
        </div>
        <div class="card">
            <h3>Dépôts Totaux</h3>
            <p><?php echo number_format($total_global, 2); ?> MAD</p>
        </div>
    </div>
</body>
</html>