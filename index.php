
<?php

session_start();
$nom = isset($_SESSION['nom']) ? htmlspecialchars($_SESSION['nom']) : "Utilisateur";

?><!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dokitalink - Votre santé en ligne</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    * {
      font-family: 'Inter', sans-serif;
    }
    
    .gradient-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .card-hover {
      transition: all 0.3s ease;
    }
    
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    
    .hero-pattern {
      background-image: url("https://www.baker.edu/wp-content/uploads/22-BC-539-SEO-How_To_Find_a_Career_in_Telehealth-2x-v1.jpg");
    }
    
    .pulse-dot {
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }
     /* Chatbot Styles */
    .chatbot-container {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
    }
    
    .chatbot-button {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      cursor: pointer;
      box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
    }
    
    .chatbot-button:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 25px rgba(2, 44, 233, 0.6);
    }
    
    .chatbot-window {
      position: absolute;
      bottom: 80px;
      right: 0;
      width: 350px;
      height: 500px;
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
      transform: scale(0);
      transform-origin: bottom right;
      transition: all 0.3s ease;
      overflow: hidden;
    }
    
    .chatbot-window.open {
      transform: scale(1);
    }
    
    .chatbot-header {
      background: linear-gradient(135deg,rgb(14, 51, 216) 0%,rgb(6, 13, 231) 100%);
      color: white;
      padding: 20px;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    
    .chatbot-messages {
      height: 350px;
      overflow-y: auto;
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }
    
    .message {
      max-width: 80%;
      padding: 12px 16px;
      border-radius: 18px;
      font-size: 14px;
      line-height: 1.4;
    }
    
    .message.bot {
      background: #f1f5f9;
      color: #334155;
      align-self: flex-start;
      border-bottom-left-radius: 4px;
    }
    
    .message.user {
      background:rgb(10, 49, 220);
      color: white;
      align-self: flex-end;
      border-bottom-right-radius: 4px;
    }
    
    .chatbot-input {
      padding: 20px;
      border-top: 1px solid #e2e8f0;
      display: flex;
      gap: 8px;
    }
    
    .chatbot-input input {
      flex: 1;
      padding: 12px 16px;
      border: 1px solid #e2e8f0;
      border-radius: 25px;
      outline: none;
      font-size: 14px;
    }
    
    .chatbot-input input:focus {
      border-color: #667eea;
    }
    
    .chatbot-input button {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #667eea;
      color: white;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
    }
    
    .chatbot-input button:hover {
      background: #5a67d8;
      transform: scale(1.05);
    }
    
    .typing-indicator {
      display: flex;
      align-items: center;
      gap: 4px;
      padding: 12px 16px;
      background: #f1f5f9;
      border-radius: 18px;
      border-bottom-left-radius: 4px;
      align-self: flex-start;
      max-width: 80px;
    }
    
    .typing-dot {
      width: 6px;
      height: 6px;
      background: #64748b;
      border-radius: 50%;
      animation: typing 1.4s infinite ease-in-out;
    }
    
    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }
    
    @keyframes typing {
      0%, 60%, 100% { transform: translateY(0); }
      30% { transform: translateY(-10px); }
    }
    
    .quick-replies {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-top: 8px;
    }
    
    .quick-reply {
      background: white;
      border: 1px solid #667eea;
      color: #667eea;
      padding: 8px 12px;
      border-radius: 15px;
      font-size: 12px;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .quick-reply:hover {
      background: #667eea;
      color: white;
    }
    
    @media (max-width: 640px) {
      .chatbot-window {
        width: calc(100vw - 40px);
        height: 450px;
        bottom: 70px;
        right: -10px;
      }
    }
  </style>
 
</head>
<body class="bg-gray-50">

  <!-- Header Navigation -->
  <header class="bg-white shadow-sm border-b border-gray-100 fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
          <i class='bx bx-plus-medical text-white text-xl'></i>
        </div>
        <span class="text-2xl font-bold text-gray-900">Dokitalink</span>
      </div>
      <div class="hidden md:flex items-center gap-6">
        <a href="#" class="text-gray-600 hover:text-blue-600 font-medium">Nos Services</a>
        <a href="pharmacie.php" class="text-gray-600 hover:text-blue-600 font-medium">Pharmacie de garde</a>
        <a href="inscriptionmedecin.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
          Vous êtes soignant ?
        </a>
        <a href="inscrire.php" class="text-blue-600 hover:text-blue-700 font-medium">Se connecter</a>
      </div>
    </div>
  </div>
</header>


  <!-- Hero Section -->
  <section class="gradient-bg hero-pattern relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="text-white">
          <h1 class="text-5xl lg:text-6xl font-bold leading-tight mb-6">
            Prenez rendez-vous en ligne
            <span class="block text-blue-200">avec un professionnel de santé</span>
          </h1>
          <p class="text-xl text-blue-100 mb-8 leading-relaxed">
            Consultation en cabinet, par téléphone ou en visio. Disponible 7j/7 au Togo.
          </p>
          
          <!-- Search Bar -->
<div class="bg-gray-100 dark:bg-gray-800 rounded-2xl p-6 shadow-2xl mb-8">
  <div class="flex flex-col md:flex-row gap-4">
    <!-- Spécialité -->
    <div class="flex-1">
      <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Spécialité</label>
      <select id="specialite" class="w-full pl-3 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-black dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <option value="">-- Choisissez une spécialité --</option>
        <option value="Généraliste">Généraliste</option>
        <option value="Cardiologue">Cardiologue</option>
        <option value="Pédiatre">Pédiatre</option>
        <option value="Dermatologue">Dermatologue</option>
      </select>
    </div>
    <!-- Localisation -->
    <div class="flex-1">
      <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Localisation</label>
      <select id="localisation" class="w-full pl-3 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-black dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <option value="">-- Choisissez une ville --</option>
        <option value="Lomé">Lomé</option>
        <option value="Kara">Kara</option>
        <option value="Sokodé">Sokodé</option>
      </select>
    </div>
    <!-- Bouton -->
    <button onclick="filtrerMedecins()" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition self-end">
      Rechercher
    </button>
  </div>
</div>

<!-- Résultat -->
<div id="resultats" class="max-w-4xl mx-auto space-y-4 mb-12"></div>

<script>
  const medecins = [
    { nom: "Dr. Koffi", specialite: "Cardiologue", ville: "Lomé" },
    { nom: "Dr. Faty", specialite: "Pédiatre", ville: "Kara" },
    { nom: "Dr. Ali", specialite: "Généraliste", ville: "Lomé" },
    { nom: "Dr. Mensah", specialite: "Dermatologue", ville: "Sokodé" }
  ];

  function filtrerMedecins() {
  const specialite = document.getElementById("specialite").value;
  const ville = document.getElementById("localisation").value;
  const resultats = document.getElementById("resultats");
  resultats.innerHTML = "<p class='text-center text-gray-400'>Chargement...</p>";

  fetch(`rechercher_medecins.php?specialite=${encodeURIComponent(specialite)}&ville=${encodeURIComponent(ville)}`)
    .then(res => res.json())
    .then(data => {
      resultats.innerHTML = "";

      if (data.length === 0) {
        resultats.innerHTML = "<p class='text-center text-gray-600 dark:text-gray-300'>Aucun médecin trouvé pour ces critères.</p>";
        return;
      }

      data.forEach(m => {
        resultats.innerHTML += `
          <div class='bg-white dark:bg-gray-800 p-4 rounded-lg shadow'>
            <h3 class='text-lg font-semibold text-blue-700 dark:text-blue-300'>${m.nom}</h3>
            <p>${m.specialite} - ${m.ville}</p>
            <a href="prendre_rdv.php?medecin=${encodeURIComponent(m.nom)}"
               class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
              Prendre RDV
            </a>
          </div>`;
      });
    })
    .catch(() => {
      resultats.innerHTML = "<p class='text-center text-red-500'>Erreur lors de la recherche. Réessayez.</p>";
    });
}

</script>


          
          <!-- Quick Stats -->
          <div class="grid grid-cols-3 gap-6 text-center">
            <div>
              <div class="text-3xl font-bold mb-1">2000+</div>
              <div class="text-white-300 text-sm">Professionnels</div>
            </div>
            <div>
              <div class="text-3xl font-bold mb-1">50k+</div>
              <div class="text-white-300 text-sm">Patients</div>
            </div>
            <div>
              <div class="text-3xl font-bold mb-1">4.9/5</div>
              <div class="text-white-300 text-sm">Satisfaction</div>
            </div>
          </div>
        </div>
        
        <!-- Hero Image -->
        <div class="relative">
          <div class="relative z-10">
            <div class="w-full h-96 bg-gradient-to-br from-blue-100 to-purple-100 rounded-2xl shadow-2xl flex items-center justify-center">
              <div class="text-center">
                <div class="w-24 h-24 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                  <i class='bx bx-user-voice text-white text-4xl'></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">Téléconsultation</h3>
                <p class="text-gray-600">Consultation vidéo sécurisée</p>
              </div>
            </div>
          </div>
          <div class="absolute -top-4 -right-4 w-72 h-72 bg-blue-400 rounded-full opacity-20 blur-3xl"></div>
          <div class="absolute -bottom-4 -left-4 w-72 h-72 bg-purple-400 rounded-full opacity-20 blur-3xl"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section class="py-24 bg-gradient-to-br from-white to-blue-50 dark:from-gray-900 dark:to-gray-800">
  <div class="max-w-7xl mx-auto px-6 sm:px-8">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-extrabold text-blue-700 dark:text-white mb-4">🩺 Comment ça marche ?</h2>
      <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
        En trois étapes simples, accédez à votre santé en toute sérénité.
      </p>
    </div>

    <div class="grid md:grid-cols-3 gap-10">
      
      <!-- Étape 1 -->
      <div class="bg-white dark:bg-gray-700 p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 text-center transform hover:-translate-y-1">
        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-800 rounded-full flex items-center justify-center mx-auto mb-6">
          <i class='bx bx-search text-blue-600 dark:text-blue-200 text-3xl'></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">1. Trouvez</h3>
        <p class="text-gray-600 dark:text-gray-300">
          Recherchez un professionnel de santé près de chez vous ou en téléconsultation.
        </p>
      </div>

      <!-- Étape 2 -->
      <div class="bg-white dark:bg-gray-700 p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 text-center transform hover:-translate-y-1">
        <div class="w-16 h-16 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center mx-auto mb-6">
          <i class='bx bx-calendar text-green-600 dark:text-green-200 text-3xl'></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">2. Réservez</h3>
        <p class="text-gray-600 dark:text-gray-300">
          Choisissez votre créneau parmi les disponibilités en temps réel.
        </p>
      </div>

      <!-- Étape 3 -->
      <div class="bg-white dark:bg-gray-700 p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 text-center transform hover:-translate-y-1">
        <div class="w-16 h-16 bg-purple-100 dark:bg-purple-800 rounded-full flex items-center justify-center mx-auto mb-6">
          <i class='bx bx-video text-purple-600 dark:text-purple-200 text-3xl'></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">3. Consultez</h3>
        <p class="text-gray-600 dark:text-gray-300">
          Rendez-vous en cabinet, par téléphone ou en visioconférence.
        </p>
      </div>

    </div>
  </div>
</section>


  <!-- Features Grid -->
  <section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Tous vos services santé</h2>
        <p class="text-xl text-gray-600">Une plateforme complète pour gérer votre santé</p>
      </div>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-2xl shadow-sm card-hover border border-gray-100">
          <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
            <i class='bx bx-calendar-check text-blue-600 text-xl'></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Prise de rendez-vous</h3>
          <p class="text-gray-600 mb-4">Réservez en quelques clics avec des professionnels vérifiés</p>
          <div class="flex items-center text-sm text-blue-600 font-medium">
            <span class="pulse-dot w-2 h-2 bg-green-500 rounded-full mr-2"></span>
            Disponible 24h/24
          </div>
        </div>
        
        <div class="bg-white p-8 rounded-2xl shadow-sm card-hover border border-gray-100">
          <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-6">
            <i class='bx bx-message-dots text-green-600 text-xl'></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Messagerie sécurisée</h3>
          <p class="text-gray-600 mb-4">Communiquez avec vos praticiens en toute confidentialité</p>
          <div class="flex items-center text-sm text-green-600 font-medium">
            <i class='bx bx-shield-check mr-2'></i>
            Cryptage end-to-end
          </div>
        </div>
        
        <div class="bg-white p-8 rounded-2xl shadow-sm card-hover border border-gray-100">
          <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
            <i class='bx bx-folder text-purple-600 text-xl'></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Dossier médical</h3>
          <p class="text-gray-600 mb-4">Stockez tous vos documents médicaux en sécurité</p>
          <div class="flex items-center text-sm text-purple-600 font-medium">
            <i class='bx bx-cloud-upload mr-2'></i>
            Stockage illimité
          </div>
        </div>
        
        <div class="bg-white p-8 rounded-2xl shadow-sm card-hover border border-gray-100">
          <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
            <i class='bx bx-history text-orange-600 text-xl'></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Historique médical</h3>
          <p class="text-gray-600 mb-4">Suivez l'évolution de vos soins et traitements</p>
          <div class="flex items-center text-sm text-orange-600 font-medium">
            <i class='bx bx-download mr-2'></i>
            Export PDF
          </div>
        </div>
        
        <div class="bg-white p-8 rounded-2xl shadow-sm card-hover border border-gray-100">
          <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mb-6">
            <i class='bx bx-bell text-red-600 text-xl'></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Rappels personnalisés</h3>
          <p class="text-gray-600 mb-4">Ne manquez plus jamais un rendez-vous ou un traitement</p>
          <div class="flex items-center text-sm text-red-600 font-medium">
            <i class='bx bx-mobile mr-2'></i>
            SMS & Push
          </div>
        </div>
        
        <div class="bg-white p-8 rounded-2xl shadow-sm card-hover border border-gray-100">
          <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6">
            <i class='bx bx-cog text-indigo-600 text-xl'></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Paramètres avancés</h3>
          <p class="text-gray-600 mb-4">Personnalisez votre expérience selon vos besoins</p>
          <div class="flex items-center text-sm text-indigo-600 font-medium">
            <i class='bx bx-customize mr-2'></i>
            100% personnalisable
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-20 bg-blue-600">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
      <h2 class="text-4xl font-bold text-white mb-6">
        Prêt à prendre soin de votre santé ?
      </h2>
      <p class="text-xl text-blue-100 mb-8">
        Rejoignez des milliers de patients qui font confiance à Dokitalink
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="connexion.php" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg">
          Créer mon compte gratuit
        </a>
        <a href="#" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-4 rounded-xl font-bold text-lg transition">
          Découvrir la démo
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="grid md:grid-cols-4 gap-8">
        <div class="col-span-2">
          <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
              <i class='bx bx-plus-medical text-white text-xl'></i>
            </div>
            <span class="text-2xl font-bold">Dokitalink</span>
          </div>
          <p class="text-gray-400 mb-6 max-w-md">
            La plateforme de référence pour vos consultations médicales en ligne au Togo.
          </p>
          <div class="flex gap-4">
            <a href="https://www.facebook.com/share/p/1ANh4WLUJC/" target="_blank" 
               class="w-10 h-10 bg-gray-800 hover:bg-blue-600 rounded-lg flex items-center justify-center transition">
              <i class='bx bxl-facebook text-xl'></i>
            </a>
            <a href="https://www.tiktok.com/@dokitalink" target="_blank" 
               class="w-10 h-10 bg-gray-800 hover:bg-pink-600 rounded-lg flex items-center justify-center transition">
              <i class='bx bxl-tiktok text-xl'></i>
            </a>
            <a href="https://www.instagram.com/dokitalink" target="_blank" 
               class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-lg flex items-center justify-center transition">
              <i class='bx bxl-instagram text-xl'></i>
            </a>
          </div>
        </div>
        
        <div>
          <h4 class="font-bold mb-4">Services</h4>
          <ul class="space-y-2 text-gray-400">
            <li><a href="#" class="hover:text-white transition">Téléconsultation</a></li>
            <li><a href="#" class="hover:text-white transition">Rendez-vous</a></li>
            <li><a href="#" class="hover:text-white transition">Dossier médical</a></li>
            <li><a href="#" class="hover:text-white transition">Messagerie</a></li>
          </ul>
        </div>
        
        <div>
          <h4 class="font-bold mb-4">Contact</h4>
          <div class="space-y-2 text-gray-400">
            <p class="flex items-center gap-2">
              <i class='bx bx-map text-blue-400'></i>
              123 Rue de la Santé, Lomé
            </p>
            <p class="flex items-center gap-2">
              <i class='bx bx-phone text-blue-400'></i>
              +228 90 08 32 72
            </p>
            <p class="flex items-center gap-2">
              <i class='bx bx-envelope text-blue-400'></i>
              info@dokitalink.com
            </p>
          </div>
        </div>
      </div>
      
      <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
        <p>&copy; 2025 <strong class="text-white">Dokitalink</strong>. Tous droits réservés.</p>
      </div>
    </div>
  </footer>
 <!-- Chatbot -->
  <div class="chatbot-container">
    <!-- Bouton du chatbot -->
    <button class="chatbot-button" onclick="toggleChat()">
      <i class='bx bx-message-dots' id="chat-icon"></i>
      <i class='bx bx-x' id="close-icon" style="display: none;"></i>
    </button>
    
    <!-- Fenêtre du chatbot -->
    <div class="chatbot-window" id="chatbot-window">
      <!-- Header -->
      <div class="chatbot-header">
        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
          <i class='bx bx-bot text-white text-xl'></i>
        </div>
        <div>
          <h3 class="font-bold text-lg"> Dokitabot</h3>
          
        </div>
      </div>

      <!-- Messages -->
      <div class="chatbot-messages" id="chatbot-messages">
        <div class="message bot">
          👋 Bonjour ! Je suis l'assistant virtuel de Dokitalink. 
          
      
          
          <div class="quick-replies">
            <button class="quick-reply" onclick="sendQuickReply('Comment prendre rendez-vous ?')">📅 RDV</button>
            <button class="quick-reply" onclick="sendQuickReply('Quels sont vos tarifs ?')">💰 Tarifs</button>
            <button class="quick-reply" onclick="sendQuickReply('Téléconsultation comment ça marche ?')">💻 Téléconsultation</button>
          </div>
        </div>
      </div>
      
      <!-- Input -->
      <div class="chatbot-input">
        <input type="text" id="chat-input" placeholder="Tapez votre message..." onkeypress="handleKeyPress(event)">
        <button onclick="sendMessage()">
          <i class='bx bx-send'></i>
        </button>
      </div>
    </div>
  </div>

  <script>
    let chatOpen = false;
    
    // Base de connaissances étendue pour l'IA du chatbot
    const knowledgeBase = {
      // Salutations et politesse
      greetings: {
        keywords: ['bonjour', 'bonsoir', 'salut', 'hello', 'hi', 'coucou', 'hey'],
        responses: [
          '👋 Bonjour ! Je suis ravi de vous aider aujourd\'hui. Que puis-je faire pour vous ?',
          '😊 Salut ! Comment allez-vous ? En quoi puis-je vous être utile ?',
          '🌟 Hello ! Bienvenue sur Dokitalink. Comment puis-je vous assister ?'
        ]
      },
      
      // Rendez-vous
      appointments: {
        keywords: ['rendez-vous', 'rdv', 'consultation', 'réserver', 'prendre', 'booking', 'disponibilité', 'créneau'],
        responses: [
          '📅 **Prise de rendez-vous facile !**\n\n✅ **Comment procéder :**\n1. Utilisez la barre de recherche en haut\n2. Saisissez votre spécialité ou symptôme\n3. Choisissez votre ville (Lomé, Kara, etc.)\n4. Sélectionnez votre créneau préféré\n5. Confirmez en 1 clic !\n\n🕐 **Disponibilités :** 7j/7, même le weekend\n💡 **Astuce :** Créez un compte pour réserver plus rapidement !',
          '📋 **Réservation simplifiée**\n\nVous pouvez prendre RDV pour :\n• 👩‍⚕️ Consultation en cabinet\n• 📞 Consultation téléphonique\n• 💻 Téléconsultation vidéo\n\n⏰ **Créneaux disponibles :** Matin, après-midi, soir\n🔄 **Modification :** Possible jusqu\'à 2h avant'
        ]
      },
      
      // Téléconsultation
      telemedicine: {
        keywords: ['téléconsultation', 'visio', 'vidéo', 'ligne', 'distance', 'webcam', 'appel vidéo', 'consultation en ligne'],
        responses: [
          '💻 **Téléconsultation - Votre médecin à domicile !**\n\n✨ **Avantages :**\n• 🏠 Depuis chez vous, confortablement\n• ⚡ Consultation immédiate disponible\n• 🔒 100% sécurisé et confidentiel\n• 💊 Ordonnance électronique possible\n• 💰 Tarif réduit : 10 000 FCFA\n\n📱 **Compatible :** Smartphone, tablette, ordinateur\n🕐 **Horaires :** 7j/7 de 6h à 22h',
          '🌐 **Consultation vidéo professionnelle**\n\n👨‍⚕️ **Spécialités disponibles :**\n• Médecine générale\n• Pédiatrie\n• Gynécologie\n• Dermatologie\n• Psychiatrie\n\n🎯 **Parfait pour :** Suivi, renouvellement, conseil médical\n⚠️ **Non adapté pour :** Urgences vitales'
        ]
      },
      
      // Urgences
      emergency: {
        keywords: ['urgence', 'urgent', 'grave', 'douleur', 'mal', 'samu', 'hôpital', 'aide', 'vite', 'maintenant'],
        responses: [
          '🚨 **URGENCES MÉDICALES**\n\n⚡ **Urgence vitale :**\n📞 **Appelez immédiatement le 15 (SAMU)**\n🏥 **Ou rendez-vous aux urgences**\n\n🟡 **Urgence non vitale :**\n• Téléconsultation rapide disponible\n• Créneaux d\'urgence en 30 minutes\n• Médecins de garde 24h/24\n\n💡 **Besoin d\'aide pour évaluer ?** Décrivez-moi vos symptômes.',
          '⚕️ **Évaluation de l\'urgence**\n\n🔴 **Appelez le 15 si :**\n• Douleur thoracique intense\n• Difficultés respiratoires\n• Perte de conscience\n• Hémorragie importante\n\n🟠 **Téléconsultation rapide pour :**\n• Fièvre élevée\n• Douleurs persistantes\n• Symptômes inquiétants\n\n💬 **Décrivez-moi votre situation pour un conseil personnalisé**'
        ]
      },
      
      // Tarifs et prix
      pricing: {
        keywords: ['prix', 'tarif', 'coût', 'combien', 'payer', 'payement', 'facturation', 'remboursement', 'mutuelle', 'assurance'],
        responses: [
          '💰 **Tarifs transparents Dokitalink**\n\n🏥 **Consultations en cabinet :**\n• Médecin généraliste : 15 000 FCFA\n• Spécialiste : 20 000 - 30 000 FCFA\n\n💻 **Téléconsultations :**\n• Toutes spécialités : 10 000 FCFA\n• Consultation d\'urgence : 12 000 FCFA\n\n✅ **Services gratuits :**\n• Création de compte\n• Messagerie sécurisée\n• Stockage documents\n\n💳 **Paiement :** CB, Mobile Money, Espèces\n🏛️ **Remboursement :** Selon votre mutuelle'
        ]
      },
      
      // Spécialités médicales
      specialties: {
        keywords: ['spécialité', 'spécialiste', 'médecin', 'docteur', 'cardiologue', 'gynécologue', 'pédiatre', 'dermatologue', 'psychiatre', 'généraliste'],
        responses: [
          '👨‍⚕️ **Nos spécialités médicales**\n\n🩺 **Médecine générale**\n👶 **Pédiatrie** - Enfants et adolescents\n👩 **Gynécologie-Obstétrique**\n❤️ **Cardiologie** - Cœur et vaisseaux\n🧠 **Neurologie** - Système nerveux\n🦴 **Orthopédie** - Os et articulations\n👁️ **Ophtalmologie** - Yeux et vision\n🦷 **Dentaire** - Soins dentaires\n🧘 **Psychiatrie** - Santé mentale\n🔬 **Dermatologie** - Peau et cheveux\n\n📍 **Disponibles à Lomé, Kara, Sokodé et en téléconsultation !**',
          '⚕️ **Trouvez le bon spécialiste**\n\nQuelle spécialité recherchez-vous ?\n• 🫀 **Cardiologue** pour le cœur\n• 👶 **Pédiatre** pour les enfants\n• 👩 **Gynécologue** pour la femme\n• 🧠 **Neurologue** pour le système nerveux\n• 👁️ **Ophtalmologue** pour les yeux\n• 🦴 **Orthopédiste** pour les os\n• 🧘 **Psychiatre** pour le mental\n\n💡 **Dites-moi vos symptômes, je vous orienterai !**'
        ]
      },
      
      // Compte utilisateur
      account: {
        keywords: ['compte', 'inscription', 'créer', 'profil', 'connexion', 'mot de passe', 'email', 'identifiant'],
        responses: [
          '👤 **Création de compte - Simple et rapide !**\n\n📝 **Étapes :**\n1️⃣ Cliquez sur "Créer un compte"\n2️⃣ Remplissez vos informations personnelles\n3️⃣ Vérifiez votre email\n4️⃣ Connectez-vous et profitez !\n\n✅ **Avantages du compte :**\n• 📅 Réservation express\n• 📁 Dossier médical sécurisé\n• 💬 Messagerie avec vos médecins\n• 🔔 Rappels automatiques\n• 📊 Historique de vos consultations\n\n🆓 **100% gratuit et sécurisé !**'
        ]
      },
      
      // Aide et support
      help: {
        keywords: ['aide', 'help', 'problème', 'bug', 'support', 'technique', 'marche pas', 'fonctionne pas', 'comment'],
        responses: [
          '🆘 **Support technique Dokitalink**\n\n💡 **Je peux vous aider avec :**\n• 🔐 Problèmes de connexion\n• 📱 Utilisation de la plateforme\n• 🎥 Configuration téléconsultation\n• 💳 Questions de paiement\n• 📧 Problèmes d\'email\n\n📞 **Contact direct :**\n• Téléphone : +228 90 08 32 72\n• Email : support@dokitalink.com\n• WhatsApp : Disponible 9h-18h\n\n⏰ **Horaires support :** Lun-Ven 8h-20h, Sam 9h-17h'
        ]
      },
      
      // Horaires et disponibilités
      schedule: {
        keywords: ['horaire', 'heure', 'ouvert', 'fermé', 'disponible', 'quand', 'planning', 'weekend'],
        responses: [
          '🕐 **Nos horaires de service**\n\n📅 **Plateforme en ligne :** 24h/24, 7j/7\n\n👨‍⚕️ **Consultations :**\n• Lundi-Vendredi : 7h-20h\n• Samedi : 8h-18h\n• Dimanche : 9h-16h\n\n💻 **Téléconsultations :**\n• Tous les jours : 6h-22h\n• Urgences : 24h/24\n\n📞 **Support client :**\n• Lun-Ven : 8h-20h\n• Sam : 9h-17h\n• Urgences : Toujours disponibles'
        ]
      }
    };
    
    // Messages de fallback quand aucun mot-clé n'est trouvé
    const fallbackResponses = [
      '🤔 Je comprends votre question, mais j\'aimerais mieux vous aider !\n\n💡 **Vous pouvez me demander :**\n• "Comment prendre rendez-vous ?"\n• "Quels sont vos tarifs ?"\n• "Téléconsultation disponible ?"\n• "Urgence médicale que faire ?"\n\n📞 **Pour une aide personnalisée :** +228 90 08 32 72',
      '🎯 **Précisez votre demande pour une réponse adaptée !**\n\nJe peux vous renseigner sur :\n• 📅 Rendez-vous et réservations\n• 💻 Téléconsultations\n• 💰 Tarifs et remboursements\n• 👨‍⚕️ Spécialités médicales\n• 🆘 Urgences et support\n\n💬 **Reformulez ou contactez-nous directement !**',
      '🔍 **Je n\'ai pas tout compris, mais je veux vous aider !**\n\n✨ **Essayez des questions comme :**\n• "Quel médecin pour mal de tête ?"\n• "Prix consultation gynécologue ?"\n• "Comment créer mon compte ?"\n• "Disponibilités ce weekend ?"\n\n🤝 **Notre équipe reste disponible au +228 90 08 32 72**'
    ];
    
    function toggleChat() {
      const window = document.getElementById('chatbot-window');
      const chatIcon = document.getElementById('chat-icon');
      const closeIcon = document.getElementById('close-icon');
      
      chatOpen = !chatOpen;
      
      if (chatOpen) {
        window.classList.add('open');
        chatIcon.style.display = 'none';
        closeIcon.style.display = 'block';
      } else {
        window.classList.remove('open');
        chatIcon.style.display = 'block';
        closeIcon.style.display = 'none';
      }
    }
    
    function sendMessage() {
      const input = document.getElementById('chat-input');
      const message = input.value.trim();
      
      if (message) {
        addMessage(message, 'user');
        input.value = '';
        
        // Simuler une réponse du bot
        setTimeout(() => {
          showTyping();
          setTimeout(() => {
            hideTyping();
            respondToMessage(message);
          }, 1500);
        }, 500);
      }
    }
    
    function sendQuickReply(message) {
      addMessage(message, 'user');
      setTimeout(() => {
        showTyping();
        setTimeout(() => {
          hideTyping();
          respondToMessage(message);
        }, 1000);
      }, 300);
    }
    
    function addMessage(text, sender) {
      const messagesContainer = document.getElementById('chatbot-messages');
      const messageDiv = document.createElement('div');
      messageDiv.className = `message ${sender}`;
      messageDiv.textContent = text;
      
      messagesContainer.appendChild(messageDiv);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    
    function showTyping() {
      const messagesContainer = document.getElementById('chatbot-messages');
      const typingDiv = document.createElement('div');
      typingDiv.className = 'typing-indicator';
      typingDiv.id = 'typing';
      typingDiv.innerHTML = '<div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div>';
      
      messagesContainer.appendChild(typingDiv);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    
    function hideTyping() {
      const typing = document.getElementById('typing');
      if (typing) {
        typing.remove();
      }
    }
    
    function respondToMessage(userMessage) {
      const message = userMessage.toLowerCase().trim();
      let response = null;
      let matchedCategory = null;
      
      // Recherche intelligente dans la base de connaissances
      for (const [category, data] of Object.entries(knowledgeBase)) {
        const keywords = data.keywords;
        const hasMatch = keywords.some(keyword => message.includes(keyword));
        
        if (hasMatch) {
          matchedCategory = category;
          // Sélection aléatoire d'une réponse pour varier
          const responses = data.responses;
          response = responses[Math.floor(Math.random() * responses.length)];
          break;
        }
      }
      
      // Si aucune correspondance trouvée, utiliser une réponse de fallback
      if (!response) {
        response = fallbackResponses[Math.floor(Math.random() * fallbackResponses.length)];
      }
      
      // Affichage de la réponse
      const messagesContainer = document.getElementById('chatbot-messages');
      const messageDiv = document.createElement('div');
      messageDiv.className = 'message bot';
      messageDiv.style.whiteSpace = 'pre-line';
      messageDiv.innerHTML = response;
      
      messagesContainer.appendChild(messageDiv);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;
      
      // Ajouter des suggestions contextuelles
      addContextualSuggestions(matchedCategory, messagesContainer);
    }
    
    function addContextualSuggestions(category, container) {
      // Suggestions basées sur la catégorie détectée
      const suggestions = {
        appointments: ['Voir les disponibilités', 'Spécialités disponibles', 'Tarifs consultation'],
        telemedicine: ['Comment ça marche ?', 'Matériel nécessaire', 'Prendre RDV visio'],
        emergency: ['Évaluer mon cas', 'Numéros d\'urgence', 'Téléconsultation rapide'],
        pricing: ['Modes de paiement', 'Remboursement mutuelle', 'Tarif téléconsultation'],
        specialties: ['Voir tous les médecins', 'Prendre RDV spécialiste', 'Conseil orientation'],
        account: ['Créer mon compte', 'Problème connexion', 'Récupérer mot de passe'],
        help: ['Contacter support', 'Guide utilisation', 'Signaler un bug']
      };
      
      if (category && suggestions[category]) {
        setTimeout(() => {
          const suggestionsDiv = document.createElement('div');
          suggestionsDiv.className = 'message bot';
          suggestionsDiv.innerHTML = `
            <div style="margin-top: 10px;">
              <small style="color: #64748b;">💡 Questions fréquentes :</small>
              <div class="quick-replies" style="margin-top: 8px;">
                ${suggestions[category].map(suggestion => 
                  `<button class="quick-reply" onclick="sendQuickReply('${suggestion}')">${suggestion}</button>`
                ).join('')}
              </div>
            </div>
          `;
          
          container.appendChild(suggestionsDiv);
          container.scrollTop = container.scrollHeight;
        }, 1000);
      }
    }
    
    // Fonction améliorée pour les réponses rapides
    function sendQuickReply(message) {
      addMessage(message, 'user');
      setTimeout(() => {
        showTyping();
        setTimeout(() => {
          hideTyping();
          respondToMessage(message);
        }, Math.random() * 1000 + 800); // Délai variable pour plus de réalisme
      }, 300);
    }
    
    function handleKeyPress(event) {
      if (event.key === 'Enter') {
        sendMessage();
      }
    }
    
    // Animation d'attention périodique
    setInterval(() => {
      if (!chatOpen) {
        const button = document.querySelector('.chatbot-button');
        button.style.animation = 'pulse 1s ease-in-out';
        setTimeout(() => {
          button.style.animation = '';
        }, 1000);
      }
    }, 10000);
  </script>
</body>
</html>