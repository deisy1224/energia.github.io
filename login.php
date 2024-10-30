<?php
include 'conexion.php'; // Conectar a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Buscar al usuario por email
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El usuario existe, verificar la contraseña
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Inicio de sesión exitoso. Bienvenido, " . $row['nombre'];
            // Aquí puedes redirigir al usuario o iniciar una sesión
            // session_start();
            // $_SESSION['nombre'] = $row['nombre'];
            // header("Location: dashboard.php");
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No existe una cuenta con este correo electrónico.";
    }

    $conn->close(); // Cerrar la conexión
}
?>
