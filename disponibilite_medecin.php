<?php
// session_start();
// if (!isset($_SESSION['medecin_id'])) {
//   header("Location: index.php");
//   exit;
// }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter une disponibilité</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

  <div class="max-w-lg mx-auto bg-white p-8 shadow rounded-lg">
    <h1 class="text-2xl font-bold text-center text-blue-700 mb-6">🕒 Ajouter une disponibilité</h1>

    <form action="traitement_disponibilite.php" method="POST" class="space-y-4">
      <label class="block">
        Jour :
        <select name="jour" class="w-full p-2 rounded border" required>
          <option value="Lundi">Lundi</option>
          <option value="Mardi">Mardi</option>
          <option value="Mercredi">Mercredi</option>
          <option value="Jeudi">Jeudi</option>
          <option value="Vendredi">Vendredi</option>
          <option value="Samedi">Samedi</option>
        </select>
      </label>

      <label class="block">
        Heure début :
        <input type="time" name="heure_debut" class="w-full p-2 rounded border" required>
      </label>

      <label class="block">
        Heure fin :
        <input type="time" name="heure_fin" class="w-full p-2 rounded border" required>
      </label>

      <button type="submit" class="bg-blue-700 text-white w-full py-2 rounded hover:bg-blue-800">Ajouter</button>
    </form>
  </div>

</body>
</html>
