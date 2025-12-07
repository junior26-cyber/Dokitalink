<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Connexion - Dokitalink</title>
  <link rel="stylesheet" href="style.css">
  <style>
    :root {
      --main-color:rgb(3, 0, 167);
      --accent-color:rgb(0, 0, 230);
      --bg-light: #e0f2f1;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      background-image: url("https://www.baker.edu/wp-content/uploads/22-BC-539-SEO-How_To_Find_a_Career_in_Telehealth-2x-v1.jpg");
      background-size: cover;
      background-position: center;
      background-repeat: repeat;
      background-attachment: fixed;
      justify-content: center;
      align-items: center;
      height: 100vh;
      animation: fadeIn 1s ease-in;
    }
    body::before {
  content: "";
  position: absolute;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  backdrop-filter: blur(2px);
  background-color: rgba(92, 70, 70, 0.3); /* léger assombrissement si tu veux */
  z-index: 0;
}

body * {
  position: relative;
  z-index: 1;
}

    .login-container {
      background-color: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      color: var(--main-color);
      /* margin-bottom: 20px; */
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }

    .password-container {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 10px;
      top: 10px;
      cursor: pointer;
      color: #777;
      font-size: 0.9rem;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: var(--main-color);
      color: white;
      font-size: 1rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color:#73857b;
    }

    .link-home {
      display: block;
      margin-top: 20px;
      text-align: center;
      color: var(--accent-color);
      text-decoration: none;
      font-weight: bold;
    }

    .link-home:hover {
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .social-icon {
  display: flex;
  gap: 20px;
  margin-top: 30px;
}

.social-icon a {
  font-size: 2rem;
  transition: transform 0.3s ease;
}


.social-icon {
  display: flex;
  justify-content:right;
  gap: 20px;
  margin-top: 30px;
}

.social-icon a {
  font-size: 2.2rem;
  color: inherit;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background-color: #ffffff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.social-icon a[href*="facebook"] {
  color: #1877f2;
}

.social-icon a[href*="tiktok"] {
    color: #1877f2;

}
.social-icon a[href*="linkedin"] {
    color: #1877f2;
}
.social-icon a:hover {
  transform: scale(1.2);
  box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
}
.logo{
  padding: -50%;
}
  </style>
</head>
<body>

  <div class="login-container">
    <h1><img class="logo" src="images/logo2.png" alt="Logo" width="150px" height="150px" /> </h1>

    <h2>Connexion</h2>
    <form action="traitement_inscription.php" method="POST">
      <input type="email"  name="email" placeholder="Adresse email" required />
      <input type="hidden" name="role" value="patient" />
      <input type="hidden" name="telephone" value="0000000000" />
      <input type="hidden" name="nom" value="inconnu" />
      <input type="hidden" name="prenom" value="inconnu" />
      
      <div class="password-container">
        <input type="password" id="password" name="mot_de_passe" placeholder="Mot de passe" required />
        <span class="toggle-password" onclick="togglePassword()"></span>
      </div>
      
      <button type="submit">Se connecter</button>
    </form>
    <a class="link-home" href="index.php">← Retour à l’accueil</a>
    <a class="link-home" href="inscrire.php">S'inscrire</a>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      const type = passwordInput.getAttribute("type");
      passwordInput.setAttribute("type", type === "password" ? "text" : "password");
    }
  </script>

</body>
</html>
