<?php
// Connexion à la base
$host = "localhost";
$dbname = "medecine"; 
$user = "root";
$pass = "";

// Connexion MySQL
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Erreur de connexion : " . $conn->connect_error);
}

// Traitement du formulaire d’envoi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["document"])) {
  $file = $_FILES["document"];
  $upload_dir = "uploads/";

  // Créer le dossier s’il n’existe pas
  if (!is_dir($upload_dir)) mkdir($upload_dir);

  $filename = basename($file["name"]);
  $target_file = $upload_dir . time() . "_" . $filename;
  $filetype = $file["type"];

  if (move_uploaded_file($file["tmp_name"], $target_file)) {
    $stmt = $conn->prepare("INSERT INTO dossier_medical (patient_id, nom_fichier, type_fichier, chemin_fichier) VALUES (?, ?, ?, ?)");
    $patient_id = 1; // À remplacer plus tard par $_SESSION['id'] si tu fais une authentification
    $stmt->bind_param("isss", $patient_id, $filename, $filetype, $target_file);
    $stmt->execute();
    $stmt->close();
    $message = "✅ Document téléversé avec succès.";
  } else {
    $message = "❌ Erreur lors de l'envoi du fichier.";
  }
}

// Récupération des documents
$docs = $conn->query("SELECT * FROM dossier_medical WHERE patient_id = 1 ORDER BY date_upload DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dossier médical - Dokitalink</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white p-10">

  <!-- Sidebar -->
  <aside class="fixed top-0 left-0 w-64 h-full bg-blue-700 text-white p-6 shadow-md">
    <h1 class="text-2xl font-bold text-center mb-10">DOKITALINK</h1>
    <nav class="flex flex-col gap-4">
      <a href="patient.php" class="hover:bg-blue-800 px-3 py-2 rounded">📊 Tableau de bord</a>
      <a href="prendre_rdv.php" class="hover:bg-blue-800 px-3 py-2 rounded">📅 Prendre un RDV</a>
      <a href="liste_medecins.php" class="hover:bg-blue-800 px-3 py-2 rounded">👨‍⚕️ Médecins</a>
      <a href="messagerie.php" class="hover:bg-blue-800 px-3 py-2 rounded">💬 Messagerie</a>
      <a href="dossier_medical.php" class="hover:bg-blue-800 px-3 py-2 rounded bg-blue-800">📁 Dossier médical</a>
      <a href="historique_consultations.php" class="hover:bg-blue-800 px-3 py-2 rounded">📄 Consultations</a>
      <a href="notifications.php" class="hover:bg-blue-800 px-3 py-2 rounded">🔔 Notifications</a>
      <a href="preferences.php" class="hover:bg-blue-800 px-3 py-2 rounded">⚙️ Paramètres</a>
    </nav>
  </aside>

  <!-- Contenu principal -->
  <div class="ml-64 max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow">
    <h1 class="text-3xl font-bold mb-6 text-blue-700 dark:text-blue-400">📁 Mon dossier médical</h1>

    <?php if (!empty($message)): ?>
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
        <?= $message ?>
      </div>
    <?php endif; ?>

    <!-- Formulaire d'ajout -->
    <form action="" method="POST" enctype="multipart/form-data" class="mb-6">
      <label class="block mb-2 font-medium">Ajouter un document (PDF, Word, image...) :</label>
      <input type="file" name="document" required class="mb-4 w-full text-sm text-gray-700 dark:text-white">
      <button type="submit"
              class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded">
        📤 Envoyer
      </button>
    </form>

    <!-- Liste des documents -->
    <h2 class="text-xl font-semibold mb-4">Mes documents :</h2>
    <?php if ($docs->num_rows > 0): ?>
      <ul class="space-y-4">
        <?php while ($doc = $docs->fetch_assoc()): ?>
          <li class="flex justify-between items-center bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
            <div>
              <p class="font-medium"><?= htmlspecialchars($doc['nom_fichier']) ?></p>
              <p class="text-sm text-gray-500">Ajouté le <?= date("d/m/Y à H:i", strtotime($doc['date_upload'])) ?></p>
            </div>
            <div class="flex gap-2">
              <a href="<?= $doc['chemin_fichier'] ?>" download class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">⬇️ Télécharger</a>
              <!-- Supprimer -->
              <form action="supprimer_doc.php" method="POST" onsubmit="return confirm('Supprimer ce document ?');">
                <input type="hidden" name="doc_id" value="<?= $doc['id'] ?>">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">🗑️ Supprimer</button>
              </form>
            </div>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p>Aucun document disponible pour le moment.</p>
    <?php endif; ?>
  </div>

</body>
</html>

<?php $conn->close(); ?>
