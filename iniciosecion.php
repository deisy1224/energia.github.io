<?php
// Configuración de conexión a la base de datos
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "energiasaludable";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos ingresados en el formulario
    $email = $_POST['email']; // Cambiado a 'email' para que coincida con el HTML
    $password = $_POST['password'];

    // Validar que se reciban los datos
    if (empty($email) || empty($password)) {
        echo "Por favor, complete todos los campos.";
        exit();
    }

    // Preparar la consulta para verificar las credenciales
    $stmt = $conn->prepare("SELECT password FROM registro WHERE email = ?");
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();

    // Verificar la contraseña ingresada
    if ($storedPassword) {
        if ($storedPassword === $password) {
            header("Location: index.html");
            exit();
        } else {
            echo "Email o contraseña incorrectos.";
        }
    } else {
        echo "Email o contraseña incorrectos.";
    }

    // Cerrar la consulta
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
