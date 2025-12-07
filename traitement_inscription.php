<?php
require 'config.php'; // Contient $pdo
session_start();

// Sécurisation des champs
$nom = trim($_POST['nom']);
$prenom = trim($_POST['prenom']);
$email = trim($_POST['email']);
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
$telephone = trim($_POST['telephone']);
$role = $_POST['role'] ? $_POST['role'] : 'patient'; // Valeur par défaut

// Vérifie si l’email est déjà utilisé
$verif = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
$verif->execute([$email]);

if ($verif->rowCount() > 0) {
    echo "❌ Erreur : cet email est déjà utilisé.";
    exit;
}

// Insertion dans la base
$sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, telephone, role) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nom, $prenom, $email, $mot_de_passe, $telephone, $role]);

$user_id = $pdo->lastInsertId();

// Stockage en session
$_SESSION["nom"] = $nom;
$_SESSION["email"] = $email;

if ($role === "patient") {
    $_SESSION["patient_id"] = $user_id;
    header("Location: patient.php");
    exit;
} elseif ($role === "medecin") {
    $_SESSION["medecin_id"] = $user_id;
    header("Location: tableau.medecin.php");
    exit;
} else {
    echo "❌ Rôle invalide";
    exit;
}
?>
