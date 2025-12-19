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