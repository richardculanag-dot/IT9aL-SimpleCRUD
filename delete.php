<?php
include 'components/pdo.php';

if (isset($_GET["delete_all"]) && $_GET["delete_all"] == 1) {
    
    $sql = "DELETE FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    header("Location: view.php?deleted_all=1");
    exit();
    
} 
elseif (isset($_GET["id"])) {
    
    $id = $_GET["id"];
    
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    
    header("Location: view.php?deleted=1");
    exit();
    
} 
else {
    header("Location: view.php");
    exit();
}
?>