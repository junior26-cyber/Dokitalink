<?php
// session_start();

// if (!isset($_SESSION["patient_id"])) {
//   header("Location: index.php"); // ou login.php
//   exit;
// }

// $nom = $_SESSION["nom"];
// $email = $_SESSION["email"];
?>

<!DOCTYPE html>
<html lang="fr" class="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Patient - DOKITALINK</title>
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
    }
  </script>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900 dark:text-white transition-colors duration-300">

  <!-- Layout principal -->
  <div class="flex flex-1">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white h-full p-6 shadow-lg fixed">
      <h1 class="text-2xl font-bold mb-10 text-center">DOKITALINK</h1>
      <nav class="flex flex-col gap-4">
        <a href="index.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">📊 <span>Acceuil</span></a>
        <a href="prendre_rdv.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">📅 <span>Prendre un RDV</span></a>
        <a href="liste_medecins.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">👨‍⚕️ <span>Médecins</span></a>
        <a href="messagerie.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">💬 <span>Messagerie</span></a>
        <a href="dossier_medical.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">📁 <span>Dossier médical</span></a>
        <a href="historique_consultations.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">📄 <span>Consultations</span></a>
        <a href="notifications.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">🔔 <span>Notifications</span></a>
        <a href="preferences.php" class="flex items-center gap-3 hover:bg-blue-800 px-3 py-2 rounded">⚙️ <span>Paramètres</span></a>
      </nav>
    </aside>

    <!-- Contenu principal -->
    <main class="ml-64 w-full p-10">
      <div class="flex justify-between items-center mb-6">
        <button id="themeToggle" class="bg-gray-200 dark:bg-gray-700 p-2 rounded-full hover:scale-105 transition">🌓</button>
      </div>

      <!-- Cartes -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl transition">
          <span class="text-4xl">📅</span>
          <h3 class="text-xl font-semibold mt-4">Prendre un rendez-vous</h3>
          <p class="text-sm text-gray-600 dark:text-gray-300">Choisissez un médecin, type de RDV et créneau.</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl transition">
          <span class="text-4xl">📁</span>
          <h3 class="text-xl font-semibold mt-4">Mon dossier médical</h3>
          <p class="text-sm text-gray-600 dark:text-gray-300">Uploader ou télécharger vos fichiers (PDF, images...)</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl transition">
          <span class="text-4xl">💬</span>
          <h3 class="text-xl font-semibold mt-4">Accéder à la messagerie</h3>
          <p class="text-sm text-gray-600 dark:text-gray-300">Messages avec vos médecins.</p>
        </div>
      </div>
    </main>
  </div>

  <!-- Bannière motivante -->
  <!-- <div class="bg-blue-50 border-t border-blue-200 px-6 py-4 flex items-center justify-between text-sm text-blue-800 font-medium">
    <div class="flex items-center space-x-3">
      <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <p>Chaque vie compte. Chaque souffle est précieux. Dokitalink veille sur vous.</p>
    </div>
    <p class="italic text-blue-600">“Prenez soin de vous. Nous sommes là, toujours là.”</p>
  </div> -->

    <footer class="bg-gray-900 text-white text-center px-6 py-4 mt-auto">
  <div class="flex flex-col items-center gap-2 text-sm md:text-base">
    <img src="images/logo2.png" alt="Logo DOKITALINK" class="w-14 h-14 rounded-full shadow-sm mb-2">
    
    <div class="text-gray-300">
      <p class="mb-1">📍 123 Rue de la Santé, Lomé, Togo</p>
      <p class="mb-1">📧 info@dokitalink.com</p>
      <p class="mb-2">📞 +228 90 08 32 72</p>
    </div>

    <div class="flex gap-4 text-2xl">
      <a href="https://www.facebook.com/share/p/1ANh4WLUJC/" target="_blank" class="hover:text-blue-500 transition">
        <i class='bx bxl-facebook'></i>
      </a>
      <a href="https://www.tiktok.com/@dokitalink" target="_blank" class="hover:text-pink-500 transition">
        <i class='bx bxl-tiktok'></i>
      </a>
      <a href="https://www.instagram.com/dokitalink" target="_blank" class="hover:text-red-400 transition">
        <i class='bx bxl-instagram'></i>
      </a>
    </div>

    <p class="text-gray-400 text-sm mt-2">&copy; 2025 <strong class="text-white">DOKITALINK</strong>. Tous droits réservés.</p>
  </div>
</footer>


  <script>
    document.getElementById("themeToggle").addEventListener("click", () => {
      document.documentElement.classList.toggle("dark");
    });
  </script>
</body>
</html>
