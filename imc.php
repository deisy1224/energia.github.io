<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto si es necesario
$password = ""; // Cambia esto si es necesario
$dbname = "energiasaludable";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['altura'];
    $phone = $_POST['peso'];

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("INSERT INTO usuarios (name, altura, peso) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $altura, $peso);

    if ($stmt->execute()) {
        echo "Registro exitoso.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
