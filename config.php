<?php
// $host = "sql112.infinityfree.com";
// $dbname = "if0_38705345_dokitalink"; 
// $user = "if0_38705345";
// $pass = "knilatikod";

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     // echo "Connexion réussie !"; // Décommenter pour tester
// } catch (PDOException $e) {
//     die("Connexion échouée : " . $e->getMessage());
// }

$host = "localhost";
$dbname = "medecine"; 
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion réussie !"; // Décommenter pour tester
} catch (PDOException $e) {
    die("Connexion échouée : " . $e->getMessage());
}
?>


