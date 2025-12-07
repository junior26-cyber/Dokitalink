<?php
// Connexion à la base
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "medecine";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécurisation des données
    $nom       = mysqli_real_escape_string($conn, $_POST['nom']);
    $medecin   = mysqli_real_escape_string($conn, $_POST['medecin']);
    $date      = mysqli_real_escape_string($conn, $_POST['date']);
    $heure     = mysqli_real_escape_string($conn, $_POST['heure']);
    $type_rdv  = mysqli_real_escape_string($conn, $_POST['type_rdv']);
    
    // Requête d'insertion
    $sql = "INSERT INTO rendez_vous (nom, medecin, date, heure, type_rdv )
            VALUES ('$nom', '$medecin', '$date', '$heure', '$type_rdv' )";

    if ($conn->query($sql) === TRUE) {
        // Redirection vers une page de confirmation
        header("Location: patient.php");
        exit();
    } else {
        echo "❌ Erreur lors de l'enregistrement : " . $conn->error;
    }
}

$conn->close();
?>
