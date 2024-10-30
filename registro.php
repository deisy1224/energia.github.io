<?php
// Configuración de la base de datos (ajusta estos valores a tu entorno)
$servername = "localhost";  // Servidor de la base de datos
$username = "root";         // Usuario de la base de datos
$password = "";             // Contraseña del usuario
$dbname = "energiasaludable";    // Nombre de la base de datos

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores enviados desde el formulario
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Hash de la contraseña para mayor seguridad
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO registro (name, email, password) VALUES ('$name', '$email', '$password')";


    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        header("Location:iniciosesion.html");
        exit();
    } else {
        echo "Error al registrar: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
