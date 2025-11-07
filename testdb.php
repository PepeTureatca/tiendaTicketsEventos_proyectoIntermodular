<?php
$conn = mysqli_connect('localhost','appuser','app1234','user_db');

if ($conn) {
  echo "✅ Conexión correcta a la base de datos";
} else {
  echo "❌ Error: " . mysqli_connect_error();
}
?>
