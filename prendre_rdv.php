<!DOCTYPE html>
<html lang="fr" class="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prendre un rendez-vous - Dokitalink</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
    }
  </script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors min-h-screen">

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
  <main class="ml-64 p-10">
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8">
      <h2 class="text-3xl font-bold mb-6 text-blue-700 dark:text-blue-400">📅 Prendre un rendez-vous</h2>

      <form action="submit_rdv.php" method="POST" class="space-y-6">

        <!-- Nom complet -->
        <div>
          <label for="nom" class="block text-sm font-medium">Nom complet</label>
          <input type="text" id="nom" name="nom" required
                 class="mt-1 w-full p-3 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Choix du médecin -->
        <div>
          <label for="medecin" class="block mb-2 font-semibold">Choisir un médecin</label>
<select id="medecin" name="medecin_id" required class="w-full p-3 rounded border">
  <option value="">-- Sélectionnez --</option>
  <?php
  $pdo = new PDO("mysql:host=localhost;dbname=medecine", "root", "");
  $medecins = $pdo->query("SELECT id, nom FROM medecins")->fetchAll();
  foreach ($medecins as $m) {
    echo "<option value='{$m['id']}'>{$m['nom']}</option>";
  }
  ?>
</select>


        </div>

        <!-- Date -->
        <div>
          <label for="date" class="block text-sm font-medium">Date</label>
          <input type="date" id="date" name="date" required
                 class="mt-1 w-full p-3 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Heure -->
        <div>
         <label for="heure" class="block mb-2 font-semibold">Heure disponible</label>
<select name="heure" id="heure" required class="w-full p-3 rounded border bg-white">
  <option value="">-- Sélectionnez un médecin d'abord --</option>
</select>

        </div>

        <!-- Type de rendez-vous -->
        <div>
          <label for="type_rdv" class="block text-sm font-medium">Type de rendez-vous</label>
          <select id="type_rdv" name="type_rdv" required
                  class="mt-1 w-full p-3 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">-- Choisir un type --</option>
            <option value="En présentiel">En présentiel</option>
            <option value="Téléconsultation">Téléconsultation</option>
            <option value="Appel téléphonique">Appel téléphonique</option>
          </select>
        </div>

        <!-- Bouton de confirmation -->
        <div class="text-center">
          <button type="submit"
                  class="bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 px-6 rounded-lg transition">
            Confirmer le rendez-vous
          </button>
        </div>

      </form>
    </div>
  </main>
<script>
document.getElementById("medecin").addEventListener("change", function () {
  const medecinId = this.value;
  const jour = new Date().toLocaleDateString('fr-FR', { weekday: 'long' });

  fetch(`get_disponibilites.php?medecin_id=${medecinId}&jour=${jour}`)
    .then(response => response.json())
    .then(data => {
      const selectHeure = document.getElementById("heure");
      selectHeure.innerHTML = ""; // Clear
      data.forEach(heure => {
        const option = document.createElement("option");
        option.value = heure;
        option.textContent = heure;
        selectHeure.appendChild(option);
      });
    });
});
</script>

</body>
</html>
