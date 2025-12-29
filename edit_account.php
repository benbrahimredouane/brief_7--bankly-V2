<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

include "db.php";


if (!isset($_GET['id'])) {
    header("Location: list_accounts.php");
    exit();
}

$id = (int) $_GET['id'];


if (isset($_POST['update'])) {

    $account_number = mysqli_real_escape_string($conn, $_POST['account_number']);
    $balance        = mysqli_real_escape_string($conn, $_POST['balance']);
    $type           = mysqli_real_escape_string($conn, $_POST['type']);
    $status         = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "UPDATE accounts 
            SET account_number = '$account_number',
                balance = '$balance',
                type = '$type',
                status = '$status'
            WHERE account_id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: list_accounts.php");
        exit();
    } else {
        $error = "Erreur : " . mysqli_error($conn);
    }
}


$result = mysqli_query($conn, "SELECT * FROM accounts WHERE account_id = $id");
$account = mysqli_fetch_assoc($result);

if (!$account) {
    header("Location: list_accounts.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Compte</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 50px;
        }

        h2 {
            color: #333;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 320px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input:focus, select:focus {
            outline: none;
            box-shadow: 0 0 5px #28a745;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>

<h2>Modifier Compte</h2>

<?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST">

    <input type="text" name="account_number"
           value="<?php echo $account['account_number']; ?>" required>

    <input type="number"  name="balance"
           value="<?php echo $account['balance']; ?>" required>

    <input type="text" name="type"
           value="<?php echo $account['type']; ?>" required>

    <select name="status" required>
        <option value="active" <?php if ($account['status']=='active') echo 'selected'; ?>>
            Active
        </option>
        <option value="blocked" <?php if ($account['status']=='blocked') echo 'selected'; ?>>
            Blocked
        </option>
    </select>

    <button type="submit" name="update">Mettre à jour</button>

</form>

<a href="list_accounts.php">Retour</a>

</body>
</html>
