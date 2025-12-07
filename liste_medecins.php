<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$database = "medecine";

$conn = new mysqli($host, $user, $password, $database);

// Vérification de la connexion
if ($conn->connect_error) {
  die("Connexion échouée : " . $conn->connect_error);
}

// Requête SQL pour récupérer les médecins disponibles
$sql = "SELECT * FROM medecins";

$result = $conn->query($sql);

// Vérification de la requête
if (!$result) {
  die("Erreur SQL : " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Médecins disponibles - Dokitalink</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 dark:text-white p-10">

  <!-- Sidebar -->
  <aside class="fixed top-0 left-0 w-64 h-full bg-blue-700 text-white p-6 shadow-md">
    <h1 class="text-2xl font-bold text-center mb-10">DOKITALINK</h1>
    <nav class="flex flex-col gap-4">
      <a href="patient.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">📊 Tableau de bord</a>
      <a href="prendre_rdv.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">📅 Prendre un RDV</a>
      <a href="liste_medecins.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">👨‍⚕️ Médecins</a>
      <a href="messagerie.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">💬 Messagerie</a>
      <a href="dossier_medical.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">📁 Dossier médical</a>
      <a href="historique_consultations.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">📄 Consultations</a>
      <a href="notifications.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">🔔 Notifications</a>
      <a href="preferences.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">⚙️ Paramètres</a>
    </nav>
  </aside>

  <!-- Contenu principal -->
  <div class="ml-64 max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold text-blue-700 dark:text-blue-400 mb-8">👨‍⚕️ Médecins disponibles</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <?php
            // Gestion de la photo avec une image par défaut
            $photo = (!empty($row['photo'])) ? $row['photo'] : 'https://via.placeholder.com/64';
          ?>
          <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center gap-4 mb-4">
              <img src="<?php echo $photo; ?>" alt="Photo du médecin"
                   class="w-16 h-16 rounded-full object-cover border-2 border-blue-500">
              <div>
                <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($row['nom']); ?></h2>
                <p class="text-sm text-gray-600 dark:text-gray-300"><?php echo htmlspecialchars($row['specialite']); ?></p>
                <p class="text-sm text-gray-500 dark:text-gray-400">📍 <?php echo htmlspecialchars($row['ville']); ?></p>
              </div>
            </div>
            <a href="prendre_rdv.php?medecin=<?php echo urlencode($row['nom']); ?>"
               class="mt-4 inline-block bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
              Prendre RDV
            </a>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>Aucun médecin disponible pour le moment.</p>
      <?php endif; ?>
    </div>
  </div>

</body>
</html>

<?php $conn->close(); ?>
