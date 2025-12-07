<?php
session_start();

// Connexion
$conn = new mysqli("localhost", "root", "", "medecine");
if ($conn->connect_error) die("Erreur de connexion : " . $conn->connect_error);
$conn->set_charset("utf8");

// Simuler un utilisateur connecté
$user_id = 1;

// Thème par défaut
$theme = "clair";
$res = $conn->query("SELECT * FROM utilisateurs WHERE id = $user_id");
$user = $res->fetch_assoc();
$theme = $user['theme'];

// Mise à jour
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nom = htmlspecialchars(trim($_POST['nom']));
  $langue = $_POST['langue'];
  $theme = $_POST['theme'];
  $notif = isset($_POST['notifications']) ? 1 : 0;
  $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

  // Téléversement photo
  $photo = $user['photo_profil'];
  if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
    $upload_dir = "uploads/photos/";
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
    $filename = time() . "_" . basename($_FILES['photo']['name']);
    $target = $upload_dir . $filename;
    move_uploaded_file($_FILES['photo']['tmp_name'], $target);
    $photo = $target;
  }

  // Requête dynamique
  $sql = "UPDATE utilisateurs SET nom=?, langue=?, theme=?, notifications=?, photo_profil=?";
  $params = [$nom, $langue, $theme, $notif, $photo];
  $types = "sssiss";

  if ($password) {
    $sql .= ", mot_de_passe=?";
    $params[] = $password;
    $types .= "s";
  }

  $sql .= " WHERE id=?";
$params[] = $user_id;
$types .= "i";

$stmt = $conn->prepare($sql);

// Fusionner types et valeurs
$bind_names[] = $types;
foreach ($params as $key => $value) {
  $bind_names[] = &$params[$key]; // passage par référence requis
}
echo "Types : $types<br>";
echo "Params : " . implode(", ", $params);
exit();

// Utiliser call_user_func_array pour bind_param
call_user_func_array([$stmt, 'bind_param'], $bind_names);

$stmt->execute();
$message = "✅ Paramètres mis à jour avec succès.";
$stmt->close();


  // Rafraîchir les données
  $res = $conn->query("SELECT * FROM utilisateurs WHERE id = $user_id");
  $user = $res->fetch_assoc();
  $theme = $user['theme'];
}
?>
<!DOCTYPE html>
<html lang="fr" class="<?= ($theme === 'sombre') ? 'dark' : '' ?>">
<head>
  <meta charset="UTF-8">
  <title>Paramètres - Dokitalink</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white p-10">

  <!-- Sidebar -->
  <aside class="fixed top-0 left-0 w-64 h-full bg-blue-700 text-white p-6 shadow-md">
    <h1 class="text-2xl font-bold text-center mb-10">DOKITALINK</h1>
    <nav class="flex flex-col gap-4">
      <a href="index.php" class="hover:bg-blue-800 px-3 py-2 rounded">📊 Acceuil</a>
      <a href="preferences.php" class="hover:bg-blue-800 px-3 py-2 rounded bg-blue-800">⚙️ Paramètres</a>
    </nav>
  </aside>

  <!-- Contenu principal -->
  <main class="ml-64 max-w-2xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-xl shadow">
    <h2 class="text-3xl font-bold mb-6 text-blue-700">⚙️ Paramètres du profil</h2>

    <?php if (!empty($message)) : ?>
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="space-y-6">
      <!-- Nom -->
      <div>
        <label class="block mb-1 font-medium">Nom complet</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required
               class="w-full p-3 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
      </div>

      <!-- Nouveau mot de passe -->
      <div>
        <label class="block mb-1 font-medium">Nouveau mot de passe</label>
        <input type="password" name="password"
               class="w-full p-3 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
        <small class="text-sm text-gray-500">Laisser vide pour ne pas changer.</small>
      </div>

      <!-- Photo de profil -->
      <div>
        <label class="block mb-1 font-medium">Photo de profil</label>
        <input type="file" name="photo"
               class="block w-full text-sm text-gray-700 dark:text-white">
        <?php if (!empty($user['photo_profil'])): ?>
          <img src="<?= $user['photo_profil'] ?>" alt="Photo actuelle" class="w-16 h-16 mt-2 rounded-full object-cover border-2 border-blue-500">
        <?php endif; ?>
      </div>

      <!-- Langue -->
      <div>
        <label class="block mb-1 font-medium">Langue</label>
        <select name="langue"
                class="w-full p-3 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
          <option value="fr" <?= $user['langue'] === 'fr' ? 'selected' : '' ?>>Français</option>
          <option value="en" <?= $user['langue'] === 'en' ? 'selected' : '' ?>>English</option>
        </select>
      </div>

      <!-- Thème -->
      <div>
        <label class="block mb-1 font-medium">Thème préféré</label>
        <select name="theme"
                class="w-full p-3 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
          <option value="clair" <?= $user['theme'] === 'clair' ? 'selected' : '' ?>>Clair</option>
          <option value="sombre" <?= $user['theme'] === 'sombre' ? 'selected' : '' ?>>Sombre</option>
        </select>
      </div>

      <!-- Notifications -->
      <div class="flex items-center gap-2">
        <input type="checkbox" name="notifications" <?= $user['notifications'] ? 'checked' : '' ?> class="w-5 h-5">
        <label class="font-medium">Recevoir des notifications par e-mail</label>
      </div>

      <!-- Bouton -->
      <div class="text-center">
        <button type="submit"
                class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg transition">
          💾 Enregistrer les modifications
        </button>
      </div>
    </form>
  </main>
</body>
</html>

<?php $conn->close(); ?>
