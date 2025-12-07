<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pharmacies de Garde - Lomé | DokitaLink</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-blue-50 to-white text-gray-900">

  <!-- Header -->
  <header class="bg-white shadow fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
            <i class='bx bx-plus-medical text-white text-xl'></i>
          </div>
          <span class="text-2xl font-bold text-gray-900">Dokitalink</span>
        </div>
      </div>
    </div>
  </header>

  <main class="pt-24 max-w-7xl mx-auto px-4">
    <div class="mb-8">
      <input type="text" id="searchInput" onkeyup="filterPharmacies()" placeholder="Rechercher une pharmacie par quartier, nom..." class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>

    <div id="pharmacyList" class="grid md:grid-cols-2 gap-8">
      <!-- Exemple de carte pharmacie -->
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
        <h2 class="text-xl font-bold text-blue-700 mb-2">Pharmacie du Soleil</h2>
        <p><i class='bx bxs-map mr-2'></i> Bé-Kpota, Lomé</p>
        <p><i class='bx bxs-phone mr-2'></i> +228 90 12 34 56</p>
        <p><i class='bx bx-time mr-2'></i> Ouverte 24h/24</p>
        <a href="https://maps.google.com?q=Pharmacie+du+Soleil+Lomé" target="_blank" class="text-blue-600 hover:underline mt-2 inline-block">Voir sur la carte</a>
      </div>
     <!-- 1. Pharmacie Sainte Marie -->
<div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
  <h2 class="text-xl font-bold text-blue-700 mb-2">Pharmacie Sainte Marie</h2>
  <p><i class='bx bxs-map mr-2'></i> Hanoukopé, Lomé</p>
  <p><i class='bx bxs-phone mr-2'></i> +228 91 01 23 45</p>
  <p><i class='bx bx-time mr-2'></i> 24h/24</p>
  <a href="https://maps.google.com?q=Pharmacie+Sainte+Marie+Lomé" target="_blank" class="text-blue-600 hover:underline mt-2 inline-block">Voir sur la carte</a>
</div>

<!-- 2. Pharmacie Centrale -->
<div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
  <h2 class="text-xl font-bold text-blue-700 mb-2">Pharmacie Centrale</h2>
  <p><i class='bx bxs-map mr-2'></i> Centre-ville, Lomé</p>
  <p><i class='bx bxs-phone mr-2'></i> +228 98 76 54 32</p>
  <p><i class='bx bx-time mr-2'></i> Jusqu’à 22h</p>
  <a href="https://maps.google.com?q=Pharmacie+Centrale+Lomé" target="_blank" class="text-blue-600 hover:underline mt-2 inline-block">Voir sur la carte</a>
</div>

<!-- 3. Pharmacie Grâce Divine -->
<div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
  <h2 class="text-xl font-bold text-blue-700 mb-2">Pharmacie Grâce Divine</h2>
  <p><i class='bx bxs-map mr-2'></i> Adakpamé, Lomé</p>
  <p><i class='bx bxs-phone mr-2'></i> +228 90 20 30 40</p>
  <p><i class='bx bx-time mr-2'></i> Ouverte 24h/24</p>
  <a href="https://maps.google.com?q=Pharmacie+Grâce+Divine+Lomé" target="_blank" class="text-blue-600 hover:underline mt-2 inline-block">Voir sur la carte</a>
</div>

<!-- 4. Pharmacie Espoir Santé -->
<div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
  <h2 class="text-xl font-bold text-blue-700 mb-2">Pharmacie Espoir Santé</h2>
  <p><i class='bx bxs-map mr-2'></i> Avénou, Lomé</p>
  <p><i class='bx bxs-phone mr-2'></i> +228 93 21 65 87</p>
  <p><i class='bx bx-time mr-2'></i> Jusqu’à 21h</p>
  <a href="https://maps.google.com?q=Pharmacie+Espoir+Santé+Lomé" target="_blank" class="text-blue-600 hover:underline mt-2 inline-block">Voir sur la carte</a>
</div>

