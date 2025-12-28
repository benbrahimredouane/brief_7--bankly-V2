<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
include "db.php";


if(!isset($_GET['id'])) {
    header("Location: list_clients.php");
    exit();
}

$id = (int) $_GET['id'];


if (isset($_POST['update'])) {
    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $cin   = mysqli_real_escape_string($conn, $_POST['cin']);

    $sql = "UPDATE clients 
            SET name='$name', email='$email', cin='$cin' 
            WHERE client_id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: list_clients.php");
        exit();
    } else {
        $error = "Erreur : " . mysqli_error($conn);
    }
}


$result = mysqli_query($conn, "SELECT * FROM clients WHERE client_id=$id");
$client = mysqli_fetch_assoc($result);

if (!$client) {
    header("Location: list_clients.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier Client</title>
    <style>  
     body {
        font-family: sans-serif;
        background-color: #f4f4f4;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 50px;
    }

    h2 {
        color: #333;
        text-align: center;
    }

    form {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        width: 300px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box; 
    }
    input:focus{
        
         box-shadow: 0 2px 10px red;
         border: 0 !important;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
    }

    button:hover {
        background-color: #218838;
    }

    a {
        margin-top: 15px;
        text-decoration: none;
        color: #007bff;
        font-size: 14px;
    }
    </style>
</head>

<body>

<h2>Modifier Client</h2>

<?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST">
    <input type="text" name="name" value="<?php echo $client['name']; ?>" required>
    <input type="email" name="email" value="<?php echo $client['email']; ?>" required>
    <input type="text" name="cin" value="<?php echo $client['cin']; ?>" required>

    <button type="submit" name="update">Mettre à jour</button>
</form>

<a  href="list_clients.php"> Retour </a>

</body>
</html>
 
