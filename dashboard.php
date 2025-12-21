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

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord - Bankly V2</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 40px;
            color: #333;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 5px;
        }

        
        nav {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            margin: 20px 0;
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

        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-top: 4px solid #007bff;
        
        }

        .card h3 {
            margin: 0;
            font-size: 14px;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card p {
            margin: 10px 0 0;
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        hr {
            border: 0;
            height: 1px;
            background: #ddd;
            margin: 20px 0;
        }
    </style>

</head>

<body>
    <h1>Bankly V2 - Dashboard</h1>
    <p>Bienvenue, <strong><?php echo $_SESSION['user']; ?></strong></p>

    <nav>
        <a href="list_clients.php"> Clients</a> |
        <a href="list_accounts.php"> Comptes</a> |
        <a href="make_transaction.php"> Transaction</a> |
        <a href="transactions_history.php"> Historique</a> |
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