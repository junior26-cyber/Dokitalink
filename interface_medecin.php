<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: connexion.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'dokitalink'); 

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$id_medecin = $_SESSION['user']['id'];

$result = $conn->query("SELECT DISTINCT u.nom FROM utilisateurs u 
                        JOIN rendezvous r ON u.id = r.id_patient 
                        WHERE r.id_medecin = $id_medecin");

if ($result && $result->num_rows > 0) {
    while($p = $result->fetch_assoc()) {
        echo "<p>" . $p['nom'] . "</p>";
    }
} else {
    echo "Aucun patient trouvé.";
}
?>
