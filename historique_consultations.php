<?php
session_start();
$conn = new mysqli("localhost", "root", "", "medecine");
if ($conn->connect_error) die("Erreur : " . $conn->connect_error);
$conn->set_charset("utf8");

// Simuler un patient connecté
$patient_id = 1;

// Récupération du thème
$res = $conn->query("SELECT theme FROM utilisateurs WHERE id = $patient_id");
$theme = ($res && $row = $res->fetch_assoc()) ? $row['theme'] : 'clair';

// Récupérer les consultations
$sql = "SELECT * FROM consultation WHERE patient_id = $patient_id ORDER BY date DESC";
$consultation = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr" class="<?= ($theme === 'sombre') ? 'dark' : '' ?>">
<head>
  <meta charset="UTF-8">
  <title>Mes consultations - Dokitalink</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white p-10">

  <!-- Sidebar -->
  <aside class="fixed top-0 left-0 w-64 h-full bg-blue-700 text-white p-6 shadow-md">
    <h1 class="text-2xl font-bold text-center mb-10">DOKITALINK</h1>
    <nav class="flex flex-col gap-4">
      <a href="patient.php" class="hover:bg-blue-800 px-3 py-2 rounded">📊 Tableau de bord</a>
      <a href="historique_consultations.php" class="hover:bg-blue-800 px-3 py-2 rounded bg-blue-800">📄 Consultations</a>
    </nav>
  </aside>

  <!-- Contenu -->
  <main class="ml-64 max-w-5xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow">
    <h2 class="text-3xl font-bold mb-6 text-blue-700 dark:text-blue-400">📄 Mes consultations</h2>

    <?php if (isset($consultation) && $consultation instanceof mysqli_result && $consultation->num_rows > 0): ?>

      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="text-sm text-gray-600 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">
            <th class="py-2">🧑‍⚕️ Médecin</th>
            <th class="py-2">📅 Date</th>
            <th class="py-2">🕒 Heure</th>
            <th class="py-2">💬 Type</th>
            <th class="py-2">📌 Statut</th>
            <th class="py-2">📎 Rapport</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($c = $consultation->fetch_assoc()): ?>
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 text-sm">
              <td class="py-2"><?= htmlspecialchars($c['medecin']) ?></td>
              <td class="py-2"><?= date("d/m/Y", strtotime($c['date'])) ?></td>
              <td class="py-2"><?= htmlspecialchars($c['heure']) ?></td>
              <td class="py-2"><?= htmlspecialchars($c['type']) ?></td>
              <td class="py-2">
                <span class="px-2 py-1 rounded-full text-xs font-medium 
                <?= $c['statut'] === 'terminé' ? 'bg-green-100 text-green-800' :
                     ($c['statut'] === 'en attente' ? 'bg-yellow-100 text-yellow-800' :
                     'bg-red-100 text-red-800') ?>">
                  <?= ucfirst($c['statut']) ?>
                </span>
              </td>
              <td class="py-2">
                <?php if (!empty($c['fichier_rapport'])): ?>
                  <a href="<?= $c['fichier_rapport'] ?>" download class="text-blue-600 hover:underline">⬇️ Télécharger</a>
                <?php else: ?>
                  <span class="text-gray-500">Aucun</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-gray-500">Aucune consultation enregistrée.</p>
    <?php endif; ?>
  </main>

</body>
</html>

<?php $conn->close(); ?>
