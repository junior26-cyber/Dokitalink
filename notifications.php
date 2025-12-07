<?php
session_start();
$conn = new mysqli("localhost", "root", "", "medecine");
if ($conn->connect_error) die("Erreur : " . $conn->connect_error);
$conn->set_charset("utf8");

$user_id = 1; // À remplacer par $_SESSION['id']

// Récupérer thème
$res = $conn->query("SELECT theme FROM utilisateurs WHERE id = $user_id");
$theme = ($res && $row = $res->fetch_assoc()) ? $row['theme'] : 'clair';

// Marquer comme lue
if (isset($_GET['lire'])) {
  $id = intval($_GET['lire']);
  $conn->query("UPDATE notifications SET est_lue = 1 WHERE id = $id AND utilisateur_id = $user_id");
  header("Location: notifications.php");
  exit();
}

// Supprimer notification
if (isset($_GET['supprimer'])) {
  $id = intval($_GET['supprimer']);
  $conn->query("DELETE FROM notifications WHERE id = $id AND utilisateur_id = $user_id");
  header("Location: notifications.php");
  exit();
}

// Récupérer les notifications
$notifs = $conn->query("SELECT * FROM notifications WHERE utilisateur_id = $user_id ORDER BY date_creation DESC");
?>

<!DOCTYPE html>
<html lang="fr" class="<?= ($theme === 'sombre') ? 'dark' : '' ?>">
<head>
  <meta charset="UTF-8">
  <title>Notifications - Dokitalink</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white p-10">

<!-- Sidebar -->
<aside class="fixed top-0 left-0 w-64 h-full bg-blue-700 text-white p-6 shadow-md">
  <h1 class="text-2xl font-bold text-center mb-10">DOKITALINK</h1>
  <nav class="flex flex-col gap-4">
    <a href="patient.php" class="hover:bg-blue-800 px-3 py-2 rounded">📊 Tableau de bord</a>
    <a href="notifications.php" class="hover:bg-blue-800 px-3 py-2 rounded bg-blue-800">🔔 Notifications</a>
  </nav>
</aside>

<!-- Contenu principal -->
<main class="ml-64 max-w-3xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow">
  <h2 class="text-3xl font-bold text-blue-700 dark:text-blue-400 mb-6">🔔 Notifications</h2>

  <?php if ($notifs->num_rows > 0): ?>
    <ul class="space-y-4">
      <?php while ($n = $notifs->fetch_assoc()): ?>
        <li class="p-4 rounded-lg border-l-4 <?= $n['est_lue'] ? 'border-gray-400 bg-gray-100 dark:bg-gray-700' : 'border-blue-600 bg-blue-50 dark:bg-blue-900' ?>">
          <h3 class="text-lg font-semibold"><?= htmlspecialchars($n['titre']) ?></h3>
          <p class="text-sm text-gray-700 dark:text-gray-200"><?= htmlspecialchars($n['contenu']) ?></p>
          <div class="text-xs text-gray-500 mt-2"><?= date("d/m/Y à H:i", strtotime($n['date_creation'])) ?></div>

          <div class="mt-3 flex gap-3">
            <?php if (!$n['est_lue']): ?>
              <a href="?lire=<?= $n['id'] ?>" class="text-blue-600 hover:underline">✅ Marquer comme lue</a>
            <?php endif; ?>
            <a href="?supprimer=<?= $n['id'] ?>" onclick="return confirm('Supprimer cette notification ?');" class="text-red-600 hover:underline">🗑️ Supprimer</a>
          </div>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else: ?>
    <p class="text-gray-500">Aucune notification pour le moment.</p>
  <?php endif; ?>
</main>

</body>
</html>

<?php $conn->close(); ?>
