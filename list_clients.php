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
        .btns{
            display: flex;
            gap:5px;
        }
        .list{
            text-align: center;
        }
        .link{
            display: flex;
            justify-content: center;
            text-decoration: none;
            color: #ffffffff;
            padding: 10px;
            background-color: #007bffff;
        }
        .link:hover{
            background: #6092c6ff;
        }
    </style>
</head>

<body>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="list_clients.php"> Clients</a>
        <a href="list_accounts.php"> Comptes</a>
        <a href="transactions_history.php"> Historique</a>
        <a href="logout.php" style="color:red"> Déconnexion</a>
    </nav>
    <hr>
    <h2 class="list">Liste des Clients</h2>
    <a class="link" href="add_client.php">add client</a>
    <table>
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
                <td class="btns">
                    <a href="delete_client.php?id=<?php echo $row['client_id']; ?>" style="color:red; font-weight:bold; text-decoration:none;">
                        Supprimer
                    </a>
                     <a href="edit_client.php?id=<?php echo $row['client_id']; ?>"
                            style="color:green; font-weight:bold; text-decoration:none; margin-right:10px;">
                            Modifier
                        </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>