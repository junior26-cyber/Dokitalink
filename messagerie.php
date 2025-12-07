<?php
session_start();

// Connexion BDD
$host = "localhost";
$user = "root";
$pass = "";
$db = "medecine";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Erreur de connexion : " . $conn->connect_error);
}

// Utilisateur connecté (à remplacer par $_SESSION['id'] si connecté)
$current_user_id = 1;
$autre_user_id = 2; // Ex : médecin ou patient cible

// Envoi d’un message
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['message'])) {
  $msg = htmlspecialchars(trim($_POST['message']));
  $stmt = $conn->prepare("INSERT INTO messages (expediteur_id, destinataire_id, message) VALUES (?, ?, ?)");
  $stmt->bind_param("iis", $current_user_id, $autre_user_id, $msg);
  $stmt->execute();
  $stmt->close();
}

// Récupération des messages entre les 2 utilisateurs
$sql = "SELECT * FROM messages 
        WHERE (expediteur_id = $current_user_id AND destinataire_id = $autre_user_id) 
           OR (expediteur_id = $autre_user_id AND destinataire_id = $current_user_id)
        ORDER BY date_envoi ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Messagerie - Dokitalink</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white p-10">

  <!-- Sidebar -->
  <aside class="fixed top-0 left-0 w-64 h-full bg-blue-700 text-white p-6 shadow-md">
    <h1 class="text-2xl font-bold text-center mb-10">DOKITALINK</h1>
    <nav class="flex flex-col gap-4">
      <a href="index.php" class="hover:bg-blue-800 px-3 py-2 rounded">📊 Acceuil</a>
      
      <a href="messagerie.php" class="hover:bg-blue-800 px-3 py-2 rounded bg-blue-800">💬 Messagerie</a>
  
      <a href="notifications.php" class="hover:bg-blue-800 px-3 py-2 rounded">🔔 Notifications</a>
      <a href="preferences.php" class="hover:bg-blue-800 px-3 py-2 rounded">⚙️ Paramètres</a>
    </nav>
  </aside>

  <!-- Contenu principal -->
  <div class="ml-64 max-w-3xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow">
    <h1 class="text-3xl font-bold mb-6 text-blue-700">💬 Messagerie</h1>

    <!-- Zone d'affichage des messages -->
    <div class="h-96 overflow-y-auto border border-gray-200 dark:border-gray-700 p-4 mb-6 rounded-lg bg-gray-50 dark:bg-gray-700">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="mb-4">
            <div class="<?= ($row['expediteur_id'] == $current_user_id) ? 'text-right' : 'text-left' ?>">
              <p class="inline-block px-4 py-2 rounded-lg <?= ($row['expediteur_id'] == $current_user_id) ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-600 dark:text-white' ?>">
                <?= htmlspecialchars($row['message']) ?>
              </p><br>
              <span class="text-xs text-gray-500"><?= date('d/m/Y H:i', strtotime($row['date_envoi'])) ?></span>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-gray-500">Aucun message pour le moment.</p>
      <?php endif; ?>
    </div>

    <!-- Formulaire d'envoi -->
    <form action="" method="POST" class="flex gap-4">
      <input type="text" name="message" placeholder="Écrire un message..." required
             class="flex-1 p-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 dark:text-white">
      <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded">
        ✉️ Envoyer
      </button>
    </form>
  </div>

</body>
</html>

<?php $conn->close(); ?>
