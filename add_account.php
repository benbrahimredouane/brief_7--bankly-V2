<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
include 'db.php';

if (isset($_POST['save_acc'])) {
    $c_id = $_POST['client_id'];
    $acc_num = "BNK-" . rand(10000, 99999);
    $type = $_POST['type'];
    $balance = $_POST['balance'];

    $sql = "INSERT INTO accounts (client_id, account_number, balance, type, status) 
            VALUES ('$c_id', '$acc_num', '$balance', '$type', 'active')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: list_accounts.php");
    }
}

$clients = mysqli_query($conn, "SELECT client_id, name FROM clients");
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background-color: #f4f4f9;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 50px;
    }

    h2 {
        color: #2c3e50;
    }

    form {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        width: 350px;
    }

    
    input, select {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box; 
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
    </head>
<body>
    <h2>Créer un Compte</h2>
    <form method="POST">
        <select name="client_id" required>
            <option value="">-- Sélectionner le Client --</option>
            <?php while($c = mysqli_fetch_assoc($clients)): ?>
                <option value="<?php echo $c['client_id']; ?>"><?php echo $c['name']; ?></option>
            <?php endwhile; ?>
        </select><br><br>
        <input type="text" name="type" placeholder="Type (ex: Epargne)" required><br><br>
        <input type="number" name="balance" placeholder="Solde Initial" required><br><br>
        <button type="submit" name="save_acc">Ouvrir le compte</button>
    </form>
</body>
</html>