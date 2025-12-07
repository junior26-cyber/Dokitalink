<?php
// session_start();
// if (!isset($_SESSION["medecin_id"])) {
//   header("Location: index.php"); // ou login.php
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
// $stmt->bindValue(":medecin_id", $medecin_id);
// $stmt->execute();
// $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $pdo->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Tableau de bord - Médecin | Dokitalink</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 dark:text-white transition-all min-h-screen">

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white p-6 fixed h-full">
      <h1 class="text-2xl font-bold text-center mb-10">DOKITALINK</h1>
      <nav class="flex flex-col gap-4">
        <a href="index.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">📊 <span>Acceuil</span></a>
        <a href="rdv_recu.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">📅 <span>RDV reçus</span></a>
        <a href="mes_patient.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">📁 <span>Mes patients</span></a>
        <a href="disponibilite_medecin.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">🕒 <span> Ajouter une disponibilité</span></a>
        <a href="messagerie.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">💬 <span>Messagerie</span></a>
        <a href="preferences.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">⚙️ <span>Paramètres</span></a>
      </nav>
    </aside>

    <!-- Contenu -->
    <main class="ml-64 flex-1 p-10">
      <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold">Bonjour Dr 👨‍⚕️</h2>
        <button id="toggleDark" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 hover:scale-105 transition">🌓</button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition">
          <h3 class="text-xl font-semibold mb-2">📅 Rendez-vous</h3>
          <p class="text-gray-600 dark:text-gray-300">Consultez les rendez-vous prévus avec vos patients.</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition">
          <h3 class="text-xl font-semibold mb-2">📁 Dossiers médicaux</h3>
          <p class="text-gray-600 dark:text-gray-300">Accédez aux documents envoyés par les patients.</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition">
          <h3 class="text-xl font-semibold mb-2">💬 Messagerie</h3>
          <p class="text-gray-600 dark:text-gray-300">Répondez aux messages de vos patients.</p>
        </div>
      </div>
    </main>
  </div>

  <script>
    document.getElementById("toggleDark").addEventListener("click", () => {
      document.documentElement.classList.toggle("dark");
    });
  </script>

</body>
</html>
