<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
include 'db.php';

$message = "";

if (isset($_POST['execute'])) {
    $acc_id = $_POST['account_id'];
    $amount = $_POST['amount'];
    $type = $_POST['type']; 

    if ($amount > 0) {
      
        $math_op = ($type == 'deposit') ? "+" : "-";

     
        $update_sql = "UPDATE accounts SET balance = balance $math_op $amount WHERE account_id = $acc_id";
        
        if (mysqli_query($conn, $update_sql)) {
         
            $log_sql = "INSERT INTO transactions (account_id, type, amount) VALUES ('$acc_id', '$type', '$amount')";
            mysqli_query($conn, $log_sql);
            
            $message = "<p style='color:green'>Transaction réussie !</p>";
        } else {
            $message = "<p style='color:red'>Erreur technique lors de la mise à jour.</p>";
        }
    } else {
        $message = "<p style='color:red'>Le montant doit être supérieur à 0.</p>";
    }
}


$accounts = mysqli_query($conn, "SELECT accounts.account_id, accounts.account_number, clients.name 
                                 FROM accounts 
                                 JOIN clients ON accounts.client_id = clients.client_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Effectuer une Transaction</title>
    <style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background-color: #f4f7f6;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px;
    }

    nav {
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    nav a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }

    form {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    input, select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }
</style>
</head>
<body>
    <nav><a href="dashboard.php">Dashboard</a>  <a href="list_accounts.php">Liste des Comptes</a></nav>
    <hr>
    <h2>Nouvelle Transaction</h2>
    
    <?php echo $message; ?>

    <form method="POST">
        <label>Compte concerné :</label><br>
        <select name="account_id" required>
            <option value="">-- Sélectionner un compte --</option>
            <?php while($acc = mysqli_fetch_assoc($accounts)): ?>
                <option value="<?php echo $acc['account_id']; ?>">
                    <?php echo $acc['account_number'] . " (" . $acc['name'] . ")"; ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Type d'opération :</label><br>
        <select name="type">
            <option value="deposit">Dépôt (+)</option>
            <option value="withdrawal">Retrait (-)</option>
        </select><br><br>

        <label>Montant (MAD) :</label><br>
        <input type="number" step="0.01" name="amount" required><br><br>

        <button type="submit" name="execute">Confirmer l'opération</button>
    </form>
</body>
</html>