<!-- 5. Pharmacie de la Victoire -->
<div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
  <h2 class="text-xl font-bold text-blue-700 mb-2">Pharmacie de la Victoire</h2>
  <p><i class='bx bxs-map mr-2'></i> Bè Kpota, Lomé</p>
  <p><i class='bx bxs-phone mr-2'></i> +228 95 66 77 88</p>
  <p><i class='bx bx-time mr-2'></i> Jusqu’à minuit</p>
  <a href="https://maps.google.com?q=Pharmacie+de+la+Victoire+Lomé" target="_blank" class="text-blue-600 hover:underline mt-2 inline-block">Voir sur la carte</a>
</div>

<!-- 6. Pharmacie Le Bon Samaritain -->
<div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
  <h2 class="text-xl font-bold text-blue-700 mb-2">Pharmacie Le Bon Samaritain</h2>
  <p><i class='bx bxs-map mr-2'></i> Agoè Zongo, Lomé</p>
  <p><i class='bx bxs-phone mr-2'></i> +228 90 55 11 22</p>
  <p><i class='bx bx-time mr-2'></i> 24h/24</p>
  <a href="https://maps.google.com?q=Pharmacie+Le+Bon+Samaritain+Lomé" target="_blank" class="text-blue-600 hover:underline mt-2 inline-block">Voir sur la carte</a>
</div>

<!-- 7. Pharmacie Santé Plus -->
<div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
  <h2 class="text-xl font-bold text-blue-700 mb-2">Pharmacie Santé Plus</h2>
  <p><i class='bx bxs-map mr-2'></i> Amoutivé, Lomé</p>
  <p><i class='bx bxs-phone mr-2'></i> +228 91 91 91 91</p>
  <p><i class='bx bx-time mr-2'></i> Jusqu’à 20h</p>
  <a href="https://maps.google.com?q=Pharmacie+Santé+Plus+Lomé" target="_blank" class="text-blue-600 hover:underline mt-2 inline-block">Voir sur la carte</a>
</div>

<!-- 8. Pharmacie Universelle -->
<div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
  <h2 class="text-xl font-bold text-blue-700 mb-2">Pharmacie Universelle</h2>
  <p><i class='bx bxs-map mr-2'></i> Nyékonakpoè, Lomé</p>
  <p><i class='bx bxs-phone mr-2'></i> +228 92 00 11 22</p>
  <p><i class='bx bx-time mr-2'></i> 24h/24</p>
  <a href="https://maps.google.com?q=Pharmacie+Universelle+Lomé" target="_blank" class="text-blue-600 hover:underline mt-2 inline-block">Voir sur la carte</a>
</div>

    </div>
  </main>

  <!-- Footer -->
   <footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid md:grid-cols-3 gap-8">
        <div>
          <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
              <i class='bx bx-plus-medical text-blue-600 text-xl'></i>
            </div>
            <span class="text-2xl font-bold">Dokitalink</span>
          </div>
          <p class="text-gray-300">Votre plateforme de confiance pour la santé connectée à Lomé et partout ailleurs.</p>
        </div>
        <div>
          <h4 class="font-bold mb-3">Services</h4>
          <ul class="space-y-2 text-gray-300">
            <li><a href="#" class="hover:text-white">Téléconsultation</a></li>
            <li><a href="#" class="hover:text-white">Rendez-vous</a></li>
            <li><a href="#" class="hover:text-white">Dossier médical</a></li>
            <li><a href="#" class="hover:text-white">Messagerie</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-bold mb-3">Contact</h4>
          <p class="flex items-center gap-2 text-gray-300"><i class='bx bx-map text-blue-400'></i> 123 Rue de la Santé, Lomé</p>
          <p class="flex items-center gap-2 text-gray-300"><i class='bx bx-phone text-blue-400'></i> +228 90 08 32 72</p>
          <p class="flex items-center gap-2 text-gray-300"><i class='bx bx-envelope text-blue-400'></i> info@dokitalink.com</p>
        </div>
      </div>
      <div class="text-center text-gray-400 text-sm mt-8 border-t border-gray-700 pt-4">
        &copy; 2025 Dokitalink. Tous droits réservés.
      </div>
    </div>
  </footer>

  <script>
    function filterPharmacies() {
      const input = document.getElementById("searchInput").value.toLowerCase();
      const cards = document.querySelectorAll("#pharmacyList .pharmacy-card, #pharmacyList div");
      cards.forEach(card => {
        card.style.display = card.innerText.toLowerCase().includes(input) ? "block" : "none";
      });
    }
  </script>
</body>
</html>
