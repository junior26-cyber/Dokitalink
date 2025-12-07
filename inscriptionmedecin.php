<?php
$host = "localhost";
$db = "medecine";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Erreur : " . $conn->connect_error);

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nom = $_POST["nom"];
  $email = $_POST["email"];
  $telephone = $_POST["telephone"];
  $specialite = $_POST["specialite"];
  $ville = $_POST["ville"];
  $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO medecins (nom, email, telephone, specialite, ville, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $nom, $email, $telephone, $specialite, $ville, $mot_de_passe);

  if ($stmt->execute()) {
   header("Location: tableau.medecin.php?success=1");
exit;

  } else {
    $message = "❌ Erreur : " . $stmt->error;
  }

  $stmt->close();
}
try {
  $conn = new mysqli($host, $user, $pass, $db);
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  $conn->set_charset("utf8mb4");

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $specialite = $_POST["specialite"];
    $ville = $_POST["ville"];
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO medecins (nom, email, telephone, specialite, ville, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nom, $email, $telephone, $specialite, $ville, $mot_de_passe);
    $stmt->execute();

    $message = "✅ Médecin inscrit avec succès !";
  }
} catch (Exception $e) {
  $message = "❌ Erreur : " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription Médecin - Dokitalink</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10 text-gray-800">

  <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-8">
    <h2 class="text-3xl font-bold mb-6 text-center text-blue-700">Inscription Médecin</h2>

    <?php if ($message): ?>
      <div class="mb-4 p-4 bg-blue-100 text-blue-800 rounded"><?= $message ?></div>
    <?php endif; ?>

    <form action="" method="POST" class="space-y-5">
      <input type="text" name="nom" placeholder="Nom complet" required class="w-full px-4 py-2 border rounded" />
      <input type="email" name="email" placeholder="Adresse email" required class="w-full px-4 py-2 border rounded" />
      <input type="text" name="telephone" placeholder="Téléphone" required class="w-full px-4 py-2 border rounded" />
      <select name="specialite" required class="w-full px-4 py-2 border rounded bg-white text-gray-800">
  <option value="">-- Choisir une spécialité --</option>
  <option value="Généraliste">Généraliste</option>
  <option value="Cardiologue">Cardiologue</option>
  <option value="Pédiatre">Pédiatre</option>
  <option value="Dermatologue">Dermatologue</option>
  <option value="Gynécologue">Gynécologue</option>
  <option value="Psychologue">Psychologue</option>
  <option value="Neurologue">Neurologue</option>
  <option value="Ophtalmologue">Ophtalmologue</option>
</select>

      <input type="text" name="ville" placeholder="Ville (ex: Lomé)" required class="w-full px-4 py-2 border rounded" />
      <input type="password" name="mot_de_passe" placeholder="Mot de passe" required class="w-full px-4 py-2 border rounded" />

      <button type="submit" class="w-full bg-blue-700 text-white py-3 rounded hover:bg-blue-800">
        🩺 S'inscrire
      </button>
    </form>
  </div>

</body>
</html>
