<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inscription - Dokitalink</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Inscription</h2>
    <form action="process_register.php" method="post">
        <input type="text" name="nom" placeholder="Nom complet" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        <select name="role">
            <option value="patient">Patient</option>
            <option value="medecin">Médecin</option>
        </select>
        <button type="submit">Créer un compte</button>
    </form>
    <p>Déjà inscrit ? <a href="index.php">Se connecter</a></p>
</body>
</html>