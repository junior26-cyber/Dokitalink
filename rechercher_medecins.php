<?php
$host = "localhost";
$db = "medecine";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Erreur : " . $conn->connect_error);
}

$specialite = isset($_GET['specialite']) ? $_GET['specialite'] : '';
$ville = isset($_GET['ville']) ? $_GET['ville'] : '';

$sql = "SELECT * FROM medecins WHERE 1";
$params = [];
$types = '';

if ($specialite !== '') {
  $sql .= " AND specialite = ?";
  $types .= 's';
  $params[] = $specialite;
}
if ($ville !== '') {
  $sql .= " AND ville = ?";
  $types .= 's';
  $params[] = $ville;
}

$stmt = $conn->prepare($sql);

// Bind dynamique sécurisé
if (!empty($params)) {
  $tmp = [];
  $tmp[] = $types;
  foreach ($params as $key => $value) {
    $tmp[] = &$params[$key]; // important : références
  }
  call_user_func_array([$stmt, 'bind_param'], $tmp);
}

$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);

$stmt->close();
$conn->close();
?>
