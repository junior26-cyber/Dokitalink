<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inscription - Dokitalink</title>
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <style>
    :root {
      --main-color: #0026ff;
      --bg-color: rgba(255, 255, 255, 0.95);
      --accent: #00bcd4;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: url('https://www.baker.edu/wp-content/uploads/22-BC-539-SEO-How_To_Find_a_Career_in_Telehealth-2x-v1.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      backdrop-filter: blur(4px);
      background-color: rgba(0, 0, 0, 0.4);
      z-index: 0;
    }

    .signup-container {
      background-color: var(--bg-color);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 420px;
      position: relative;
      z-index: 1;
      animation: fadeIn 0.8s ease-in-out;
    }

    .signup-container img.logo {
      display: block;
      margin: 0 auto 20px;
      width: 100px;
    }

    h2 {
      text-align: center;
      color: var(--main-color);
      margin-bottom: 30px;
    }

    input {
      width: 100%;
      padding: 12px 14px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
      transition: border 0.3s ease;
    }

    input:focus {
      border-color: var(--main-color);
      outline: none;
    }

    .password-container {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 12px;
      transform: translateY(-50%);
      font-size: 18px;
      color: #888;
      cursor: pointer;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: var(--main-color);
      color: white;
      font-size: 1rem;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #001ec7;
    }

    .link-login {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: var(--main-color);
      text-decoration: none;
      font-weight: bold;
    }

    .link-login:hover {
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="signup-container">
    <img class="logo" src="images/logo2.png" alt="Logo Dokitalink" />
    <h2>Créer un compte</h2>
    <form action="traitement_inscription.php" method="POST">
      <input type="text" name="nom" placeholder="Nom" required />
      <input type="text" name="prenom" placeholder="Prénom" required />
      <input type="text" name="date_naissance" placeholder="Date de naissance (ex: 2001-12-31)" required />
      <input type="text" name="adresse" placeholder="Adresse" required />
      <input type="text" name="telephone" placeholder="Numéro de téléphone" required />
      <input type="email" name="email" placeholder="Adresse email" required />
      <input type="hidden" name="role" value="patient" />

      <div class="password-container">
        <input type="password" name="mot_de_passe" id="password" placeholder="Mot de passe" required />
        <i class='bx bx-show toggle-password' onclick="togglePassword('password')"></i>
      </div>

      <button type="submit">S'inscrire</button>
    </form>
    <a class="link-login" href="index.php">Déjà inscrit ? Se connecter</a>
  </div>

  <script>
    function togglePassword(id) {
      const input = document.getElementById(id);
      input.type = input.type === "password" ? "text" : "password";
    }
  </script>

</body>
</html>
