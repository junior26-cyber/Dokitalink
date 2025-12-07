<?php
// session_start();
// if (!isset($_SESSION["medecin_id"])) {
//   header("Location: index.php");
//   exit;
// }

// $medecin_id = $_SESSION["medecin_id"];

// $pdo = new PDO("mysql:host=localhost;dbname=medecine", "root", "");
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// // Requête pour récupérer les RDV du médecin
// $sql = "SELECT rv.*, u.nom AS patient_nom, u.prenom AS patient_prenom
//         FROM rendez_vous rv
//         JOIN utilisateurs u ON rv.patient_id = u.id
//         WHERE rv.medecin_id = ?
//         ORDER BY rv.date_rdv DESC, rv.heure_rdv DESC";

// $stmt = $pdo->prepare($sql);
// $stmt->execute([$medecin_id]);
// $rdvs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Rendez-vous reçus - Dokitalink</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white p-10">

  <h1 class="text-3xl font-bold text-blue-700 mb-8">📆 Rendez-vous reçus</h1>

 
    <div class="space-y-6">
     
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
          <div class="flex justify-between items-center">
            <div>
              <h2 class="text-xl font-semibold">
               
                </h2>
              <p class="text-sm text-gray-600 dark:text-gray-300">📅 </p>
              <p class="text-sm text-gray-600 dark:text-gray-300">📍</p>
              
            </div>
            <!-- Option : bouton accepter / refuser -->
            <div class="space-x-2">
              <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">✅ Accepter</a>
              <a href="#" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">❌ Refuser</a>
            </div>
          </div>
        </div>
     
    <p>Aucun rendez-vous pour le moment.</p>
 
</body>
</html>
