<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    

    mysqli_query($conn, "DELETE t FROM transactions t
                  JOIN accounts a ON t.account_id = a.account_id
                  WHERE a.client_id = '$id'" );
    
    
    mysqli_query($conn, "DELETE FROM accounts WHERE client_id = '$id'");
    
    
    mysqli_query($conn, "DELETE FROM clients WHERE client_id = '$id'");
}

header("Location: list_clients.php");
exit();
?>