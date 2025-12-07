<?php
// session_start();
// if (!isset($_SESSION["medecin_id"])) {
//   header("Location: index.php");
//   exit;
// }

// $medecin_id = $_SESSION["medecin_id"];

// $pdo = new PDO("mysql:host=localhost;dbname=medecine", "root", "");
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// // Récupère les patients qui ont déjà eu une consultation avec ce médecin
// $sql = "SELECT DISTINCT u.nom, u.prenom, u.email, u.telephone
//         FROM consultations c
//         JOIN utilisateurs u ON c.patient_id = u.id
//         WHERE c.medecin_id = ?";
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$medecin_id]);
// $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes Patients - Dokitalink</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white p-10">

  <h1 class="text-3xl font-bold mb-6 text-blue-700">👥 Mes patients</h1>

  <?php 
//   if (count($patients) > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php 
    //   foreach ($patients as $p): ?>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition">
          <h2 class="text-xl font-semibold mb-2"></h2>
          <p class="text-sm text-gray-600 dark:text-gray-300"></p>
          <p class="text-sm text-gray-600 dark:text-gray-300"></p>
        </div>
      <?php
    //  endforeach; ?>
    </div>
  <?php
//  else: ?>
    <p class="text-gray-600">Aucun patient trouvé pour l’instant.</p>
  <?php
//  endif; ?>

</body>
</html>
