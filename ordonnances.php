<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'healf_bridge');
$res = $conn->query("SELECT * FROM ordonnances WHERE id_patient={$_SESSION['user']['id']}");
while($o = $res->fetch_assoc()) echo "<p>" . $o['contenu'] . "</p>";
?>